<div class="space-y-6">
    
    <div>
        <x-input-label for="amenity_category_id" :value="__('Amenity Category Id')"/>
        <x-text-input id="amenity_category_id" name="amenity_category_id" type="text" class="mt-1 block w-full" :value="old('amenity_category_id', $amenity?->amenity_category_id)" autocomplete="amenity_category_id" placeholder="Amenity Category Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('amenity_category_id')"/>
    </div>
    <div>
        <x-input-label for="name" :value="__('Name')"/>
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $amenity?->name)" autocomplete="name" placeholder="Name"/>
        <x-input-error class="mt-2" :messages="$errors->get('name')"/>
    </div>
    <div>
        <x-input-label for="icon" :value="__('Icon')"/>
        <x-text-input id="icon" name="icon" type="text" class="mt-1 block w-full" :value="old('icon', $amenity?->icon)" autocomplete="icon" placeholder="Icon"/>
        <x-input-error class="mt-2" :messages="$errors->get('icon')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>