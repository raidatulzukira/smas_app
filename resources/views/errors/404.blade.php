@extends('errors::minimal')

@section('title', __('Halaman Tidak Ditemukan'))

@section('code', '404')

@section('message')
    <div style="color: #00526A;">
        <h1 style="font-weight: bold;">Waduh! Halaman Hilang.</h1>
        <p>Maaf, halaman yang Anda cari di sistem SMAS APP tidak ditemukan.</p>
        <a href="/" style="color: #628b35; text-decoration: underline;">Kembali ke Dashboard</a>
    </div>
@endsection
