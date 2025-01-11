use App\Http\Controllers\OrderController;

@extends('admin.layouts.master')

@section('title','Product  List Page')

@section('content')




        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <!-- DATA TABLE -->


                        <div class="table-responsive table-responsive-data2">
                            <div class="mb-2">
                                <a href="{{ route('admin#orderList') }}" class="text-dark  text-decoration-none"><i class="fa-solid fa-arrow-left text-dark me-2"></i>Back</a>

                            </div>
                            <div class="row col-5">
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <div class="card-header">
                                         <h4>   <i class="fa-solid fa-clipboard me-2 text-success"></i>Order Info </h4>
                                         <span class=" text-secondary text-warning"><i class="fa-solid fa-triangle-exclamation text-warning me-2"></i>Include Delivery Charges</span>
                                        </div>
                                        <div class="row my-2">
                                           <div class="col"><i class="fa-solid fa-barcode me-2 text-success"></i>Order Code</div>
                                            <div class="col">{{ $orderList[0]->order_code }}</div>
                                        </div>
                                        <div class="row mb-2">
                                           <div class="col"> <i class="fa-solid fa-user me-2 text-success"></i>Customer Name</div>
                                            <div class="col h6">{{ strtoupper($orderList[0]->user_name) }}</div>
                                        </div>
                                        <div class="row mb-2">
                                           <div class="col"> <i class="fa-solid fa-clock me-2 text-success"></i>Order Date</div>
                                            <div class="col">{{ $orderList[0]->created_at->format('M-d-Y h:m') }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col"> <i class="fa-solid fa-money-bill me-2 text-success"></i>Total Price</div>
                                             <div class="col">{{ $order->totalPrice }} Kyats</div>
                                         </div>
                                    </div>
                                </div>
                            </div>
                            <form action="" enctype="multipart/form-data">
                                @csrf
                                <table class="table table-data2 text-center" >
                                    <thead class="thead-dark">
                                        <tr >

                                            <th class="text-white">Order ID</th>
                                            <th class="text-white">Product Image</th>
                                            <th class="text-white">Product Name</th>
                                            <th class="text-white">Ouatity</th>
                                            <th class="text-white">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataList">
                                           @foreach($orderList as $o)
                                                <td class="align-middle">{{ $o->id }}</td>
                                                <td class="align-middle">
                                                    <img src="{{ asset('storage/'.$o->product_image) }}" alt="" style="width:100px;" class="img-thumbnail shadow-sm">
                                                </td>
                                                <th class="align-middle">{{ $o->product_name }}</th>
                                                <td class="align-middle">{{ $o->qty }}</td>
                                                <td class="align-middle">{{ $o->total }} Kyats</td>
                                            @endforeach
                                    </tbody>
                                </table>

                            </form>
                            <div class="mt-3">
                            </div>

                        </div>

                        <!-- END DATA TABLE -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->


@endsection


