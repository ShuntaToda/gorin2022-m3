<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    public function items(Request $request)
    {
        $query = Item::query();

        if (isset($request->shop_id)) {
            $query->where('shop_id', $request->shop_id);
        }
        if (isset($request->price)) {
            $query->where('price', $request->price);
        }
        if (isset($request->title)) {
            $query->where('name', 'LIKE', "%" . $request->title . "%");
        }

        $items = $query->get();
        if (!isset($items[0])) {
            return response()->json('error', Response::HTTP_NOT_FOUND);
        }
        return response()->json($items, Response::HTTP_OK);
    }
    public function order(Request $request)
    {
        $item = Item::find($request->item_id);
        if (isset($request->address) && isset($item)) {
            if (isset($request->coupon_code)) {
                $coupon = Coupon::where('coupon_code', $request->coupon_code)->first();
                if(!isset($coupon)){
                    return response()->json('error', Response::HTTP_NOT_FOUND);
                }
                Order::create([
                    'item_id' => $request->item_id,
                    'coupon_code' => $request->coupon_code,
                    'address' => $request->address,
                    'payment' => $item->price - $coupon->discount_price,
                ]);
                return response()->json('ok', Response::HTTP_OK); 
            } else {
                Order::create([
                    'item_id' => $request->item_id,
                    'coupon_code' => null,
                    'address' => $request->address,
                    'payment' => $item->price,
                ]);
                return response()->json('ok', Response::HTTP_OK); 
            }
        } else {
            return response()->json('error', Response::HTTP_NOT_FOUND);
        }
    }
}
