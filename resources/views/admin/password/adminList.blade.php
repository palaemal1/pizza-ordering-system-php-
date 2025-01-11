
@extends('admin.layouts.master')

@section('title','Admin List Page')

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
                                    <h2 class="title-1">Admin List</h2>

                                </div>
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
                                <h3>Total-{{ $admin->total() }}</h3>

                            </div>
                            <div class="col-3 offset-1">
                                <form action="{{ route('admin#list') }}" method="get">
                                    @csrf
                                    <div class="d-flex my-2">
                                    <input type="text" name="key"  id="" class="form-control" placeholder="Search..." value="{{ request('key') }}" >
                                    <button type="submit" class="btn bg-black text-white"><i class="fa-solid fa-magnifying-glass "></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>




                        @if(count($admin)!=0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead class="thead-dark  class="text-white"">
                                    <tr>

                                        <th class="text-white">Image</th>
                                        <th class="text-white">Admin List</th>
                                        <th class="text-white">Email</th>
                                        <th class="text-white">Phone number</th>
                                        <th class="text-white">Gender</th>
                                        <th class="text-white">Address</th>
                                        <th class="text-white">Created Date</th>
                                        <th class="text-white">Role</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>



                                    @foreach($admin as $a)
                                    <tr class="tr-shadow">
                                        <td>
                                            @if($a->image !=null)
                                            <img src="{{ asset('storage/'.$a->image) }}" alt="" style="width: 70px; height:100px;"  class="img-thumbnail shadow-sm"></td>
                                            @else
                                            {
                                                @if($a->gender =='male')
                                                <img src="{{ asset('image/images.png') }}" alt="" style="width: 70px; height:100px;"  class="img-thumbnail shadow-sm">
                                                @else
                                                <img src="{{ asset('image/download.jpg') }}" alt=""  style="width: 70px; height:100px;" class="img-thumbnail shadow-sm">
                                                @endif

                                            }

                                            @endif

                                        <td class="col-2">{{ $a->name }}</td>
                                        <td>{{ $a->email }}</td>
                                        <td>{{ $a->phone }}</td>
                                        <td>{{ $a->gender }}</td>
                                        <td>{{ $a->address }}</td>


                                        <td>{{ $a->created_at->format('M-j-Y h:m:A') }}</td>
                                        <td>
                                            <input type="hidden" class="userId" value="{{ $a->id }}">
                                            <select name="role"  class="form-control changeRole ">
                                                <option value="admin" @if($a->role =='admin') selected @endif>Admin</option>
                                                <option value="user" @if($a->role =='user') selected @endif>User</option>
                                            </select>
                                        </td>

                                        <td>
                                            <div class="table-data-feature">
                                               @if(Auth::user()->id==$a->id)
                                               <a href="#">
                                                <button class="item " data-toggle="tooltip" data-placement="top" title="Change Admin Role">
                                                    <i class="fa-solid fa-person-circle-minus text-success me-2"></i>
                                                </button>
                                                </a>
                                               <a href="#">
                                                <button class="item " data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="fa-solid fa-trash text-danger"></i>
                                                </button>
                                                </a>


                                               @else

                                               <a href="{{ route('admin#changeRole',Auth::user()->id) }}">
                                                <button class="item " data-toggle="tooltip" data-placement="top" title="Change Admin Role">
                                                    <i class="fa-solid fa-person-circle-minus text-success me-2"></i>
                                                </button>
                                                </a>

                                               <a href="{{ route('admin#adminDelete',Auth::user()->id) }}">
                                                <button class="item " data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="fa-solid fa-trash text-danger"></i>
                                                </button>
                                                </a>
                                               @endif

                                            </div>
                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                            <div class="">
                               {{ $admin->links() }}
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

@section('scriptSection')
<script>


    $(document).ready(function(){
        $('.changeRole').change(function(){
            $changeRole=$(this).val();
            $parentNode=$(this).parents("tr");
            $userId=$parentNode.find('.userId').val();
            $data={
                'userId':$userId,
                'role':$changeRole,
            };

            $.ajax({
                type:'get',
                url:'/admin/change/role',
                data:$data,
                dataType:'json',

            });
            window.location.href="/admin/list";

        })
    })



</script>

@endsection
