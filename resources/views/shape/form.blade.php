<div class="space-y-6">
    
    <div>
        <x-input-label for="route_id" :value="__('Route Id')"/>
        <x-text-input id="route_id" name="route_id" type="text" class="mt-1 block w-full" :value="old('route_id', $shape?->route_id)" autocomplete="route_id" placeholder="Route Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('route_id')"/>
    </div>
    <div>
        <x-input-label for="path" :value="__('Path')"/>
        <x-text-input id="path" name="path" type="text" class="mt-1 block w-full" :value="old('path', $shape?->path)" autocomplete="path" placeholder="Path"/>
        <x-input-error class="mt-2" :messages="$errors->get('path')"/>
    </div>
    <div>
        <x-input-label for="length_km" :value="__('Length Km')"/>
        <x-text-input id="length_km" name="length_km" type="text" class="mt-1 block w-full" :value="old('length_km', $shape?->length_km)" autocomplete="length_km" placeholder="Length Km"/>
        <x-input-error class="mt-2" :messages="$errors->get('length_km')"/>
    </div>
    <div>
        <x-input-label for="is_primary" :value="__('Is Primary')"/>
        <x-text-input id="is_primary" name="is_primary" type="text" class="mt-1 block w-full" :value="old('is_primary', $shape?->is_primary)" autocomplete="is_primary" placeholder="Is Primary"/>
        <x-input-error class="mt-2" :messages="$errors->get('is_primary')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>