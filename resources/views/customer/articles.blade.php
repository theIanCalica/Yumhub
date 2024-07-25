@extends('customer.layout.app')

@section('title', 'Articles')

@section('content')
    <div class="max-w-4xl mx-auto" id="articles-container">
        @include('customer.load')
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            let nextPageUrl = "{{ $articles->nextPageUrl() }}";

            $(window).scroll(function() {
                if (
                    $(window).scrollTop() + $(window).height() >=
                    $(document).height() - 100
                ) {
                    if (nextPageUrl) {
                        loadMorePosts();
                    }
                }
            });

            function loadMorePosts() {
                $.ajax({
                    url: nextPageUrl,
                    type: "get",
                    beforeSend: function() {
                        nextPageUrl = "";
                    },
                    success: function(data) {
                        nextPageUrl = data.nextPageUrl;
                        $("#articles-container").append(data.view);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error loading more articles:", error);
                    },
                });
            }
        });
    </script>
@endsection
