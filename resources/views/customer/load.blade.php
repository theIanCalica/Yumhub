@foreach ($articles as $article)
    <div class="flex items-center bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden mb-6">
        <div class="w-48 h-48 flex-shrink-0">
            <img class="w-full h-full object-cover" src="{{ $article->filePath }}" alt="Article Image">
        </div>
        <div class="p-6 flex flex-col">
            <span class="text-gray-500 text-sm mb-1">Published on: {{ $article->created_at->format('F d, Y') }}</span>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $article->title }}</h2>
            <p class="text-gray-700 text-base">
                {{ $article->description }}
            </p>
        </div>
    </div>
@endforeach
