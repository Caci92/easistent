<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseListRequest;
use App\Http\Requests\UpdatePurchaseListRequest;
use App\Models\PurchaseList;
use Illuminate\Support\Facades\Redirect;

class PurchaseListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchaseLists = PurchaseList::all();
        return view('purchase_list.index', compact('purchaseLists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('purchase_list.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param StorePurchaseListRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePurchaseListRequest $request)
    {
        PurchaseList::create([
            'name' => $request->name,
            'user_id' => auth()->user()->id
        ]);

        return Redirect::route('purchaseList.index')->with('message', 'Purchase List Created');
    }

    /**
     * Show the form for editing the specified resource.
     * @param PurchaseList $purchaseList
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit(PurchaseList $purchaseList)
    {
        return view('purchase_list.edit', compact('purchaseList'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdatePurchaseListRequest $request
     * @param PurchaseList $purchaseList
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePurchaseListRequest $request, PurchaseList $purchaseList)
    {
        $purchaseList->fill($request->validated());
        $purchaseList->save();

        return Redirect::route('purchaseList.index')->with('message', 'Purchase List Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PurchaseList $purchaseList
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PurchaseList $purchaseList)
    {
        $purchaseList->delete();
        return redirect()->route('purchaseList.index')->with('message', 'Purchase List Deleted');
    }
}
