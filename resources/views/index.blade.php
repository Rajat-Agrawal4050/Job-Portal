@extends('layouts.layout')
@section('content1')

<!-- @if ($user = Auth::guard('api')->user()) 
     {{ 'yes' }}
     @else
     {{'no'}}
     @endif -->
<div class="hero1" style="background: url('')">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="hero-content">
          <h1>Your Career’s <span>Opportunity.</span></h1>
          <p>
            <span>2400</span> Peoples are daily search in this portal,
            <span>100</span> user added job portal!
          </p>

          <div class="counter-area">
            <div class="row g-lg-4 g-md-5 gy-5 justify-content-center">
              <div class="col-lg-3 col-sm-6">
                <div class="counter-single">
                  <div class="counter-icon">
                    <img src="assets/images/icon/job2.svg" alt="image" />
                  </div>
                  <div class="coundown">
                    <?php

                    use App\Models\AllJob;
                    use App\Models\JobApplication;
                    ?>
                    <p>Live Jobs</p>
                    <div class="d-flex align-items-center gap-2">
                      <h3 class="odometer">{{ AllJob::where('status',1)->count() }}</h3>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-sm-6">
                <div class="counter-single">
                  <div class="counter-icon">
                    <img
                      src="assets/images/icon/companies.svg"
                      alt="image" />
                  </div>
                  <div class="coundown">
                    <p>Companies</p>
                    <div class="d-flex align-items-center gap-2">
                      <h3 class="odometer">{{ AllJob::select('user_id')->distinct()->get()->count() }}</h3>
                      <span>+</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-sm-6">
                <div class="counter-single">
                  <div class="counter-icon">
                    <img
                      src="assets/images/icon/candidates.svg"
                      alt="image" />
                  </div>
                  <div class="coundown">
                    <p>Applicants</p>
                    <div class="d-flex align-items-center gap-2">
                      <h3 class="odometer">{{ JobApplication::select('user_id')->distinct()->get()->count() }}</h3>
                      <span>+</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-sm-6">
                <div class="counter-single">
                  <div class="counter-icon">
                    <img
                      src="assets/images/icon/new-jobs.svg"
                      alt="image" />
                  </div>
                  <div class="coundown">
                    <p>Total Jobs</p>
                    <div class="d-flex align-items-center gap-2">
                      <h3 class="odometer">{{ AllJob::count() }}</h3>
                      <span>+</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="job-search-area">
            <form action="#" method="post" id="myform1">
              <div class="form-inner job-title">
                <input
                  type="text"
                  name="keyword"
                  id="keyword"
                  placeholder="Job Title" />
              </div>
              <div class="form-inner category">
                <select name="category" class="select1" id="category">
                  <option value="">Category</option>
                  @if($categories->isNotEmpty())
                  @foreach($categories as $cat)
                  <option value="{{$cat->id}}">{{$cat->name}}</option>
                  @endforeach
                  @endif
                </select>
              </div>

              <div class="form-inner">
                <button
                  type="submit"
                  class="primry-btn-2"
                  style="cursor: pointer">
                  <img src="assets/images/icon/search-icon.svg" alt />
                  Search
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="home3-categor-area pt-120 mb-120">
  <div class="container">
    <div class="row mb-60">
      <div
        class="col-12 d-flex flex-wrap align-items-end justify-content-md-between justify-content-start gap-3">
        <div class="section-title1">
          <h2>Popular <span>Category</span> List</h2>
          <p>
            To choose your trending job dream &amp; to make future bright.
          </p>
        </div>
        <div class="swiper-btn-2">
          <div class="swiper-prev prev-5">
            <i class="bi bi-chevron-left"></i>
          </div>
          <div class="swiper-next next-5">
            <i class="bi bi-chevron-right"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="swiper category3-slider">
        <div class="swiper-wrapper">

          @if($categories->isNotEmpty())
          @foreach($categories as $cat)
          <div class="swiper-slide">
            <div class="category-card3">
              <img
                class="img-fluid"
                src="assets/images/bg/category-31.png"
                alt />
              <div class="category-tag">
                <span>Trending</span>
              </div>
              <div class="category-content">
                <div class="category-icon"></div>
                <h5><a href="job-listing?cat={{ $cat->id }}">{{ $cat->name }}</a></h5>
                <p>Open Post: <span>{{ AllJob::where('status',1)->where('category_id',$cat->id)->count() }}</span></p>
              </div>
            </div>
          </div>
          @endforeach
          @endif

        </div>
      </div>
    </div>
  </div>
</div>

<div class="home1-featured-area mb-120">
  <div class="container">
    <div class="row mb-60">
      <div
        class="col-12 d-flex flex-wrap align-items-end justify-content-md-between justify-content-start gap-3">
        <div class="section-title1">
          <h2>Latest <span>Featured</span> Jobs</h2>
          <p>To choose your trending job dream & to make future bright.</p>
        </div>
        <div class="explore-btn">
          <a href="job-listing">Explore More
            <span><img
                src="assets/images/icon/explore-elliose.svg"
                alt /></span></a>
        </div>
      </div>
    </div>
    <div class="row g-4">
      @if($jobs->isNotEmpty())
      @foreach($jobs as $job)
      <div class="col-xl-4 col-lg-6">
        <div class="feature-card">
          <div class="company-area">
            <div class="logo">
              <img src="{{ empty($job->user->profile_pic) ? asset('assets/images/bg/company-logo/company-01.png') : asset('profile_pic/'.$job->user->profile_pic) }}" alt />
            </div>
            <div class="company-details">
              <div class="name-location">
                <h5><a href="{{ route('job.detail',$job->id) }}">{{ $job->title }}</a></h5>
                <p>{{ $job->category->name }}</p>
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
                  <span class="title">Salary:</span> &#8377; {{ $job->salary }} <span class="time">Per month</span>
                </p>
              </li>
              <li>
                <img src="assets/images/icon/arrow2.svg" alt />
                <p>
                  <span class="title">Vacancy:</span> <span> {{ $job->vacancy }} Person</span>
                </p>
              </li>
              <li>
                <img src="assets/images/icon/arrow2.svg" alt />
                <p>
                  <span class="title">Location:</span>
                  <span> {{ $job->location }}</span>
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
      @endforeach
      @endif
    </div>
  </div>
</div>

<div class="home1-work-process mb-120">
  <div class="container">
    <div class="row mb-60">
      <div class="col-12 d-flex justify-content-center">
        <div class="section-title1 text-center">
          <h2>JOBES Working <span>Process</span></h2>
          <p>To choose your trending job dream & to make future bright.</p>
        </div>
      </div>
    </div>
    <div class="row g-lg-4 gy-5 justify-content-center">
      <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="single-work-process one text-center">
          <div class="icon">
            <img src="assets/images/icon/account-create.svg" alt />
          </div>
          <div class="work-content">
            <h5><a href="register.html">Account Create</a></h5>
            <p>To create your account be confident & safely.</p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="single-work-process two text-center">
          <div class="icon">
            <img src="assets/images/icon/create-resume.svg" alt />
          </div>
          <div class="work-content">
            <h5><a href="edit-profile-2.html">Create Resume</a></h5>
            <p>To create your account be confident & safely.</p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="single-work-process one text-center">
          <div class="icon">
            <img src="assets/images/icon/job-find.svg" alt />
          </div>
          <div class="work-content">
            <h5><a href="job-listing1.html">Find Jobs </a></h5>
            <p>To create your account be confident & safely.</p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="single-work-process two text-center">
          <div class="icon">
            <img src="assets/images/icon/job-apply.svg" alt />
          </div>
          <div class="work-content">
            <h5><a href="job-listing1.html">Apply Jobs</a></h5>
            <p>To create your account be confident & safely.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="home5-clients-feedback-area mb-120">
  <div class="container">
    <div class="row mb-60">
      <div
        class="col-12 d-flex flex-wrap align-items-end justify-content-md-between justify-content-start gap-3">
        <div class="section-title3">
          <h2>Clients <span style="color: #00a7ac">Feedback</span></h2>
          <p>
            To choose your trending job dream &amp; to make future bright.
          </p>
        </div>
        <div class="swiper-btn1 d-flex align-items-center">
          <div class="left-btn prev-2">
            <img src="assets/images/icon/explore-elliose.svg" alt />
          </div>
          <div class="right-btn next-2">
            <img src="assets/images/icon/explore-elliose.svg" alt />
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="swiper home5-feedback-slider">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="client-feedback-wrap hover-btn">
                <span class="for-border"></span>
                <div class="client-feedback-inner">
                  <div class="client-feedback-top">
                    <div class="author-area">
                      <div class="author-img">
                        <img
                          src="assets/images/bg/home5-testimonial-01.png"
                          alt />
                        <div class="author-quat">
                          <img
                            class="quate1"
                            src="assets/images/icon/home5-testimonial-quat.svg"
                            alt />
                          <img
                            class="quate2"
                            src="assets/images/icon/home5-testimonial-quat2.svg"
                            alt />
                        </div>
                      </div>
                      <div class="author-content">
                        <h5>Rakhab Uddin</h5>
                        <span>UI/UX Engineer</span>
                      </div>
                    </div>
                    <div class="reviews">
                      <ul>
                        <li><i class="bi bi-star-fill"></i></li>
                        <li><i class="bi bi-star-fill"></i></li>
                        <li><i class="bi bi-star-fill"></i></li>
                        <li><i class="bi bi-star-fill"></i></li>
                        <li><i class="bi bi-star-half"></i></li>
                      </ul>
                    </div>
                  </div>
                  <div class="client-feedback-content">
                    <p>
                      On the other hand, denounce with righteous to
                      indignation and dislike men who are so the beguiled
                      and demoralized.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="client-feedback-wrap hover-btn">
                <span class="for-border"></span>
                <div class="client-feedback-inner">
                  <div class="client-feedback-top">
                    <div class="author-area">
                      <div class="author-img">
                        <img
                          src="assets/images/bg/home5-testimonial-02.png"
                          alt />
                        <div class="author-quat">
                          <img
                            class="quate1"
                            src="assets/images/icon/home5-testimonial-quat.svg"
                            alt />
                          <img
                            class="quate2"
                            src="assets/images/icon/home5-testimonial-quat2.svg"
                            alt />
                        </div>
                      </div>
                      <div class="author-content">
                        <h5>Mrs. Jordan Harry</h5>
                        <span>UI/UX Engineer</span>
                      </div>
                    </div>
                    <div class="reviews">
                      <ul>
                        <li><i class="bi bi-star-fill"></i></li>
                        <li><i class="bi bi-star-fill"></i></li>
                        <li><i class="bi bi-star-fill"></i></li>
                        <li><i class="bi bi-star-fill"></i></li>
                        <li><i class="bi bi-star-half"></i></li>
                      </ul>
                    </div>
                  </div>
                  <div class="client-feedback-content">
                    <p>
                      On the other hand, denounce with righteous to
                      indignation and dislike men who are so the beguiled
                      and demoralized.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="home1-trusted-company mb-120">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title">
          <h5>Our Trusted Company</h5>
        </div>
        <div class="swiper trusted-company-slider">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="company-logo">
                <img
                  src="assets/images/bg/company-logo/trusted-company-01.png"
                  alt />
              </div>
            </div>
            <div class="swiper-slide">
              <div class="company-logo">
                <img
                  src="assets/images/bg/company-logo/trusted-company-22.png"
                  alt />
              </div>
            </div>
            <div class="swiper-slide">
              <div class="company-logo">
                <img
                  src="assets/images/bg/company-logo/trusted-company-33.png"
                  alt />
              </div>
            </div>
            <div class="swiper-slide">
              <div class="company-logo">
                <img
                  src="assets/images/bg/company-logo/trusted-company-04.png"
                  alt />
              </div>
            </div>
            <div class="swiper-slide">
              <div class="company-logo">
                <img
                  src="assets/images/bg/company-logo/trusted-company-05.png"
                  alt />
              </div>
            </div>
            <div class="swiper-slide">
              <div class="company-logo">
                <img
                  src="assets/images/bg/company-logo/trusted-company-66.png"
                  alt />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="home1-article-area mb-120">
  <div class="container">
    <div class="row mb-60">
      <div class="col-12 d-flex justify-content-center">
        <div class="section-title1 text-center">
          <h2>Portal Recent <span>Article</span></h2>
          <p>To choose your trending job dream & to make future bright.</p>
        </div>
      </div>
    </div>
    <div class="row g-lg-4 gy-5 justify-content-center">
      <div class="col-lg-4 col-md-6 col-sm-10">
        <div class="recent-article-wrap">
          <div class="recent-article-img">
            <img
              class="img-fluid"
              src="assets/images/blog/blog-img-01.png"
              alt />
            <div class="publish-area d-xl-none d-flex">
              <a href="blog-grid.html"><span>02</span>March</a>
            </div>
          </div>
          <div class="recent-article-content">
            <div class="recent-article-meta">
              <div class="publish-area">
                <a href="blog-grid.html"><span>02</span>March</a>
              </div>
              <ul>
                <li>
                  <a href="blog-grid.html"><img src="assets/images/icon/comment.svg" alt />03
                    Comments</a>
                </li>
                <li>
                  <a href="blog-grid.html"><img src="assets/images/icon/user.svg" alt />Mr. Jack
                    Frank</a>
                </li>
              </ul>
            </div>
            <h4>
              <a href="blog-details.html">To Make Your Smartness & Catch Your Bright Dream.</a>
            </h4>
            <div class="explore-btn">
              <a href="blog-details.html"><span><img src="assets/images/icon/explore-elliose.svg" alt /></span>
                Explore More</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-10">
        <div class="recent-article-wrap">
          <div class="recent-article-img">
            <img
              class="img-fluid"
              src="assets/images/blog/blog-img-02.png"
              alt />
            <div class="publish-area d-xl-none d-flex">
              <a href="blog-grid.html"><span>04</span>March</a>
            </div>
          </div>
          <div class="recent-article-content">
            <div class="recent-article-meta">
              <div class="publish-area">
                <a href="blog-grid.html"><span>04</span>March</a>
              </div>
              <ul>
                <li>
                  <a href="blog-grid.html"><img src="assets/images/icon/comment.svg" alt />11
                    Comments</a>
                </li>
                <li>
                  <a href="blog-grid.html"><img src="assets/images/icon/user.svg" alt />Mr. Marko
                    jack</a>
                </li>
              </ul>
            </div>
            <h4>
              <a href="blog-details.html">Be Confident Your Dream & Struggle About Your Bright
                Dream</a>
            </h4>
            <div class="explore-btn">
              <a href="blog-details.html"><span><img src="assets/images/icon/explore-elliose.svg" alt /></span>
                Explore More</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-10">
        <div class="recent-article-wrap">
          <div class="recent-article-img">
            <img
              class="img-fluid"
              src="assets/images/blog/blog-img-03.png"
              alt />
            <div class="publish-area d-xl-none d-flex">
              <a href="blog-grid.html"><span>05</span>March</a>
            </div>
          </div>
          <div class="recent-article-content">
            <div class="recent-article-meta">
              <div class="publish-area">
                <a href="blog-grid.html"><span>05 </span>March</a>
              </div>
              <ul>
                <li>
                  <a href="blog-grid.html"><img src="assets/images/icon/comment.svg" alt />02
                    Comments</a>
                </li>
                <li>
                  <a href="blog-grid.html"><img src="assets/images/icon/user.svg" alt />Srikanto
                    Frank</a>
                </li>
              </ul>
            </div>
            <h4>
              <a href="blog-details.html">To Make Your Smartness & Catch Your Bright Dream.</a>
            </h4>
            <div class="explore-btn">
              <a href="blog-details.html"><span><img src="assets/images/icon/explore-elliose.svg" alt /></span>
                Explore More</a>
            </div>
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

    $('#myform1').submit(function(e) {
      e.preventDefault();

      let keyword = $("#keyword").val();
      let cat = $("#category option:selected").attr('value');

      // console.log(keyword+','+cat);
      let url = '{{ route("job.listing") }}?'; // returns /job-listing

      if (keyword.trim() != '') {
        url += '&keyword=' + keyword;
      }
      if (cat.trim() != '') {
        url += '&cat=' + cat;
      }
      window.location.href = url;
    });
  });
</script>
@endsection