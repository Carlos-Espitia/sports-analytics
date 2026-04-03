import { Link } from '@inertiajs/react';

export default function AppLayout({ children }) {
    return (
        <div className="min-h-screen bg-gray-100">
            <nav className="bg-white shadow-sm">
                <div className="max-w-4xl mx-auto px-8 py-4 flex items-center gap-6">
                    <Link href="/" className="text-lg font-bold text-gray-800 mr-4">
                        Sports Analytics
                    </Link>
                    <Link href="/soccer/standings/premier-league-2024-25" className="text-sm text-gray-600 hover:text-gray-900">
                        Standings
                    </Link>
                    <Link href="/soccer/fixtures/premier-league-2024-25" className="text-sm text-gray-600 hover:text-gray-900">
                        Fixtures
                    </Link>
                </div>
            </nav>
            <main className="p-8">
                {children}
            </main>
        </div>
    );
}
