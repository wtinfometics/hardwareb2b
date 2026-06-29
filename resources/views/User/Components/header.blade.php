    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Topbar Start -->
    <div class="container-fluid px-5 py-4 d-none d-lg-block">
        <div class="row gx-0 align-items-center text-center">
            <div class="col-md-4 col-lg-3 text-center text-lg-start">
                <div class="d-inline-flex align-items-center">
                    <a href="/" class="navbar-brand p-0">
                        <img       src="{{ !empty($companyData->logo) ? asset('Company/' . $companyData->logo) : asset('images/default-logo.png') }}"
                            alt="Logo">
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-lg-6 text-center">
                <div class="position-relative ps-4">
                    <form method="get" action="/shop">
                        <div class="d-flex border rounded-pill">
                            <input class="form-control border-0 rounded-pill w-100 py-3" type="text" name="search"
                                data-bs-target="#dropdownToggle123" placeholder="Search Looking For?">

                            <button type="submit" class="btn btn-primary rounded-pill py-3 px-5" style="border: 0;"><i
                                    class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 text-center text-lg-end">
                <div class="d-inline-flex align-items-center">

                    <a href="/cart" class="text-muted d-flex align-items-center justify-content-center"><span
                            class="rounded-circle btn-md-square border"><i class="fas fa-shopping-cart"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar & Hero Start -->
    <div class="container-fluid nav-bar p-0">
        <div class="row gx-0 custom-navbar px-5 ">
            <div class="col-lg-3 d-none d-lg-block">

            </div>
            <div class="col-12 col-lg-9">
                <nav class="navbar navbar-expand-lg navbar-light bg-primary custom-navbar">
                    <a href="/" class="navbar-brand d-block d-lg-none ">

                       <img
    style="width:150px;height:48px"
  src="{{ !empty($companyData->logo) ? asset('Company/' . $companyData->logo) : asset('images/default-logo.png') }}"
    alt="Logo">
                    </a>

                    <div class="d-flex flex-wrap">
                    <a href="/cart" class="text-muted d-lg-none d-md-block  d-flex align-items-center justify-content-center"><span
                            class="rounded-circle btn-md-square border"><i class="fas fa-shopping-cart"></i></span>
                    </a>
                    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars fa-1x"></span>
                    </button></div>

                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav ms-auto py-0">
                            <a href="/" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">
                                Home
                            </a>

                            <a href="/shop" class="nav-item nav-link {{ request()->is('shop') ? 'active' : '' }}">
                                Shop
                            </a>

                            <a href="/blogs" class="nav-item nav-link {{ request()->is('blogs') ? 'active' : '' }}">
                                Blogs
                            </a>

                            <a href="/contact" class="nav-item nav-link {{ request()->is('contact') ? 'active' : '' }}">
                                Contact
                            </a>
                        </div>
                        <a href="tel:+{{ isset($companyData->phone)?$companyData->phone:'' }}"
                            class="btn btn-secondary rounded-pill py-2 px-4 px-lg-3 mb-3 mb-md-3 mb-lg-0">
                            <i class="fa fa-mobile-alt me-2"></i>
                            +{{ isset($companyData->phone)?$companyData->phone:''  }}
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->
