<div class="space-y-6">
    
    <div>
        <x-input-label for="short_name" :value="__('Short Name')"/>
        <x-text-input id="short_name" name="short_name" type="text" class="mt-1 block w-full" :value="old('short_name', $busRoute?->short_name)" autocomplete="short_name" placeholder="Short Name"/>
        <x-input-error class="mt-2" :messages="$errors->get('short_name')"/>
    </div>
    <div>
        <x-input-label for="long_name" :value="__('Long Name')"/>
        <x-text-input id="long_name" name="long_name" type="text" class="mt-1 block w-full" :value="old('long_name', $busRoute?->long_name)" autocomplete="long_name" placeholder="Long Name"/>
        <x-input-error class="mt-2" :messages="$errors->get('long_name')"/>
    </div>
    <div>
        <x-input-label for="scope" :value="__('Scope')"/>
        <x-text-input id="scope" name="scope" type="text" class="mt-1 block w-full" :value="old('scope', $busRoute?->scope)" autocomplete="scope" placeholder="Scope"/>
        <x-input-error class="mt-2" :messages="$errors->get('scope')"/>
    </div>
    <div>
        <x-input-label for="service_pattern" :value="__('Service Pattern')"/>
        <x-text-input id="service_pattern" name="service_pattern" type="text" class="mt-1 block w-full" :value="old('service_pattern', $busRoute?->service_pattern)" autocomplete="service_pattern" placeholder="Service Pattern"/>
        <x-input-error class="mt-2" :messages="$errors->get('service_pattern')"/>
    </div>
    <div>
        <x-input-label for="transport_type_id" :value="__('Transport Type Id')"/>
        <x-text-input id="transport_type_id" name="transport_type_id" type="text" class="mt-1 block w-full" :value="old('transport_type_id', $busRoute?->transport_type_id)" autocomplete="transport_type_id" placeholder="Transport Type Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('transport_type_id')"/>
    </div>
    <div>
        <x-input-label for="organization_id" :value="__('Organization Id')"/>
        <x-text-input id="organization_id" name="organization_id" type="text" class="mt-1 block w-full" :value="old('organization_id', $busRoute?->organization_id)" autocomplete="organization_id" placeholder="Organization Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('organization_id')"/>
    </div>
    <div>
        <x-input-label for="origin_stop_id" :value="__('Origin Stop Id')"/>
        <x-text-input id="origin_stop_id" name="origin_stop_id" type="text" class="mt-1 block w-full" :value="old('origin_stop_id', $busRoute?->origin_stop_id)" autocomplete="origin_stop_id" placeholder="Origin Stop Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('origin_stop_id')"/>
    </div>
    <div>
        <x-input-label for="destination_stop_id" :value="__('Destination Stop Id')"/>
        <x-text-input id="destination_stop_id" name="destination_stop_id" type="text" class="mt-1 block w-full" :value="old('destination_stop_id', $busRoute?->destination_stop_id)" autocomplete="destination_stop_id" placeholder="Destination Stop Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('destination_stop_id')"/>
    </div>
    <div>
        <x-input-label for="municipality_id" :value="__('Municipality Id')"/>
        <x-text-input id="municipality_id" name="municipality_id" type="text" class="mt-1 block w-full" :value="old('municipality_id', $busRoute?->municipality_id)" autocomplete="municipality_id" placeholder="Municipality Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('municipality_id')"/>
    </div>
    <div>
        <x-input-label for="distance_km" :value="__('Distance Km')"/>
        <x-text-input id="distance_km" name="distance_km" type="text" class="mt-1 block w-full" :value="old('distance_km', $busRoute?->distance_km)" autocomplete="distance_km" placeholder="Distance Km"/>
        <x-input-error class="mt-2" :messages="$errors->get('distance_km')"/>
    </div>
    <div>
        <x-input-label for="is_active" :value="__('Is Active')"/>
        <x-text-input id="is_active" name="is_active" type="text" class="mt-1 block w-full" :value="old('is_active', $busRoute?->is_active)" autocomplete="is_active" placeholder="Is Active"/>
        <x-input-error class="mt-2" :messages="$errors->get('is_active')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>