<x-layouts.tus>
    <div class="max-w-2xl mx-auto mt-4">
        <div x-data="TusUppy({
                endpoint: '{{ route('laratus.options')}}'
            })">
            <div x-ref="uploadContainer">
            </div>
        </div>
    </div>


    @push('scripts')
        @vite(['resources/js/Tus/uppy.js'])
    @endpush
</x-layouts.tus>
