@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Daftar Aset Barang') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-700 mb-4">Manajemen Item</h3>

                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">

                        <div>
                            <a href="{{ route('items.create') }}" style="background-color: #4f46e5; color: white; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.375rem; text-decoration: none; display: inline-block;">
                                + Tambah Barang
                            </a>
                        </div>

                        <div style="width: 250px; position: relative;">
                            <form action="{{ route('items.index') }}" method="GET" style="margin: 0;">
                                <input type="search" name="search" placeholder="Cari barang..." value="{{ request('search') }}"
                                    style="width: 100%; height: 40px; padding-left: 1rem; padding-right: 2.5rem; border-radius: 0.5rem; border: 1px solid #d1d5db; outline: none; font-size: 0.875rem;">

                                <button type="submit" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #6b7280; padding: 0;">
                                    <svg style="height: 1rem; width: 1rem; fill: currentColor;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                                    </svg>
                                </button>
                            </form>
                        </div>

                    </div>
                </div>

                <div class="overflow-x-auto border border-gray-200 rounded-lg">
                    <table class="w-full bg-white text-sm text-gray-600">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 uppercase text-xs leading-normal border-b border-gray-200">
                                <th class="py-3 px-6 text-center w-20">Gambar</th>
                                <th class="py-3 px-6 text-center">Kode Barang</th>
                                <th class="py-3 px-6 text-left">Nama Barang</th>
                                <th class="py-3 px-6 text-center">Kategori</th>
                                <th class="py-3 px-6 text-center">Brand</th>
                                <th class="py-3 px-6 text-center">Stok</th>
                                <th class="py-3 px-6 text-center">Harga</th>
                                <th class="py-3 px-6 text-center">Deskripsi</th>
                                <th class="py-3 px-6 text-center w-28">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @forelse($items as $item)
                                <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                                    <td class="py-3 px-6 flex justify-center">
                                        <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://via.placeholder.com/150' }}"
                                            alt="img" class="w-14 h-14 object-cover rounded-md border shadow-sm">
                                    </td>
                                    <td class="py-3 px-6 text-center font-bold text-indigo-600">
                                        {{ $item->item_kode ?? $item->item_kode }}
                                    </td>
                                    <td class="py-3 px-6 text-left font-medium text-gray-800">
                                        {{ $item->item_name }}
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        {{ $item->category->name ?? 'N/A' }}
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        {{ $item->brand ?? '-' }}
                                    </td>
                                    <td class="py-3 px-6 text-center font-semibold">
                                        {{ $item->stock }}
                                    </td>
                                    <td class="py-3 px-6 text-center whitespace-nowrap">
                                        Rp {{ number_format($item->price ?? ($item->harga ?? 0), 0, ',', '.') }}
                                    </td>
                                    <td class="py-3 px-6 text-center truncate max-w-xs" title="{{ $item->description }}">
                                        {{ \Illuminate\Support\Str::limit($item->description ?? '-', 30) }}
                                    </td>

                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center space-x-3">
                                            <a href="{{ route('items.edit', $item->id) }}"
                                                class="w-4 transform text-gray-500 hover:text-indigo-600 hover:scale-110 transition duration-150"
                                                title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('items.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');"
                                                class="inline-block m-0 p-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="w-4 transform text-gray-500 hover:text-red-600 hover:scale-110 transition duration-150"
                                                    title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="py-10 text-center text-gray-400 italic">Data tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- <div class="overflow-x-auto border rounded-lg">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 uppercase text-xs leading-normal">
                                <th class="py-3 px-6 text-left w-20">Gambar</th>
                                <th class="py-3 px-6 text-left">Kode Barang</th>
                                <th class="py-3 px-6 text-left">Nama Barang</th>
                                <th class="py-3 px-6 text-left">Kategori</th>
                                <th class="py-3 px-6 text-left">Brand</th>
                                <th class="py-3 px-6 text-center">Stok</th>
                                <th class="py-3 px-6 text-center">Harga</th>
                                <th class="py-3 px-6 text-center">Deskripsi</th>
                                <th class="py-3 px-6 text-center w-28">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm">
                            @forelse($items as $item)
                                <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                                    <td class="py-3 px-6 text-left">
                                        <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://via.placeholder.com/150' }}"
                                            alt="img" class="w-14 h-14 object-cover rounded-md border shadow-sm">
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <span
                                            class="font-bold text-indigo-600">{{ $item->item_kode ?? $item->item_code }}</span>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <span class="text-gray-800 font-medium">{{ $item->item_name }}</span>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $item->category->name ?? 'N/A' }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $item->brand ?? '-' }}
                                    </td>
                                    <td class="py-3 px-6 text-center font-semibold">
                                        {{ $item->stock }}
                                    </td>
                                    <td class="py-3 px-6 text-center whitespace-nowrap">
                                        Rp {{ number_format($item->price ?? ($item->harga ?? 0), 0, ',', '.') }}
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        {{ \Illuminate\Support\Str::limit($item->description ?? '-', 30) }}
                                    </td>

                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center space-x-3">
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('items.edit', $item->id) }}"
                                                class="w-4 transform hover:text-indigo-600 hover:scale-110 transition duration-150"
                                                title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('items.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="w-4 transform hover:text-red-600 hover:scale-110 transition duration-150"
                                                    title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="py-10 text-center text-gray-400 italic">Data tidak
                                        ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div> --}}

                @if (method_exists($items, 'links'))
                    <div class="mt-4">
                        {{ $items->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
