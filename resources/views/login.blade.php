@extends('layouts.layout')
@section('content1')

<div class="login-area register-area pt-50 mb-120">
  <div class="container">
    @if(Session::has('success'))
    <div class="alert alert-success">
      <p>{{ Session::get('success') }}</p>
    </div>
    @endif
    <div class="row">
      <div class="col-lg-12">
        <div class="form-wrapper">
          <div class="form-title">
            <h3>Log In Here!</h3>
            <span></span>
          </div>

          <div class="alert_container">
            <div id="msg2" class="alert alert-danger alert-dismissible d-none">
              <span></span>
              <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>

          <div class="register-tab">
            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <!-- <button class="nav-link navbtn active " onclick="func1(this)" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Candidate</button>
                                    <button class="nav-link navbtn" onclick="func1(this)" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Company</button> -->
              </div>
            </nav>


            <div class="tab-content" id="nav-tabContent">

              <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">


                <form action="#" method="POST" id="userLoginForm">
                  @csrf
                  <div class="row" style="margin-top:-45px">
                    <div class="col-lg-12">
                      <div class="form-inner mb-25">
                        <label for="email">Email*</label>
                        <div class="input-area">
                          <img src="assets/images/icon/email-2.svg" alt>
                          <input type="email" id="email" name="email" placeholder="info@example.com">
                        </div>
                        <p style="display: block;"></p>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-inner">
                        <label for="email">Password*</label>
                        <input type="password" name="password" id="password" placeholder="Password" />
                        <i class="bi bi-eye-slash" id="togglePassword"></i>
                      </div>
                      <p></p>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-agreement form-inner d-flex justify-content-between flex-wrap">
                        <div class="form-group">
                          <input type="checkbox" name="remember_me" id="remember_me">
                          <label for="remember_me">Remember Me</label>
                        </div>
                        <!-- <a href="#" class="forgot-pass">Forget Password?</a> -->
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-inner">
                        <button class="primry-btn-2" id="login_btn" style="cursor: pointer;" type="submit">LogIn</button>
                      </div>
                    </div>

                    <div class="col-lg-12 text-center">
                      <a href="{{ route('auth.google.redirect') }}" class="btn btn-light btn-lg text-center align-items-center shadow-sm border rounded-pill px-4 py-2 my-4">
                        <img src="https://img.icons8.com/color/48/000000/google-logo.png" alt="Google Logo" class="me-2" width="24" height="24">
                        &nbsp; <span class="">Login with Google</span>
                      </a>
                      @foreach (['error', 'success', 'warning', 'info'] as $type)
                      @if (session($type))
                      <div class="my-2 text-danger alert alert-{{ $type }}">
                        {{ session($type) }}
                      </div>
                      @endif
                      @endforeach
                    </div>
                    <div class="col-lg-12 d-flex justify-content-center">
                      <h6>Don’t have an account? <a href="register">Sign Up</a></h6>
                    </div>
                  </div>
                </form>
              </div>

              <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                <!-- <form action="#" method="POST" id="vendorLoginForm">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-inner mb-25">
                          <label for="email">Email*</label>
                          <div class="input-area">
                            <img src="assets/images/icon/email-2.svg" alt>
                            <input type="email" name="vendor_email" id="vendor_email" placeholder="info@example.com">
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="form-inner">
                          <label for="email">Password*</label>
                          <input type="password" id="vendor_password" name="vendor_password" placeholder="Password" />
                          <i class="bi bi-eye-slash" id="togglePassword"></i>
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="form-agreement form-inner d-flex justify-content-between flex-wrap">
                          <div class="form-group">
                            <input type="checkbox" id="html">
                            <label for="html">Remember Me</label>
                          </div>
                          <a href="#" class="forgot-pass">Forget Password?</a>
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="form-inner">
                          <button class="primry-btn-2" id="vendor_login_btn" type="submit">LogIn</button>
                        </div>
                      </div>
                      <h6>Don’t have an account? <a href="register">Sign Up</a></h6>
                    </div>
                  </form> -->
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
  $("#userLoginForm").on("submit", function(e) {
    e.preventDefault();
    let container = document.querySelector(".alert_container");
    let html = ` <span></span>
              <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>`;
    if (!document.querySelector(".alert_container #msg2")) {
      let ele = document.createElement("div")
      ele.setAttribute('id', 'msg2')
      ele.classList.add('alert', 'alert-danger', 'alert-dismissible', 'd-none')
      ele.innerHTML = html
      container.append(ele);
    }
    // console.log('ok')
    // return
    let form = $(this)[0];
    let form_data = new FormData(form);

    $.ajax({
      type: 'POST',
      url: '{{ route("auth.processLogin") }}',
      data: form_data,
      processData: false,
      contentType: false,
      dataType: 'json',
      beforeSend: function() {},
      success: function(resp) {
        console.log(resp)

        if (resp.status == false) {
          if (resp.errors.email) {
            $('#email').parent().siblings('p').addClass('text-danger').html(resp.errors.email[0]);
          } else {
            $('#email').parent().siblings('p').removeClass('text-danger').html('');
          }

          if (resp.errors.password) {
            $('#password').parent().siblings('p').addClass('text-danger').html(resp.errors.password[0]);
          } else {
            $('#password').parent().siblings('p').removeClass('text-danger').html('');
          }
        } else {
          $('#name').parent().siblings('p').removeClass('text-danger').html('');
          $('#password').parent().siblings('p').removeClass('text-danger').html('');

          if (resp.login == true) {
            window.location.href = '{{ route("user.profile") }}';
          } else {
            $("#msg2").removeClass('d-none');
            $("#msg2").children('span').html('Invalid Credentials, Please Try Again.');
          }
        }


      },
      error: function(xhr, status, code) {
        console.error(xhr);
      },
    });

  });
</script>
@endsection