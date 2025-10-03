<div class="space-y-6">
    
    <div>
        <x-input-label for="name" :value="__('Name')"/>
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $restaurant?->name)" autocomplete="name" placeholder="Name"/>
        <x-input-error class="mt-2" :messages="$errors->get('name')"/>
    </div>
    <div>
        <x-input-label for="restaurant_category_id" :value="__('Restaurant Category Id')"/>
        <x-text-input id="restaurant_category_id" name="restaurant_category_id" type="text" class="mt-1 block w-full" :value="old('restaurant_category_id', $restaurant?->restaurant_category_id)" autocomplete="restaurant_category_id" placeholder="Restaurant Category Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('restaurant_category_id')"/>
    </div>
    <div>
        <x-input-label for="cuisine_types" :value="__('Cuisine Types')"/>
        <x-text-input id="cuisine_types" name="cuisine_types" type="text" class="mt-1 block w-full" :value="old('cuisine_types', $restaurant?->cuisine_types)" autocomplete="cuisine_types" placeholder="Cuisine Types"/>
        <x-input-error class="mt-2" :messages="$errors->get('cuisine_types')"/>
    </div>
    <div>
        <x-input-label for="description" :value="__('Description')"/>
        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $restaurant?->description)" autocomplete="description" placeholder="Description"/>
        <x-input-error class="mt-2" :messages="$errors->get('description')"/>
    </div>
    <div>
        <x-input-label for="price_band" :value="__('Price Band')"/>
        <x-text-input id="price_band" name="price_band" type="text" class="mt-1 block w-full" :value="old('price_band', $restaurant?->price_band)" autocomplete="price_band" placeholder="Price Band"/>
        <x-input-error class="mt-2" :messages="$errors->get('price_band')"/>
    </div>
    <div>
        <x-input-label for="hours" :value="__('Hours')"/>
        <x-text-input id="hours" name="hours" type="text" class="mt-1 block w-full" :value="old('hours', $restaurant?->hours)" autocomplete="hours" placeholder="Hours"/>
        <x-input-error class="mt-2" :messages="$errors->get('hours')"/>
    </div>
    <div>
        <x-input-label for="reservations_supported" :value="__('Reservations Supported')"/>
        <x-text-input id="reservations_supported" name="reservations_supported" type="text" class="mt-1 block w-full" :value="old('reservations_supported', $restaurant?->reservations_supported)" autocomplete="reservations_supported" placeholder="Reservations Supported"/>
        <x-input-error class="mt-2" :messages="$errors->get('reservations_supported')"/>
    </div>
    <div>
        <x-input-label for="address_id" :value="__('Address Id')"/>
        <x-text-input id="address_id" name="address_id" type="text" class="mt-1 block w-full" :value="old('address_id', $restaurant?->address_id)" autocomplete="address_id" placeholder="Address Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('address_id')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>