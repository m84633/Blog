<nav class="navbar  navbar-expand-md navbar-light  table-success sticky-top navbar-shadow">
	<div class="container">
	    <a href="{{ route('posts.index') }}" class="navbar-brand">MyBlog</a>
	    <form action="{{ route('search') }}" method="GET" class="form-inline" role="search">
	        <input type="search" class="form-control form-control-md mr-md-2" name="keyword" placeholder="搜尋文章" aria-label="Search">
	        <button type="submit" class="btn btn-md btn-outline-info my-2 my-md-0">
	            <i class="fas fa-search"></i>
	            搜尋
	        </button>
        </form>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                @auth
                    <li class="nav-item">
                        <a href="{{ route('users.showAvatar') }}" class="px-1">
                            <img src="{{ Auth::user()->getAvatarUrl() }}" style="width: 30px; height: 30px;" class="rounded-circle mt-1">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            {{ Auth::user()->name }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link" onclick="event.preventDefault(); $('#logout-form').submit();">登出</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">登入</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">註冊</a>
                    </li>
                @endauth
                @auth
                @if (Auth::user()->isAdmin())
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">管理帳號</a>
                </li>
                @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>

