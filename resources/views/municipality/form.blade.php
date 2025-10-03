<div class="space-y-6">
    
    <div>
        <x-input-label for="department_id" :value="__('Department Id')"/>
        <x-text-input id="department_id" name="department_id" type="text" class="mt-1 block w-full" :value="old('department_id', $municipality?->department_id)" autocomplete="department_id" placeholder="Department Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('department_id')"/>
    </div>
    <div>
        <x-input-label for="name" :value="__('Name')"/>
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $municipality?->name)" autocomplete="name" placeholder="Name"/>
        <x-input-error class="mt-2" :messages="$errors->get('name')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>