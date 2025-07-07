<x-layout>
    <x-slot name="title">Jobs available</x-slot>
    <h1 class="font-bold">Jobs available:</h1>

    <ul>
        @forelse($jobs as $job)
            <li><a href="{{ route('jobs.show', $job->id) }}">
                    {{ $job->title }}</a> - {{ $job->description }}
            </li>
        @empty
            <p>No jobs found!</p>
        @endforelse
    </ul>
</x-layout>
