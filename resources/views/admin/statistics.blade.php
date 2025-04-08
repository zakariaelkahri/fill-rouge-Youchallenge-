
    @extends('layouts.admin.master')

    @section('admin-title')
        statistics
    @endsection
    @section('main')

        <main class="flex-1 p-6">
            <h1 class="text-3xl font-bold mb-4 text-green-800">Welcome to the Admin Dashboard</h1>
            <p class="mb-4 text-green-600">Select an option from the sidebar to manage the application.</p>
            <h2 class="text-2xl font-bold mt-5 text-green-800">Statistics</h2>
            <div class="bg-green-50 rounded-lg shadow-lg mt-4 p-4 border border-green-200">
                <ul class="space-y-2">
                    <li class="flex justify-between p-4 bg-white rounded-lg border border-green-100">
                        <span>Total Users:</span>
                        <span class="font-semibold text-green-700">150</span>
                    </li>
                    <li class="flex justify-between p-4 bg-white rounded-lg border border-green-100">
                        <span>Total Tournaments:</span>
                        <span class="font-semibold text-green-700">25</span>
                    </li>
                    <li class="flex justify-between p-4 bg-white rounded-lg border border-green-100">
                        <span>Total Active Tournaments:</span>
                        <span class="font-semibold text-green-700">10</span>
                    </li>
                    <li class="flex justify-between p-4 bg-white rounded-lg border border-green-100">
                        <span>Total Teams:</span>
                        <span class="font-semibold text-green-700">40</span>
                    </li>
                    <li class="flex justify-between p-4 bg-white rounded-lg border border-green-100">
                        <span>Total Players:</span>
                        <span class="font-semibold text-green-700">300</span>
                    </li>
                    <li class="flex justify-between p-4 bg-white rounded-lg border border-green-100">
                        <span>Total Matches:</span>
                        <span class="font-semibold text-green-700">100</span>
                    </li>
                    <li class="flex justify-between p-4 bg-white rounded-lg border border-green-100">
                        <span>Total Completed Matches:</span>
                        <span class="font-semibold text-green-700">75</span>
                    </li>
                    <li class="flex justify-between p-4 bg-white rounded-lg border border-green-100">
                        <span>Total Players Registered This Month:</span>
                        <span class="font-semibold text-green-700">25</span>
                    </li>
                </ul>
            </div>
        </main>
    @endsection