@extends('user.layouts.master')


@section('content')

    <!-- Cart Start -->
    <div class="container-fluid" style="height:350px;">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table id="dataTable" class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order ID</th>
                            <th>Total Price</th>
                            <th>Status</th>
                    </thead>
                    <tbody class="align-middle">
                        @foreach($order as $odr)

                            <tr>
                                <td class="align-middle">{{ $odr->created_at->format('M-j-Y h:m:A') }}</td>
                                <td class="align-middle">{{ $odr->order_code }}</td>
                                <td class="align-middle">{{ $odr->totalPrice }} Kyats</td>
                                <td class="align-middle">
                                    @if($odr->status ==0)
                                        <span class="text-warning"><i class="fa-solid fa-circle-pause me-2 text-warning"></i>Pending.....</span>
                                    @elseif($odr->status==1)
                                        <span class="text-success"><i class="fa-solid fa-check me-2 text-success"></i>Success</span>
                                    @elseif($odr->status ==2)
                                        <span class="text-danger"><i class="fa-solid fa-triangle-exclamation me-2 text-danger"></i>Rejected</span>

                                    @endif
                                </td>

                            </tr>

                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $order->links() }}

                </div>
            </div>

        </div>
    </div>
    <!-- Cart End -->

@endsection


