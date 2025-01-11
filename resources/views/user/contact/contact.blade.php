@extends('user.layouts.master')

@section('content')
<div class="container-fluid bg-secondary col-8">
    <div class="row px-xl-5">
            <a href="{{ route('user#home') }}" class="my-3"><i class="fa-solid fa-arrow-left text-white"></i></a>
            <div class="col-lg-6 offset-3">
                    <h3 class="text-white my-3 text-center">Contact with Us</h3>
            </div>
            <div class="row col-8 offset-2 pb-3">
                <div class="col bg-white shadow-sm my-5">
                    <form action="{{ route('user#createMessage') }}" method="post">
                        @csrf
                    <h5 class=" d-block my-3">Get in touch</h5>
                    <div class="d-flex">
                        <input type="text" name="name" placeholder="Name"  value="{{ old('name') }}" id="" class="form-control me-3">
                        <input type="email" class="form-control" value="{{ old('email') }}" name="email" placeholder="Email">
                    </div>
                    <div class="my-2">
                        <input type="text" placeholder="Subject..." name="title"  value="{{ old('title') }}" class="form-control">
                    </div>
                    <div class="my-2">
                        <textarea name="message" id="" cols="30" rows="10" placeholder="Message..." class="form-control"> {{ old('message') }}</textarea>
                    </div>
                    <div class="mb-3 ">
                        <button class=" btn  float-right my-3 bg-primary text-white" type="submit">Send</button>
                    </div>
                    </form>
                </div>
                <div class="col-6 bg-primary my-3 shadow-sm border-radius-5">
                    <div class="">
                        <h5 class="text-white my-5">Contact Us</h5>
                        <div class="my-3">
                            <i class="fa-solid fa-location-dot text-white me-3"></i><span class="me-3 text-white">123 Street, New York, USA</span>

                        </div>
                        <div class="my-4">
                            <i class="fa-solid fa-phone-flip text-white me-3"></i><span class="me-3 text-white">+012 345 67890</span>
                        </div>
                        <div class="my-4">
                            <i class="fa-solid fa-envelope text-white me-3"></i><span class="me-3 text-white">info@example.com</span>
                        </div>
                        <div class="my-4">
                            <h6 class="text-white my-2">
                                Follow Us
                            </h6>
                            <a href="" class="text-decoration-none">

                                <i class="fa-brands fa-square-twitter text-white me-2"></i>
                            </a>
                            <a href="" class="text-decoration-none">
                                <i class="fa-brands fa-square-facebook text-white me-2"></i>
                            </a>
                            <a href="" class="text-decoration-none">
                                <i class="fa-brands fa-square-instagram text-white me-2"></i>
                            </a>
                            <a href="" class="text-decoration-none">
                                <i class="fa-brands fa-telegram text-white me-2"></i>
                            </a>

                        </div>
                    </div>
                </div>
            </div>

    </div>
</div>
@endsection
