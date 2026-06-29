<nav id="sidebar">
    <div class="sidebar_blog_1">
        <div class="sidebar-header">
            <div class="logo_section">

            </div>
        </div>
        <div class="sidebar_user_info">
            <div class="icon_setting"></div>
            <div class="user_profle_side">

                @php
                    $colors = [
                        ['bg-primary', 'text-white'],
                        ['bg-success', 'text-white'],
                        ['bg-danger', 'text-white'],
                        ['bg-dark', 'text-white'],
                        ['bg-info', 'text-dark'],
                        ['bg-warning', 'text-dark'],
                    ];

                    $color = $colors[array_rand($colors)];

                    $bg = $color[0];
                    $text = $color[1];

                    $admin = session('admin_auth', []);

                    $firstName = $admin['first_name'] ?? '';
                    $lastName = $admin['last_name'] ?? '';

                    $fullName = trim($firstName . ' ' . $lastName);

                    $initials = strtoupper(substr($firstName, 0, 1));

                    if (!empty($lastName)) {
                        $initials .= strtoupper(substr($lastName, 0, 1));
                    }
                @endphp

                <div class="user_img">
                    <div class="rounded-circle d-inline-flex justify-content-center align-items-center {{ $bg }} {{ $text }}"
                        style="width:70px; height:70px; font-weight:bold; font-size:24px;">
                        {{ $initials }}
                    </div>
                </div>

                <div class="user_info">
                    <h6>{{ $fullName }}</h6>
                    <p>
                        <span class="online_animation"></span> Online
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar_blog_2">
        <h4>General</h4>
        <ul class="list-unstyled components">
            <li><a href="/admin/dashboard"><i class="fa fa-dashboard yellow_color"></i> <span>Dashboard</span></a></li>
            <li><a href="/admin/orders"><i class="fa fa-shopping-cart orange_color"></i> <span>Orders</span></a></li>
            <li><a href="/admin/products"><i class="fa fa-cube purple_color2"></i> <span>Products</span></a></li>
            <li><a href="/admin/banners"><i class="fa fa-image green_color"></i> <span>Banner </span></a></li>
            <li><a href="/admin/coupons"><i class="fa fa-ticket blue1_color"></i> <span>Coupon</span></a></li>
            <li><a href="/admin/posts"><i class="fa fa-pencil-square yellow_color"></i> <span>Posts</span></a></li>
            <li><a href="/admin/categories"><i class="fa fa-folder-open orange_color"></i> <span>Category</span></a>
            </li>
            <li><a href="/admin/subcategories"><i class="fa fa-folder-open purple_color2"></i> <span>Sub
                        Category</span></a></li>
            <li><a href="/admin/profile"><i class="fa fa-user green_color"></i> <span>Profile</span></a></li>
            <li><a href="/admin/attributes"><i class="fa fa-tags blue1_color"></i> <span>Attribute</span></a></li>
            <li><a href="/admin/brands"><i class="fa fa-star orange_color"></i> <span>Brand</span></a></li>
            <li><a href="/admin/social-media "><i class="fa fa-share-alt purple_color2"></i> <span>Social
                        Media</span></a></li>
            <li><a href="/admin/policies"><i class="fa fa-file-text green_color"></i> <span>Policies</span></a></li>
            <li><a href="/admin/company"><i class="fa fa-building blue1_color"></i> <span>Company</span></a></li>
            <li><a href="/admin/posters"><i class="fa fa-envelope orange_color"></i> <span>Poster</span></a></li>
            <li><a href="/admin/contacts"><i class="fa fa-image purple_color2"></i> <span>Contact</span></a></li>
        </ul>
    </div>
</nav>
