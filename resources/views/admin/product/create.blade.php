
@extends('admin.layouts.master')

@section('title','Create Pizza List Page')

@section('content')




        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3 offset-8">
                            <a href="{{ route('products#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                        </div>
                    </div>

                    <div class="col-lg-6 offset-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Create your Food</h3>
                                </div>
                                <hr>
                                <form action="{{ route('products#create') }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                    @csrf


                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="pizzaName" type="text" value="{{ old('pizzaName') }}" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your food name...">
                                        @error('pizzaName')
                                        <div class="invalid-feedback">
                                             <small class="text-danger">{{ $message }}</small>
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Category</label>
                                       <select name="pizzaCategory" class="form-control @error('pizzaCategory') is-invalid @enderror" id="">
                                            <option value="">Choose your Category</option>
                                            @foreach($categories as $c)

                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                       </select>
                                       @error('pizzaCategory')
                                       <div class="invalid-feedback">
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                       </div>
                                       @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Description</label>
                                       <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="" cols="30" rows="10" placeholder="Enter your description for food.....">{{ old('description') }}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Image</label>
                                        <input id="cc-pament" name="pizzaImage" type="file" value="{{ old('pizzaImage') }}" class="form-control @error('pizzaImage') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                        @error('pizzaImage')
                                        <div class="invalid-feedback">
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                        <input id="cc-pament" name="waitingTime" type="number" value="{{ old('waitingTime') }}" class="form-control @error('waitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                        @error('waitingTime')
                                        <div class="invalid-feedback">
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        </div>
                                        @enderror
                                    </div>



                                       <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Price</label>
                                        <input id="cc-pament" name="price" type="number" value="{{ old('price') }}" class="form-control @error('price') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter  Price...">
                                        @error('price')
                                        <div class="invalid-feedback">
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        </div>
                                        @enderror
                                    </div>


                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                            <span id="payment-button-amount">Create</span>

                                            <i class="fa-solid fa-circle-right"></i>
                                        </button>
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
