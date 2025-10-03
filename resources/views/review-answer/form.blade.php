<div class="space-y-6">
    
    <div>
        <x-input-label for="review_id" :value="__('Review Id')"/>
        <x-text-input id="review_id" name="review_id" type="text" class="mt-1 block w-full" :value="old('review_id', $reviewAnswer?->review_id)" autocomplete="review_id" placeholder="Review Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('review_id')"/>
    </div>
    <div>
        <x-input-label for="user_id" :value="__('User Id')"/>
        <x-text-input id="user_id" name="user_id" type="text" class="mt-1 block w-full" :value="old('user_id', $reviewAnswer?->user_id)" autocomplete="user_id" placeholder="User Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('user_id')"/>
    </div>
    <div>
        <x-input-label for="comment" :value="__('Comment')"/>
        <x-text-input id="comment" name="comment" type="text" class="mt-1 block w-full" :value="old('comment', $reviewAnswer?->comment)" autocomplete="comment" placeholder="Comment"/>
        <x-input-error class="mt-2" :messages="$errors->get('comment')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>