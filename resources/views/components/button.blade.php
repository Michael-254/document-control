<button {{ $attributes->merge(['type' => 'submit', 'class' => 'h-8 px-4 m-2 text-sm text-indigo-100 transition-colors duration-150 bg-green-700 rounded-lg focus:shadow-outline hover:bg-green-800']) }}>
    {{ $slot }}
</button>
