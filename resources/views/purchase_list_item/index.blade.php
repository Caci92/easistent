<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $purchaseList->name }} {{ __('Items') }}
                </h2>
            </div>
            <div class="order-last">
                <a href="{{ route('purchaseListItem.create', $purchaseList) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">{{ __('Add new Purchase List Item') }}</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table-fixed w-full">
                        <tbody>
                            @foreach($purchaseList->items as $item)
                                <tr>
                                    <td class="@if(!$loop->first) border-t @endif px-4 py-2 @if($item->completed) item-completed @endif">
                                        {{$item->description}}
                                    </td>

                                    <td class="@if(!$loop->first) border-t @endif px-4 py-2 text-right">
                                        @can('manage_mark_purchaseListItem')
                                            @if($item->completed)
                                                <a class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 rounded-full" href="{{ route('purchaseListItem.markNotCompleted', [$purchaseList, $item]) }}">
                                                    {{ __('Mark Incomplete') }}
                                                </a>
                                            @else
                                                <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" href="{{ route('purchaseListItem.markCompleted', [$purchaseList, $item]) }}">
                                                    {{ __('Mark Complete') }}
                                                </a>
                                            @endif
                                        @endcan

                                        <a class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-full font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150" href="{{ route('purchaseListItem.edit', [$purchaseList, $item]) }}">
                                            {{ __('Edit') }}
                                        </a>

                                        <a class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150" href="{{ route('purchaseListItem.destroy', [$purchaseList, $item]) }}">
                                            {{ __('Delete') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
