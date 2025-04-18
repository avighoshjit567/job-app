<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\JobPost;

class JobPostController extends Controller
{
    // function for view job post
    public function index()
    {
        return Inertia::render('Job/Index');
    }
    
    // function for create job post
    public function create()
    {
        return Inertia::render('Job/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'job_type' => 'required|string',
            'vacancy' => 'required|integer',
            'gender' => 'required|string',
            'description' => 'required|string',
        ]);

        $jobPost = new JobPost($validated);

        return redirect()->route('job.post')->with('success', 'Job post created successfully.');
    }
}
