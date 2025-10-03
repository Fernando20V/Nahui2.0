<div class="space-y-6">
    
    <div>
        <x-input-label for="title" :value="__('Title')"/>
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $event?->title)" autocomplete="title" placeholder="Title"/>
        <x-input-error class="mt-2" :messages="$errors->get('title')"/>
    </div>
    <div>
        <x-input-label for="event_category_id" :value="__('Event Category Id')"/>
        <x-text-input id="event_category_id" name="event_category_id" type="text" class="mt-1 block w-full" :value="old('event_category_id', $event?->event_category_id)" autocomplete="event_category_id" placeholder="Event Category Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('event_category_id')"/>
    </div>
    <div>
        <x-input-label for="author" :value="__('Author')"/>
        <x-text-input id="author" name="author" type="text" class="mt-1 block w-full" :value="old('author', $event?->author)" autocomplete="author" placeholder="Author"/>
        <x-input-error class="mt-2" :messages="$errors->get('author')"/>
    </div>
    <div>
        <x-input-label for="description" :value="__('Description')"/>
        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $event?->description)" autocomplete="description" placeholder="Description"/>
        <x-input-error class="mt-2" :messages="$errors->get('description')"/>
    </div>
    <div>
        <x-input-label for="start_at" :value="__('Start At')"/>
        <x-text-input id="start_at" name="start_at" type="text" class="mt-1 block w-full" :value="old('start_at', $event?->start_at)" autocomplete="start_at" placeholder="Start At"/>
        <x-input-error class="mt-2" :messages="$errors->get('start_at')"/>
    </div>
    <div>
        <x-input-label for="end_at" :value="__('End At')"/>
        <x-text-input id="end_at" name="end_at" type="text" class="mt-1 block w-full" :value="old('end_at', $event?->end_at)" autocomplete="end_at" placeholder="End At"/>
        <x-input-error class="mt-2" :messages="$errors->get('end_at')"/>
    </div>
    <div>
        <x-input-label for="recurrence" :value="__('Recurrence')"/>
        <x-text-input id="recurrence" name="recurrence" type="text" class="mt-1 block w-full" :value="old('recurrence', $event?->recurrence)" autocomplete="recurrence" placeholder="Recurrence"/>
        <x-input-error class="mt-2" :messages="$errors->get('recurrence')"/>
    </div>
    <div>
        <x-input-label for="address_id" :value="__('Address Id')"/>
        <x-text-input id="address_id" name="address_id" type="text" class="mt-1 block w-full" :value="old('address_id', $event?->address_id)" autocomplete="address_id" placeholder="Address Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('address_id')"/>
    </div>
    <div>
        <x-input-label for="place_id" :value="__('Place Id')"/>
        <x-text-input id="place_id" name="place_id" type="text" class="mt-1 block w-full" :value="old('place_id', $event?->place_id)" autocomplete="place_id" placeholder="Place Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('place_id')"/>
    </div>
    <div>
        <x-input-label for="cost" :value="__('Cost')"/>
        <x-text-input id="cost" name="cost" type="text" class="mt-1 block w-full" :value="old('cost', $event?->cost)" autocomplete="cost" placeholder="Cost"/>
        <x-input-error class="mt-2" :messages="$errors->get('cost')"/>
    </div>
    <div>
        <x-input-label for="currency" :value="__('Currency')"/>
        <x-text-input id="currency" name="currency" type="text" class="mt-1 block w-full" :value="old('currency', $event?->currency)" autocomplete="currency" placeholder="Currency"/>
        <x-input-error class="mt-2" :messages="$errors->get('currency')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>