<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            {{ link_to_route('home', config('app.name', 'Laravel'), [], ['class' => 'navbar-brand']) }}

        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li>{{ link_to_route('home', __('Home')) }}</li>
                <li>{{ link_to_route('register', __('Posts')) }}</li>
                <li>{{ link_to_route('feed', __('News')) }}</li>
                <li>{{ link_to_route('category', __('Categories')) }}</li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li>{{ link_to_route('login', __('Login')) }}</li>
                    <li>{{ link_to_route('register', __('Register')) }}</li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                {{ link_to_route('users.show', __('User Profile'), Auth::user()) }}
                            </li>
                            <li>
                                {{ link_to_route('posts.create', __('Add Post')) }}
                            </li>
                            <li>
                                {{ link_to_route('feed.create', __('Add Feed')) }}
                            </li>
                            <li>
                                {{ link_to_route('category.create', __('Add Category')) }}
                            </li>
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>

    </div>
</nav>
