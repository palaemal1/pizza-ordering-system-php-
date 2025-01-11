
@extends('admin.layouts.master')

@section('title','Account Details Info')

@section('content')




        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">


                    <div class="col-lg-8 offset-2">
                          @if(session('updateSuccess'))
                    <div class="col-4 offset-8">
                     <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-circle-xmark text-success me-2"></i>{{ session('updateSuccess') }}
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>
                     </div>
                     @endif
                        <div class="card">

                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Account Info</h3>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-3 offset-2">
                                        @if(Auth::user()->image ==null)
                                            @if(Auth::user()->gender=='male')
                                                 <img src="{{ asset('image/images.png') }}" alt="" class="img-thumbnail shadow-sm">
                                            @else
                                                 <img src="{{ asset('image/download.jpg') }}" alt="" class="img-thumbnail shadow-sm">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="John Doe" class="img-thumbnail" />
                                        @endif


                                    </div>
                                    <div class="col-5 offset-1">
                                        <h4 class="my-3"><i class="fa-solid fa-user me-3"></i>{{ Auth::user()->name }}</h4>
                                        <h4 class="my-3"><i class="fa-solid fa-envelope me-3"></i>{{ Auth::user()->email }}</h4>
                                        <h4 class="my-3"><i class="fa-solid fa-phone me-3"></i>{{ Auth::user()->phone }}</h4>
                                        <h4 class="my-3"><i class="fa-solid fa-venus-mars me-3"></i>{{ Auth::user()->gender }}</h4>
                                        <h4 class="my-3"><i class="fa-solid fa-map-location-dot me-3"></i>{{ Auth::user()->address }}</h4>
                                        <h4 class="my-3"><i class="fa-solid fa-user-clock me-3"></i>{{ Auth::user()->created_at->format('M-j-Y ') }}</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 offset-2">
                                        <a href="{{ route('admin#edit') }}">
                                        <button type="submit" class="btn bg-dark text-white">
                                            <i class="fa-solid fa-pen-to-square me-2"></i> Edit Profile
                                        </button>
                                    </a>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->


@endsection
