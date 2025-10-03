<div class="space-y-6">
    
    <div>
        <x-input-label for="user_id" :value="__('User Id')"/>
        <x-text-input id="user_id" name="user_id" type="text" class="mt-1 block w-full" :value="old('user_id', $review?->user_id)" autocomplete="user_id" placeholder="User Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('user_id')"/>
    </div>
    <div>
        <x-input-label for="reviewable_type" :value="__('Reviewable Type')"/>
        <x-text-input id="reviewable_type" name="reviewable_type" type="text" class="mt-1 block w-full" :value="old('reviewable_type', $review?->reviewable_type)" autocomplete="reviewable_type" placeholder="Reviewable Type"/>
        <x-input-error class="mt-2" :messages="$errors->get('reviewable_type')"/>
    </div>
    <div>
        <x-input-label for="reviewable_id" :value="__('Reviewable Id')"/>
        <x-text-input id="reviewable_id" name="reviewable_id" type="text" class="mt-1 block w-full" :value="old('reviewable_id', $review?->reviewable_id)" autocomplete="reviewable_id" placeholder="Reviewable Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('reviewable_id')"/>
    </div>
    <div>
        <x-input-label for="rating" :value="__('Rating')"/>
        <x-text-input id="rating" name="rating" type="text" class="mt-1 block w-full" :value="old('rating', $review?->rating)" autocomplete="rating" placeholder="Rating"/>
        <x-input-error class="mt-2" :messages="$errors->get('rating')"/>
    </div>
    <div>
        <x-input-label for="title" :value="__('Title')"/>
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $review?->title)" autocomplete="title" placeholder="Title"/>
        <x-input-error class="mt-2" :messages="$errors->get('title')"/>
    </div>
    <div>
        <x-input-label for="comment" :value="__('Comment')"/>
        <x-text-input id="comment" name="comment" type="text" class="mt-1 block w-full" :value="old('comment', $review?->comment)" autocomplete="comment" placeholder="Comment"/>
        <x-input-error class="mt-2" :messages="$errors->get('comment')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>