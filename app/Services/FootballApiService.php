<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FootballApiService
{
    private string $baseUrl;
    private string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.football_api.base_url');
        $this->apiKey  = config('services.football_api.key');
    }

    // -------------------------------------------------------
    // Core HTTP method — all requests go through here
    // -------------------------------------------------------
    private function get(string $endpoint, array $params = []): array
    {
        $response = Http::withHeaders([
            'x-apisports-key' => $this->apiKey,
        ])->get("{$this->baseUrl}/{$endpoint}", $params);

        return $response->json();
    }

    // -------------------------------------------------------
    // Teams
    // -------------------------------------------------------
    public function getTeams(int $leagueId, int $season): array
    {
        return $this->get('teams', [
            'league' => $leagueId,
            'season' => $season,
        ]);
    }

    // -------------------------------------------------------
    // Standings
    // -------------------------------------------------------
    public function getStandings(int $leagueId, int $season): array
    {
        return $this->get('standings', [
            'league' => $leagueId,
            'season' => $season,
        ]);
    }

    // -------------------------------------------------------
    // Fixtures
    // -------------------------------------------------------
    public function getFixtures(int $leagueId, int $season): array
    {
        return $this->get('fixtures', [
            'league' => $leagueId,
            'season' => $season,
        ]);
    }

    // -------------------------------------------------------
    // Fixture statistics
    // -------------------------------------------------------
    public function getFixtureStatistics(int $fixtureId): array
    {
        return $this->get('fixtures/statistics', [
            'fixture' => $fixtureId,
        ]);
    }

    // -------------------------------------------------------
    // Players
    // -------------------------------------------------------
    public function getPlayers(int $leagueId, int $season, int $page = 1): array
    {
        return $this->get('players', [
            'league' => $leagueId,
            'season' => $season,
            'page'   => $page,
        ]);
    }
}
