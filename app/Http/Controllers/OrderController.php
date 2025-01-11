<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //direct order page

    public function orderList(){
        $order=Order::select('orders.*','users.name as user_name')
                    ->leftJoin('users','users.id','orders.user_id')
                    ->when(request('key'),function($query){
                        $query->where('users.name','like','%'.request('key').'%');
                    })
                    ->orderBy('created_at','desc')
                    ->paginate(5);
        return view('admin.order.list',compact('order'));
    }


    //direct order status
    public function changeStatus(Request $request){
        //dd($request->all());
                $order=Order::select('orders.*','users.name as user_name')
                            ->leftJoin('users','users.id','orders.user_id')
                            ->orderBy('created_at','desc');
                if($request->orderStatus ==null){
                    $order=$order->paginate(5);
                }else{
                    $order=$order->where('orders.status',$request->orderStatus)->paginate(5);
                }

                return view('admin.order.list',compact('order'));

    }

    //change status
    public function ajaxChangeStatus(Request $request){
            Order::where('id',$request->orderId)->update([
                'status'=>$request->status,
            ]);
    }

    //direct order list info
    public function listInfo($orderCode){
        $orderList=OrderList::select('order_lists.*','users.name as user_name','products.image as product_image','products.name as product_name')
                            ->leftJoin('users','users.id','order_lists.user_id')
                            ->leftJoin('products','products.id','order_lists.product_id')
                            ->where('order_code',$orderCode)
                            ->get();
        $order=Order::where('order_code',$orderCode)->first();
        return view('admin.order.productList',compact('orderList','order'));
    }
}
