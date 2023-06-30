<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Create new Purchase List') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('After adding, navigate to Purchase list in the menu section to add items. ') }}
        </p>
    </header>

    <form method="post" action="{{ route('purchaseList.store') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" autocomplete="name" />
            <x-input-error :messages="$errors->storePurchaseList->get('name')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
