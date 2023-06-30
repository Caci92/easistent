<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Purchase List') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Edit the name of the purchase list.') }}
        </p>
    </header>

    <form method="post" action="{{ route('purchaseList.update', $purchaseList) }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" required :value="old('name', $purchaseList->name)" type="text" class="mt-1 block w-full" autocomplete="name" />
            <x-input-error :messages="$errors->storePurchaseList->get('name')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'purchase-list-updated' || session('status') === 'purchase-list-created')
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
