<div class="header">
  <!-- navbar -->
  <nav class="navbar-classic navbar navbar-expand-lg">
        <a id="nav-toggle" href="#" class="h4 text-primary"><i data-feather="menu" class="nav-icon me-2 icon-xs"></i>
        </a>
    <!--Navbar nav -->
    <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
      <!-- List -->
      <li class="dropdown stopevent ms-2">
        <a class="rounded-circle" href="#" role="button" id="dropdownUser"
          data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="avatar avatar-md avatar-indicators avatar-online">
            <img alt="avatar" src="{{ asset('assets/img/user/'.Auth::user()->photo) }}" class="rounded-circle" />
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end" aria-labelledby="dropdownUser">
          <div class="border-bottom px-4 pb-0 pt-2">
            <div class="lh-1 ">
              <h5 class="mb-1">{{ Auth::user()->name }}</h5>
            </div>
          </div>
          <ul class="list-group">
            <li class="list-group-item">
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                    <i class="me-2" data-feather="user"></i> Edit Profile
                </a>
            </li>
            <li class="list-group-item bg-light">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item" href="{{ route('logout') }}">
                        <i class="me-2"
                        data-feather="power"></i>Log Out
                    </button>
                </form>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </nav>
</div>
