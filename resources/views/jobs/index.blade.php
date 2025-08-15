<x-layout>
    <div class="bg-blue-900 h-24 px-4 mb-4 flex items-center justify-center rounded">
        <x-search/>
    </div>

    {{-- Back button --}}
    @if(request()->has('keywords') || request()->has('location'))
        <a href="{{route('jobs.index')}}"
           class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded mb-4 inline-block">
            <i class="fa fa-arrow-left mr-1"></i> Back
        </a>
    @endif

    <x-slot name="title">Jobs available</x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        @forelse($jobs as $job)
            <x-job-card :job="$job"/>
        @empty
            <p class="text-xl">No jobs available!</p>
        @endforelse
    </div>
    {{ $jobs->links() }}
    <a href="/" class="block mt-6 text-center text-xl text-indigo-700">
        <i class="fa fa-arrow-alt-circle-left"></i>
        Home page
    </a>
</x-layout>
