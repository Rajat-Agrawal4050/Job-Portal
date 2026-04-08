@extends('layouts.layout')
@section('content1')

<?php

use App\Models\JobApplication;
use App\Models\SavedJob;
?>
<div class="inner-banner">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="banner-content text-center">
          <h1>Job Details</h1>
          <span></span>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">
                Job Details
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="job-details-pages pt-120 mb-120">
  <div class="container">
    @include('message')
    <div class="row g-lg-4 gy-5">
      <div class="col-lg-8">
        <div class="job-details-content">
          <div class="job-list-content">
            <div class="company-area">
              <div class="logo">
                <img
                  src="{{ empty($job_detail->user->profile_pic) ? asset('assets/images/bg/company-logo/company-01.png') : asset('profile_pic/'.$job_detail->user->profile_pic) }}"
                  alt />
              </div>
              <div class="company-details">
                <div class="name-location">
                  <h5><a href="#">{{ $job_detail->title }}</a></h5>
                  <p>{{ $job_detail->user->name }}</p>
                </div>
              </div>
            </div>
            <div class="job-discription">
              <ul class="one">
                <li>
                  <img src="assets/images/icon/map-2.svg" alt />
                  <p><span class="title">Location:</span> {{ $job_detail->location }}</p>
                </li>
                <li>
                  <img src="assets/images/icon/category-2.svg" alt />
                  <p><span class="title">Category:</span> {{ $job_detail->category->name }}</p>
                </li>
              </ul>
              <ul>
                <li>
                  <img src="assets/images/icon/company-2.svg" alt />
                  <p><span class="title">Job Type:</span> {{ $job_detail->jobType->name }}</p>
                </li>
                <li>
                  <img src="assets/images/icon/salary-2.svg" alt />
                  <p>
                    <span class="title">Salary:</span>
                    {{ $job_detail->salary }} /Per Month
                  </p>
                </li>
              </ul>
            </div>
          </div>
          <p><span>Job Description:</span> {{ strip_tags(html_entity_decode($job_detail->description)) }}</p>
          <br />
          <!-- <p><span>Job Responsibility:</span></p>
              <ul>
                <li>
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                  Veniam, facilis.
                </li>
                <li>
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                  Veniam, facilis.
                </li>
                <li>
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                  Veniam, facilis.
                </li>
              </ul> -->
          <!-- <h6>Educational Requirements:</h6>

              <ul>
                <li>B Tech</li>
              </ul> -->

          <!-- <h6>Skills Requirements:</h6>
              <ul>
                <li>Php</li>
                <li>Java</li>
                <li>C</li>
                <li>MS Office</li>
                <li>Linux</li>
              </ul> -->
          <h6>Experiences:</h6>
          <ul>
            <li>{{ $job_detail->experience }} Minimum Years in this field.</li>
          </ul>

          <!-- <p class=""><span>Extra Benefits:</span></p>
              <ul>
                <li>Certificate</li>
                <li>Flexible Hours</li>
                <li>Health Insurance</li>
              </ul> -->
        </div>
      </div>
      <div class="col-lg-4">
        <div class="job-details-sidebar mb-120">
          <div class="save-apply-btn d-flex justify-content-end mb-50">
            <ul>
              <li>
                @if(Auth::check() && SavedJob::where(['user_id'=> Auth::user()->id, 'job_id'=> $job_detail->id])->count()<=0)
                  <a class="save-btn" data-id="{{ $job_detail->id }}" id="saveBtn" href="#">Save Job <span><i class="bi bi-bookmark-fill"></i></span></a>
                  @elseif(Auth::check() && SavedJob::where(['user_id'=> Auth::user()->id, 'job_id'=> $job_detail->id])->count()>0)
                  <a class="save-btn" href="#">Saved<span class="saved-job2"><i class="bi bi-bookmark-fill saved-job"></i></span></a>
                  @elseif(!Auth::check())
                  <a class="save-btn" onclick="window.location.href='/login'" href="#">Login to Save<span><i class="bi bi-bookmark-fill"></i></span></a>
                  @endif

              </li>

              <li>
                @if(Auth::check() && JobApplication::where(['user_id'=> Auth::user()->id, 'job_id'=> $job_detail->id])->count()<=0)
                  <button id="applyBtn" data-id="{{ $job_detail->id }}" style="cursor: pointer;"
                  class="primry-btn-2 lg-btn">Apply Position</button>
                  @elseif(Auth::check() && JobApplication::where(['user_id'=> Auth::user()->id, 'job_id'=> $job_detail->id])->count()>0)
                  <button
                    class="primry-btn-2 lg-btn">Already Applied</button>
                  @elseif(!Auth::check())
                  <button onclick="window.location.href='/login'" style="cursor: pointer;"
                    class="primry-btn-2 lg-btn">Login to Apply</button>
                  @endif
              </li>
            </ul>
          </div>
          <div class="job-summary-area mb-50">
            <div class="job-summary-title">
              <h6>Job Summary:</h6>
            </div>
            <ul>
              <li>
                <p>
                  <span class="title">Job Posted:</span> {{ \Carbon\Carbon::parse($job_detail->created_at)->format('d M, Y') }}
                </p>
              </li>
              <!-- <li>
                    <p>
                      <span class="title">Expiration:</span> 10 December, 2024
                    </p>
                  </li> -->
              <li>
                <p><span class="title">Vacancy:</span> {{ $job_detail->vacancy }} Person.</p>
              </li>
              <li>
                <p>
                  <span class="title">Experiences:</span> {{ $job_detail->experience }} Years Minimum
                </p>
              </li>
              <!-- <li>
                    <p><span class="title">Education:</span>B Tech</p>
                  </li> -->
              <li>
                <p><span class="title">Gender:</span> Both.</p>
              </li>
            </ul>
          </div>
          <!-- <div class="view-job-btn mb-30">
                <a href="job-listing?vid="
                  ><img src="assets/images/icon/company-2.svg" alt />View All
                  Jobs In This Company</a
                >
              </div> -->
          <div class="job-share-area mb-50">
            <h6>Job Link Share:</h6>
            <ul>
              <li>
                <a href="#"><i class="bx bx-link"></i></a>
              </li>
              <li>
                <a href="http://www.facebook.com/sharer?u="><i class="bx bxl-facebook"></i></a>
              </li>
              <li>
                <a href="http://twitter.com/share?text=share&url="><i class="bx bxl-twitter"></i></a>
              </li>
              <li>
                <a
                  href="http://www.linkedin.com/shareArticle?mini=true&amp;url="><i class="bx bxl-linkedin"></i></a>
              </li>
              <li>
                <a href="https://www.instagram.com/"><i class="bx bxl-instagram-alt"></i></a>
              </li>
            </ul>
          </div>
          <div class="email-area mb-50">
            <div class="title">
              <h6>
                <img src="assets/images/icon/email-2.svg" alt />Email Now
              </h6>
            </div>
            <p>
              Send your resume at
              <a
                href="https://demo-egenslab.b-cdn.net/cdn-cgi/l/email-protection#99f0f7fff6d9fce1f8f4e9f5fcb7faf6f4"><span
                  class="__cf_email__"
                  data-cfemail="5e373038311e3b263f332e323b703d3133">[email&#160;protected]</span></a>
            </p>
          </div>
          <!-- <div class="location-area">
            <h6>Get Location:</h6>
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3649.564763018799!2d90.36349791490355!3d23.834071191491947!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c14c8682a473%3A0xa6c74743d52adb88!2sEgens%20Lab!5e0!3m2!1sen!2sbd!4v1674212581590!5m2!1sen!2sbd"
              style="border: 0"
              allowfullscreen
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div> -->
        </div>
      </div>
    </div>
    <div class="row">

      <!-- <div class="col-lg-12 mb-120">
            <div class="company-gallery">
              <div class="title">
                <h5>Company Gallery View</h5>
              </div>
              <div class="swiper company-gallery-slider" data-cursor="Drag">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <a
                      href="assets/images/bg/company-gallery-big-01.png"
                      data-fancybox="gallery"
                      class="gallery2-img"
                    >
                      <div class="gallery-wrap">
                        <img
                          class="img-fluid"
                          src="assets/images/bg/company-gallery-sm-01.png"
                          alt
                        />
                        <div
                          class="overlay d-flex align-items-center justify-content-center"
                        >
                          <div class="items-content text-center">
                            <img src="assets/images/icon/eye.svg" alt />
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                  <div class="swiper-slide">
                    <a
                      href="assets/images/bg/company-gallery-big-02.png"
                      data-fancybox="gallery"
                      class="gallery2-img"
                    >
                      <div class="gallery-wrap">
                        <img
                          class="img-fluid"
                          src="assets/images/bg/company-gallery-sm-02.png"
                          alt
                        />
                        <div
                          class="overlay d-flex align-items-center justify-content-center"
                        >
                          <div class="items-content text-center">
                            <img src="assets/images/icon/eye.svg" alt />
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                  <div class="swiper-slide">
                    <a
                      href="assets/images/bg/company-gallery-big-03.png"
                      data-fancybox="gallery"
                      class="gallery2-img"
                    >
                      <div class="gallery-wrap">
                        <img
                          class="img-fluid"
                          src="assets/images/bg/company-gallery-sm-03.png"
                          alt
                        />
                        <div
                          class="overlay d-flex align-items-center justify-content-center"
                        >
                          <div class="items-content text-center">
                            <img src="assets/images/icon/eye.svg" alt />
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                  <div class="swiper-slide">
                    <a
                      href="assets/images/bg/company-gallery-big-04.png"
                      data-fancybox="gallery"
                      class="gallery2-img"
                    >
                      <div class="gallery-wrap">
                        <img
                          class="img-fluid"
                          src="assets/images/bg/company-gallery-sm-04.png"
                          alt
                        />
                        <div
                          class="overlay d-flex align-items-center justify-content-center"
                        >
                          <div class="items-content text-center">
                            <img src="assets/images/icon/eye.svg" alt />
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                  <div class="swiper-slide">
                    <a
                      href="assets/images/bg/company-gallery-big-05.png"
                      data-fancybox="gallery"
                      class="gallery2-img"
                    >
                      <div class="gallery-wrap">
                        <img
                          class="img-fluid"
                          src="assets/images/bg/company-gallery-sm-05.png"
                          alt
                        />
                        <div
                          class="overlay d-flex align-items-center justify-content-center"
                        >
                          <div class="items-content text-center">
                            <img src="assets/images/icon/eye.svg" alt />
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
      <div class="col-lg-12">
        <div class="related-jobs">
          <div class="section-title mb-40">
            <h3>Related Jobs:</h3>
            <div class="swiper-btn1 d-flex align-items-center">
              <div class="left-btn prev-4">
                <img src="assets/images/icon/explore-elliose.svg" alt />
              </div>
              <div class="right-btn next-4">
                <img src="assets/images/icon/explore-elliose.svg" alt />
              </div>
            </div>
          </div>
          <div class="swiper related-job-slider">
            <div class="swiper-wrapper">

              <?php

              use App\Models\AllJob;

              $cat_id = $job_detail->category_id;
              $all_jobs = AllJob::where('category_id', $cat_id)->where('status', 1)->where('id', '!=', $job_detail->id)->with('category', 'user', 'jobType')->take(5)->get();
              foreach ($all_jobs as $job) {
              ?>
                <div class="swiper-slide">
                  <div class="feature-card">
                    <div class="company-area">
                      <div class="logo">
                        <img src="{{ empty($job->user->profile_pic) ? asset('assets/images/bg/company-logo/company-01.png') : asset('profile_pic/'.$job->user->profile_pic) }}" alt>
                      </div>
                      <div class="company-details">
                        <div class="name-location">
                          <h5>
                            <a href="job-details.html">{{ $job->title }}</a>
                          </h5>
                          <p>
                            {{ $job->category->name }}
                          </p>
                        </div>
                        <div class="bookmark">
                          <i class="bi bi-bookmark"></i>
                        </div>
                      </div>
                    </div>
                    <div class="job-discription">
                      <ul>
                        <li>
                          <img src="assets/images/icon/arrow2.svg" alt />
                          <p>
                            <span class="title">Salary:</span> {{ $job->salary }}
                            / <span class="time">Per month</span>
                          </p>
                        </li>
                        <li>
                          <img src="assets/images/icon/arrow2.svg" alt />
                          <p>
                            <span class="title">Vacancy:</span>
                            <span>
                              {{ $job->vacancy }}
                              Person (Both)</span>
                          </p>
                        </li>
                        <li>
                          <img src="assets/images/icon/arrow2.svg" alt />
                          <p>
                            <span class="title">Create Date:</span>
                            <span>
                              {{ \Carbon\Carbon::parse($job->created_at)->format('d M, Y') }}
                            </span>
                          </p>
                        </li>
                      </ul>
                    </div>
                    <div class="job-type-apply">
                      <div class="apply-btn">
                        <a href="{{ route('job.detail',$job->id) }}"><span><img
                              src="assets/images/icon/apply-ellipse.svg"
                              alt /></span>Apply Now</a>
                      </div>
                    </div>
                  </div>
                </div>
              <?Php } ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <h5>Apply to Job</h5>
        <div class="tab-content">
          <div class="tab-pane p-3 active" id="home" role="tabpanel">
            <h5>Uploaded Resumes</h5>
            <form>
              <div class="mb-3 row">
                <div class="col-md-9">
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="exampleRadios"
                      id="exampleRadios1"
                      value="option1"
                      checked="" />
                    <label class="form-check-label" for="exampleRadios1">
                      Resume Title
                    </label>
                  </div>
                </div>
                <div class="col-md-3">
                  <button type="submit" class="btn btn-primary btn-sm">
                    Apply
                  </button>
                </div>
              </div>
              <hr />
              <h5>Upload and Apply with new Resume</h5>
              <div class="row">
                <div class="mb-3">
                  <input
                    type="email"
                    class="form-control"
                    id="exampleInput2"
                    aria-describedby="emailHelp"
                    placeholder="Resume Title" />
                </div>
                <div class="input-group mb-3">
                  <textarea
                    class="form-control"
                    aria-label="With textarea"></textarea>
                </div>
                <div class="input-group mb-3">
                  <input
                    type="file"
                    class="form-control"
                    id="inputGroupFile01" />
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Upload</button>
              <button type="button" class="btn btn-danger">
                Upload & Apply
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
  $(document).ready(function() {

    $(document).on('click', '#saveBtn', function() {

      let id = $(this).data('id');
      $.ajax({
        url: '{{ route("saved.job") }}',
        method: "POST",
        data: {
          id: id,
          _token: '{{ csrf_token() }}',
        },
        dataType: 'json',
        beforeSend: function() {},
        success: function(data) {
          window.location.href = '{{ url()->current() }}';
        },
        error: function(xhr, status, code) {
          console.error(xhr.responseText);
        }
      })
    });

    $(document).on('click', '#applyBtn', function() {

      let id = $(this).data('id');
      // return
      Swal.fire({
        title: 'Are you sure?',
        text: "You want to Apply this Job!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Apply!'
      }).then((result) => {
        if (result.isConfirmed) {

          $.ajax({
            url: '{{ route("apply.job") }}',
            method: "POST",
            data: {
              id: id,
              applyJob: true,
              _token: '{{ csrf_token() }}',
            },
            dataType: 'json',
            beforeSend: function() {
              // $("#formLoader").css({
              //   "display": "flex",
              // })

            },
            success: function(data) {
              // data=JSON.parse(data);
              // $("#formLoader").css({
              //   "display": "none",
              // })
              console.log(data)
              if (data.status == true) {
                window.location.href = '{{ url()->current() }}';
              } else {
                Swal.fire('Error', data.message, 'error');
              }

            },
            error: function(xhr, status, code) {
              Swal.fire('Something went wrong', '', 'error');
              console.error(xhr.responseText);
            }

          })


        }
      })

    });


  });
</script>
@endsection