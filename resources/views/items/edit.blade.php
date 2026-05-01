@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit Item') }}: <span class="text-indigo-600">{{ $item->item_name }}</span>
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-8">

                    <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="space-y-8">

                            <div>
                                <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">Informasi Utama</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Item Name -->
                                    <div>
                                        <x-input-label for="item_name" :value="__('Nama Barang')" class="text-gray-700 font-semibold" />
                                        <x-text-input id="item_name" name="item_name" type="text" class="mt-1 block w-full bg-gray-50 focus:bg-white transition" :value="old('item_name', $item->item_name)" required />
                                        <x-input-error class="mt-2" :messages="$errors->get('item_name')" />
                                    </div>

                                    <!-- Item Code -->
                                    <div>
                                        <x-input-label for="item_kode" :value="__('Kode Barang')" class="text-gray-700 font-semibold" />
                                        <x-text-input id="item_kode" name="item_kode" type="text" class="mt-1 block w-full bg-gray-50 focus:bg-white transition" :value="old('item_kode', $item->item_kode)" required />
                                        <x-input-error class="mt-2" :messages="$errors->get('item_kode')" />
                                    </div>

                                    <!-- Category -->
                                    <div>
                                        <x-input-label for="category_id" :value="__('Kategori')" class="text-gray-700 font-semibold" />
                                        <select name="category_id" id="category_id" class="mt-1 block w-full border-gray-300 bg-gray-50 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm transition">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                                    </div>

                                    <!-- Brand -->
                                    <div>
                                        <x-input-label for="brand" :value="__('Brand / Merk')" class="text-gray-700 font-semibold" />
                                        <x-text-input id="brand" name="brand" type="text" class="mt-1 block w-full bg-gray-50 focus:bg-white transition" :value="old('brand', $item->brand)" />
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">Inventaris & Harga</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Stock -->
                                    <div>
                                        <x-input-label for="stock" :value="__('Stok')" class="text-gray-700 font-semibold" />
                                        <x-text-input id="stock" name="stock" type="number" class="mt-1 block w-full bg-gray-50 focus:bg-white transition" :value="old('stock', $item->stock)" required />
                                    </div>

                                    <!-- Price -->
                                    <div>
                                        <x-input-label for="price" :value="__('Harga (Rp)')" class="text-gray-700 font-semibold" />
                                        <x-text-input id="price" name="price" type="number" class="mt-1 block w-full bg-gray-50 focus:bg-white transition" :value="old('price', $item->price)" required />
                                        <x-input-error class="mt-2" :messages="$errors->get('price')" />
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">Detail Tambahan</h3>
                                <div class="space-y-6">
                                    <!-- Description -->
                                    <div>
                                        <x-input-label for="description" :value="__('Deskripsi')" class="text-gray-700 font-semibold" />
                                        <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 bg-gray-50 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm transition">{{ old('description', $item->description) }}</textarea>
                                    </div>

                                    <!-- Image -->
                                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                        <x-input-label for="image" :value="__('Foto Barang (Opsional, Maks 20MB)')" class="text-gray-700 font-semibold mb-2" />

                                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6">
                                            @if($item->image)
                                                <div class="relative group">
                                                    <img src="{{ asset('storage/' . $item->image) }}" alt="Preview" class="w-32 h-32 object-cover rounded-lg border-2 border-indigo-100 shadow-sm">
                                                    <span class="absolute bottom-1 left-1 bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">Foto Saat Ini</span>
                                                </div>
                                            @endif

                                            <div class="flex-1 w-full">
                                                <input type="file" name="image" id="image" class="block w-full text-sm text-gray-600
                                                    file:mr-4 file:py-2.5 file:px-4
                                                    file:rounded-md file:border-0
                                                    file:text-sm file:font-semibold
                                                    file:bg-indigo-600 file:text-white
                                                    hover:file:bg-indigo-700 hover:file:cursor-pointer transition" />
                                                <p class="text-xs text-gray-400 mt-2">Biarkan kosong jika tidak ingin mengubah foto. Format didukung: JPG, PNG, JPEG.</p>
                                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="flex justify-end items-center gap-4 mt-10 pt-6 border-t border-gray-200">
                            <a href="{{ route('items.index') }}" class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition shadow-sm">
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-2.5 bg-indigo-600 border border-transparent text-white font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition shadow-sm">
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
