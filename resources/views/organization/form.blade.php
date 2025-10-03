<div class="space-y-6">
    
    <div>
        <x-input-label for="name" :value="__('Name')"/>
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $organization?->name)" autocomplete="name" placeholder="Name"/>
        <x-input-error class="mt-2" :messages="$errors->get('name')"/>
    </div>
    <div>
        <x-input-label for="organization_type_id" :value="__('Organization Type Id')"/>
        <x-text-input id="organization_type_id" name="organization_type_id" type="text" class="mt-1 block w-full" :value="old('organization_type_id', $organization?->organization_type_id)" autocomplete="organization_type_id" placeholder="Organization Type Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('organization_type_id')"/>
    </div>
    <div>
        <x-input-label for="contact_email" :value="__('Contact Email')"/>
        <x-text-input id="contact_email" name="contact_email" type="text" class="mt-1 block w-full" :value="old('contact_email', $organization?->contact_email)" autocomplete="contact_email" placeholder="Contact Email"/>
        <x-input-error class="mt-2" :messages="$errors->get('contact_email')"/>
    </div>
    <div>
        <x-input-label for="contact_phone" :value="__('Contact Phone')"/>
        <x-text-input id="contact_phone" name="contact_phone" type="text" class="mt-1 block w-full" :value="old('contact_phone', $organization?->contact_phone)" autocomplete="contact_phone" placeholder="Contact Phone"/>
        <x-input-error class="mt-2" :messages="$errors->get('contact_phone')"/>
    </div>
    <div>
        <x-input-label for="website" :value="__('Website')"/>
        <x-text-input id="website" name="website" type="text" class="mt-1 block w-full" :value="old('website', $organization?->website)" autocomplete="website" placeholder="Website"/>
        <x-input-error class="mt-2" :messages="$errors->get('website')"/>
    </div>
    <div>
        <x-input-label for="address_id" :value="__('Address Id')"/>
        <x-text-input id="address_id" name="address_id" type="text" class="mt-1 block w-full" :value="old('address_id', $organization?->address_id)" autocomplete="address_id" placeholder="Address Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('address_id')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>