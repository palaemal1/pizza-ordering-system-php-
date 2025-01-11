
@extends('admin.layouts.master')

@section('title','Account Details Edit Info')

@section('content')




        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">


                    <div class="col-lg-6 offset-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Account Profile</h3>
                                </div>

                                <hr>
                                <form action="{{ route('admin#update',Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                <div class="row">
                                <div class="col-4 offset-1">
                                        @if(Auth::user()->image ==null)
                                            @if(Auth::user()->gender=='male')
                                                <img src="{{ asset('image/images.png') }}" alt="" class="img-thumbnail shadow-sm">
                                            @else
                                                <img src="{{ asset('image/download.jpg') }}" alt="" class="img-thumbnail shadow-sm">
                                            @endif
                                    @else
                                        <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="" class="img-thumbnail ">

                                    @endif
                                    <div class="my-2 ">
                                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="">
                                        @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="my-2">
                                        <button type="submit" class="btn btn-dark text-white col"><i class="fa-solid fa-circle-chevron-right me-2"></i>Update</button>
                                    </div>
                                    </div>
                                    <div class="row  col-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text" value="{{ old('name',Auth::user()->name) }}" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your name...">
                                            @error('name')
                                            <div class="invalid-feedback">
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                            </div>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="email" value="{{ old('email',Auth::user()->email) }}" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your Email...">
                                            @error('emalil')
                                            <div class="invalid-feedback">
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="tel" value="{{ old('phone',Auth::user()->phone) }}" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your phone number...">
                                            @error('phone')
                                            <div class="invalid-feedback">
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Gender</label>
                                            <select name="gender" id="" class="form-control">
                                                <option value="">Choose gender...</option>
                                                <option value="male"  @if(Auth::user()->gender =='male') selected @endif>Male</option>
                                                <option value="female" @if(Auth::user()->gender =='female') selected @endif>Female</option>
                                            </select>
                                            @error('gender')
                                            <div class="invalid-feedback">
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                            </div>
                                            @enderror


                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Address</label>
                                           <textarea name="address" class="form-control" placeholder="Enter your Address....." >{{ old('address',Auth::user()->address) }}</textarea>
                                           @error('address')
                                           <div class="invalid-feedback">
                                               <small class="text-danger">
                                                   {{ $message }}
                                               </small>
                                           </div>
                                           @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Role</label>
                                            <input id="cc-pament" name="role" type="text"  class="form-control @error('role') is-invalid @enderror" disabled value="{{ old('role',Auth::user()->role) }}">

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
