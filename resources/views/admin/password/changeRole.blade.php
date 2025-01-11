
@extends('admin.layouts.master')

@section('title','Account  Change Role')

@section('content')




        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">


                    <div class="col-lg-6 offset-3">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('admin#list') }}">
                                    <div class="ms-2">
                                        <i class="fa-solid fa-arrow-left text-dark" ></i>
                                    </div>
                                </a>


                                <div class="card-title">
                                    <h3 class="text-center title-2">Chagne Role</h3>
                                </div>

                                <hr>
                                <form action="{{ route('admin#changeRoleData',$account->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                <div class="row">
                                <div class="col-4 offset-1">
                                        @if($account->image ==null)
                                            @if($account->gender=='male')
                                                <img src="{{ asset('image/images.png') }}" alt="" class="img-thumbnail shadow-sm">
                                            @else
                                                <img src="{{ asset('image/download.jpg') }}" alt="" class="img-thumbnail shadow-sm">
                                            @endif
                                    @else
                                        <img src="{{ asset('storage/'.$account->image) }}" alt="" class="img-thumbnail ">

                                    @endif

                                    <div class="my-2 ">
                                        <button type="submit" class="btn btn-dark text-white col-9"><i class="fa-solid fa-circle-chevron-right me-2"></i>Change</button>
                                    </div>
                                    </div>
                                    <div class="row  col-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament"  disabled name="name" type="text" value="{{ old('name',$account->name) }}" class="form-control " aria-required="true" aria-invalid="false" placeholder="Enter your name...">


                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Role</label>
                                            <select name="role" id="" class="form-control">
                                                <option value="admin" @if($account->role=='admin') selected @endif>Admin</option>
                                                <option value="user"@if($account->role=='user') selected  @endif>User</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament"  disabled name="email" type="email" value="{{ old('email',$account->email) }}" class="form-control " aria-required="true" aria-invalid="false" placeholder="Enter your Email...">

                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" disabled  name="phone" type="tel" value="{{ old('phone',$account->phone) }}" class="form-control " aria-required="true" aria-invalid="false" placeholder="Enter your phone number...">

                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Gender</label>
                                            <select name="gender"  disabled id="" class="form-control">
                                                <option value="">Choose gender...</option>
                                                <option value="male"  @if($account->gender =='male') selected @endif>Male</option>
                                                <option value="female" @if($account->gender =='female') selected @endif>Female</option>
                                            </select>



                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Address</label>
                                           <textarea name="address" disabled  class="form-control" placeholder="Enter your Address....." >{{ old('address',$account->address) }}</textarea>

                                        </div>

                                    </div>

                                </div>

                            </form>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->


@endsection
