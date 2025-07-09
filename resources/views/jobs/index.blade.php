<x-layout>
    <x-slot name="title">Jobs available</x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        @forelse($jobs as $job)
            <x-job-card :job="$job"/>
        @empty
            <p>No jobs available!</p>
        @endforelse
    </div>
    <a href="/" class="block text-center text-xl text-indigo-700">
        <i class="fa fa-arrow-alt-circle-left"></i>
        Home page
    </a>
</x-layout>
