<div class="space-y-6">
    
    <div>
        <x-input-label for="restaurant_id" :value="__('Restaurant Id')"/>
        <x-text-input id="restaurant_id" name="restaurant_id" type="text" class="mt-1 block w-full" :value="old('restaurant_id', $dishRestaurant?->restaurant_id)" autocomplete="restaurant_id" placeholder="Restaurant Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('restaurant_id')"/>
    </div>
    <div>
        <x-input-label for="dish_id" :value="__('Dish Id')"/>
        <x-text-input id="dish_id" name="dish_id" type="text" class="mt-1 block w-full" :value="old('dish_id', $dishRestaurant?->dish_id)" autocomplete="dish_id" placeholder="Dish Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('dish_id')"/>
    </div>
    <div>
        <x-input-label for="price" :value="__('Price')"/>
        <x-text-input id="price" name="price" type="text" class="mt-1 block w-full" :value="old('price', $dishRestaurant?->price)" autocomplete="price" placeholder="Price"/>
        <x-input-error class="mt-2" :messages="$errors->get('price')"/>
    </div>
    <div>
        <x-input-label for="currency" :value="__('Currency')"/>
        <x-text-input id="currency" name="currency" type="text" class="mt-1 block w-full" :value="old('currency', $dishRestaurant?->currency)" autocomplete="currency" placeholder="Currency"/>
        <x-input-error class="mt-2" :messages="$errors->get('currency')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>