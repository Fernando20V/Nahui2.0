<div class="space-y-6">
    
    <div>
        <x-input-label for="booking_id" :value="__('Booking Id')"/>
        <x-text-input id="booking_id" name="booking_id" type="text" class="mt-1 block w-full" :value="old('booking_id', $bookingDay?->booking_id)" autocomplete="booking_id" placeholder="Booking Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('booking_id')"/>
    </div>
    <div>
        <x-input-label for="accommodation_id" :value="__('Accommodation Id')"/>
        <x-text-input id="accommodation_id" name="accommodation_id" type="text" class="mt-1 block w-full" :value="old('accommodation_id', $bookingDay?->accommodation_id)" autocomplete="accommodation_id" placeholder="Accommodation Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('accommodation_id')"/>
    </div>
    <div>
        <x-input-label for="day" :value="__('Day')"/>
        <x-text-input id="day" name="day" type="text" class="mt-1 block w-full" :value="old('day', $bookingDay?->day)" autocomplete="day" placeholder="Day"/>
        <x-input-error class="mt-2" :messages="$errors->get('day')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>