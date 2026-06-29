<div class="topbar">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="full">
            <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
            <div class="logo_section">

            </div>
            <div class="right_topbar">
                <div class="icon_info">
                    <ul>
                        <!-- <li><a href="#"><i class="fa fa-bell-o"></i><span class="badge">2</span></a></li>
                        <li><a href="#"><i class="fa fa-question-circle"></i></a></li>
                        <li><a href="#"><i class="fa fa-envelope-o"></i><span class="badge">3</span></a></li> -->
                    </ul>
                    <ul class="user_profile_dd">
                        <li>
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

                                $admin = session('admin_auth');

                                $firstName = $admin['first_name'] ?? '';
                                $lastName = $admin['last_name'] ?? '';

                                $initials = strtoupper(substr($firstName, 0, 1));

                                if (!empty($lastName)) {
                                    $initials .= strtoupper(substr($lastName, 0, 1));
                                }
                            @endphp

                            <a class="dropdown-toggle" data-toggle="dropdown">
                                <div class="rounded-circle d-inline-flex justify-content-center align-items-center {{ $bg }} {{ $text }}"
                                    style="width:50px; height:50px; font-size:18px; font-weight:bold;">
                                    {{ $initials }}
                                </div>

                                <span class="name_user">
                                    {{ $firstName . ' ' . $lastName }}
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/admin/profile">My Profile</a>
                                <a class="dropdown-item" href="/admin/logout">
                                    <h5 class="text-danger">Log Out</h5>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>
