@extends('layouts.layout')
@section('content1')

<div class="register-area pt-80 mb-120">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="form-wrapper">
          <div class="form-title">
            <h3>Register Account</h3>
            <span></span>
          </div>
          <div class="register-tab">
            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <!-- <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Candidate</button> -->
                <!-- <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Company</button> -->
              </div>
            </nav>
            <div style="margin-top:-64px;" class="tab-content" id="nav-tabContent">

              <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <form action="#" id="signupForm" method="post">
                  @csrf
                  <div class="row">

                    <div class="col-md-6 div2">
                      <div class="form-inner mb-25">
                        <label for="firstname1">Name*</label>
                        <div class="input-area">
                          <img src="assets/images/icon/user-2.svg" alt>
                          <input type="text" id="name" name="name" placeholder="Mr. Robert">

                        </div>
                        <p></p>
                      </div>
                    </div>

                    <div class="col-md-6 div2">
                      <div class="form-inner mb-25">
                        <label for="lastname1">Email*</label>
                        <div class="input-area">
                          <img src="assets/images/icon/email-2.svg" alt>
                          <input type="text" id="email" name="email" placeholder="info@example.com">

                        </div>
                        <p></p>
                      </div>
                    </div>
                    <div class="col-md-6 div2">
                      <div class="form-inner mb-25">
                        <label for="password">Password*</label>
                        <input type="password" name="password3" id="password3" placeholder="Password" />
                        <i class="bi bi-eye-slash" id="togglePassword3"></i>

                      </div>
                      <p></p>
                    </div>
                    <div class="col-md-6 div2">
                      <div class="form-inner">
                        <label for="password4">Confirm Password*</label>
                        <input type="password" name="password4" id="password4" placeholder="Confirm Password" />
                        <i class="bi bi-eye-slash" id="togglePassword4"></i>
                      </div>
                      <p></p>
                    </div>



                    <div class="row mb-4" id="div1" style="display: none;">

                      <div class="col-sm-12">
                        <div class="alert alert-success">
                          OTP has been sent to your E-mail <span class="currentUserEmail">example@gmail.com</span>

                        </div>
                        <p id="para"></p>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 input-area">
                          <input type="text" style="width: 100%!important;" class="form-control mb-4" name="signup_otp" id="signup_otp" placeholder="OTP">
                        </div>
                      </div>
                      <button type="button" id="signup_button" class="btn btn--icon btn-sm btn--round btn-info pl-3 pr-3 confirmOtp" style="float: right; margin-left: 1rem;">Verify</button>

                    </div>

                    <div class="col-md-12 div3">
                      <div class="form-agreement form-inner d-flex justify-content-between flex-wrap">
                        <div class="form-group two">
                          <input type="checkbox" id="agree" name="agree">
                          <label for="agree">Here, I will agree company terms & conditions.</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 div3">
                      <div class="form-inner">
                        <button id="btn1" style="cursor: pointer;" class="primry-btn-2" type="submit">Sign Up</button>
                      </div>
                    </div>
                          <div class="col-lg-12 text-center">
                      <a href="{{ route('auth.google.redirect') }}" class="btn btn-light btn-lg text-center align-items-center shadow-sm border rounded-pill px-4 py-2 my-4">
                        <img src="https://img.icons8.com/color/48/000000/google-logo.png" alt="Google Logo" class="me-2" width="24" height="24">
                        &nbsp; <span class="">Login with Google</span>
                      </a>
                      @foreach (['error', 'success', 'warning', 'info'] as $type)
                      @if (session($type))
                      <div class="my-2 alert alert-{{ $type }}">
                        {{ session($type) }}
                      </div>
                      @endif
                      @endforeach
                    </div>
                    <h6>Already have an account? <a href="login"> Login</a> Here</h6>

                  </div>


                </form>
              </div>



              <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <form>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-inner mb-25">
                        <label for="firstname">First Name*</label>
                        <div class="input-area">
                          <img src="assets/images/icon/user-2.svg" alt>
                          <input type="text" id="firstname" name="firstname" placeholder="Mr. Robert">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-inner mb-25">
                        <label for="lastname">Last Name*</label>
                        <div class="input-area">
                          <img src="assets/images/icon/user-2.svg" alt>
                          <input type="text" id="lastname" name="lastname" placeholder="Jonson">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-inner mb-25">
                        <label for="username">User Name*</label>
                        <div class="input-area">
                          <img src="assets/images/icon/user-2.svg" alt>
                          <input type="text" id="username1" name="username" placeholder="robertjonson">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-inner mb-25">
                        <label for="email">Email*</label>
                        <div class="input-area">
                          <img src="assets/images/icon/email-2.svg" alt>
                          <input type="text" id="email1" name="email1" placeholder="info@example.com">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-inner mb-25">
                        <label for="companyname">Company Name*</label>
                        <div class="input-area">
                          <img src="assets/images/icon/company-2.svg" alt>
                          <input type="text" id="companyname" name="companyname" placeholder="Mr. Robert">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-inner mb-25">
                        <label>Company Type*</label>
                        <div class="input-area">
                          <img src="assets/images/icon/category-2.svg" alt>
                          <select class="select1">
                            <option value="0">Digital Agency</option>
                            <option value="1">Digital Marketing Agency</option>
                            <option value="2">Software Company</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-inner mb-25">
                        <label for="password">Password*</label>
                        <input type="password" name="password" id="password3" placeholder="Password" />
                        <i class="bi bi-eye-slash" id="togglePassword3"></i>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-inner">
                        <label for="password4">Confirm Password*</label>
                        <input type="password" name="confirmpassword" id="password4" placeholder="Confirm Password" />
                        <i class="bi bi-eye-slash" id="togglePassword4"></i>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-agreement form-inner d-flex justify-content-between flex-wrap">
                        <div class="form-group two">
                          <input type="checkbox" id="html">
                          <label for="html">Here, I will agree company terms & conditions.</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-inner">
                        <button class="primry-btn-2" type="submit">Sign Up</button>
                      </div>
                    </div>
                    <h6>Already have an account? <a href="login.html"> Login</a> Here</h6>

                  </div>
                </form>
              </div>
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
  $("#signupForm").on("submit", function(e) {
    e.preventDefault();

    let form = $(this)[0];
    let form_data = new FormData(form);
    // console.log(form_data)
    // return
    $.ajax({
      type: 'POST',
      url: "{{ route('auth.processRegister') }}",
      data: form_data,
      processData: false,
      contentType: false,
      dataType: 'json',
      beforeSend: function() {
        $("#btn1").addClass('disabled');
        $("#btn1").html('Loading..');
      },
      success: function(resp) {
        $("#btn1").removeClass('disabled');
        $("#btn1").html('Sign Up');

        console.log(resp);
        if (resp.status == false) {
          if (resp.errors.name) {
            $('#name').parent().siblings('p').addClass('text-danger').html(resp.errors.name[0]);
          } else {
            $('#name').parent().siblings('p').removeClass('text-danger').html('');
          }

          if (resp.errors.email) {
            $('#email').parent().siblings('p').addClass('text-danger').html(resp.errors.email[0]);
          } else {
            $('#email').parent().siblings('p').removeClass('text-danger').html('');
          }

          if (resp.errors.password3) {
            $('#password3').parent().siblings('p').addClass('text-danger').html(resp.errors.password3[0]);
          } else {
            $('#password3').parent().siblings('p').removeClass('text-danger').html('');
          }

          if (resp.errors.password4) {
            $('#password4').parent().siblings('p').addClass('text-danger').html(resp.errors.password4[0]);
          } else {
            $('#password4').parent().siblings('p').removeClass('text-danger').html('');
          }
        } else {
          $('#name').parent().siblings('p').removeClass('text-danger').html('');
          $('#email').parent().siblings('p').removeClass('text-danger').html('');
          $('#password3').parent().siblings('p').removeClass('text-danger').html('');
          $('#password4').parent().siblings('p').removeClass('text-danger').html('');

          window.location.href = '{{ route("user.profile") }}';
        }
      },
      error: function(xhr, status, code) {
        console.error(status);
      }
    });

  });
</script>
@endsection