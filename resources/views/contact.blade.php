@extends('layouts.layout')
@section('content1')

<div class="inner-banner">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="banner-content text-center">
          <h1>Contact</h1>
          <span></span>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">
                Contact
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="office-location-area pt-120 mb-120">
  <div class="container">
    <div class="row mb-120">
      <div class="col-lg-12 mb-70">
        <div class="office-location">
          <div class="office-categoty">
            <div class="single-category d-lg-block d-none">
              <h5>Main Office</h5>
              <span class="first"></span>
              <p></p>
            </div>
            <!-- <div class="single-category d-lg-block d-none">
                                <h5>Office-01</h5>
                                <span></span>
                                <p></p>
                            </div>
                            <div class="single-category d-lg-block d-none">
                                <h5>Office-02</h5>
                                <span></span>
                                <p></p>
                            </div> -->
          </div>
          <div class="row g-lg-4 gy-5">
            <div class="col-lg-4">
              <div
                class="single-category d-lg-none d-flex justify-content-center">
                <h5>Main Office</h5>
              </div>
              <div class="single-location">
                <h5>Andheri, Mumbai</h5>
                <ul>
                  <li>
                    <div class="icon">
                      <img src="assets/images/icon/phone-5.svg" alt />
                    </div>
                    <a href="tel:5554546565">+91 8650402124</a>
                  </li>
                  <li>
                    <div class="icon">
                      <img src="assets/images/icon/location.svg" alt />
                    </div>
                    <a>address..</a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- <div class="col-lg-4">
                                <div class="single-category d-lg-none  d-flex justify-content-center">
                                    <h5>Office-01</h5>
                                </div>
                                <div class="single-location">
                                    <h5>New York, USA</h5>
                                    <ul>
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/icon/phone-5.svg" alt>
                                            </div>
                                            <a href="tel:+9811873468987">+981-187 346 8987</a>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/icon/location.svg" alt>
                                            </div>
                                            <a>New York, Avenue-01, Block-B, House-140/142</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="single-category d-lg-none d-flex justify-content-center">
                                    <h5>Office-02</h5>
                                </div>
                                <div class="single-location">
                                    <h5>London City, UK</h5>
                                    <ul>
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/icon/phone-5.svg" alt>
                                            </div>
                                            <a href="tel:+998737346898">+998-737 346 898</a>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/icon/location.svg" alt>
                                            </div>
                                            <a>West London, Avenue-05, Block No-C, House-08/10</a>
                                        </li>
                                    </ul>
                                </div>
                            </div> -->
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="office-location-map">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3649.564763018799!2d90.36349791490355!3d23.834071191491947!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c14c8682a473%3A0xa6c74743d52adb88!2sEgens%20Lab!5e0!3m2!1sen!2sbd!4v1675482960370!5m2!1sen!2sbd"
            style="border: 0"
            allowfullscreen
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="contact-support-area mb-120">
  <div class="container">
    <div class="row g-lg-4 gy-5">
      <div class="col-lg-6">
        <div class="contect-content">
          <h4>Need Any Help? Contact Us</h4>
          <p>
            Alternatively you can also check for the Company email, phone
            number and address in the official website.
          </p>
          <div class="support">
            <div class="icon">
              <img src="assets/images/icon/footer-support-icon.svg" alt />
            </div>
            <div class="content">
              <h5>Support Line:</h5>
              <a href="tel:543534545">954543454350</a>
            </div>
          </div>
          <div class="service-available">
            <span>N:B</span>
            <p>
              Our Customer Service Available from 9 am to 6 pm (Saturday to
              Thursday)
            </p>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="contact-form form-wrapper">
          <form action="#" method="POST" id="contactForm">
            <div class="row">
              <div class="col-md-6">
                <div class="form-inner mb-25">
                  <label for="name">Your Name*</label>
                  <div class="input-area">
                    <img src="assets/images/icon/user-2.svg" alt />
                    <input
                      type="text"
                      name="name" value="{{ Auth::check() ? Auth::user()->name : ''; }}"
                      id="name"
                      placeholder="Mr. Jackson Mile" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-inner mb-25">
                  <label for="email">Email*</label>
                  <div class="input-area">
                    <img src="assets/images/icon/email-2.svg" alt />
                    <input
                      type="text"
                      name="email" value="{{ Auth::check() ? Auth::user()->email : ''; }}"
                      id="email"
                      placeholder="info@example.com" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-inner mb-25">
                  <label for="phonenumber">Phone*</label>
                  <div class="input-area">
                    <img src="assets/images/icon/phone-2.svg" alt />
                    <input
                      type="text"
                      name="phone" value="{{ Auth::check() ? Auth::user()->mobile : ''; }}"
                      id="phone"
                      placeholder="+880-17 *** *** **" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-inner mb-25">
                  <label for="jobplace">Company Name (Optional)</label>
                  <div class="input-area">
                    <img src="assets/images/icon/company-2.svg" alt />
                    <input
                      type="text"
                      id="cname"
                      name="cname"
                      placeholder="Company Name" />
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-inner mb-40">
                  <label for="message">Message</label>
                  <textarea
                    name="message"
                    id="message"
                    placeholder="Message..."></textarea>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-inner">
                  <input type="hidden" value="{{ csrf_token(); }}" name="_token">
                  <button class="primry-btn-2 lg-btn w-unset" type="submit">
                    Send Message
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    $("#contactForm").on("submit", function(e) {
      e.preventDefault();

      if ($("#name").val() == "") {
        Swal.fire("Your Name is mandatory", "", "error");
        return;
      }
      let regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      let email = $("#email").val();
      if (!regex.test(email)) {
        Swal.fire("Please Enter valid E-mail", "", "error");
        return;
      }

       if ($("#phone").val() == "") {
        Swal.fire("Enter Phone Number", "", "error");
        return;
      }
      if ($("#message").val() == "") {
        Swal.fire("Message is mandatory", "", "error");
        return;
      }
      $.ajax({
        type: "POST",
        url: "{{ route('send.message') }}",
        data: $("#contactForm").serialize(),
        success: function(html) {
          console.log(html);

          if (html.trim() == "1") {
            $("#contactForm")[0].reset();
            Swal.fire("Success", "Message Sent.", "success");
          } else if (html.trim() == "-1") {
            Swal.fire("Error", "Please Login.", "error");
          } else {
            Swal.fire("Error", "Message not sent.", "error");
          }
        },
          error: function(xhr, status, code) {
            console.error(xhr.responseText);
            Swal.fire('Error Occured','','error');
          }
      });
    });
  });
</script>
@endsection