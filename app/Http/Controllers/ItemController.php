<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    /**
     */
    public function index(Request $request)
    {

        $query = Item::with('category')->latest();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('item_name', 'like', '%' . $search . '%')
                  ->orWhere('item_kode', 'like', '%' . $search . '%')
                  ->orWhere('brand', 'like', '%' . $search . '%');
        }

        $items = $query->paginate(10)->withQueryString();

        return view('items.index', compact('items'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name'   => 'required|string|max:255',
            'item_kode'   => 'required|string|unique:items,item_kode',
            'category_id' => 'required|exists:categories,id',
            'stock'       => 'required|integer|min:0',
            'brand'       => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:20480',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('assets/items', 'public');
        }

        \App\Models\Item::create($data);

        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     */
    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    /**
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'item_name'   => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'stock'       => 'required|integer|min:0',
            'price'       => 'required|numeric|min:0',
            'brand'       => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'item_kode'   => [
                'required',
                Rule::unique('items', 'item_kode')->ignore($item->id),
            ],
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:20480',
        ], [
            'item_kode.unique' => 'Kode item sudah digunakan oleh barang lain.',
            'image.max' => 'Ukuran gambar maksimal adalah 20MB.',
        ]);

        $data = $request->only([
            'item_name',
            'category_id',
            'item_kode',
            'stock',
            'price',
            'brand',
            'description'
        ]);

        if ($request->hasFile('image')) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }

            $path = $request->file('image')->store('assets/items', 'public');

            $data['image'] = $path;
        }

        $item->update($data);

        return redirect()->route('items.index')->with('success', 'Barang ' . $item->item_name . ' berhasil diperbarui!');
    }

    public function destroy(Item $item)
    {
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return redirect()->route('items.index')->with('success', 'Barang ' . $item->item_name . ' dipindahkan ke tempat sampah!');
    }
}
