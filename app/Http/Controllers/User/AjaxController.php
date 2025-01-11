<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function pizzaList(Request $request){
       if($request->status =='desc'){
            $data=Product::orderBy('created_at','desc')->get();

        }else{
            $data=Product::orderBy('created_at','asc')->get();
        }

        return $data;
    }

    //add pizza to cart
    public function addToCart(Request $request){
        $data=$this->getOrderData($request);
        Cart::create($data);
        $response=[
            'message'=>'Add to Cart Completed!',
            'status'=>'Success'
        ];
        return response()->json($response,200);
    }

    //direct order
    public function order(Request $request){
        $total=0;
        foreach($request->all() as $item){
          $data=  OrderList::create([
                'user_id'=>$item['userId'],
                'product_id'=>$item['productId'],
                'qty'=>$item['qty'],
                'total'=>$item['total'],
                'order_code'=>$item['order_code']
            ]);
            $total +=$data->total;

        }
        Cart::where('user_id',Auth::user()->id)->delete();
        Order::create([
            'user_id'=>Auth::user()->id,
            'order_code'=>$data->order_code,
            'totalPrice'=>$data->total+3000
        ]);
        return response()->json([
            'message'=>'Order Completed!',
            'status'=>'true'
        ],200);
    }

    //direct cart clear
    public function clear(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    //direct clear product
    public function clearProduct(Request $request){
        Cart::where('user_id',Auth::user()->id)
        ->where('product_id',$request->productId)
        ->where('id',$request->cartId)
        ->delete();
    }

    //increase view count

    public function viewCount(Request $request){
        //logger($request->all());

        $product=Product::where('id',$request->productId)->first();
        $viewCount=[
            'view_count'=>$product->view_count+1,
        ];
        Product::where('id',$request->productId)->update($viewCount);
        
    }


    //get order data
    private function getOrderData($request){
        return [
            'user_id'=>$request->userId,
            'product_id'=>$request->pizzaId,
            'qty'=>$request->count
        ];
    }
}
