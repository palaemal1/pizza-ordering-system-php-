@extends('user.layouts.master')


@section('content')

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table id="dataTable" class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                    </thead>
                    <tbody class="align-middle">
                        @foreach($cartList as $cart)
                        <tr>
                            <input type="hidden" class="cartId" name="cartId" value="{{ $cart->id }}">

                            <input type="hidden" class="userId" name="userId" value="{{ $cart->user_id }}">
                            <input type="hidden" class="productId" name="productId" id="" value="{{ $cart->product_id }}">

                            <td class="align-middle"><img src="{{ asset('storage/'.$cart->pizza_image) }}" alt="" style="width: 50px;" class="img-thumbnail shadow-sm"></td>
                            <td class="align-middle">{{ $cart->pizza_name }}</td>
                            <td class="align-middle" id="price">{{ $cart->pizza_price }} Kyats</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-warning btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm  border-0 text-center" id="qty" value="{{ $cart->qty }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-warning btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle" id="total">{{ $cart->pizza_price * $cart->qty }} Kyats</td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i class="fa fa-times"></i></button></td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6 >Subtotal</h6>
                            <h6 id="subTotal">{{ $totalPrice }} Kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery Fee</h6>
                            <h6 class="font-weight-medium">3000 Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalPrice">{{ $totalPrice+3000 }} Kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="OrderBtn">
                            Proceed To Checkout
                        </button>
                        <button id="removeBtn" class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="OrderBtn">
                                Clear Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

@endsection

@section('scriptSource')
    <script src="{{ asset('js/cart.js') }}"></script>
    <script>
        //$(document).ready(function(){
            $('#OrderBtn').click(function(){
                $orderList=[];
                $ran=Math.floor(Math.random() * 1000001);

                $('#dataTable tbody tr').each(function(index,row){
                    $orderList.push({
                        'userId':$(row).find('.userId').val(),
                        'productId':$(row).find('.productId').val(),
                        'qty':$(row).find('#qty').val(),
                        'total':Number($(row).find('#total').text().replace("Kyats"," ")),
                        'order_code' : 'POS'+ $ran
                });
                });
                $.ajax({
                    type:'get',
                    url:'/user/ajax/order',
                    data:Object.assign({},$orderList),
                    dataType:'json',
                    success:function(response){
                        if(response.status =="true"){
                            window.location.href="/user/home";
                        }

                    }
                })
            })

            $('#removeBtn').click(function(){
                $('#dataTable tbody tr').remove();
                $('#subTotal').html("0 Kyats");
                $('#finalPrice').html("3000 Kyats");

                $.ajax({
                    type:'get',
                    url:'/user/ajax/cart/clear',
                    dataType:'json'

                });
            })

            $('.btnRemove').click(function(){
            $parentNode=$(this).parents("tr");
            $productId=$parentNode.find('.productId').val();
            $cartId=$parentNode.find('.cartId').val();
            $parentNode.remove();
            $totalPrice=0;

            $('#dataTable tbody tr').each(function(index,row){
            $totalPrice+=Number($(row).find('#total').text().replace("Kyats",""))
            });
            $('#subTotal').html($totalPrice+" Kyats")
            $('#finalPrice').html(($totalPrice + 3000) +" Kyats");
            $.ajax({
                type:'get',
                url:'/user/ajax/clear/product',
                data:{'productId':$productId,
                        'cartId':$cartId
                },
                dataType:'json'
         });
    })
     //   })

    </script>

@endsection
