<x-layout>
    <h1 class="text-3xl font-bold mb-4 p-3 border border-gray-400 text-center">Welcome to Workopia!</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        @forelse($jobs as $job)
            <x-job-card :job="$job"/>
        @empty
            <p>No jobs available!</p>
        @endforelse
    </div>
    <a href="{{ route('jobs.index') }}" class="block text-center text-xl text-indigo-700">
        <i class="fa fa-arrow-alt-circle-right"></i>
        See all jobs
    </a>
    <x-bottom-banner/>
</x-layout>
