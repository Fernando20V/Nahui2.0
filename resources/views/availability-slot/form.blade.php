<div class="space-y-6">
    
    <div>
        <x-input-label for="accommodation_id" :value="__('Accommodation Id')"/>
        <x-text-input id="accommodation_id" name="accommodation_id" type="text" class="mt-1 block w-full" :value="old('accommodation_id', $availabilitySlot?->accommodation_id)" autocomplete="accommodation_id" placeholder="Accommodation Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('accommodation_id')"/>
    </div>
    <div>
        <x-input-label for="start_date" :value="__('Start Date')"/>
        <x-text-input id="start_date" name="start_date" type="text" class="mt-1 block w-full" :value="old('start_date', $availabilitySlot?->start_date)" autocomplete="start_date" placeholder="Start Date"/>
        <x-input-error class="mt-2" :messages="$errors->get('start_date')"/>
    </div>
    <div>
        <x-input-label for="end_date" :value="__('End Date')"/>
        <x-text-input id="end_date" name="end_date" type="text" class="mt-1 block w-full" :value="old('end_date', $availabilitySlot?->end_date)" autocomplete="end_date" placeholder="End Date"/>
        <x-input-error class="mt-2" :messages="$errors->get('end_date')"/>
    </div>
    <div>
        <x-input-label for="status" :value="__('Status')"/>
        <x-text-input id="status" name="status" type="text" class="mt-1 block w-full" :value="old('status', $availabilitySlot?->status)" autocomplete="status" placeholder="Status"/>
        <x-input-error class="mt-2" :messages="$errors->get('status')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>