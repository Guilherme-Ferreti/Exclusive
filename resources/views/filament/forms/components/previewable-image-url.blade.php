@php
    $key = $getKey();
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div
        class="grid gap-4 w-full"
        x-data="{
            async validate() {
                await $wire.callSchemaComponentMethod(@js($key), 'isValidImageUrl');
            }
        }"
    >
        <x-filament::input.wrapper>
            <x-filament::input
                type="url"
                wire:model="{{ $getStatePath() }}"
                x-on:change="validate"
            />
        </x-filament::input.wrapper>

        <div class="w-full h-48 overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
            @if ($isValidImageUrl())
                <div class="size-full bg-gray-100 dark:bg-gray-900 p-2">
                    <img 
                        src="{{ $field->getState() }}"
                        alt="Preview" 
                        loading="lazy"
                        class="size-full object-contain"
                    />
                </div>
            @else
                <div class="size-full flex items-center justify-center">
                    <div class="text-center p-4">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Image Preview</p>
                        @if ($field->getState() !== null)
                            <p class="text-xs text-gray-400 dark:text-gray-500">Invalid image URL provided.</p>
                        @endif
                    </div>
                </div>
            @endif            
        </div>
    </div>
</x-dynamic-component>
