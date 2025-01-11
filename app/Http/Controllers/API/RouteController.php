<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //get product list
    public function productList(){
       $product=Product::get();
       $user=User::get();
       $order=OrderList::get();
       $dataList=[
           'product'=>$product,
           'user'=>$user,
           'order'=>$order,
       ];

        return response()->json($dataList,200);
    }
    public function categoryList(){
        $data=Category::get();
        return response()->json($data,200);
    }
    public function userList(){
        $user=User::get();
        return response()->json($user,200);
    }
    public function pizzaList(){
        $piz=OrderList::get();
        $data=['product'=>[
            'pizza'=>[
                'pizzaList'=>$piz
            ]
        ]];
     //   return $data['product']['pizza']['pizzaList'][1]->total;
        return response()->json($data,200);
    }
    public function orderList(){
        $order=Order::get();
        return response()->json($order,200);
    }

    public function createCategory(Request $request){
        $data=[
            'name'=>$request->name,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ];
        
        $response=Category::create($data);
        return response()->json($response,200);
    }

    public function createContact(Request $request){
        $contact=[
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
        ];
        Contact::create($contact);
        $res=Contact::orderBy('created_at','desc')->get();

        return response()->json($res,200);
    }

    public function deleteCategory(Request $request){
        $data=Category::where('id',$request->category_id)->first();
        if(isset($data)){
            Category::where('id',$request->category_id)->delete();
            return response()->json([
             'message'=>'deleted message',
            ],200);
         }return response()->json(['message'=>'there is no category'],200);
        }
 
    public function deleteCate($id){
        $data=Category::where('id',$id)->first();
        if(isset($data)){
            Category::where('id',$id)->delete();
            return response()->json([
                'status'=>true,
                'message'=>'deleted category',
            ],200);
        }
        return response()->json([
            'status'=>false,
            'message'=>'there is no category',
        ],200);
    }

    public function categoryDetails(Request $request){
       $data= Category::where('id',$request->category_id)->first();
        if(isset($data)){
            return response()->json(['status'=>true,'category'=>$data],200);
        }
        return response()->json(['status'=>false,'category'=>'there is no category'],200);
    }

    public function cateDetails($id){
        $data=Category::where('id',$id)->first();
        if(isset($data)){
            return response()->json([
                'status'=>true,
                'category'=>$data
            ],200);
        }    
        return response()->json([
            'status'=>false,
            'category'=>'there is no category',
        ],200);
    }

    public function categoryUpdate(Request $request){
        $data=[
            'name'=>$request->name,
        ];
        $res=Category::where('id',$request->category_id)->first();
        if(isset($res)){
            Category::where('id',$request->category_id)->update($data);
            return response()->json([
                'status'=>true,
                'category'=>'category updated.',
                'categories'=>$res
            ],200);
        }
        return response()->json([
            'status'=>false,
            'category'=>'there is no category!',
        ],200);
        }
       
}
