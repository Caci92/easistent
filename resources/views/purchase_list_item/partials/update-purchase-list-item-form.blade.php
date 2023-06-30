<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Purchase List item') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('purchaseListItem.update', [$purchaseList, $purchaseListItem]) }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input id="description" name="description" required :value="old('description', $purchaseListItem->description)" type="text" class="mt-1 block w-full" autocomplete="description" />
            <x-input-error :messages="$errors->storePurchaseListItem->get('description')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'purchase-list-item-updated' || session('status') === 'purchase-list-item-created')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
