<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //direct product list
    public function list(){
        $pizzas=Product::select('products.*','categories.name as category_name')
                        ->when(request('key'),function($query){
                        $query->where('products.name','like','%'.request('key').'%');
        })
                        ->leftJoin('categories','products.category_id','categories.id')
                        ->orderBy('products.created_at','desc')
                        ->paginate(3);
                        $pizzas->appends(request()->all());
        return view('admin.product.pizzaList',compact('pizzas'));
    }

    //direct create pizza page
    public function createPizzaPage(){
        $categories=Category::select('id','name')->get();

        return view('admin.product.create',compact('categories'));;
    }

    //create pizza data
    public function create(Request $request){
        $this->productValidationCheck($request,"create");
        $data=$this->getProductInfo($request);

            $fileName=uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$fileName);

            $data['image']=$fileName;

        Product::create($data);
        return redirect()->route('products#list');
    }

    //delete pizza info
    public function delete($id){
        Product::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Product deleted successfully!']);
    }

    //edit pizza
    public function edit($id){
        $pizzas=Product::select('products.*','categories.name as category_name')
                    ->leftJoin('categories','products.category_id','categories.id')
                    ->where('products.id',$id)->first();
        return view('admin.product.edit',compact('pizzas'));
    }

    //update pizza data
    public function updatePage($id){
        $pizza=Product::where('id',$id)->first();
        $category=Category::select('id','name')->get();
        return view('admin.product.update',compact('pizza','category'));
    }

    //update data for pizza
    public function update(Request $request){
        $this->productValidationCheck($request,"update");
        $data=$this->getProductInfo($request);

        if($request->hasFile('pizzaImage')){
            $dbImg=Product::where('id',$request->pizzaId)->first();
            $dbImg=$dbImg->image;
            if($dbImg!= null){
                Storage::delete('public/'.$dbImg);
            }

            $fileName=uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$fileName);
            $data['image']=$fileName;
        }
        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('products#list');

    }

    //check product
    private function productValidationCheck($request,$action){
        $validationRules=[
            'pizzaName'=>'required|min:5|unique:products,name,'.$request->pizzaId,
            'pizzaCategory'=>'required',
            'description'=>'required|min:10',

            'price'=>'required',
            'waitingTime'=>'required'
        ];
        $validationRules['pizzaImage']=$action =="create"?     'required|mimes:png,jpg,jpeg,webp|file' : 'mimes:png,jpg,jpeg|file';
        Validator::make($request->all(),$validationRules)->validate();
    }

    //get product info
    private function getProductInfo($request){
        return [
            'category_id'=>$request->pizzaCategory,
            'name'=>$request->pizzaName,
            'description'=>$request->description,
            'price'=>$request->price,
            'waiting_time'=>$request->waitingTime
        ];
    }
}
