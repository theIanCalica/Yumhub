@extends('customer.layout.app')

@section('content')
    <div class=" container mx-auto p-10 ">
        <div class="grid grid-cols-2  gap-4 mt-5">
            <!-- Column 1 content -->
            <div class="p-4 text-center flex items-center justify-center">
                <img src="{{ asset('svg/about-us/firstPic.svg') }}" class="h-60" alt="">
            </div>


            <!-- Column 2 content -->
            <div class="p-6">
                <h1 class="text-4xl font-bold mb-4 mt-12">Mission</h1>
                <p class=" leading-relaxed">
                    To connect users seamlessly with local vendors, offering convenience, choice, and satisfaction in every
                    order.
                </p>
            </div>

        </div>
    </div>
@endsection
