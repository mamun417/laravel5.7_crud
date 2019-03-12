<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                    <img alt="image" class="img-circle" src="{{ asset('admin/img/mamun.jpg') }}"/>
                     </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="clear"> <span class="block m-t-xs"> <strong
                                    class="font-bold">David Williams</strong>
                        </span> <span class="text-muted text-xs block">Art Director <b
                                    class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>

            <li class="@if ($current_controller == 'AdminController') {{ "active" }} @endif">
                <a href="{{ route('admin.dashboard') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>

            <li class="@if ($current_controller == 'BrandsController') {{ "active" }} @endif">
                <a href="{{ route('admin.brands.index') }}"><i class="fa fa-pie-chart"></i> <span class="nav-label">Brands</span> </a>
            </li>

            <li class="@if ($current_controller == 'CategoriesController') {{ "active" }} @endif">
                <a href="{{ route('admin.categories.index') }}"><i class="fa fa-pie-chart"></i> <span class="nav-label">Categories</span> </a>
            </li>

            <li>
                <a href="metrics.html"><i class="fa fa-pie-chart"></i> <span class="nav-label">Product</span> </a>
            </li>
        </ul>

    </div>
</nav>