
@extends('admin.layouts.master')

@section('title','Order List Page')

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
                                    <h2 class="title-1">Order List</h2>

                                </div>
                            </div>

                        </div>

                        <form action="{{ route('admin#changeStatus') }}" method="get">
                            @csrf
                            <div class="d-flex">
                                <div class="input-group mb-3">
                                    <label for="" class="me-2 mt-2">Order Status</label>
                                    <select name="orderStatus" id="orderStatus" class="form-control col-3 custom-select">
                                        <option value="">All</option>
                                        <option value="0" @if(request('orderStatus')=='0') selected @endif>Pending...</option>
                                        <option value="1" @if(request('orderStatus')=='1') selected @endif>Accept</option>
                                        <option value="2" @if(request('orderStatus')=='2') selected @endif>Reject</option>
                                    </select>
                                    <button type="submit" id="" class="btn btn-sm btn-dark text-white" ><i class="fa-solid fa-magnifying-glass me-2"></i>Search</button>
                                </div>
                            </div>

                        </form>



                        <div class="row">
                            <div class="col-3">
                               <h3 class="text-secondary"> Search Key-{{ request('key') }}</h3>
                            </div>
                            <div class="col-5 text-center">
                                <h3>Total-{{ $order->total() }}</h3>

                            </div>
                            <div class="col-3 offset-1">
                                <form action="{{ route('admin#orderList') }}" method="get">
                                    @csrf
                                    <div class="d-flex my-2">
                                    <input type="text" name="key"  id="" class="form-control" placeholder="Search..." value="{{ request('key') }}" >
                                    <button type="submit" class="btn bg-black text-white"><i class="fa-solid fa-magnifying-glass "></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>


                    @if(count($order)!=0)

                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center" >
                                <thead class="thead-dark">
                                    <tr >

                                        <th class="text-white">User ID</th>
                                        <th class="text-white">User Name</th>

                                        <th class="text-white">Order Date</th>
                                        <th class="text-white">Order Code</th>
                                        <th class="text-white">Amount</th>
                                        <th class="text-white">Status</th>
                                    </tr>
                                </thead>
                                <tbody id="dataList">
                                    @foreach($order as $o)
                                        <tr class="tr-shadow shadow-sm">
                                            <input type="hidden" class="orderId" value="{{ $o->id }}">
                                            <td class="">{{ $o->user_id }}</td>
                                            <td class="">{{ $o->user_name }}</td>
                                            <td class="">{{ $o->created_at->format('M-d-Y h:m') }}</td>
                                            <td class=""><a href="{{ route('admin#listInfo',$o->order_code) }}" class="text-decoration-none">{{ $o->order_code }}</a></td>
                                            <td class="">{{ $o->totalPrice }} Kyats</td>
                                            <td class="">
                                                <select name="status"  class="form-control changeStatus">
                                                    <option value="0" @if($o->status ==0) selected @endif>Pending...</option>
                                                    <option value="1" @if($o->status ==1) selected @endif>Accept</option>
                                                    <option value="2" @if($o->status ==2) selected @endif>Reject</option>
                                                </select>
                                            </td>

                                        </tr>

                                    @endforeach


                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $order->appends(request()->query())->links() }}
                            </div>

                        </div>
                        @else

                        <h3 class="text-secondary text-center mt-5">There is no Order Here!</h3>
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
        /*
        $('#orderStatus').change(function(){
            $status=$('#orderStatus').val();

            $.ajax({
                type:'get',
                url:'http://localhost/pizza_order-system/public/order/ajax/status',
                data:{
                    'status' : $status,
                },
                dataType:'json',
                success:function(response){
                    $list='';
                    for($i=0;$i<response.length;$i++){
                        $month=['January','Feburary','March','April','May','June','July','August','September','October','November','December'];
                        $dbDate=new Date(response[$i].created_at);
                        $finalDate=$month[$dbDate.getMonth()]+"-"+$dbDate.getDate()+"-"+$dbDate.getFullYear();

                        if(response[$i].status==0){
                            $message=`
                            <select name="status"  class="form-control changeStatus">
                                                    <option value="0" selected>Pending...</option>
                                                    <option value="1" >Accept</option>
                                                    <option value="2" >Reject</option>
                                                </select>
                            `;
                        }else if(response[$i].status==1){
                            $message=`
                            <select name="status"  class="form-control changeStatus">
                                                    <option value="0" >Pending...</option>
                                                    <option value="1" selected>Accept</option>
                                                    <option value="2" >Reject</option>
                                                </select>
                            `;
                        }else if(response[$i].status==2){
                            $message=`
                            <select name="status"  class="form-control changeStatus">
                                                    <option value="0" >Pending...</option>
                                                    <option value="1" >Accept</option>
                                                    <option value="2" selected>Reject</option>
                                                </select>
                            `;

                        }
                        $list=`
                        <tr class="tr-shadow shadow-sm">
                                            <input type="hidden" class="orderId" value="${response[$i].id}">
                                            <td class=""> ${response[$i].user_id} </td>
                                            <td class=""> ${response[$i].user_name} </td>
                                            <td class=""> ${$finalDate} </td>
                                            <td class=""> ${response[$i].order_code} </td>
                                            <td class=""> ${response[$i].totalPrice}  Kyats</td>
                                            <td class="">${$message}</td>

                                        </tr>
                        `;
                    }
                    $('#dataList').html($list);
                }
            })




        })
        */
        //change status
        $('.changeStatus').change(function(){
            $currentStatus=$(this).val();
            $parentNode=$(this).parents("tr");
            $orderId=$parentNode.find('.orderId').val();

            $data={
                'status':$currentStatus,
                'orderId':$orderId,
            };
            console.log($data);
            $.ajax({
                type:'get',
                url:'/order/ajax/change/status',
                data:$data,
                dataType:'json',
            })

        })
    })
</script>

@endsection
