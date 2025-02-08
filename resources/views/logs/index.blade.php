@extends('layouts.app')

@section('title', 'Logs')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-semibold mb-4">Log Aktivitas Anda</h2>

    <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">#</th>
                <th class="px-4 py-2">Aksi</th>
                <th class="px-4 py-2">Deskripsi</th>
                <th class="px-4 py-2">Waktu</th>
                <th class="px-4 py-2">IP Address</th>
                <th class="px-4 py-2">Device</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                <td class="px-4 py-2">{{ $log->action }}</td>
                <td class="px-4 py-2">{{ $log->description ?? '-' }}</td>
                <td class="px-4 py-2">{{ $log->created_at->format('d M Y, H:i') }}</td>
                <td class="px-4 py-2">{{ $log->ip_address }}</td>
                <td class="px-4 py-2">{{ $log->user_agent }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $logs->links() }}
    </div>
</div>
@endsection
