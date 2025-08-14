<x-layout>
    <section class="flex flex-col md:flex-row gap-4">
        {{--Profile info form --}}
        <div class="bg-white p-8 rounded-lg shadow-md w-full">
            <h3 class="text-3xl font-bold mb-4 text-center">
                Profile Info
            </h3>
            @if($user->avatar)
                <div class="flex justify-center mt-2">
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}"
                         class="w-32 h-32 object-cover rounded-full"/>
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <x-inputs.text id="name" name="name" label="Name" value="{{ $user->name }}"/>
                <x-inputs.text id="email" name="email" label="Email address" type="email" value="{{ $user->email }}"/>
                <x-inputs.file id="avatar" name="avatar" label="Upload Avatar" value="{{ $user->avatar }}"/>
                <button type="submit"
                        class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 border rounded focus:outline-none">
                    Update
                </button>
            </form>
        </div>


        {{--Job Listings --}}
        <div class="bg-white p-8 rounded-lg shadow-md w-full">
            <h3 class="text-3xl font-bold mb-4 text-center">
                My Job Listings
            </h3>
            @forelse($jobs as $job)
                <div class="flex justify-between items-center py-2 border-gray-200">
                    <div>
                        <h3 class="text-xl font-semibold mt-2">{{ $job->title }}</h3>
                        <p class="text-gray-700">{{ $job->job_type }}</p>
                        <p class="text-gray-700">Created: {{ $job->created_at }}</p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('jobs.edit', $job->id) }}"
                           class="bg-blue-500 text-white px-4 py-2 text-sm">Edit</a>
                        <!-- Delete Form -->
                        <form method="POST" action="{{ route('jobs.destroy', $job->id) }} ? from=dashboard"
                              onsubmit="return confirm('Are you sure you want to delete this job?')">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded text-sm"
                            >
                                Delete
                            </button>
                        </form>
                        <!-- End Delete Form -->
                    </div>
                </div>

                {{-- Applicants --}}
                <div class="mt-4">
                    <h4 class="text-lg font-semibold mb-2">Applicants for this job:</h4>
                    @forelse($job->applicants as $applicant)
                        <div class="py-2 border-b-2 border-b-gray-200">
                            <p class="text-gray-800">
                                <strong>Name: </strong>{{ $applicant->full_name }}
                            </p>
                            <p class="text-gray-800">
                                <strong>Phone: </strong>{{ $applicant->contact_phone }}
                            </p>
                            <p class="text-gray-800">
                                <strong>Email: </strong>{{ $applicant->contact_email }}
                            </p>
                            <p class="text-gray-800">
                                <strong>Message: </strong>{{ $applicant->message }}
                            </p>
                            <p class="text-gray-800 mt-2">
                                <a href="{{asset('storage/' . $applicant->resume_path)}}"
                                   class="text-blue-600 hover:underline" download>
                                    <i class="fas fa-download"></i> Download Resume
                                </a>
                            </p>

                            {{-- Delete Applicant --}}
                            <form method="POST" action="{{ route('applicant.destroy', $applicant->id) }}"
                                  onsubmit="return confirm('Are you sure you want to delete this applicant?')">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class=" text-red-600 hover:text-red-700 text-sm mb-2"
                                >
                                    <i class="fas fa-trash"></i> Delete Applicant
                                </button>
                            </form>

                        </div>

                    @empty
                        <p class=" text-gray-700 mb-4
                            ">No applicants yet.</p>
                    @endforelse
                </div>
            @empty
                <p class="text-center text-gray-700">You have not job listings!</p>
            @endforelse
        </div>
    </section>
    <x-bottom-banner/>
</x-layout>
