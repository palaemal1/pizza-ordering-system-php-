


@extends('admin.layouts.master')

@section('title','User contact List Page')

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
                                    <h2 class="title-1">User Contact List</h2>

                                </div>
                            </div>

                        </div>



                  @if(count($user)!=0)

                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center" >
                                <thead class="thead-dark">
                                    <tr >
                                        <th class="text-white">User Name</th>

                                        <th class="text-white">Email</th>
                                        <th class="text-white">Subject</th>
                                        <th class="text-white">Message</th>
                                        <th class="text-white">Date</th>
                                    </tr>
                                </thead>
                                <tbody id="dataList">



                                    @foreach($user as $o)
                                        <tr class="tr-shadow shadow-sm">
                                            <input type="hidden" value="{{ $o->id }}">
                                            <td class="">{{ $o->name }}</td>
                                            <td class="">{{ $o->email }}</td>
                                            <td class="">{{ $o->subject }}</td>
                                            <td class="">{{ $o->message }}</td>
                                            <td class="">{{ $o->created_at->format('M-d-Y h:m') }}</td>


                                        </tr>

                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                         @else

                        <h3 class="text-secondary text-center mt-5">There is no Message Here!</h3>
                        @endif
                        <!-- END DATA TABLE -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->


@endsection


