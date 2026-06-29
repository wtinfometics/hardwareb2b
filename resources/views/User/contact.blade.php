@extends('User.main')

<!-- Page Meta Data Starts -->
@section('metadata')
  <!-- Contact Page -->

<title>Contact First Pro UAE | Door Hardware & Cabinet Accessories Supplier</title>

<meta name="description" content="Contact First Pro UAE for inquiries about door handles, security handles, hinges, sliders, and cabinet hardware. Get expert support and wholesale pricing for your business needs.">

<meta name="keywords" content="contact First Pro UAE, hardware supplier contact UAE, door handles supplier UAE, cabinet hardware inquiries, wholesale hardware UAE, architectural hardware support, furniture fittings supplier UAE, door accessories supplier">

@endsection
<!-- Page Meta Data Ends -->

<!-- Page Content Starts -->
@section('pagecontent')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">Contact Us</h1>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Contact</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Contucts Start -->
    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="p-5 bg-light rounded">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                            <h4 class="text-primary border-bottom border-primary border-2 d-inline-block pb-2">Get in
                                touch</h4>
                            <p class="mb-5 fs-5 text-dark">We are here for you! how can we help, We are here for you!
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <h5 class="text-primary wow fadeInUp" data-wow-delay="0.1s">Let’s Connect</h5>
                        <h1 class="display-5 mb-4 wow fadeInUp" data-wow-delay="0.3s">Send Your Message</h1>


                        {{-- Success Message --}}
                        @if (!empty($success) && $success === true && !empty($message))
                            <div class="alert alert-success auto-hide">
                                {{ $message }}
                            </div>
                        @endif

                        {{-- Error Message from Controller --}}
                        @if (isset($success) && $success === false && !empty($message))
                            <div class="alert alert-danger auto-hide">
                                {{ $message }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success auto-hide">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger auto-hide ">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="post" action="/contacts">
                            @csrf
                            <div class="row g-4 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" name="first_name"
                                            class="form-control @error('first_name') is-invalid @enderror" id="name"
                                            placeholder="Enter The First name ">
                                        @error('first_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <label for="name">First Name</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" name="last_name"
                                            class="form-control @error('last_name') is-invalid @enderror" id="email"
                                            placeholder="Enter The Last Name">
                                        @error('last_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <label for="email">Last Name</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="number" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror" id="phone"
                                            placeholder="Enter Phone Number">
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <label for="phone">Phone Number</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror" id="project"
                                            placeholder="Enter E-Mail Address">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <label for="project">E-Mail Address </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" name="subject"
                                            class="form-control @error('subject') is-invalid @enderror" id="subject"
                                            placeholder="Enter The Message Subject">
                                        @error('subject')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <label for="subject">Subject</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea name="message" class="form-control @error('message') is-invalid @enderror" placeholder="Leave a message here"
                                            id="message" style="height: 160px"></textarea>
                                        @error('message')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <label for="message">Message</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-100 py-3">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="h-100 rounded">
                            <iframe class="rounded w-100" style="height: 100%;"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d462562.8478570542!2d54.947546!3d25.075707!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f434b1c3b2b7d%3A0x2c9f7b3c8d1a6b0!2sDubai%20-%20United%20Arab%20Emirates!5e0!3m2!1sen!2sin!4v1720000000000!5m2!1sen!2sin"
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contuct End -->
@endsection
<!-- Page Content Ends -->
