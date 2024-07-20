@extends('customer.layout.app')

@section('title', 'Article')

@section('content')
    <div class="max-w-4xl mx-auto" id="articles-container">
        <!-- Articles will be dynamically appended here by JavaScript -->
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/customer/article.js') }}"></script>
@endsection
