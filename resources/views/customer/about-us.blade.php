@extends('customer.layout.app')

@section('content')
    <div class=" container mx-auto p-10  ">
        <div class="container w-full mt-10  ">
            <h1 class="text-5xl font-black text-center">Charging forward together</h1>
        </div>


        <div class="container w-full mt-10 flex justify-center">
            <div class="max-w-10xl rounded overflow-hidden shadow-lg">
                <img src="{{ asset('images/1_aboutUs.jpg') }}" alt="" class="h-lvh w-full">
                <div class="px-6 py-4">
                    <p class="text-black text-2xl px-12 font-medium text-center">
                        Guided by the Yumhub Way, our mission is to drive Southeast Asia forward by creating economic
                        empowerment for everyone.
                    </p>
                </div>
            </div>
        </div>

    </div>
@endsection
