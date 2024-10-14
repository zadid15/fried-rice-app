<button {{ $attributes->merge(['class' => 'mb-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}>
    {{ $slot }}
</button>
