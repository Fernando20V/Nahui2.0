<div class="space-y-6">
    
    <div>
        <x-input-label for="organization_id" :value="__('Organization Id')"/>
        <x-text-input id="organization_id" name="organization_id" type="text" class="mt-1 block w-full" :value="old('organization_id', $accommodation?->organization_id)" autocomplete="organization_id" placeholder="Organization Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('organization_id')"/>
    </div>
    <div>
        <x-input-label for="address_id" :value="__('Address Id')"/>
        <x-text-input id="address_id" name="address_id" type="text" class="mt-1 block w-full" :value="old('address_id', $accommodation?->address_id)" autocomplete="address_id" placeholder="Address Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('address_id')"/>
    </div>
    <div>
        <x-input-label for="accommodation_type_id" :value="__('Accommodation Type Id')"/>
        <x-text-input id="accommodation_type_id" name="accommodation_type_id" type="text" class="mt-1 block w-full" :value="old('accommodation_type_id', $accommodation?->accommodation_type_id)" autocomplete="accommodation_type_id" placeholder="Accommodation Type Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('accommodation_type_id')"/>
    </div>
    <div>
        <x-input-label for="title" :value="__('Title')"/>
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $accommodation?->title)" autocomplete="title" placeholder="Title"/>
        <x-input-error class="mt-2" :messages="$errors->get('title')"/>
    </div>
    <div>
        <x-input-label for="description" :value="__('Description')"/>
        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $accommodation?->description)" autocomplete="description" placeholder="Description"/>
        <x-input-error class="mt-2" :messages="$errors->get('description')"/>
    </div>
    <div>
        <x-input-label for="size_sqm" :value="__('Size Sqm')"/>
        <x-text-input id="size_sqm" name="size_sqm" type="text" class="mt-1 block w-full" :value="old('size_sqm', $accommodation?->size_sqm)" autocomplete="size_sqm" placeholder="Size Sqm"/>
        <x-input-error class="mt-2" :messages="$errors->get('size_sqm')"/>
    </div>
    <div>
        <x-input-label for="floors" :value="__('Floors')"/>
        <x-text-input id="floors" name="floors" type="text" class="mt-1 block w-full" :value="old('floors', $accommodation?->floors)" autocomplete="floors" placeholder="Floors"/>
        <x-input-error class="mt-2" :messages="$errors->get('floors')"/>
    </div>
    <div>
        <x-input-label for="bedrooms" :value="__('Bedrooms')"/>
        <x-text-input id="bedrooms" name="bedrooms" type="text" class="mt-1 block w-full" :value="old('bedrooms', $accommodation?->bedrooms)" autocomplete="bedrooms" placeholder="Bedrooms"/>
        <x-input-error class="mt-2" :messages="$errors->get('bedrooms')"/>
    </div>
    <div>
        <x-input-label for="bathrooms" :value="__('Bathrooms')"/>
        <x-text-input id="bathrooms" name="bathrooms" type="text" class="mt-1 block w-full" :value="old('bathrooms', $accommodation?->bathrooms)" autocomplete="bathrooms" placeholder="Bathrooms"/>
        <x-input-error class="mt-2" :messages="$errors->get('bathrooms')"/>
    </div>
    <div>
        <x-input-label for="cats_allowed" :value="__('Cats Allowed')"/>
        <x-text-input id="cats_allowed" name="cats_allowed" type="text" class="mt-1 block w-full" :value="old('cats_allowed', $accommodation?->cats_allowed)" autocomplete="cats_allowed" placeholder="Cats Allowed"/>
        <x-input-error class="mt-2" :messages="$errors->get('cats_allowed')"/>
    </div>
    <div>
        <x-input-label for="dogs_allowed" :value="__('Dogs Allowed')"/>
        <x-text-input id="dogs_allowed" name="dogs_allowed" type="text" class="mt-1 block w-full" :value="old('dogs_allowed', $accommodation?->dogs_allowed)" autocomplete="dogs_allowed" placeholder="Dogs Allowed"/>
        <x-input-error class="mt-2" :messages="$errors->get('dogs_allowed')"/>
    </div>
    <div>
        <x-input-label for="base_price" :value="__('Base Price')"/>
        <x-text-input id="base_price" name="base_price" type="text" class="mt-1 block w-full" :value="old('base_price', $accommodation?->base_price)" autocomplete="base_price" placeholder="Base Price"/>
        <x-input-error class="mt-2" :messages="$errors->get('base_price')"/>
    </div>
    <div>
        <x-input-label for="currency" :value="__('Currency')"/>
        <x-text-input id="currency" name="currency" type="text" class="mt-1 block w-full" :value="old('currency', $accommodation?->currency)" autocomplete="currency" placeholder="Currency"/>
        <x-input-error class="mt-2" :messages="$errors->get('currency')"/>
    </div>
    <div>
        <x-input-label for="status" :value="__('Status')"/>
        <x-text-input id="status" name="status" type="text" class="mt-1 block w-full" :value="old('status', $accommodation?->status)" autocomplete="status" placeholder="Status"/>
        <x-input-error class="mt-2" :messages="$errors->get('status')"/>
    </div>
    <div>
        <x-input-label for="posted_at" :value="__('Posted At')"/>
        <x-text-input id="posted_at" name="posted_at" type="text" class="mt-1 block w-full" :value="old('posted_at', $accommodation?->posted_at)" autocomplete="posted_at" placeholder="Posted At"/>
        <x-input-error class="mt-2" :messages="$errors->get('posted_at')"/>
    </div>
    <div>
        <x-input-label for="view_count" :value="__('View Count')"/>
        <x-text-input id="view_count" name="view_count" type="text" class="mt-1 block w-full" :value="old('view_count', $accommodation?->view_count)" autocomplete="view_count" placeholder="View Count"/>
        <x-input-error class="mt-2" :messages="$errors->get('view_count')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>