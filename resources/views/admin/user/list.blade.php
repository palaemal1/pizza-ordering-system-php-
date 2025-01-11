
@extends('admin.layouts.master')

@section('title','User List Page')

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
                                    <h2 class="title-1">User List</h2>

                                </div>
                            </div>

                        </div>
                        @if(session('deletedSuccess'))
                        <div class="col-4 offset-8">
                         <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark text-danger me-2"></i>{{ session('deletedSuccess') }}
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                         </div>
                         </div>
                         @endif
                        <div class="row">
                            <div class="col-3">
                               <h3 class="text-secondary"> Search Key-{{ request('key') }}</h3>
                            </div>
                            <div class="col-5 text-center">
                                 <h3>Total-{{ $user->total() }}</h3>

                            </div>
                            <div class="col-3 offset-1">
                                <form action="{{ route('admin#userList') }}" method="get">
                                    @csrf
                                    <div class="d-flex my-2">
                                    <input type="text" name="key"  id="" class="form-control" placeholder="Search..." value="{{ request('key') }}" >
                                    <button type="submit" class="btn bg-black text-white"><i class="fa-solid fa-magnifying-glass "></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>


                    @if(count($user)!=0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center" >
                                <thead class="thead-dark">
                                    <tr >

                                        <th class="text-white">Image</th>
                                        <th class="text-white">Name</th>

                                        <th class="text-white">Gender</th>
                                        <th class="text-white">Phone</th>
                                        <th class="text-white">Email</th>
                                        <th class="text-white">Address</th>
                                        <th class="text-white">Role</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="dataList">
                                    @foreach($user as $u)
                                        <tr class="tr-shadow">

                                        <td class="align-middle">
                                            @if($u->image==null)
                                                @if($u->gender=='male')
                                                    <img src="{{ asset('image/images.png') }}" alt="" style="width: 70px; height:100px;"  class="img-thumbnail shadow-sm">
                                                @else
                                                    <img src="{{ asset('image/download.jpg') }}" alt=""  style="width: 70px; height:100px;" class="img-thumbnail shadow-sm">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/'.$u->image) }}" alt="" style="width:70px; height:100px;" class="img-thumbnail shadow-sm">
                                            @endif
                                        </td>
                                        <input type="hidden" class="userId" value="{{ $u->id }}">

                                        <td class="align-middle">{{ $u->name }}</td>
                                        <td class="align-middle">{{ $u->gender }}</td>
                                        <td class="align-middle">{{ $u->phone }}</td>
                                        <td class="align-middle">{{ $u->email }}</td>
                                        <td class="align-middle">{{ $u->address }}</td>
                                        <td class="align-middle">
                                            <select  class="form-control changeRole">
                                                <option value="admin" @if($u->role=='admin') selected @endif>Admin</option>
                                                <option value="user" @if($u->role=='user') selected @endif>User</option>
                                            </select>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('admin#editUserAccount',$u->id) }}">
                                                <button class="item " data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fa-solid fa-person-circle-minus text-success me-2"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('admin#deleteUserAccount',$u->id) }}">
                                                <button class="item btnDelete " data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="fa-solid fa-trash text-danger"></i>
                                                </button>
                                            </a>
                                        </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="mt-3">
                                    {{ $user->links() }}
                            </div>

                        </div>
                    @else
                        <h3 class="text-secondary text-center mt-5">There is no User Here!</h3>
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
                url:'/user/change/role',
                data:$data,
                dataType:'json',

            });

            window.location.href="/user/list";

        })
    })

    </script>

@endsection
