
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
      <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="{{route('dashboard')}}" class="text-nowrap logo-img">
          <img src="{{asset('assets/admins/images/logos/logo_gau-removebg-preview.png')}}" style="margin-left: 60px" width="100px" height="80px" alt="Kamu House" />
        </a>
        <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
          <i class="ti ti-x fs-8"></i>
        </div>
      </div>
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
        <ul id="sidebarnav">
          <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Trang chủ </span>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('dashboard')}}" aria-expanded="false">
              <span>
                <i class="bi bi-house-door-fill"></i>
              </span>
              <span class="hide-menu">Trang chủ</span>
            </a>
          </li>
          <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Chức năng</span>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('admins.categories.index')}}" aria-expanded="false">
              <span>
                <i class="bi bi-list-check"></i>
                            </span>
              <span class="hide-menu">Danh mục sản phẩm </span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('admins.sanphams.index')}}" aria-expanded="false">
              <span>
                <i class="bi bi-box-seam-fill"></i>
              </span>
              <span class="hide-menu">Sản phẩm </span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('admins.donhangs.index')}}" aria-expanded="false">
              <span>
                <i class="ti ti-layout-dashboard"></i>
              </span>
              <span class="hide-menu">Đơn hàng </span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('admins.makhuyenmais.index')}}" aria-expanded="false">
              <span>
                <i class="bi bi-cash-stack"></i>              </span>
              <span class="hide-menu">Mã khuyến mãi </span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('admins.taikhoans.index')}}" aria-expanded="false">
              <span>
                <i class="bi bi-person-lines-fill"></i>
              </span>
              <span class="hide-menu">Tài khoản </span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('admins.thongtintrangwebs.index')}}" aria-expanded="false">
              <span>
                <i class="bi bi-info-circle-fill"></i>
              </span>
              <span class="hide-menu">Thông tin website </span>
            </a>
          </li>
        </ul>
        <div class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-4 rounded">
          <div class="d-flex">
            <div class="unlimited-access-title me-3">
              <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Quản trị viên</h6>
              <span href="#" target="_blank" class="btn btn-primary fs-2 fw-semibold lh-sm">Kamu House</span>
            </div>
            <div class="unlimited-access-img">
              <img src="{{asset('assets/admins/images/backgrounds/rocket.png')}}" alt="" class="img-fluid">
            </div>
          </div>
        </div>
      </nav>
      <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
  </aside>