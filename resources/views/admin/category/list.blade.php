
@extends('admin.layouts.master')

@section('title','Category List Page')

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
                                    <h2 class="title-1">Category List</h2>

                                </div>
                            </div>
                            <div class="table-data__tool-right">
                                <a href="{{ route('category#createPage') }}">
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                        <i class="zmdi zmdi-plus"></i>Add Category
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

                            @if(session('deletedSuccess'))
                            <div class="col-4 offset-8">
                             <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-xmark text-danger me-2"></i>{{ session('deletedSuccess') }}
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
                                <h3>Total-{{ $categories->total() }}</h3>

                            </div>
                            <div class="col-3 offset-1">
                                <form action="{{ route('category#listPage') }}" method="get">
                                    @csrf
                                    <div class="d-flex my-2">
                                    <input type="text" name="key"  id="" class="form-control" placeholder="Search..." value="{{ request('key') }}" >
                                    <button type="submit" class="btn bg-black text-white"><i class="fa-solid fa-magnifying-glass "></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>



                        @if(count($categories)!=0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-white">ID</th>
                                        <th class="text-white">Category Name</th>
                                        <th class="text-white">Created Date</th>

                                        <th class="text-white"></th>
                                    </tr>
                                </thead>

                                <tbody>



                                    @foreach($categories as $category)
                                    <tr class="tr-shadow">
                                        <td>{{ $category->id }}</td>
                                        <td class="col-6">{{ $category->name }}</td>

                                        <td>{{ $category->created_at->format('M-j-Y h:m:A') }}</td>

                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{ route('category#editPage',$category->id) }}">
                                                    <button class="item " data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa-solid fa-pen-to-square text-success"></i>
                                                    </button>
                                                </a>

                                                <a href="{{ route('category#delete',$category->id) }}">
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
                            <div class="">
                                {{ $categories->appends(request()->query())->links() }}
                            </div>


                        </div>

                        @else
                        <h3 class="text-secondary text-center text-success mb-5">There is no category Here!</h3>
                        @endif
                        <!-- END DATA TABLE -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->


@endsection
