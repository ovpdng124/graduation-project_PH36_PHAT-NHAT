<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.index')}}" class="brand-link">
        <img src="{{asset('bower_components/admin-lte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <a href="{{route('admin.profile')}}"><img src="{{asset('bower_components/admin-lte/dist/img/avatar5.png')}}" class="img-circle elevation-2" alt="User Image"></a>
            </div>
            <div class="info">
                <a href="{{route('admin.profile')}}" class="d-block">{{Auth::user()->full_name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('user.list')}}" class="nav-link">
                        <i class="fa fa-list"></i>
                        <span>User list</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('order.list')}}" class="nav-link">
                        <i class="fa fa-list"></i>
                        <span>Order list</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('voucher.index')}}" class="nav-link">
                        <i class="fa fa-list"></i>
                        <span>Voucher list</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('product.index')}}" class="nav-link">
                        <i class="fa fa-list"></i>
                        <span>Product list</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('product-attribute.index')}}" class="nav-link">
                        <i class="fa fa-list"></i>
                        <span>Product attributes list</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('category.index')}}" class="nav-link">
                        <i class="fa fa-list"></i>
                        <span>Category list</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
