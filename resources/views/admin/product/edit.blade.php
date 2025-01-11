
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
                                <div class="ms-5">

                                        <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>

                                </div>
                                <div class="card-title">
                                    <h3 class="text-center title">Pizza Details</h3>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-3 offset-1">

                                            <img src="{{ asset('storage/'.$pizzas->image) }}" alt="" class="img-thumbnail shadow-sm ">



                                    </div>
                                    <div class="col-7 ">
                                        <div class="my-3 h3"><i class="fa-solid fa-pizza-slice me-2"></i><span class="text-secondary">{{ $pizzas->name }}</span></div>

                                        <span class="my-3 btn bg-dark text-white"><i class="fa-solid fa-hand-holding-dollar me-2"></i>{{ $pizzas->price }}</span>
                                        <span class="my-3 btn bg-dark text-white"><i class="fa-solid fa-clock me-2"></i>{{ $pizzas->waiting_time }}mins</span>
                                        <span class="my-3 btn bg-dark text-white"><i class="fa-solid fa-eye me-2"></i>{{ $pizzas->view_count }}</span>
                                        <span class="my-3 btn bg-dark text-white"><i class="fa-solid fa-user-clock me-2"></i>{{ $pizzas->created_at->format('M-j-Y ') }}</span>
                                        <span class="my-3 btn bg-dark text-white"><i class="fa-solid fa-clone me-2"></i>{{ $pizzas->category_name }}</span>
                                        <div class="my-3  h3"><i class="fa-solid fa-file-lines me-2 "></i><span class="text-secondary">Details</span></div>
                                        <div class="my-3 h5">{{ $pizzas->description }}</div>
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
