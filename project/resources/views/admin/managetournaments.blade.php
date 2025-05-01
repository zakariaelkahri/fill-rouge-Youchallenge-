@extends('layouts.admin.master')

@section('admin-title')
    Manage Tournaments
@endsection

@section('main')
<div class="flex h-screen bg-gray-900">
    <div class="bg-gray-800 p-6 rounded-lg shadow-md w-full">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-gray-700 p-4 rounded-lg border border-gray-600 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-300">Total Tournaments</p>
                    <p class="text-2xl font-bold text-white">{{ $tournaments->count() }}</p>
                </div>
                <div class="bg-indigo-600 p-3 rounded-full">
                    <i class="fas fa-trophy text-xl text-white"></i>
                </div>
            </div>
            <div class="bg-gray-700 p-4 rounded-lg border border-gray-600 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-300">Validated Tournaments</p>
                    <p class="text-2xl font-bold text-white">{{ $tournaments->where('is_validated', 1)->count() }}</p>
                </div>
                <div class="bg-green-600 p-3 rounded-full">
                    <i class="fas fa-check-circle text-xl text-white"></i>
                </div>
            </div>
            <div class="bg-gray-700 p-4 rounded-lg border border-gray-600 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-300">Pending Validation</p>
                    <p class="text-2xl font-bold text-white">{{ $tournaments->where('is_validated', 0)->count() }}</p>
                </div>
                <div class="bg-yellow-600 p-3 rounded-full">
                    <i class="fas fa-clock text-xl text-white"></i>
                </div>
            </div>
            <div class="bg-gray-700 p-4 rounded-lg border border-gray-600 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-300">Active Now</p>
                    <p class="text-2xl font-bold text-white">{{ $tournaments->where('status', 'ongoing')->count() }}</p>
                </div>
                <div class="bg-blue-600 p-3 rounded-full">
                    <i class="fas fa-play-circle text-xl text-white"></i>
                </div>
            </div>
        </div>

        <!-- Tournaments Table -->
        <div class="overflow-x-auto rounded-lg border border-gray-700">
            <table class="w-full text-left text-sm bg-gray-900 text-gray-300">
                <thead class="bg-gray-700 text-gray-300">
                    <tr>
                        <th class="px-6 py-3">Tournament</th>
                        <th class="px-6 py-3">Game</th>
                        <th class="px-6 py-3">Start Date</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Participants</th>
                        <th class="px-6 py-3">Validation</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @if ($tournaments)
                          @foreach ($tournaments as $tournament)
                    <tr class="hover:bg-gray-700">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-lg overflow-hidden mr-3">
                                    <img src="{{ $tournament->getPhotoUrl() }}" alt="{{ $tournament->name }}" class="w-full h-full object-cover">
                                </div>
                                <span class="text-white font-medium">{{ $tournament->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">{{ $tournament->format }}</td>
                        <td class="px-6 py-4">{{ $tournament->start_date }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs leading-5 font-semibold rounded-full 
                                {{ $tournament->status == 'upcoming' ? 'bg-green-900 text-green-300' : '' }}
                                {{ $tournament->status == 'ongoing' ? 'bg-yellow-900 text-yellow-300' : '' }}
                                {{ $tournament->status == 'completed' ? 'bg-blue-900 text-blue-300' : '' }}">
                                {{ ucfirst($tournament->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            {{ $tournament->particpated_teams }}/{{ $tournament->max_participants }}
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{route('admin/apdate/tournament')}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                    class="px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-150
                                    {{ $tournament->is_validated 
                                        ? 'bg-green-600 hover:bg-green-700 text-white' 
                                        : 'bg-gray-600 hover:bg-gray-700 text-gray-200' }}">
                                    <i class="fas {{ $tournament->is_validated ? 'fa-check-circle' : 'fa-times-circle' }} mr-2"></i>
                                    {{ $tournament->is_validated ? 'Validated' : 'Not Validated' }}
                                </button>
                                <input type="hidden" name="tournament_id" value="{{ $tournament->id }}">
                                <input type="hidden" name="is_validated" value="{{ $tournament->is_validated ? '0' : '1' }}">
                            </form>
                        </td>
                    </tr>  
                    @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</div>

@if (session('success'))
<script>
Swal.fire({
    position: "center",
    icon: "success",
    title: @json(session('success') . ' 🎮'),
    showConfirmButton: false,
    timer: 2000,
    customClass: {
        popup: 'rounded-xl bg-gray-800 text-white'
    },
    background: '#1f2937'
});
</script>
@endif
@endsection