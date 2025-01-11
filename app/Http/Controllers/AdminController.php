<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
     //change password page
     public function changePasswordPage(){
        return view('admin.password.changePassword');
    }

    //change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);

        $user=User::select('password')->where('id',Auth::user()->id)->first();
        $dbPassword=$user->password;
        if(Hash::check($request->oldPassword,$dbPassword)){
            $data=['password'=>Hash::make($request->newPassword)];
            User::where('id',Auth::user()->id)->update($data);
           // Auth::logout();
            return redirect()->route('category#listPage')->with(['changeSuccess'=>'Password Changed Successfully...!']);

        }
        return back()->with(['notMatch'=>'The old password is not matching,Try again!']);
    }

    //Account info details
    public function details(){
        return view('admin.password.details');
    }

    //edit account info
    public function edit(){
        return view('admin.password.edit');
    }

    public function update($id,Request $request){
        $this->accountValidationCheck($request);
        $data=$this->getUserData($request);

        //update image
        if($request->hasFile('image')){
            $dbImg=User::where('id',$id)->first();
            $dbImg=$dbImg->image;

            if($dbImg !=null){
                Storage::delete('public/'.$dbImg);
            }

            $fileName=uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image']=$fileName;


        }

        User::where('id',$id)->update($data);
        return redirect()->route('admin#details')->with(['updateSuccess'=>'Admin Account Updated']);
    }

    //direct admin list
    public function adminList(){
        $admin=User::when(request('key'),function($query){
            $query->orWhere('name','like','%'.request('key').'%')
                ->orWhere('email','like','%'.request('key').'%')
                ->orWhere('gender','like','%'.request('key').'%')
                ->orWhere('phone','like','%'.request('key').'%')
                ->orWhere('address','like','%'.request('key').'%');
        })

        ->where('role','admin')->paginate(3);
        $admin->appends(request()->all());
        return view('admin.password.adminList',compact('admin'));
    }

    //direct admin delete
    public function adminDelete($id){
       User::where('id',$id)->delete();
       return back()->with(['deleteSuccess'=>'Admin account deleted.....']);
    }

    //change role
    public function changeRole($id){
        $account=User::where('id',$id)->first();
        return view('admin.password.changeRole',compact('account'));
    }

    //change role data
    public function change($id,Request $request){
        $data=$this->getUserValidationData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }

    //change admin Role with select option
    public function adminChangeRole(Request $request){
        User::where('id',$request->userId)->update([
            'role'=>$request->role,
        ]);
    }

    private function getUserValidationData($request){
        return [
            'role'=>$request->role
        ];
    }

    //validation check for account
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'gender'=>'required',
            'phone'=>'required',
            'image'=>'mimes:jpg,jpeg,png|file',
            'address'=>'required'
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
            'created_at'=>Carbon::now()
        ];
    }
    //check password validation
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6',
            'newPassword'=>'required|min:6',
            'confirmPassword'=>'required|min:6|same:newPassword'
        ])->validate();
    }
}
