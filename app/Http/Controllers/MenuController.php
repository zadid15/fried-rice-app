<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    // Menampilkan daftar menu
    public function index()
    {
        $menus = Menu::all();
        return view('menus.index', compact('menus'));
    }

    // Menampilkan form untuk membuat menu baru
    public function create()
    {
        return view('menus.create');
    }

    // Menyimpan menu baru ke database
    public function store(Request $request)
    {

        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Menyimpan gambar dan mendapatkan path
        $imagePath = $request->file('gambar')->store('menus', 'public');

        // Buat menu baru dengan path gambar
        Menu::create([
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'gambar' => $imagePath, // Simpan path gambar di database
        ]);

        return redirect()->route('menu.index')->with('success', 'Menu Baru Berhasil Ditambahkan !');
    }

    // Menampilkan form untuk mengedit menu yang ada
    public function edit(Menu $menu)
    {
        return view('menus.edit', compact('menu'));
    }

    // Memperbarui menu yang ada
    public function update(Request $request, Menu $menu)
    {
        // Validasi input termasuk file gambar
        $validated = $request->validate([
            'nama_menu' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
        ]);

        // Cek jika ada gambar yang di-upload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($menu->gambar) {
                Storage::delete($menu->gambar);
            }

            // Upload gambar baru dan simpan path-nya
            $validated['gambar'] = $request->file('gambar')->store('menus');
        }

        // Update menu dengan data baru
        $menu->update($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('menu.index')->with('success', 'Menu Berhasil Diubah !');
    }

    // Menghapus menu yang ada
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('menu.index')->with('success', 'Menu Berhasil Dihapus !');
    }
}
