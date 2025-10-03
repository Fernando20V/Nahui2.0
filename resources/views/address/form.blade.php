<div class="space-y-6">
    
    <div>
        <x-input-label for="municipality_id" :value="__('Municipality Id')"/>
        <x-text-input id="municipality_id" name="municipality_id" type="text" class="mt-1 block w-full" :value="old('municipality_id', $address?->municipality_id)" autocomplete="municipality_id" placeholder="Municipality Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('municipality_id')"/>
    </div>
    <div>
        <x-input-label for="street_address" :value="__('Street Address')"/>
        <x-text-input id="street_address" name="street_address" type="text" class="mt-1 block w-full" :value="old('street_address', $address?->street_address)" autocomplete="street_address" placeholder="Street Address"/>
        <x-input-error class="mt-2" :messages="$errors->get('street_address')"/>
    </div>
    <div>
        <x-input-label for="latitude" :value="__('Latitude')"/>
        <x-text-input id="latitude" name="latitude" type="text" class="mt-1 block w-full" :value="old('latitude', $address?->latitude)" autocomplete="latitude" placeholder="Latitude"/>
        <x-input-error class="mt-2" :messages="$errors->get('latitude')"/>
    </div>
    <div>
        <x-input-label for="longitude" :value="__('Longitude')"/>
        <x-text-input id="longitude" name="longitude" type="text" class="mt-1 block w-full" :value="old('longitude', $address?->longitude)" autocomplete="longitude" placeholder="Longitude"/>
        <x-input-error class="mt-2" :messages="$errors->get('longitude')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>