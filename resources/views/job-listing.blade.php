@extends('layouts.layout')
@section('content1')

<?php

use App\Models\AllJob;
use Illuminate\Support\Facades\Request;

?>

<div class="inner-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-content text-center">
                    <h1>Job Listing</h1>
                    <span></span>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Job Listing </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="job-listing-area pt-120 mb-120">
    <div class="container">
        <form method="get" id="filterForm" action="{{ route('job.listing') }}">

            <div class="row g-lg-4 gy-5">

                <div class="col-lg-4 order-lg-1 order-2">

                    <div class="job-sidebar">
                        <div class="job-widget style-1 mb-20">
                            <div class="check-box-item">
                                <h5 class="job-widget-title">Job Category</h5>
                                <div class="checkbox-container">
                                    <?Php
                                    $c = Request::get('cat') ?? '';
                                    $c = explode(',', $c);
                                    ?>
                                    <ul>
                                        @if($categories->isNotEmpty())
                                        @foreach($categories as $cat)
                                        <li>
                                            <label class="containerss" for="cat{{ $cat->id }}">
                                                <input name="cat[]" <?php echo in_array($cat->id, $c) ? 'checked' : ''; ?> type="checkbox" id="cat{{ $cat->id }}" class="category filter" value="{{ $cat->id }}">
                                                <span class="checkmark"></span>
                                                <span class="text">{{ $cat->name }}</span>
                                                <span class="qty">(<?php
                                                                    $count = AllJob::where('category_id', $cat->id)->where('status', 1)->count();
                                                                    echo $count;
                                                                    ?>)</span>
                                            </label>
                                        </li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="job-widget mb-20">
                            <div class="check-box-item">
                                <h5 class="job-widget-title">Type of Employments</h5>
                                <div class="checkbox-container">
                                    <?Php
                                    $t = Request::get('job_type') ?? '';
                                    $t = explode(',', $t);
                                    ?>
                                    <ul>
                                        @if($job_types->isNotEmpty())
                                        @foreach($job_types as $type)
                                        <li>

                                            <label class="containerss" for="type{{ $type->id }}">
                                                <input name="job_type[]" <?php echo in_array($type->id, $t) ? 'checked' : ''; ?> type="checkbox" id="type{{ $type->id }}" class="type filter" value="{{ $type->id }}">
                                                <span class="checkmark"></span>
                                                <span class="text">{{ $type->name }}</span>
                                                <span class="qty">(<?php
                                                                    $count = AllJob::where('job_type_id', $type->id)->where('status', 1)->count();
                                                                    echo $count;
                                                                    ?>)</span>
                                            </label>
                                        </li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="job-widget mb-20">
                            <div class="check-box-item">
                                <h5 class="job-widget-title">Date of Post</h5>
                                <div class="checkbox-container">
                                    <ul>
                                        <?Php
                                        $t = Request::get('date') ?? '';
                                        $t = explode(',', $t);
                                        ?>
                                        <?php
                                        $count = AllJob::whereDate('created_at', date('Y-m-d'))->where('status', 1)->count();
                                        ?>
                                        <li>
                                            <label class="containerss">
                                                <input type="checkbox" <?php echo in_array('today', $t) ? 'checked' : ''; ?> name="dateFilter[]" class="filter date_posted" value="today">
                                                <span class="checkmark"></span>
                                                <span class="text">Today</span>
                                                <span class="qty">(<?= $count ?>)</span>
                                            </label>
                                        </li>
                                        <li>
                                            <?php
                                            $count = AllJob::whereDate('created_at', '>=', date('Y-m-d', strtotime('-7 days')))->whereDate('created_at', '<=', date('Y-m-d'))->where('status', 1)->count();
                                            ?>
                                            <label class="containerss">
                                                <input type="checkbox" <?php echo in_array('last_week', $t) ? 'checked' : ''; ?> name="dateFilter[]" class="filter date_posted" value="last_week">
                                                <span class="checkmark"></span>
                                                <span class="text">Last week ago</span>
                                                <span class="qty">(<?= $count ?>)</span>
                                            </label>
                                        </li>
                                        <li>
                                            <?php
                                            $count = AllJob::whereDate('created_at', '>=', date('Y-m-d', strtotime('-1 month')))->whereDate('created_at', '<=', date('Y-m-d'))->where('status', 1)->count();
                                            ?>
                                            <label class="containerss">
                                                <input type="checkbox" <?php echo in_array('1_month_ago', $t) ? 'checked' : ''; ?> name="dateFilter[]" class="filter date_posted" value="1_month_ago">
                                                <span class="checkmark"></span>
                                                <span class="text">Last month ago</span>
                                                <span class="qty">(<?= $count ?>)</span>
                                            </label>
                                        </li>
                                        <li>
                                            <?php
                                            $count = AllJob::whereDate('created_at', '>=', date('Y-m-d', strtotime('-3 month')))->whereDate('created_at', '<=', date('Y-m-d'))->where('status', 1)->count();
                                            ?>
                                            <label class="containerss">
                                                <input type="checkbox" <?php echo in_array('3_month_ago', $t) ? 'checked' : ''; ?> name="dateFilter[]" class="filter date_posted" value="3_month_ago">
                                                <span class="checkmark"></span>
                                                <span class="text">3 month ago</span>
                                                <span class="qty">(<?= $count ?>)</span>
                                            </label>
                                        </li>
                                        <li>
                                            <?php
                                            $count = AllJob::whereDate('created_at', '>=', date('Y-m-d', strtotime('-1 year')))->whereDate('created_at', '<=', date('Y-m-d'))->where('status', 1)->count();
                                            ?>
                                            <label class="containerss">
                                                <input type="checkbox" <?php echo in_array('1_year_ago', $t) ? 'checked' : ''; ?> name="dateFilter[]" class="filter date_posted" value="1_year_ago">
                                                <span class="checkmark"></span>
                                                <span class="text">1 year ago</span>
                                                <span class="qty">(<?= $count ?>)</span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="job-widget">
                            <!-- <div class="check-box-item">
                                <h5 class="job-widget-title mb-15">Salary Range</h5>
                                <div class="range-wrap">
                                    <div class="slider-labels">
                                    <div class="caption">
                                        <span id="slider-range-value1"></span>K
                                    </div>
                                    -
                                    <div class="text-right caption">
                                        <span id="slider-range-value2"></span>K
                                    </div>
                                </div>
                                     <div class="row">
                                    <div class="col-sm-12">
                                        <form>
                                            <input type="hidden" name="min-value" value>
                                            <input type="hidden" name="max-value" value>
                                        </form>
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div id="slider-range"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="salary-container">
                                    <ul>
                                        <li>

                                            <input class="form-check-input offered_salary filter" type="checkbox" value="10-20">
                                            <div class="content">
                                                <span class="text">&#8377; 10K - &#8377; 20K</span>
                                                <span class="qty">(3)</span>
                                            </div>
                                        </li>
                                        <li>

                                            <input class="form-check-input offered_salary filter" type="checkbox" value="20-30">
                                            <div class="content">
                                                <span class="text">&#8377; 20K - &#8377; 30K</span>
                                                <span class="qty">(1)</span>
                                            </div>
                                        </li>
                                        <li>

                                            <input class="form-check-input offered_salary filter" type="checkbox" value="30-40">
                                            <div class="content">
                                                <span class="text">&#8377; 30K - &#8377; 40K</span>
                                                <span class="qty">(7)</span>
                                            </div>
                                        </li>
                                        <li>

                                            <input class="form-check-input offered_salary filter" type="checkbox" value="40-50">
                                            <div class="content">
                                                <span class="text">&#8377; 40K - &#8377; 50K</span>
                                                <span class="qty">(2)</span>
                                            </div>
                                        </li>
                                        <li>

                                            <input class="form-check-input offered_salary filter" type="checkbox" value="50-60">
                                            <div class="content">
                                                <span class="text">&#8377; 50K - &#8377; 60K</span>
                                                <span class="qty">(0)</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div> -->
                        </div>

                        <div class="job-widget-btn">
                            <input type="submit" class="primry-btn-2 lg-btn text-center" style="display: block; width:100%; margin-top:-40px; cursor:pointer" value="Search">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 order-lg-2 order-1">
                    <div class="job-listing-wrrap">
                        <div class="row g-4 mb-25">
                            <div class="col-lg-6 d-flex align-items-center">

                                <!-- <p class="show-item">Showing results 0 in 0 jobs list</p> -->
                            </div>
                            <div class="col-lg-6 d-flex align-items-center justify-content-lg-end">
                                <div class="grid-select-area">
                                    <div class="select-area">
                                        <?Php
                                        $sort_val = Request::get('sort');
                                        ?>
                                        <select name="sort" class="select1 filter" id="sort">
                                            <option value="">Sort By(Default)</option>
                                            <option value="Newest" <?php echo $sort_val == 'Newest' ? 'selected' : ''; ?>>Newest</option>
                                            <option value="Oldest" <?php echo $sort_val == 'Oldest' ? 'selected' : ''; ?>>Oldest</option>
                                            <option value="Random" <?php echo $sort_val == 'Random' ? 'selected' : ''; ?>>Random</option>
                                            <option value="Popularity" <?php echo $sort_val == 'Popularity' ? 'selected' : ''; ?>>Popularity</option>

                                        </select>
                                    </div>
                                    <div class="grid-area">
                                        <ul>
                                            <li><a href="job-listing2.html">
                                                    <svg width="16" height="16" viewbox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M6.26106 6.95674H0.695674C0.311464 6.95674 0 6.64527 0 6.26106V0.695674C0 0.311464 0.311464 0 0.695674 0H6.26106C6.64527 0 6.95674 0.311464 6.95674 0.695674V6.26106C6.95674 6.64527 6.64527 6.95674 6.26106 6.95674Z" />
                                                        <path d="M15.304 6.95674H9.73864C9.35443 6.95674 9.04297 6.64527 9.04297 6.26106V0.695674C9.04297 0.311464 9.35443 0 9.73864 0H15.304C15.6882 0 15.9997 0.311464 15.9997 0.695674V6.26106C15.9997 6.64527 15.6882 6.95674 15.304 6.95674Z" />
                                                        <path d="M6.26106 16.0004H0.695674C0.311464 16.0004 0 15.689 0 15.3048V9.73937C0 9.35517 0.311464 9.0437 0.695674 9.0437H6.26106C6.64527 9.0437 6.95674 9.35517 6.95674 9.73937V15.3048C6.95674 15.689 6.64527 16.0004 6.26106 16.0004Z" />
                                                        <path d="M15.304 16.0004H9.73864C9.35443 16.0004 9.04297 15.689 9.04297 15.3048V9.73937C9.04297 9.35517 9.35443 9.0437 9.73864 9.0437H15.304C15.6882 9.0437 15.9997 9.35517 15.9997 9.73937V15.3048C15.9997 15.689 15.6882 16.0004 15.304 16.0004Z" />
                                                    </svg>
                                                </a></li>
                                            <li><a class="active" href="job-listing1.html">
                                                    <svg width="22" height="16" viewbox="0 0 22 16" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1.91313 0C0.856731 0 0 0.893707 0 1.99656C0 3.09861 0.856731 3.99157 1.91313 3.99157C2.96953 3.99157 3.82626 3.09861 3.82626 1.99656C3.82626 0.893707 2.96953 0 1.91313 0Z" />
                                                        <path d="M1.91313 6.00464C0.856731 6.00464 0 6.8976 0 8.00045C0 9.1025 0.856731 9.99621 1.91313 9.99621C2.96953 9.99621 3.82626 9.1025 3.82626 8.00045C3.82626 6.8976 2.96953 6.00464 1.91313 6.00464Z" />
                                                        <path d="M1.91313 12.0085C0.856731 12.0085 0 12.9023 0 14.0043C0 15.1064 0.856731 16.0001 1.91313 16.0001C2.96953 16.0001 3.82626 15.1064 3.82626 14.0043C3.82626 12.9023 2.96953 12.0085 1.91313 12.0085Z" />
                                                        <path d="M20.561 0.495117H6.95229C6.15787 0.495117 5.51367 1.16716 5.51367 1.99665C5.51367 2.82545 6.15782 3.49744 6.95229 3.49744H20.561C21.3554 3.49744 21.9996 2.82545 21.9996 1.99665C21.9996 1.16716 21.3554 0.495117 20.561 0.495117Z" />
                                                        <path d="M20.561 6.49878H6.95229C6.15787 6.49878 5.51367 7.17077 5.51367 8.00032C5.51367 8.82911 6.15782 9.5011 6.95229 9.5011H20.561C21.3554 9.5011 21.9996 8.82911 21.9996 8.00032C21.9996 7.17077 21.3554 6.49878 20.561 6.49878Z" />
                                                        <path d="M20.561 12.5034H6.95229C6.15787 12.5034 5.51367 13.1754 5.51367 14.0042C5.51367 14.833 6.15782 15.5049 6.95229 15.5049H20.561C21.3554 15.5049 21.9996 14.833 21.9996 14.0042C21.9996 13.1754 21.3554 12.5034 20.561 12.5034Z" />
                                                    </svg>
                                                </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="job-content">


                            @if($jobs->isNotEmpty())
                            @foreach($jobs as $job)
                            <div class="col-lg-12 mb-30">
                                <div class="job-listing-card">
                                    <div class="job-top">
                                        <div class="job-list-content">
                                            <div class="company-area">
                                                <div class="logo">
                                                    <img src="{{ empty($job->user->profile_pic) ? asset('assets/images/bg/company-logo/company-01.png') : asset('profile_pic/'.$job->user->profile_pic) }}" alt>
                                                </div>
                                                <div class="company-details">
                                                    <div class="name-location">
                                                        <h5><a href="{{ route('job.detail',$job->id) }}">{{ $job->title }}</a></h5>
                                                        <p><a href="#">{{ $job->user->name }}</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="job-discription">
                                                <ul>
                                                    <li>
                                                        <p><span class="title">Salary:</span> &#8377; {{ $job->salary }} / <span class="time">Per Month</span></p>
                                                    </li>
                                                    <li>
                                                        <p><span class="title">Create Date:</span> {{ \Carbon\Carbon::parse($job->created_at)->format('d M, Y') }}</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        @if(Auth::check() && \App\Models\SavedJob::where(['user_id'=> Auth::user()->id, 'job_id'=> $job->id])->count()<=0)
                                            <div class="bookmark">
                                            <i class="bi bi-bookmark-fill"></i>
                                    </div>
                                    @elseif(Auth::check() && \App\Models\SavedJob::where(['user_id'=> Auth::user()->id, 'job_id'=> $job->id])->count()>0)
                                    <div class="bookmark saved-job2">
                                        <i class="bi bi-bookmark-fill saved-job"></i>
                                    </div>
                                    @elseif(!Auth::check())
                                    <div class="bookmark">
                                        <i class="bi bi-bookmark-fill"></i>
                                    </div>
                                    @endif

                                </div>
                                <div class="job-type-apply">
                                    <div class="job-type">

                                        <span class='light-purple'>{{ $job->category->name }}</span>
                                        <!-- <span class='light-green'>Remote</span> -->
                                        <!-- <span class='light-blue'>Remote</span> -->


                                    </div>
                                    <div class="apply-btn">
                                        @if(Auth::check() && \App\Models\JobApplication::where(['user_id'=> Auth::user()->id, 'job_id'=> $job->id])->count()<=0)
                                            <a href="{{ route('job.detail',$job->id) }}"><span><img src="assets/images/icon/apply-ellipse.svg" alt></span>Apply Now</a>
                                            @elseif(Auth::check() && \App\Models\JobApplication::where(['user_id'=> Auth::user()->id, 'job_id'=> $job->id])->count()>0)
                                            <a href="{{ route('job.detail',$job->id) }}"><span><img src="assets/images/icon/apply-ellipse.svg" alt></span>Applied</a>
                                            @elseif(!Auth::check())
                                            <a href="{{ route('job.detail',$job->id) }}"><span><img src="assets/images/icon/apply-ellipse.svg" alt></span>Apply Now</a>
                                            @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                        {{ $jobs->links() }}

                        @else
                        <div class="w-50 mx-auto text-center alert alert-danger">No Job Found</div>
                        @endif


                        <!-- <div class="col-lg-12 d-flex justify-content-center">
                            <div class="pagination-area">
                                <nav aria-label="...">
                                    <ul class="pagination">
                                        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"></a></li>

                                        <li class="page-item active" aria-current="page"><a class="page-link" href="job-listing.html?p=1"> 1</a></li>

                                        <li class="page-item disabled"><a class="page-link" href="#"></a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div> -->



                    </div>



                </div>
            </div>


    </div>
    </form>
</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {


        $('#filterForm').submit(function(e) {
            e.preventDefault();

            let url = '{{ route("job.listing") }}?';
            // console.log(url);

            let cat_arr = $('input:checkbox[name="cat[]"]:checked').map(function() {
                return $(this).val();
            }).get(); // returns array
            console.log(cat_arr);


            let type_arr = $('input:checkbox[name="job_type[]"]:checked').map(function() {
                return $(this).val();
            }).get();

            console.log(type_arr);

            let date_arr = $('input:checkbox[name="dateFilter[]"]:checked').map(function() {
                return $(this).val();
            }).get();

            console.log(date_arr)

            let sort = $('#sort option:selected').text();
            //  console.log('sort:'+sort);

            if (cat_arr.length > 0) {
                url += '&cat=' + cat_arr;
            }
            if (type_arr.length > 0) {
                url += '&job_type=' + type_arr;
            }
            if (date_arr.length > 0) {
                url += '&date=' + date_arr;
            }
            if (sort != '' && sort != 'Sort By(Default)') {
                url += '&sort=' + sort;
            }
            window.location.href = url;


        });

        $('#sort').change(function() {
            $('#filterForm').submit();
        })

    });
</script>
@endsection