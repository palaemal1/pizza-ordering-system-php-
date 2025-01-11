<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //create message
    public function sendMessage(Request $request){
        $data=$this->getUserData($request);
        Contact::create($data);
        return back();
    }

    //user message
     public function userMessage(){
        //dd($id);
        $user=Contact::get();
        return view('admin.user.message',compact('user'));
       // return redirect()->route('admin#userMessage',compact('user'));
    }

    private function getUserData(Request $request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'subject'=>$request->title,
            'message'=>$request->message
        ];
    }
}
