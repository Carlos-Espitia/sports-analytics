import AppLayout from '@/Layouts/AppLayout';

export default function Fixtures({ season, fixtures }) {
    const finished  = fixtures.filter(f => f.status === 'finished');
    const scheduled = fixtures.filter(f => f.status === 'scheduled');

    return (
        <AppLayout>
        <div className="max-w-3xl mx-auto">

                <h1 className="text-3xl font-bold text-gray-800 mb-1">Fixtures</h1>
                <p className="text-gray-500 mb-8">{season.name}</p>

                {finished.length > 0 && (
                    <section className="mb-8">
                        <h2 className="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Results</h2>
                        <div className="space-y-2">
                            {finished.map(fixture => (
                                <FixtureRow key={fixture.id} fixture={fixture} />
                            ))}
                        </div>
                    </section>
                )}

                {scheduled.length > 0 && (
                    <section>
                        <h2 className="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Upcoming</h2>
                        <div className="space-y-2">
                            {scheduled.map(fixture => (
                                <FixtureRow key={fixture.id} fixture={fixture} />
                            ))}
                        </div>
                    </section>
                )}

            </div>
        </AppLayout>
    );
}

function FixtureRow({ fixture }) {
    const date = new Date(fixture.match_date);
    const formatted = date.toLocaleDateString('en-GB', {
        day: 'numeric', month: 'short', year: 'numeric'
    });

    return (
        <div className="bg-white rounded-xl shadow-sm px-6 py-4 flex items-center justify-between">
            <div className="flex-1 text-right">
                <span className="font-semibold text-gray-800">{fixture.home_team.name}</span>
            </div>

            <div className="mx-6 text-center min-w-[80px]">
                {fixture.status === 'finished' ? (
                    <span className="text-xl font-bold text-gray-800">
                        {fixture.home_score} - {fixture.away_score}
                    </span>
                ) : (
                    <span className="text-sm text-gray-400">{formatted}</span>
                )}
            </div>

            <div className="flex-1 text-left">
                <span className="font-semibold text-gray-800">{fixture.away_team.name}</span>
            </div>
        </div>
    );
}
