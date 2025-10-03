<div class="space-y-6">
    
    <div>
        <x-input-label for="accommodation_id" :value="__('Accommodation Id')"/>
        <x-text-input id="accommodation_id" name="accommodation_id" type="text" class="mt-1 block w-full" :value="old('accommodation_id', $accommodationAmenity?->accommodation_id)" autocomplete="accommodation_id" placeholder="Accommodation Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('accommodation_id')"/>
    </div>
    <div>
        <x-input-label for="amenity_id" :value="__('Amenity Id')"/>
        <x-text-input id="amenity_id" name="amenity_id" type="text" class="mt-1 block w-full" :value="old('amenity_id', $accommodationAmenity?->amenity_id)" autocomplete="amenity_id" placeholder="Amenity Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('amenity_id')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>