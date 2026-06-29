@extends('User.main')

<!-- Page Meta Data Starts -->
@section('metadata')
    <title>Electro - Electronics Website Template</title>
    <meta content="" name="keywords">
    <meta content="" name="description">
@endsection
<!-- Page Meta Data Ends -->

<!-- Page Content Starts -->
@section('pagecontent')
    <!-- Page Header -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6 wow fadeInUp">
            Blogs
        </h1>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp">
            <li class="breadcrumb-item">
                <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item active text-white">
                Blogs
            </li>
        </ol>
    </div>

    <section class="container-fluid my-5">
        <div class="container">
            <div class="text-center mb-5">
                <h5 class="text-primary h6">Our Blog</h5>
                <h2 class="display-20 display-md-18 display-lg-16">Recent Blog</h2>
            </div>
            <div class="row">
                @forelse($paginatedData as $post)
                    <div class="col-lg-4 col-md-6 mb-2-6 my-3">

                        <article class="card card-style2 position-relative">

                            <a href="{{ url('/blogs/' . $post->post_slug . '/' . $post->post_id) }}"
                                class="stretched-link"></a>

                            <div class="card-img">
                                <img class="rounded-top"
                                    src="{{ $post->featured_image
                                        ? asset('Posts/' . $post->featured_image)
                                        : 'https://img.freepik.com/free-vector/door-handle-key-set_1284-20884.jpg' }}"
                                    alt="{{ $post->post_name }}">

                                <div class="date">
                                    <span>{{ \Carbon\Carbon::parse($post->created_at)->format('d') }}</span>
                                    {{ \Carbon\Carbon::parse($post->created_at)->format('M') }}
                                </div>
                            </div>

                            <div class="card-body">

                                <h3 class="h5"><a>{{ Str::limit($post->post_name, 50, '...') }} </a>
                                </h3>


                                <p class="display-30">
                                    {{ Str::limit($post->short_description, 150, '...') }}
                                </p>

                                <span class="read-more">Read more</span>

                            </div>

                            <div class="card-footer">
                                <ul>
                                    <li>
                                        <span>
                                            <i class="fa fa-list"></i>
                                            {{ $post->category->category_name }}
                                        </span>
                                    </li>
                                    <li>
                                        <span>
                                            <i class="fas fa-user"></i>
                                            Admin
                                        </span>
                                    </li>
                                </ul>
                            </div>

                        </article>
                    </div>
                @empty
                    <h2> Posts Not Exists</h2>
                @endforelse
            </div>

            {{ $paginatedData->links('User.Pagination.custom') }}
        </div>
    </section>
@endsection
<!-- Page Content Ends -->
