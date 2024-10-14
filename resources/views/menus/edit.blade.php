<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Menu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('menu.update', $menu) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Name input -->
                        <div class="mb-4">
                            <label for="nama_menu" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Nama Menu') }}</label>
                            <input type="text" name="nama_menu" id="nama_menu" value="{{ old('nama_menu', $menu->nama_menu) }}" class="form-input w-full rounded-md shadow-sm" required>
                            @error('nama_menu')
                                <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description input -->
                        <div class="mb-4">
                            <label for="deskripsi" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Deskripsi') }}</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-input w-full rounded-md shadow-sm">{{ old('deskripsi', $menu->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- harga input -->
                        <div class="mb-4">
                            <label for="harga" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Harga') }}</label>
                            <input type="number" name="harga" id="harga" value="{{ old('harga', $menu->harga) }}" class="form-input w-full rounded-md shadow-sm" required>
                            @error('harga')
                                <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Image input -->
                        <div class="mb-4">
                            <label for="gambar" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Gambar') }}</label>
                            <input type="file" name="gambar" id="gambar" class="form-input w-full rounded-md shadow-sm">
                            @error('gambar')
                                <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Show current gambar if exists -->
                        @if($menu->gambar)
                            <div class="mb-4">
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Current gambar') }}</label>
                                <img src="{{ Storage::url($menu->gambar) }}" alt="{{ $menu->nama_menu }}" class="rounded-lg w-48 h-48 object-cover">
                            </div>
                        @endif

                        <!-- Submit button -->
                        <div class="flex items-center justify-end">
                            <a href="{{ route('menu.index') }}" class="ml-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">{{ __('Batal') }}</a>
                            <button type="submit" class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Ubah Menu') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
