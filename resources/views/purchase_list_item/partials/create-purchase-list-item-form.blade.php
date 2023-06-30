<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Add new items') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('This item will be add in the selected list.') }}
        </p>
    </header>

    <form method="post" action="{{ route('purchaseListItem.store', $purchaseList) }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Item Name')" />
            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" autocomplete="description" />
            <x-input-error :messages="$errors->storePurchaseListItem->get('description')" class="mt-2" />

        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
