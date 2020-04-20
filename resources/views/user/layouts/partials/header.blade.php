<!-- header -->
<header class="header">
    <div class="container-fluid px-lg-5">
        <!-- nav -->
        <nav class="py-4">
            <div id="logo">
                <h1><a href="{{route('index')}}"><span class="fa fa-bold" aria-hidden="true"></span>ootie</a></h1>
            </div>

            <label for="drop" class="toggle rounded bg-transparent border border-light text-light"><i class="fa fa-bars"></i></label>
            <input type="checkbox" id="drop"/>
            <ul class="menu mt-2">
                @auth
                    @if(\App\Helpers\GlobalHelper::checkAdminRole())
                        <li><a href="{{route('admin.index')}}">Dashboard</a></li>
                    @endif
                @endauth
                <li class=""><a href="{{route('index')}}">Home</a></li>
                <li><a href="{{route('shopping')}}">Shopping</a></li>
                <li><a href="{{route('list.cart')}}">Cart</a><br></li>
                @auth
                    <li class="d-none d-lg-block">
                        <a href="#">User<span class="fa fa-angle-down" aria-hidden="true"></span></a>
                        <ul>
                            <li><a href="{{route('profile')}}">Profile</a></li>
                            <li><a href="{{route('logout')}}">Logout</a></li>
                        </ul>
                    </li>
                    <li class="d-lg-none"><a href="{{route('profile')}}">Profile</a></li>
                    <li class="d-lg-none"><a href="{{route('logout')}}">Logout</a></li>
                @else
                    <li class="d-none d-lg-block">
                        <a href="#">User<span class="fa fa-angle-down" aria-hidden="true"></span></a>
                        <ul>
                            <li><a href="{{route('login-form')}}">Login</a></li>
                            <li><a href="{{route('register-form')}}">Register</a></li>
                        </ul>
                    </li>
                    <li class="d-lg-none"><a href="{{route('login-form')}}">Login</a></li>
                    <li class="d-lg-none"><a href="{{route('register-form')}}">Register</a></li>
                @endauth
            </ul>
        </nav>
        <!-- //nav -->
    </div>
</header>
<!-- //header -->
