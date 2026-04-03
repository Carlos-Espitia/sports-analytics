import AppLayout from '@/Layouts/AppLayout';
import { router } from '@inertiajs/react';

export default function Standings({ season, standings, seasons }) {
    return (
        <AppLayout>
            <div className="max-w-4xl mx-auto">

                <div className="flex items-center justify-between mb-6">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-800">Standings</h1>
                        <p className="text-gray-500">{season.name}</p>
                    </div>
                    <SeasonSelector seasons={seasons} currentSlug={season.slug} type="standings" />
                </div>

                <div className="bg-white rounded-xl shadow overflow-hidden">
                    <table className="w-full text-sm">
                        <thead className="bg-gray-50 text-gray-500 uppercase text-xs tracking-wider">
                            <tr>
                                <th className="px-4 py-3 text-left w-8">#</th>
                                <th className="px-4 py-3 text-left">Team</th>
                                <th className="px-4 py-3 text-center">P</th>
                                <th className="px-4 py-3 text-center">W</th>
                                <th className="px-4 py-3 text-center">D</th>
                                <th className="px-4 py-3 text-center">L</th>
                                <th className="px-4 py-3 text-center">GF</th>
                                <th className="px-4 py-3 text-center">GA</th>
                                <th className="px-4 py-3 text-center">GD</th>
                                <th className="px-4 py-3 text-center font-bold text-gray-700">Pts</th>
                            </tr>
                        </thead>
                        <tbody className="divide-y divide-gray-100">
                            {standings.map((row) => (
                                <tr key={row.id} className="hover:bg-gray-50 transition-colors">
                                    <td className="px-4 py-3 text-gray-400">{row.position}</td>
                                    <td className="px-4 py-3 font-medium text-gray-800">{row.team.name}</td>
                                    <td className="px-4 py-3 text-center text-gray-600">{row.played}</td>
                                    <td className="px-4 py-3 text-center text-gray-600">{row.won}</td>
                                    <td className="px-4 py-3 text-center text-gray-600">{row.drawn}</td>
                                    <td className="px-4 py-3 text-center text-gray-600">{row.lost}</td>
                                    <td className="px-4 py-3 text-center text-gray-600">{row.goals_for}</td>
                                    <td className="px-4 py-3 text-center text-gray-600">{row.goals_against}</td>
                                    <td className="px-4 py-3 text-center text-gray-600">{row.goals_for - row.goals_against}</td>
                                    <td className="px-4 py-3 text-center font-bold text-gray-800">{row.points}</td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>

            </div>
        </AppLayout>
    );
}

function SeasonSelector({ seasons, currentSlug, type }) {
    function onChange(e) {
        router.visit(`/soccer/${type}/${e.target.value}`);
    }

    return (
        <select
            value={currentSlug}
            onChange={onChange}
            className="text-sm border border-gray-300 rounded-lg px-3 py-2 bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
            {seasons.map(s => (
                <option key={s.id} value={s.slug}>{s.name}</option>
            ))}
        </select>
    );
}
