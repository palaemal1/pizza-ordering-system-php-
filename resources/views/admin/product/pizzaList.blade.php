
@extends('admin.layouts.master')

@section('title','Pizza List Page')

@section('content')




        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <!-- DATA TABLE -->
                        <div class="table-data__tool">
                            <div class="table-data__tool-left">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Product List</h2>

                                </div>
                            </div>
                            <div class="table-data__tool-right">
                                <a href="{{ route('products#createPizzaPage') }}">
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                        <i class="zmdi zmdi-plus"></i>Add Food
                                    </button>
                                </a>

                            </div>
                        </div>

                           @if(session('createdSuccess'))
                           <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-check text-success me-2"></i>{{ session('createdSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            </div>
                            @endif

                            @if(session('deleteSuccess'))
                            <div class="col-4 offset-8">
                             <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-xmark text-danger me-2"></i>{{ session('deleteSuccess') }}
                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>
                             </div>
                             @endif

                             @if(session('updatedSuccess'))
                             <div class="col-4 offset-8">
                              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                 <i class="fa-solid fa-circle-xmark text-warning me-2"></i>{{ session('updatedSuccess') }}
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                              </div>
                              @endif
                        <div class="row">
                            <div class="col-3">
                               <h3 class="text-secondary"> Search Key-{{ request('key') }}</h3>
                            </div>
                            <div class="col-5 text-center">
                                <h3>Total-{{ $pizzas->total() }}</h3>

                            </div>
                            <div class="col-3 offset-1">
                                <form action="{{ route('products#list') }}" method="get">
                                    @csrf
                                    <div class="d-flex my-2">
                                    <input type="text" name="key"  id="" class="form-control" placeholder="Search..." value="{{ request('key') }}" >
                                    <button type="submit" class="btn bg-black text-white"><i class="fa-solid fa-magnifying-glass "></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        @if(count($pizzas)!=0)


                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead class="thead-dark">
                                    <tr >

                                        <th class="text-white">Pizza Image</th>
                                        <th class="text-white">Name</th>

                                        <th class="text-white">Price</th>
                                        <th class="text-white">Category</th>
                                        <th class="text-white">View Count</th>
                                        <th class="text-white"></th>
                                    </tr>
                                </thead>

                                <tbody>



                                    @foreach($pizzas as $pizza)
                                    <tr class="tr-shadow shadow-sm">
                                        <td class="col-2"><img src="{{ asset('storage/'.$pizza->image) }}" class="img-thumbnail shadow-sm" alt=""></td>
                                        <td class="col-3">{{ $pizza->name }}</td>
                                        <td class="col-2">{{ $pizza->price }}</td>
                                        <td class="col-2">{{ $pizza->category_name }}</td>

                                        <td class=""><i class="fa-solid fa-eye text-primary me-2"></i>{{ $pizza->view_count }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{ route('products#edit',$pizza->id) }}">
                                                    <button class="item " data-toggle="tooltip" data-placement="top" title="View">
                                                        <i class="fa-solid fa-eye text-warning"></i>
                                                    </button>
                                                </a>


                                                <a href="{{ route('products#updatePage',$pizza->id) }}">
                                                    <button class="item " data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa-solid fa-pen-to-square text-success"></i>
                                                    </button>
                                                </a>

                                                <a href="{{ route('products#delete',$pizza->id) }}">
                                                <button class="item " data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="fa-solid fa-trash text-danger"></i>
                                                </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $pizzas->links() }}
                            </div>


                        </div>
                        @else
                        <h3 class="text-secondary text-center mt-5">There is no Pizza Here!</h3>

                        @endif
                        <!-- END DATA TABLE -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->


@endsection
