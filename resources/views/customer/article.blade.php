@extends('customer.layout.app')

@section('title', 'Article')

@section('content')
    <div class="max-w-4xl mx-auto p-6" id="article-container">
        <article class="bg-white shadow-md rounded-lg p-6 mb-6">
            <figure class="mb-4">
                <img src="{{ $article->filePath }}" alt="{{ $article->title }}" class="w-full h-64 object-cover rounded-lg">
            </figure>
            <div class="article-content">
                <h1 class="text-2xl font-bold mb-2">{{ $article->title }}</h1>
                <span class="text-sm text-gray-500">{{ $article->category }}</span>
                <p class="mt-2 text-gray-700">{{ $article->description }}</p>
                <div class="mt-4">
                    {!! $article->content !!}
                </div>
            </div>
        </article>
    </div>
@endsection
