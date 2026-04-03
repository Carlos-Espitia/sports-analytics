<?php

namespace App\Console\Commands;

use App\Models\Fixture;
use App\Models\MatchStat;
use App\Models\Season;
use App\Models\Standing;
use App\Models\Team;
use App\Services\FootballApiService;
use Illuminate\Console\Command;

class SyncFootballData extends Command
{
    protected $signature   = 'football:sync {--season= : The season slug to sync (defaults to all seasons)}';
    protected $description = 'Sync football data from API-Football into the database';

    public function handle(FootballApiService $api): void
    {
        $seasons = Season::whereNotNull('api_league_id')->get();

        if ($seasons->isEmpty()) {
            $this->error('No seasons with api_league_id found. Add api_league_id to your seasons first.');
            return;
        }

        foreach ($seasons as $season) {
            $this->info("Syncing: {$season->name}");

            $this->syncTeams($api, $season);
            $this->syncFixtures($api, $season);
            $this->syncStandings($api, $season);
            $this->syncMatchStats($api, $season);
        }

        $this->info('Sync complete.');
    }

    // -------------------------------------------------------
    // 1. Teams
    // -------------------------------------------------------
    private function syncTeams(FootballApiService $api, Season $season): void
    {
        $this->line('  → Syncing teams...');

        $response = $api->getTeams($season->api_league_id, $season->api_season_year);

        foreach ($response['response'] ?? [] as $item) {
            $t = $item['team'];

            Team::updateOrCreate(
                ['api_football_id' => $t['id']],
                [
                    'sport_id'   => $season->sport_id,
                    'name'       => $t['name'],
                    'short_name' => $t['code'] ?? null,
                    'logo_url'   => $t['logo'] ?? null,
                    'country'    => $t['country'] ?? null,
                    'city'       => $item['venue']['city'] ?? null,
                ]
            );
        }

        $this->line('     Done.');
    }

    // -------------------------------------------------------
    // 2. Fixtures
    // -------------------------------------------------------
    private function syncFixtures(FootballApiService $api, Season $season): void
    {
        $this->line('  → Syncing fixtures...');

        $response = $api->getFixtures($season->api_league_id, $season->api_season_year);

        foreach ($response['response'] ?? [] as $item) {
            $f        = $item['fixture'];
            $goals    = $item['goals'];
            $teams    = $item['teams'];
            $status   = $this->mapStatus($f['status']['short']);

            $homeTeam = Team::where('api_football_id', $teams['home']['id'])->first();
            $awayTeam = Team::where('api_football_id', $teams['away']['id'])->first();

            if (! $homeTeam || ! $awayTeam) {
                continue;
            }

            Fixture::updateOrCreate(
                ['api_football_id' => $f['id']],
                [
                    'season_id'    => $season->id,
                    'home_team_id' => $homeTeam->id,
                    'away_team_id' => $awayTeam->id,
                    'match_date'   => $f['date'],
                    'status'       => $status,
                    'home_score'   => $goals['home'],
                    'away_score'   => $goals['away'],
                    'venue'        => $f['venue']['name'] ?? null,
                ]
            );
        }

        $this->line('     Done.');
    }

    // -------------------------------------------------------
    // 3. Standings
    // -------------------------------------------------------
    private function syncStandings(FootballApiService $api, Season $season): void
    {
        $this->line('  → Syncing standings...');

        $response = $api->getStandings($season->api_league_id, $season->api_season_year);
        $rows     = $response['response'][0]['league']['standings'][0] ?? [];

        foreach ($rows as $row) {
            $team = Team::where('api_football_id', $row['team']['id'])->first();

            if (! $team) {
                continue;
            }

            Standing::updateOrCreate(
                ['season_id' => $season->id, 'team_id' => $team->id],
                [
                    'position'       => $row['rank'],
                    'played'         => $row['all']['played'],
                    'won'            => $row['all']['win'],
                    'drawn'          => $row['all']['draw'],
                    'lost'           => $row['all']['lose'],
                    'goals_for'      => $row['all']['goals']['for'],
                    'goals_against'  => $row['all']['goals']['against'],
                    'points'         => $row['points'],
                ]
            );
        }

        $this->line('     Done.');
    }

    // -------------------------------------------------------
    // 4. Match stats — only for finished fixtures missing stats
    // -------------------------------------------------------
    private function syncMatchStats(FootballApiService $api, Season $season): void
    {
        $this->line('  → Syncing match stats...');

        $fixtures = Fixture::where('season_id', $season->id)
            ->where('status', 'finished')
            ->whereDoesntHave('stats')
            ->whereNotNull('api_football_id')
            ->get();

        if ($fixtures->isEmpty()) {
            $this->line('     No new finished fixtures to sync stats for.');
            return;
        }

        foreach ($fixtures as $fixture) {
            $response = $api->getFixtureStatistics($fixture->api_football_id);

            foreach ($response['response'] ?? [] as $teamStats) {
                $team = Team::where('api_football_id', $teamStats['team']['id'])->first();

                if (! $team) {
                    continue;
                }

                $stats = collect($teamStats['statistics'])->pluck('value', 'type');

                MatchStat::updateOrCreate(
                    ['match_id' => $fixture->id, 'team_id' => $team->id],
                    [
                        'possession'       => (int) $stats->get('Ball Possession'),
                        'shots'            => $stats->get('Total Shots'),
                        'shots_on_target'  => $stats->get('Shots on Goal'),
                        'corners'          => $stats->get('Corner Kicks'),
                        'fouls'            => $stats->get('Fouls'),
                        'yellow_cards'     => $stats->get('Yellow Cards') ?? 0,
                        'red_cards'        => $stats->get('Red Cards') ?? 0,
                    ]
                );
            }
        }

        $this->line('     Done.');
    }

    // -------------------------------------------------------
    // Map API status codes to our simplified statuses
    // -------------------------------------------------------
    private function mapStatus(string $apiStatus): string
    {
        return match(true) {
            in_array($apiStatus, ['FT', 'AET', 'PEN']) => 'finished',
            in_array($apiStatus, ['1H', '2H', 'HT', 'ET', 'BT', 'P', 'LIVE']) => 'live',
            in_array($apiStatus, ['CANC', 'ABD', 'PST']) => 'cancelled',
            default => 'scheduled',
        };
    }
}
