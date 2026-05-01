@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <!-- Kotak Utama Dashboard -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">

                <!-- Bagian Welcome Message -->
                <div class="p-8 border-b border-gray-100 bg-white">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Selamat Datang di Sistem Manajemen Aset</h3>
                    <p class="text-gray-500">{{ __("You're logged in!") }} Silakan pilih menu di bawah ini untuk mengelola data sistem Anda.</p>
                </div>

                <!-- Bagian Menu Card -->
                <div class="p-8 bg-gray-50/50">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Menu 1: Kelola Barang Aset -->
                        <a href="{{ route('items.index') }}" class="flex items-start p-6 bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md hover:border-indigo-500 hover:ring-1 hover:ring-indigo-500 transition-all duration-200 group">
                            <!-- Ikon -->
                            <div class="p-3 bg-indigo-50 rounded-lg group-hover:bg-indigo-100 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <!-- Teks -->
                            <div class="ml-5">
                                <h4 class="text-lg font-bold text-gray-800 group-hover:text-indigo-600 transition-colors">Kelola Barang Aset</h4>
                                <p class="text-sm text-gray-500 mt-1">Tambah, edit, hapus, dan lihat daftar seluruh aset barang yang terdaftar.</p>
                            </div>
                        </a>

                        <!-- Menu 2: Kelola Kategori Aset -->
                        <a href="{{ route('categories.index') }}" class="flex items-start p-6 bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md hover:indigo-500 hover:ring-1 hover:ring-indigo-500 transition-all duration-200 group">
                            <!-- Ikon -->
                            <div class="p-3 bg-indigo-50 rounded-lg group-hover:bg-indigo-100 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <!-- Teks -->
                            <div class="ml-5">
                                <h4 class="text-lg font-bold text-gray-800 group-hover:text-indigo-600 transition-colors">Kelola Kategori Aset</h4>
                                <p class="text-sm text-gray-500 mt-1">Atur pengelompokan jenis dan kategori untuk memudahkan manajemen aset.</p>
                            </div>
                        </a>

                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
