@extends('customer.layout.app')

@section('content')
    <h1>Search Results</h1>
    @if ($results)
        <ul>
            @foreach ($results as $result)
                <li>
                    <strong>{{ $result['name'] }}</strong>
                    <p>{{ $result['category'] }}</p>
                    <p>{{ $result['price'] }}</p>
                </li>
            @endforeach
        </ul>
    @else
        <p>No results found.</p>
    @endif
@endsection
