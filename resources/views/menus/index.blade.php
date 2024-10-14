<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Menu') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Menampilkan pesan sukses sebagai alert -->
            @if (session('success'))
                <div class="max-w-80 mb-5 p-4 text-center bg-green-100 border border-green-400 text-green-700 rounded">
                    <strong>{{ session('success') }}</strong>
                </div>
            @endif

            <x-button>
                <a href="{{ route('menu.create') }}">Tambah Menu</a>
            </x-button>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NO</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Menu</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Deskripsi</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Gambar</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Harga</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($menus as $menu)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $menu->nama_menu }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $menu->deskripsi }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($menu->gambar)
                                            <img src="{{ Storage::url($menu->gambar) }}" alt="{{ $menu->gambar }}"
                                                class="w-16 h-16 object-cover">
                                        @else
                                            <span class="text-gray-500">No Image Available</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $menu->harga }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('menu.edit', $menu) }}"
                                            class="inline-block bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">Ubah</a>
                                        <form action="{{ route('menu.destroy', $menu) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
