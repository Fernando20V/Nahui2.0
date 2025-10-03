<div class="space-y-6">
    
    <div>
        <x-input-label for="organization_id" :value="__('Organization Id')"/>
        <x-text-input id="organization_id" name="organization_id" type="text" class="mt-1 block w-full" :value="old('organization_id', $organizationRoute?->organization_id)" autocomplete="organization_id" placeholder="Organization Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('organization_id')"/>
    </div>
    <div>
        <x-input-label for="route_id" :value="__('Route Id')"/>
        <x-text-input id="route_id" name="route_id" type="text" class="mt-1 block w-full" :value="old('route_id', $organizationRoute?->route_id)" autocomplete="route_id" placeholder="Route Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('route_id')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>