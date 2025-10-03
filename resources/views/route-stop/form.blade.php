<div class="space-y-6">
    
    <div>
        <x-input-label for="route_id" :value="__('Route Id')"/>
        <x-text-input id="route_id" name="route_id" type="text" class="mt-1 block w-full" :value="old('route_id', $routeStop?->route_id)" autocomplete="route_id" placeholder="Route Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('route_id')"/>
    </div>
    <div>
        <x-input-label for="stop_id" :value="__('Stop Id')"/>
        <x-text-input id="stop_id" name="stop_id" type="text" class="mt-1 block w-full" :value="old('stop_id', $routeStop?->stop_id)" autocomplete="stop_id" placeholder="Stop Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('stop_id')"/>
    </div>
    <div>
        <x-input-label for="sequence" :value="__('Sequence')"/>
        <x-text-input id="sequence" name="sequence" type="text" class="mt-1 block w-full" :value="old('sequence', $routeStop?->sequence)" autocomplete="sequence" placeholder="Sequence"/>
        <x-input-error class="mt-2" :messages="$errors->get('sequence')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>