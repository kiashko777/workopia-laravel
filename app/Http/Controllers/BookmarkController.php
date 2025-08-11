<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookmarkController extends Controller
{
    // @desc Get all users bookmarks
    // @route GET/ bookmarks
    public function index(): View
    {
        $user = Auth::user();

        $bookmarks = $user->bookmarkedJobs()->orderBy('job_user_bookmarks.created_at', 'desc')->paginate(6);
        return view('jobs.bookmarked')->with('bookmarks', $bookmarks);
    }

    // @desc Create a new bookmarked job
    // @route POST/ bookmarks/{job}
    public function store(Job $job): RedirectResponse
    {
        $user = Auth::user();

        //Check if job already bookmarked
        if ($user->bookmarkedJobs()->where('job_id', $job->id)->exists()) {
            return redirect()->back()->with('error', 'Job already bookmarked!');
        }
        //Add job to user bookmarks
        $user->bookmarkedJobs()->attach($job->id);
        return redirect()->back()->with('success', 'Job bookmarked successfully!');
    }

    // @desc Delete a bookmarked job
    // @route DELETE/ bookmarks/{job}
    public function destroy(Job $job): RedirectResponse
    {
        $user = Auth::user();

        //Check if job is not bookmarked
        if (!$user->bookmarkedJobs()->where('job_id', $job->id)->exists()) {
            return redirect()->back()->with('error', 'Job is not bookmarked!');
        }
        //Remove bookmark
        $user->bookmarkedJobs()->detach($job->id);
        return redirect()->back()->with('success', 'Bookmark removed successfully!');
    }

}
