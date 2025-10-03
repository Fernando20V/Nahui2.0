<div class="space-y-6">
    
    <div>
        <x-input-label for="user_id" :value="__('User Id')"/>
        <x-text-input id="user_id" name="user_id" type="text" class="mt-1 block w-full" :value="old('user_id', $booking?->user_id)" autocomplete="user_id" placeholder="User Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('user_id')"/>
    </div>
    <div>
        <x-input-label for="accommodation_id" :value="__('Accommodation Id')"/>
        <x-text-input id="accommodation_id" name="accommodation_id" type="text" class="mt-1 block w-full" :value="old('accommodation_id', $booking?->accommodation_id)" autocomplete="accommodation_id" placeholder="Accommodation Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('accommodation_id')"/>
    </div>
    <div>
        <x-input-label for="start_date" :value="__('Start Date')"/>
        <x-text-input id="start_date" name="start_date" type="text" class="mt-1 block w-full" :value="old('start_date', $booking?->start_date)" autocomplete="start_date" placeholder="Start Date"/>
        <x-input-error class="mt-2" :messages="$errors->get('start_date')"/>
    </div>
    <div>
        <x-input-label for="end_date" :value="__('End Date')"/>
        <x-text-input id="end_date" name="end_date" type="text" class="mt-1 block w-full" :value="old('end_date', $booking?->end_date)" autocomplete="end_date" placeholder="End Date"/>
        <x-input-error class="mt-2" :messages="$errors->get('end_date')"/>
    </div>
    <div>
        <x-input-label for="guests" :value="__('Guests')"/>
        <x-text-input id="guests" name="guests" type="text" class="mt-1 block w-full" :value="old('guests', $booking?->guests)" autocomplete="guests" placeholder="Guests"/>
        <x-input-error class="mt-2" :messages="$errors->get('guests')"/>
    </div>
    <div>
        <x-input-label for="total_price" :value="__('Total Price')"/>
        <x-text-input id="total_price" name="total_price" type="text" class="mt-1 block w-full" :value="old('total_price', $booking?->total_price)" autocomplete="total_price" placeholder="Total Price"/>
        <x-input-error class="mt-2" :messages="$errors->get('total_price')"/>
    </div>
    <div>
        <x-input-label for="currency" :value="__('Currency')"/>
        <x-text-input id="currency" name="currency" type="text" class="mt-1 block w-full" :value="old('currency', $booking?->currency)" autocomplete="currency" placeholder="Currency"/>
        <x-input-error class="mt-2" :messages="$errors->get('currency')"/>
    </div>
    <div>
        <x-input-label for="status" :value="__('Status')"/>
        <x-text-input id="status" name="status" type="text" class="mt-1 block w-full" :value="old('status', $booking?->status)" autocomplete="status" placeholder="Status"/>
        <x-input-error class="mt-2" :messages="$errors->get('status')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>