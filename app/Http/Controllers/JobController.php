<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(): object
    {
        $title = 'Available Jobs';
        $jobs = [
            'Web Developer',
            'Database Administrator',
            'Software Engineer',
            'System Analyst'
        ];
        return view('jobs.index', compact('title', 'jobs'));
    }

    public function create(): View
    {
        return view('jobs.create');
    }
}
