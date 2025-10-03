<div class="space-y-6">
    
    <div>
        <x-input-label for="user_id" :value="__('User Id')"/>
        <x-text-input id="user_id" name="user_id" type="text" class="mt-1 block w-full" :value="old('user_id', $interestUser?->user_id)" autocomplete="user_id" placeholder="User Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('user_id')"/>
    </div>
    <div>
        <x-input-label for="interest_id" :value="__('Interest Id')"/>
        <x-text-input id="interest_id" name="interest_id" type="text" class="mt-1 block w-full" :value="old('interest_id', $interestUser?->interest_id)" autocomplete="interest_id" placeholder="Interest Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('interest_id')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>