<?php

namespace App\Http\Controllers;

use App\Mail\JobNotificationEmail;
use App\Models\AllJob;
use App\Models\Category;
use App\Models\JobApplication;
use App\Models\JobType;
use App\Models\Message;
use App\Models\SavedJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
  public function job_post()
  {

    $categories = Category::where('status', 1)->get();
    $job_types = JobType::where('status', 1)->get();

    return view('job-post', compact('categories', 'job_types'));
  }
  public function job_list()
  {

    $id = Auth::user()->id;
    $jobs = AllJob::where('user_id', $id)->with('category', 'jobType')->latest()->paginate(5);
    return view('job-list', compact('jobs'));
  }

  public function jobListing(Request $request)
  {

    // dd($request->all())
    $query = AllJob::query();

    $query->where('status', 1);

    if ($request->has('cat') && $request->filled('cat')) {

      $cat_arr = explode(',', $request->cat);

      $query->where(function ($q) use ($cat_arr) {    // where conditions inside group()
        foreach ($cat_arr as $index => $val) {
          $q->orWhere('category_id', $val);
        }
      });
    }

    if ($request->has('job_type') && $request->filled('job_type')) {

      $type_arr = explode(',', $request->job_type);

      $query->where(function ($q) use ($type_arr) {
        foreach ($type_arr as $index => $val) {
          $q->orWhere('job_type_id', $val);
        }
      });
    }

    if ($request->has('date') && $request->filled('date')) {

      $date_arr = explode(',', $request->date);

      $query->where(function ($q) use ($date_arr) {  //  $query->where(function ($q) use ($date_arr) { }) used for logical grouping like AND ()
        foreach ($date_arr as $key => $val) {
          if ($val == 'today') {
            $q->orWhereDate('created_at', date('Y-m-d'));
          } else if ($val == 'last_week') {
            $q->orWhere(function ($qe) {
              $qe->whereDate('created_at', '>=', date('Y-m-d', strtotime('-7 days')))->whereDate('created_at', '<=', date('Y-m-d'));
            });
          } else if ($val == '1_month_ago') {
            $q->orWhere(function ($qe) {
              $qe->whereDate('created_at', '>=', date('Y-m-d', strtotime('-1 month')))->whereDate('created_at', '<=', date('Y-m-d'));
            });
          } else if ($val == '3_month_ago') {
            $q->orWhere(function ($qe) {
              $qe->whereDate('created_at', '>=', date('Y-m-d', strtotime('-3 month')))->whereDate('created_at', '<=', date('Y-m-d'));
            });
          } else if ($val == '1_year_ago') {
            $q->orWhere(function ($qe) {
              $qe->whereDate('created_at', '>=', date('Y-m-d', strtotime('-1 year')))->whereDate('created_at', '<=', date('Y-m-d'));
            });
          }
        }
      });
    }


    if ($request->filled('keyword')) {
      $k = $request->keyword;
      $query->where(function ($q) use ($k) {
        $q->where('title', 'like', "%{$k}%")
          ->orWhere('description', 'like', "%{$k}%");
      });
    }

    if ($request->filled('sort')) {
      // if sort is not empty value
      if ($request->sort == 'Newest') {
        $query->orderBy('created_at', 'DESC');
      } else if ($request->sort == 'Oldest') {
        $query->orderBy('created_at', 'ASC');
      } else if ($request->sort == 'Random') {
      } else if ($request->sort == 'Popularity') {
        $query->orderBy('views', 'DESC');
      }
    }

    $categories = Category::where('status', 1)->get();
    $job_types = JobType::where('status', 1)->get();

    $jobs = $query->with('category', 'jobType', 'user')->paginate(5);

    // Preserve filter parameters in pagination links
    $jobs->appends($request->all());

    return view('job-listing', compact('categories', 'job_types', 'jobs'));
  }

  public function showEditJob(Request $request, $id)
  {

    $categories = Category::where('status', 1)->get();
    $job_types = JobType::where('status', 1)->get();

    $job = AllJob::where('id', $id)->where('user_id', Auth::user()->id)->with('category', 'jobType')->first();
    if ($job == null) {
      abort(404);
    }
    return view('edit-job', compact('job', 'categories', 'job_types'));
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
      $job->save();

      session()->flash('success', 'Job Edited Successfully.');
      return redirect()->back();
    } else {
      return redirect()->back()->withInput()->withErrors($validator);
    }
  }

  public function my_applications()
  {
    $my_applications = JobApplication::where('user_id', Auth::user()->id)->with('job', 'job.jobType', 'job.applications')->paginate(5);
    return view('my-applications', compact('my_applications'));
  }

  public function removeApplication(Request $request)
  {

    $job_application = JobApplication::where('id', $request->id)->where('user_id', Auth::user()->id)->first();
    if ($job_application == null) {
      session()->flash('error', 'Job Application not Found');
      return response()->json([
        'status' => false,
        'message' => 'Job Application not Found',
      ]);
    }

    JobApplication::find($request->id)->delete();
    session()->flash('success', 'Job Application removed Successfully');
    return response()->json([
      'status' => true,
      'message' => 'Job Application removed Successfully',
    ]);
  }

  public function saveJob(Request $request)
  {

    // dd($request);
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

      $job = new AllJob();
      $job->user_id = Auth::user()->id;
      $job->title = $request->title;
      $job->category_id = $request->cat;
      $job->job_type_id = $request->job_type;
      $job->vacancy = $request->vacancies;
      $job->salary = $request->salary;
      $job->location = $request->location;
      $job->description = $request->summernote1;
      $job->experience = $request->experience;
      $job->company_name = $request->company_name;
      $job->save();

      session()->flash('success', 'Job Added Successfully.');
      return redirect()->route('job.list');
    } else {
      return redirect()->back()->withInput()->withErrors($validator);
    }
  }

  public function deleteJob(Request $request)
  {

    $job = AllJob::where('user_id', Auth::user()->id)->where('id', $request->id)->first();
    if ($job == null) {
      return -2;
    }

    AllJob::where('id', $request->id)->delete();
    return 1;
  }

  public function job_detail(Request $request, $id)
  {
    // return $id;
    $job_detail = AllJob::where('id', $id)->with('category', 'jobType', 'user')->first();
    if ($job_detail == null) {
      abort(404);
    }
    return view('job-details', compact('job_detail'));
  }

  public function apply_job(Request $request)
  {

    $job_id = $request->id;

    // if job not found in db
    $job = AllJob::where('id', $job_id)->first();
    if ($job == null) {
      session()->flash('error', 'Job does not Exist');
      return response()->json([
        'status' => false,
        'message' => 'Job does not Exist',
      ]);
    }

    // you cannot apply on your own job

    $employer_id = $job->user_id;
    if ($employer_id == Auth::user()->id) {
      session()->flash('error', 'you cannot apply on your own job');
      return response()->json([
        'status' => false,
        'message' => 'you cannot apply on your own job',
      ]);
    }

    // you cannot apply on a job twice
    $applications_count = JobApplication::where(['user_id' => Auth::user()->id, 'job_id' => $job_id])->count();
    if ($applications_count > 0) {
      session()->flash('error', 'you have already applied on this job');
      return response()->json([
        'status' => false,
        'message' => 'you have already applied on this job',
      ]);
    }

    $job_application = new JobApplication();
    $job_application->job_id = $job_id;
    $job_application->user_id = Auth::user()->id;
    $job_application->employer_id = $employer_id;
    $job_application->applied_date = now();
    $job_application->save();

    $employer = User::where('id', $employer_id)->first();
    // send notification email to employer 
    $mailData = [
      'employer' => $employer,
      'user'    =>  Auth::user(),
      'job'     => $job,
    ];

    Mail::to($employer->email)->send(new JobNotificationEmail($mailData));

    session()->flash('success', 'Job applied Successfully.');
    return response()->json([
      'status' => true,
      'message' => 'Job applied Successfully.',
    ]);
  }

  public function savedJob(Request $request)
  {
    $id = $request->id;
    $job = AllJob::find($id);
    if ($job == null) {
      session()->flash('error', 'Job not found');
      return response()->json([
        'status' => false,
      ]);
    }

    // check user already saved job
    $count = SavedJob::where(['user_id' => Auth::user()->id, 'job_id' => $id])->count();
    if ($count > 0) {
      session()->flash('error', 'You already applied to this job.');
      return response()->json([
        'status' => false,
      ]);
    }

    $save_job = new SavedJob();
    $save_job->job_id = $id;
    $save_job->user_id = Auth::user()->id;
    $save_job->save();

    session()->flash('success', 'You have successfully saved the job.');
    return response()->json([
      'status' => true,
    ]);
  }

  public function savedJobs(Request $request)
  {

    $id = Auth::user()->id;
    $jobs = SavedJob::where('user_id', $id)->with('job', 'job.jobType', 'job.applications')->latest()->paginate(5);
    return view('savedJobs', ['jobs' => $jobs]);
  }

  public function deleteSavedJob(Request $request)
  {

    $job = SavedJob::where('user_id', Auth::user()->id)->where('id', $request->id)->first();
    if ($job == null) {
      return -2;
    }

    SavedJob::where('id', $request->id)->delete();
    return 1;
  }

  public function sendMessage(Request $req)
  {
    // return $req->all();
    if (!Auth::check()) {
      return -1;
    }
    $user_id = Auth::id();

    $msg_check = Message::create(['user_id' => $user_id, 'message' => $req->message]);
    if ($msg_check) {
      return 1;
    }
  }
}
