<x-layout>
    <x-slot name="title">Jobs available</x-slot>
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
</x-layout>
