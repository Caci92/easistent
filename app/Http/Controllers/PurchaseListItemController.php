<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseListItemRequest;
use App\Http\Requests\StorePurchaseListRequest;
use App\Http\Requests\UpdatePurchaseListItemRequest;
use App\Models\PurchaseList;
use App\Models\PurchaseListItem;
use Illuminate\Support\Facades\Redirect;

class PurchaseListItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param PurchaseList $purchaseList
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(PurchaseList $purchaseList)
    {
        return view('purchase_list_item.index', compact('purchaseList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param PurchaseList $purchaseList
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create(PurchaseList $purchaseList)
    {
        return view('purchase_list_item.create', compact('purchaseList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePurchaseListItemRequest $request
     * @param PurchaseList $purchaseList
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePurchaseListItemRequest $request, PurchaseList $purchaseList)
    {
        PurchaseListItem::create([
            'description' => $request->description,
            'user_id' => auth()->user()->id,
            'purchase_list_id' => $purchaseList->id
        ]);

        return Redirect::route('purchaseListItem.index', $purchaseList)->with('message', 'Purchase List Item Created');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PurchaseList $purchaseList
     * @param PurchaseListItem $purchaseListItem
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit(PurchaseList $purchaseList, PurchaseListItem $purchaseListItem)
    {
        return view('purchase_list_item.edit', compact('purchaseList', 'purchaseListItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePurchaseListItemRequest $request
     * @param PurchaseList $purchaseList
     * @param PurchaseListItem $purchaseListItem
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePurchaseListItemRequest $request, PurchaseList $purchaseList, PurchaseListItem $purchaseListItem)
    {
        $purchaseListItem->fill($request->validated());
        $purchaseListItem->save();

        return Redirect::route('purchaseListItem.index', $purchaseList)->with('message', 'Purchase List Item Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PurchaseList $purchaseList
     * @param PurchaseListItem $purchaseListItem
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PurchaseList $purchaseList, PurchaseListItem $purchaseListItem)
    {
        $purchaseListItem->delete();
        return redirect()->route('purchaseListItem.index', $purchaseList)->with('message', 'Purchase List Item Deleted');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PurchaseList $purchaseList
     * @param PurchaseListItem $purchaseListItem
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markCompleted(PurchaseList $purchaseList, PurchaseListItem $purchaseListItem)
    {
        $this->authorize('manage_mark_purchaseListItem');

        $purchaseListItem->fill([
            'completed' => new \DateTIme()
        ]);
        $purchaseListItem->save();

        return Redirect::route('purchaseListItem.index', $purchaseList)->with('message', 'Purchase List Item marked as Complete');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PurchaseList $purchaseList
     * @param PurchaseListItem $purchaseListItem
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markNotCompleted(PurchaseList $purchaseList, PurchaseListItem $purchaseListItem)
    {
        $this->authorize('manage_mark_purchaseListItem');

        $purchaseListItem->fill([
            'completed' => null
        ]);
        $purchaseListItem->save();

        return Redirect::route('purchaseListItem.index', $purchaseList)->with('message', 'Purchase List Item marked as Incomplete');
    }
}
