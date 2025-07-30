@extends('dashboard.layouts-admin.admin')

@section('title', 'Profil Admin - Dinas Sosial Kota Majalengka')

@section('content')
<div class="p-6 bg-white shadow rounded">
    <h1 class="text-2xl font-bold mb-4">Profil Admin</h1>

    <div class="space-y-2">
        <p><strong>Nama:</strong> {{ $admin->name }}</p>
        <p><strong>Email:</strong> {{ $admin->email }}</p>
        <p><strong>Role:</strong> {{ ucfirst($admin->role) }}</p>
    </div>
</div>

@endsection