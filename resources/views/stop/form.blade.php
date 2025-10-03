<div class="space-y-6">
    
    <div>
        <x-input-label for="name" :value="__('Name')"/>
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $stop?->name)" autocomplete="name" placeholder="Name"/>
        <x-input-error class="mt-2" :messages="$errors->get('name')"/>
    </div>
    <div>
        <x-input-label for="municipality_id" :value="__('Municipality Id')"/>
        <x-text-input id="municipality_id" name="municipality_id" type="text" class="mt-1 block w-full" :value="old('municipality_id', $stop?->municipality_id)" autocomplete="municipality_id" placeholder="Municipality Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('municipality_id')"/>
    </div>
    <div>
        <x-input-label for="address_id" :value="__('Address Id')"/>
        <x-text-input id="address_id" name="address_id" type="text" class="mt-1 block w-full" :value="old('address_id', $stop?->address_id)" autocomplete="address_id" placeholder="Address Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('address_id')"/>
    </div>
    <div>
        <x-input-label for="place_id" :value="__('Place Id')"/>
        <x-text-input id="place_id" name="place_id" type="text" class="mt-1 block w-full" :value="old('place_id', $stop?->place_id)" autocomplete="place_id" placeholder="Place Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('place_id')"/>
    </div>
    <div>
        <x-input-label for="lat" :value="__('Lat')"/>
        <x-text-input id="lat" name="lat" type="text" class="mt-1 block w-full" :value="old('lat', $stop?->lat)" autocomplete="lat" placeholder="Lat"/>
        <x-input-error class="mt-2" :messages="$errors->get('lat')"/>
    </div>
    <div>
        <x-input-label for="lng" :value="__('Lng')"/>
        <x-text-input id="lng" name="lng" type="text" class="mt-1 block w-full" :value="old('lng', $stop?->lng)" autocomplete="lng" placeholder="Lng"/>
        <x-input-error class="mt-2" :messages="$errors->get('lng')"/>
    </div>
    <div>
        <x-input-label for="is_terminal" :value="__('Is Terminal')"/>
        <x-text-input id="is_terminal" name="is_terminal" type="text" class="mt-1 block w-full" :value="old('is_terminal', $stop?->is_terminal)" autocomplete="is_terminal" placeholder="Is Terminal"/>
        <x-input-error class="mt-2" :messages="$errors->get('is_terminal')"/>
    </div>
    <div>
        <x-input-label for="is_active" :value="__('Is Active')"/>
        <x-text-input id="is_active" name="is_active" type="text" class="mt-1 block w-full" :value="old('is_active', $stop?->is_active)" autocomplete="is_active" placeholder="Is Active"/>
        <x-input-error class="mt-2" :messages="$errors->get('is_active')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>