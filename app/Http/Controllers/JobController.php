<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JobController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */

    //@desc Show all job listings
    //@route GET /jobs
    public function index(): View
    {
        $jobs = Job::all();
        return view('jobs.index')->with('jobs', $jobs);
    }

    /**
     * Show the form for creating a new resource.
     */
    //@desc Show listing create form
    //@route GET /jobs/create
    public function create(): View
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    //@desc Save jobs to database
    //@route POST /jobs
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|in:full-time,part-time,contract,temporary,internship,volunteer,on-call',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'nullable|string',
            'contact_email' => 'required|string',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company_website' => 'nullable|url',

        ]);

        //Get user id
        $validatedData['user_id'] = auth()->user()->id;

        //Check for image
        if ($request->hasFile('company_logo')) {

            //Store the file and get the path
            $path = $request->file('company_logo')->store('logos', 'public');

            //Add path to validated data
            $validatedData['company_logo'] = $path;
        }

        //Submit to database
        Job::create($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Job created successfully!');
    }

    /**
     * Display the specified resource.
     */
    //@desc Display a single listing
    //@route GET /jobs/{$id}
    public function show(Job $job): View
    {
        return view('jobs.show')->with('job', $job);
    }

    /**
     * Show the form for editing the specified resource.
     */
    //@desc Show listing edit form
    //@route GET /jobs/{$id}/edit
    public function edit(Job $job): View
    {
        //Check if user authorized
        $this->authorize('update', $job);

        return view('jobs.edit')->with('job', $job);
    }

    /**
     * Update the specified resource in storage.
     */
    //@desc Update job listing
    //@route PUT /jobs/{$id}
    public function update(Request $request, Job $job): string
    {
        //Check if user authorized
        $this->authorize('update', $job);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|in:full-time,part-time,contract,temporary,internship,volunteer,on-call',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'nullable|string',
            'contact_email' => 'required|string',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company_website' => 'nullable|url',

        ]);

        //Check for image
        if ($request->hasFile('company_logo')) {

            //Delete old logo
            Storage::delete('public/logos/' . basename($job->company_logo));

            //Store the file and get the path
            $path = $request->file('company_logo')->store('logos', 'public');

            //Add path to validated data
            $validatedData['company_logo'] = $path;
        }

        //Submit to database
        $job->update($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Job updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    //@desc Delete the job listing
    //@route DELETE /jobs/{$id}
    public function destroy(Job $job): RedirectResponse
    {
        //Check if user authorized
        $this->authorize('delete', $job);

        //If logo then delete it
        if ($job->company_logo) {
            Storage::delete('public/logos/' . $job->company_logo);
        }
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully!');
    }
}
