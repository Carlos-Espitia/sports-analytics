export default function Home({ message }) {
    return (
        <div className="min-h-screen bg-gray-100 flex items-center justify-center">
            <div className="bg-white rounded-xl shadow p-8 text-center">
                <h1 className="text-3xl font-bold text-gray-800 mb-2">Sports Analytics</h1>
                <p className="text-gray-500">{message}</p>
            </div>
        </div>
    );
}
