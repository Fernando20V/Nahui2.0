<div class="space-y-6">
    
    <div>
        <x-input-label for="route_id" :value="__('Route Id')"/>
        <x-text-input id="route_id" name="route_id" type="text" class="mt-1 block w-full" :value="old('route_id', $routeSchedule?->route_id)" autocomplete="route_id" placeholder="Route Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('route_id')"/>
    </div>
    <div>
        <x-input-label for="days_mask" :value="__('Days Mask')"/>
        <x-text-input id="days_mask" name="days_mask" type="text" class="mt-1 block w-full" :value="old('days_mask', $routeSchedule?->days_mask)" autocomplete="days_mask" placeholder="Days Mask"/>
        <x-input-error class="mt-2" :messages="$errors->get('days_mask')"/>
    </div>
    <div>
        <x-input-label for="start_time" :value="__('Start Time')"/>
        <x-text-input id="start_time" name="start_time" type="text" class="mt-1 block w-full" :value="old('start_time', $routeSchedule?->start_time)" autocomplete="start_time" placeholder="Start Time"/>
        <x-input-error class="mt-2" :messages="$errors->get('start_time')"/>
    </div>
    <div>
        <x-input-label for="end_time" :value="__('End Time')"/>
        <x-text-input id="end_time" name="end_time" type="text" class="mt-1 block w-full" :value="old('end_time', $routeSchedule?->end_time)" autocomplete="end_time" placeholder="End Time"/>
        <x-input-error class="mt-2" :messages="$errors->get('end_time')"/>
    </div>
    <div>
        <x-input-label for="headway_minutes" :value="__('Headway Minutes')"/>
        <x-text-input id="headway_minutes" name="headway_minutes" type="text" class="mt-1 block w-full" :value="old('headway_minutes', $routeSchedule?->headway_minutes)" autocomplete="headway_minutes" placeholder="Headway Minutes"/>
        <x-input-error class="mt-2" :messages="$errors->get('headway_minutes')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>