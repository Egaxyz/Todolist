<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Type;
use DB;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobController extends Controller
{
    public function index()
    {
        $job = Job::with('type')->get();
        return Inertia::render('Job/Job', [
            'job' => $job,
        ]);
    }
    public function create()
    {
        $types = Type::all();
        return inertia('Job/Create', [
            'job' => Job::all(),
            'types' => $types,
        ]);
    }
    public function store(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'type_id' => 'required',
            'name' => 'required',
            'status' => 'required',
            'due_to' => 'required|date',
            'description' => 'required',
            'jobs.0.priority' => 'required',
            'jobs.0.start_date' => 'required|date',
            'jobs.0.end_date' => 'required|date',
            'jobs.0.url' => 'nullable|url',
                ]);
        DB::beginTransaction();
        try {
            $job = Job::create([
                'user_id' => $user->id,
                'type_id' => $request->type_id,
                'name' => $request->name,
                'status' => $request->status,
                'due_to' => $request->due_to,
                'description' => $request->description,
            ]);
            
            foreach ($request->jobs as $jobDetail) {
                $job->details()->create([
                    'job_id' => $job->id,
                    'priority' => $jobDetail['priority'],
                    'start_date' => $jobDetail['start_date'],
                    'end_date' => $jobDetail['end_date'],
                    'attachment_url' => $jobDetail['url'],
                ]);
            }

            DB::commit();
            return redirect()->route('job.index')->with('success', 'Job created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create job: ' . $e->getMessage());
        }
    }
    public function detail($id)
    {
        $job = Job::with('details')->findOrFail($id);
        return inertia('Job/Detail', [
            'editJob' => $job,
        ]);
    }
    public function edit($id)
    {
        $job = Job::with('details')->findOrFail($id);
        $types = Type::all();
        return inertia('Job/Create', [
            'editJob' => $job,
            'types' => $types,
        ]);
    }
    public function update(Request $request, Job $job, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'due_to' => 'required|date',
            'type_id' => 'required',
            'jobs.0.priority' => 'required',
            'jobs.0.start_date' => 'required|date',
            'jobs.0.end_date' => 'required|date',
            'jobs.0.url' => 'nullable|url',

        ]);
        $job = Job::findOrFail($id);
        $job->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'due_to' => $request->due_to,
            'type_id' => $request->type_id,
            'jobs.0.priority' => $request->jobs[0]['priority'],
            'jobs.0.start_date' => $request->jobs[0]['start_date'],
            'jobs.0.end_date' => $request->jobs[0]['end_date'],
            'jobs.0.url' => $request->jobs[0]['url'],
        ]);

        return redirect()->route('job.index')->with('success', 'Job updated successfully');
    }
    public function destroy($id)
    {
        $job = Job::find($id);
        if (!$job) {
            return redirect()->route('job.index')->with('error', 'Job not found');
        }
        $job->delete();

        return redirect()->route('job.index')->with('success', 'Job deleted successfully');
    }
}