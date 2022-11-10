<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 一覧表示
        $items = Item::where('shop_id', Auth::id())->get();
        return response(view('items', compact('items')))->withHeaders(['Cache-Control'=> 'no-store']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 作成フォーム
        return response(view('items_create'))->withHeaders(['Cache-Control'=> 'no-store']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 作成
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        Item::create([
            'name' => $request->name,
            'price' => $request->price,
            'shop_id' => Auth::id()
        ]);
        $message = '商品情報が登録されました。';
        return response(view('items_create',compact('message')))->withHeaders(['Cache-Control'=> 'no-store']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 編集
        $item = Item::find($id);
        return response(view('items_edit', compact('item')))->withHeaders(['Cache-Control'=> 'no-store']);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 更新
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $item = Item::find($id);
        $item->update([
            'name' => $request->name,
            'price' => $request->price,
            'shop_id' => Auth::id()
        ]);
        $message = '商品情報が更新されました。';
        return response(view('items_edit',compact('message', 'item')))->withHeaders(['Cache-Control'=> 'no-store']);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);

        $item->delete();
        return redirect(route('home'));
    }
}
