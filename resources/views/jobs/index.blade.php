@extends('layout')

@section('title')
    Jobs available
@endsection

@section('content')

    <h1>Jobs available</h1>

    @if(!empty($jobs))
        <ul>
            @foreach($jobs as $job)
                <li>
                    {{ $job }}
                </li>
            @endforeach
        </ul>
    @else
        <p>No jobs found!</p>
    @endif
@endsection
