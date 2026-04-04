<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AllJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\JobApplication;

class JobsController extends Controller
{
    //
    public function all_jobs()
    {
        $jobs = AllJob::with('user', 'applications')->paginate(4);
        return view('admin.jobs', ['jobs' => $jobs]);
    }

    public function show_edit_job($id)
    {

        return view('admin.edit_job', ['id' => $id]);
    }

    public function editJob(Request $request)
    {

        $id = $request->job_id;

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5|max:200',
            'cat' => 'required',
            'vacancies' => 'required|integer',
            'salary' => 'required',
            'job_type' => 'required',
            'experience' => 'required',
            'location' => 'required|max:50',
            'company_name' => 'required',
            'summernote1' => 'required|min:3|max:50',
        ]);

        if ($validator->passes()) {

            $job = AllJob::find($id);
            $job->title = $request->title;
            $job->category_id = $request->cat;
            $job->job_type_id = $request->job_type;
            $job->vacancy = $request->vacancies;
            $job->salary = $request->salary;
            $job->location = $request->location;
            $job->description = $request->summernote1;
            $job->experience = $request->experience;
            $job->company_name = $request->company_name;

            $job->status = $request->status;
            $job->isFeatured = $request->isFeatured ? 1 : 0;

            $job->save();

            session()->flash('success', 'Job Edited Successfully.');
            return redirect()->back();
        } else {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    public function deleteJob(Request $request)
    {

        $job = AllJob::where('id', $request->id)->first();
        if ($job == null) {
            return -2;
        }

        AllJob::where('id', $request->id)->delete();
        return 1;
    }

    public function show_job_applications()
    {

        $my_applications = JobApplication::with('job', 'job.jobType', 'job.applications')->paginate(5);
        return view('admin.job_applications', compact('my_applications'));
    }

    public function removeApplication(Request $request)
    {

        $job_application = JobApplication::where('id', $request->id)->first();
        if ($job_application == null) {
            return response()->json([
                'status' => false,
                'message' => 'Job Application not Found',
            ]);
        }

        JobApplication::find($request->id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Job Application removed Successfully',
        ]);
    }
}
