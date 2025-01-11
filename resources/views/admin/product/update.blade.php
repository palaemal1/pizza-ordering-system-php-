
@extends('admin.layouts.master')

@section('title','Update Pizza Data')

@section('content')




        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">


                    <div class="col-lg-6 offset-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Update Pizza</h3>
                                </div>

                                <hr>
                                <form action="{{ route('products#update') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                <div class="row">
                                <div class="col-4 offset-1">
                                    <input type="hidden" name="pizzaId" value={{ $pizza->id }}>

                                        <img src="{{ asset('storage/'.$pizza->image) }}" alt="" class="img-thumbnail ">


                                    <div class="my-2 ">
                                        <input type="file" name="pizzaImage" class="form-control @error('pizzaImage') is-invalid @enderror" id="">
                                        @error('pizzaImage')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <a href="{{ route('products#update') }}">
                                        <div class="my-2">
                                        <button type="submit" class="btn btn-dark text-white col"><i class="fa-solid fa-circle-chevron-right me-2"></i>Update</button>
                                    </div>
                                    </a>

                                    </div>
                                    <div class="row  col-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="pizzaName" type="text" value="{{ old('pizzaName',$pizza->name) }}" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your pizza name you want to order...">
                                            @error('pizzaName')
                                            <div class="invalid-feedback">
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                            </div>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Description</label>
                                            <textarea name="description" id="" cols="30" rows="10" placeholder="Enter your pizza info what you describe..." class="form-control">{{ old('description',$pizza->description) }}</textarea>
                                            @error('description')
                                            <div class="invalid-feedback">
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Category</label>
                                            <select name="pizzaCategory" id="" class="form-control @error('pizzaCategory') is-invalid @enderror">
                                                <option value="">Choose your pizza category...</option>
                                                @foreach($category as $c)
                                                     <option value="{{ $c->id }}" @if($pizza->category_id == $c->id) selected @endif>{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('pizzaCategory')
                                                <div class="invalid-feedback">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="price" type="tel" value="{{ old('price',$pizza->price) }}" class="form-control @error('price') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your pizza Price...">
                                            @error('price')
                                            <div class="invalid-feedback">
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                            <input type="number" name="waitingTime" value="{{ old('waitingTime',$pizza->waiting_time) }}" placeholder="Enter hours when you can wait..." id="" class="form-control @error('waitingTime') is-invalid @enderror">
                                            @error('waitingTime')
                                            <div class="invalid-feedback">
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                            </div>
                                            @enderror


                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Created Date</label>
                                           <input type="text" name="createdDate" class="form-control" value="{{ old('createdDate',$pizza->created_at->format('M-d-Y ')) }}" placeholder="Enter your Created pizza date....." >
                                           @error('createdDate')
                                           <div class="invalid-feedback">
                                               <small class="text-danger">
                                                   {{ $message }}
                                               </small>
                                           </div>
                                           @enderror
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
