  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-orange navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('admin.home') }}" class="nav-link">首頁</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link"></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form  class="form-inline ml-3">
      <div class="input-group input-group-sm" style="display: none" v-show="showSearch">
        <input class="form-control form-control-navbar"  type="search" placeholder="Search" aria-label="Search" v-model="message">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src='{{asset('admin/dist/img/user1-128x128.jpg')}}' alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src='{{asset('admin/dist/img/user8-128x128.jpg')}}' alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src='{{asset('admin/dist/img/user3-128x128.jpg')}}' alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          {{-- @if(Auth::user()->unreadnotifications->count()) --}}
          <span v-cloak v-if="notReadCount" class="badge badge-warning navbar-badge">@{{ notReadCount }}</span>
          {{-- @endif --}}
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span v-if="haveNot" class="dropdown-item dropdown-header">共有@{{ notCount }}條通知</span>
          <span v-if="!haveNot" class="dropdown-item dropdown-header">目前沒有通知</span>
          <no_read_not v-for="(value,index) in notRead" :data="value" :key="index"></no_read_not>
          <read_not v-if="notAll" v-for="(value,index) in Read.slice(0,ReadLoop)" :data="value" :key="value.id"></read_not>
          <read_not v-if="!notAll" v-for="(value,index) in Read" :data="value" :key="value.id"></read_not>
          {{-- @foreach(auth()->user()->unreadNotifications as $notification) --}}
          {{-- <div class="dropdown-divider"> </div> --}}
{{--             <a href="#" class="dropdown-item text-white bg-danger">
              <i class="fas fa-envelope mr-2"></i> {{ $notification->data['data'] }}
              <span class="float-right text-white text-sm">{{ $notification->created_at->diffForHumans() }}</span>
            </a> --}}
         
          {{-- @endforeach --}}
{{--           @foreach(auth()->user()->readNotifications as $notification)
          @if($loop->iteration == 5)
            @break
          @endif --}}
          {{-- <div class="dropdown-divider"></div> --}}
  {{--         <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> {{ $notification->data['data'] }}
            <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
          </a> --}}
{{--           @endforeach --}}
        <div v-if="haveNot">
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer" @click.prevent.stop="mark">將所有通知視為已讀</a>
          <div class="dropdown-divider"></div>
          
            <a v-if="notAll" href="#" class="dropdown-item dropdown-footer" @click.prevent.stop="seeAll">查看更多通知</a>
            <a v-if="!notAll" href="#" class="dropdown-item dropdown-footer" @click.prevent.stop="seeAll">顯示較少通知</a>
            <a href="#" class="dropdown-item dropdown-footer" @click.prevent.stop="deleteAll">刪除所有通知</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"  onclick="event.preventDefault();document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt" title="logout">
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                        @csrf
            </form>
          </i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->