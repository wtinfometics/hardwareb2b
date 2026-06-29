    <!-- Footer Start -->
    <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
        <div class="container py-5">

            <div class="row g-4 rounded mb-5" style="background: rgba(255, 255, 255, .03);">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded p-4">
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4"
                            style="width: 70px; height: 70px;">
                            <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h4 class="text-white">Address</h4>
                            @if(!empty($companyData))
                            <p class="mb-2">
                                {{ $companyData->address .
                                    ' ' .
                                    $companyData->street .
                                    ' ' .
                                    $companyData->city .
                                    ' ' .
                                    $companyData->state .
                                    ' ' .
                                    $companyData->country .
                                    ' ' .
                                    $companyData->pin_code }}
                            </p>
                            @else

                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded p-4">
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4"
                            style="width: 70px; height: 70px;">
                            <i class="fas fa-envelope fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h4 class="text-white">Mail Us</h4>
                            <p class="mb-2"> {{ isset($companyData->email) ? $companyData->email :'' }} </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded p-4">
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4"
                            style="width: 70px; height: 70px;">
                            <i class="fa fa-phone-alt fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h4 class="text-white">Telephone</h4>
                            <p class="mb-2"> {{ isset($companyData->phone)?$companyData->phone :'' }} </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded p-4">
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4"
                            style="width: 70px; height: 70px;">
                            <i class="fas fa-industry fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h4 class="text-white">Company Name</h4>
                            <p class="mb-2">{{ isset($companyData->name)? $companyData->name :'' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <div class="footer-item">
                            <h4 class="text-primary mb-4">FIRST PRO</h4>
                            <p class="mb-3">First Pro is a trusted Dubai-based supplier of premium hardware products,
                                offering door handles, push handles, hinges, and architectural fittings in bulk for
                                commercial projects</p>
                            <div class="position-relative mx-auto rounded-pill">
                                <input class="form-control rounded-pill w-100 py-3 ps-4 pe-5" type="text"
                                    placeholder="Enter your email">
                                <button type="button"
                                    class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 mt-2 me-2">SignUp</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="text-primary mb-4">Pages </h4>
                        <a href="/" class=""><i class="fas fa-angle-right me-2"></i> Home</a>
                        <a href="/shop" class=""><i class="fas fa-angle-right me-2"></i> Products</a>
                        <a href="/blogs" class=""><i class="fas fa-angle-right me-2"></i> Blogs</a>
                        <a href="/contact" class=""><i class="fas fa-angle-right me-2"></i> Contact</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">

                    <div class="footer-item d-flex flex-column">
                        <h4 class="text-primary mb-4">Information</h4>
                        @forelse($policies->take(5) as $policy)
                            <a href="{{ url('policy/' . $policy->policy_id . '/view') }}" class=""><i
                                    class="fas fa-angle-right me-2"></i> {{ $policy->policy_name }}</a>
                        @empty
                            <h5>No Policy Exists </h5>
                        @endforelse
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">

                    <div class="footer-item">
                        <h4 class="text-primary mb-4">Social Media</h4>

                        <div class="d-flex gap-3">

                            @if ($socialMedia?->facebook)
                                <a href="{{ $socialMedia->facebook }}" target="_blank" class="social-icon">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            @endif

                            @if ($socialMedia?->instagram)
                                <a href="{{ $socialMedia->instagram }}" target="_blank" class="social-icon">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            @endif

                            @if ($socialMedia?->youtube)
                                <a href="{{ $socialMedia->youtube }}" target="_blank" class="social-icon">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            @endif

                            @if ($socialMedia?->linkedin)
                                <a href="{{ $socialMedia->linkedin }}" target="_blank" class="social-icon">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            @endif

                            @if ($socialMedia?->x)
                                <a href="{{ $socialMedia->x }}" target="_blank" class="social-icon">
                                    <i class="fab fa-x-twitter"></i>
                                </a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-6 text-center text-md-start mb-md-0">

                </div>
                <div class="col-md-6 text-center text-md-end text-white">

                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Developed By <a target="_blank" class="border-bottom text-white" href="https://wtinfometics.com">WT
                        Infometics</a>.
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!-- Replace 919876543210 with your WhatsApp number -->
    <a href="{{ isset($socialMedia->whatsapp) ? $socialMedia->whatsapp :'' }}" class="whatsapp-btn" target="_blank" aria-label="Chat on WhatsApp">
        <i class="fa-brands fa-whatsapp"></i>
    </a>
