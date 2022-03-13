<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-3">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }} " aria-current="page" href="/dashboard">
          <span data-feather="home"></span>
          Dashboard
        </a>
      </li>
      @can('user')
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/posts*') ? 'active' : '' }} " href="/dashboard/posts">
          <span data-feather="file-text"></span>
          My Posts
        </a>
      </li>
      @endcan
      <li class="nav-item">
        <a class="nav-link {{ Request::is('posts') ? 'active' : '' }} " href="/posts">
          <span data-feather="folder"></span>
          All Blogs
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('categories') ? 'active' : '' }} " href="/categories">
          <span data-feather="list"></span>
          All Categories
        </a>
      </li>
    </ul>

    {{-- baris dibawah hanya bisa diakses oleh admin --}}
    @can('admin')
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>Administrator</span>
      <a class="link-secondary" href="#" aria-label="Add a new report">
        <span data-feather="user"></span>
      </a>
    </h6>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/categories*') ? 'active' : '' }} " href="/dashboard/categories">
          <span data-feather="grid"></span>
          Post Categories
        </a>
      </li>
    </ul>
    @endcan

  </div>
</nav>