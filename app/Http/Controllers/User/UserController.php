<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //direct home page
    public function home(){
        $pizza=Product::orderBy('created_at','desc')->get();
        $category=Category::get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();
        $history=Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }

    //direct change password page
    public function changePasswordPage(){
        return view('user.password.change');
    }

    //direct change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        $user=User::select('password')->where('id',Auth::user()->id)->first();
        $dbPassword=$user->password;

        if(Hash::check($request->oldPassword,$dbPassword)){
            $data=[
                'password'=>Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            return back()->with(['changeSuccess'=>'Password Change success']);

        }
        return back()->with(['notMatch'=>'The old password does not match,Try Again!']);


    }

    //account change page
    public function accountChangePage(){
        return view('user.profile.account');
    }

    //filter pizza
    public function filter($id){
        $pizza=Product::where('category_id',$id)->orderBy('created_at','desc')->get();
        $category=Category::get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();
        $history=Order::where('user_id',Auth::user()->id)->get();

        return view('user.main.home',compact('pizza','category','cart','history'));

    }
    //user message
  //  public function userMessage(){
        //dd($id);
        //$user=Contact::get();
        //return redirect()->route('admin#userMessage',compact('user'));
  //  }
    //describe pizza details
    public function pizzaDetails($pizzaId){
        $pizza=Product::where('id',$pizzaId)->first();
        $pizzaList=Product::get();
        return view('user.main.details',compact('pizza','pizzaList'));
    }
    //change account
    public function accountChange($id,Request $request){
        $this->accountValidationCheck($request);
        $data=$this->getUserData($request);
        if($request->hasFile('image')){
            $dbImg=User::where('id',$id)->first();
            $dbImg=$dbImg->image;

            if($dbImg !=null){
                Storage::delete('public/'.$dbImg);
            }
            $fileName=uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/'.$fileName);
            $data['image']=$fileName;

        }
        User::where('id',$id)->update($data);
        return back()->with(['updateSuccess'=>'User account updated....']);


    }
    //direct user history
    public function history(){
        $order=Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate('5');
        return view('user.main.history',compact('order'));
    }

    //direct user cart list
    public function cartList(){
        $cartList=Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as pizza_image')
                        ->leftJoin('products','products.id','carts.product_id')
                        ->where('carts.user_id',Auth::user()->id)
                        ->get();

                        $totalPrice=0;
                        foreach($cartList as $c){
                            $totalPrice+=$c->pizza_price*$c->qty;
                        }
        return view('user.main.cart',compact('cartList','totalPrice'));
    }

    //direct user list page
    public function userList(){
        $user=User::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
        })
                    ->orderBy('name','desc')
                    ->where('role','user')
                    ->paginate(3);
        return view('admin.user.list',compact('user'));
    }
     //user change role
    public function userChangeRole(Request $request){
        User::where('id',$request->userId)->update([
            'role'=>$request->role,
        ]);
    }

   //direct update user account page
   public function editAccount($id){
    $user=User::where('id',$id)->first();

    return view('admin.user.edit',compact('user'));
   }

   //update user info data
  public function updateAccount($id,Request $request){
    $this->accountValidationCheck($request);
    $data=$this->getUserData($request);
    if($request->hasFile('image')){
        $dbImage=User::where('id',$id)->first();
        $dbImage=$dbImage->image;

        if($dbImage !=null){
            Storage::delete('public/'.$dbImage);
        }
        $fileName=uniqid().$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/'.$fileName);
        $data['image']=$fileName;

    }
    User::where('id',$id)->update($data);
    return redirect()->route('admin#userList')->with(['updateSuccess'=>'User account updated....']);

  }

  //delete user account
    public function deleteUserAccount($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'User account deleted.....']);

    }

    //direct user contact page
    public function contact(){
        return view('user.contact.contact');
    }

    //check password validation
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6|max:10',
            'newPassword'=>'required|min:6|max:10',
            'confirmPassword'=>'required|min:6|max:10'
        ])->validate();
    }

    //check account validation
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'gender'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'image'=>'mimes:png,jpg,jpeg'
        ])->validate();
    }

    //get user data
    private function getUserData($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'gender'=>$request->gender,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'updated_at'=>Carbon::now()
        ];
    }
}
