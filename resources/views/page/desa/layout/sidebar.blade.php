<div class="app-brand demo">
  <a href="javascript:void(0)" class="app-brand-link">
    <span class="app-brand-logo demo">
      <!-- <img src=""> -->
    </span>
    <?php
    $currentRoute = request()->route()->getName();
    $isDataMaster = false;

    foreach($request as $req) {
      if ($currentRoute == 'prosedur' || $currentRoute == 'waktu_layanan' || $currentRoute == 'data_surat' || route('staff_acc',['id_surat'=>$req->id_surat,'surat'=>$req->singkatan]) == url()->current() || route('staff_cetak',['id_surat'=>$req->id_surat,'surat'=>$req->singkatan]) == url()->current() || route('kepaladesa_acc',['id_surat'=>$req->id_surat,'surat'=>$req->singkatan]) == url()->current() || route('data_request',['id_surat'=>$req->id_surat,'singkatan'=>$req->singkatan]) == url()->current()) {
        $isDataMaster = true;
        break;
      }
    }
    ?>
    <span class="app-brand-text demo menu-text fw-bolder" style="text-transform: uppercase;">{{implode(" ", array_slice(explode(" ", Auth::user()->name),0,2))}}</span>
  </a>

  <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
    <i class="bx bx-chevron-left bx-sm align-middle"></i>
  </a>
</div>

<div class="menu-inner-shadow"></div>

<ul class="menu-inner py-1" id="menu">
  @if(Auth::user()->level=="Admin")
  <li class="menu-header small text-uppercase">
    <span class="menu-header-text">Dashboard</span>
  </li>
  <li class="menu-item {{ (route('dashboard') == url()->current()) ? ' active' : '' }}">
    <a href="{{route('dashboard')}}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-home"></i>
      <div data-i18n="Basic">Dashboard</div>
    </a>
  </li>
  <li class="menu-header small text-uppercase">
    <span class="menu-header-text">Profile</span>
  </li>
  <li class="menu-item {{ (route('profil_desa') == url()->current()) ? ' active' : '' }}">
    <a href="{{route('profil_desa')}}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-building"></i>
      <div data-i18n="Basic">Profile App</div>
    </a>
  </li>
  <li class="menu-header small text-uppercase">
    <span class="menu-header-text">User & Master</span>
  </li>
  <li class="menu-item {{ request()->routeIs('data_user*') ? ' active open' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-user"></i>
      <div data-i18n="Account Settings">Data User</div>
    </a>
    <ul class="menu-sub">
      <li class="menu-item{{ (route('data_user', 'Pengaju') == url()->current()) ? ' active' : '' }}">
        <a href="{{ route('data_user', 'Pengaju') }}" class="menu-link">
          <div data-i18n="Account">Pengaju</div>
        </a>
      </li>
      <li class="menu-item{{ (route('data_user', 'Pengurus') == url()->current()) ? ' active' : '' }}">
        <a href="{{ route('data_user', 'Pengurus') }}" class="menu-link">
          <div data-i18n="Notifications">Pengurus</div>
        </a>
      </li>
    </ul>
  </li>
  <li class="menu-item{{ $isDataMaster ? ' active open' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-briefcase"></i>
      <div data-i18n="Account Settings">Data Master</div>
    </a>
    <ul class="menu-sub">
      <li class="menu-item {{ (route('data_surat') == url()->current()) ? ' active' : '' }}">
        <a href="{{ route('data_surat') }}" class="menu-link">
          <div data-i18n="Account">Surat</div>
        </a>
      </li>
      <li class="menu-item {{ (route('prosedur') == url()->current()) ? ' active' : '' }}">
        <a href="{{ route('prosedur') }}" class="menu-link">
          <div data-i18n="Notifications">Prosedur</div>
        </a>
      </li>
      <li class="menu-item {{ (route('waktu_layanan') == url()->current()) ? ' active' : '' }}">
        <a href="{{ route('waktu_layanan') }}" class="menu-link">
          <div data-i18n="Notifications">Waktu Pelayanan</div>
        </a>
      </li>
    </ul>
  </li>
  @elseif(Auth::user()->level=="Pengaju")
  <li class="menu-header small text-uppercase">
    <span class="menu-header-text">Dashboard</span>
  </li>
  <li class="menu-item {{ request()->routeIs('dashboard_pengaju') ? ' active' : '' }}">
    <a href="{{route('dashboard_pengaju')}}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-home"></i>
      <div data-i18n="Basic">Dashboard</div>
    </a>
  </li>
  <li class="menu-header small text-uppercase">
    <span class="menu-header-text">Pengajuan Saya</span>
  </li>
  <li class="menu-item {{ $isDataMaster && $currentRoute == 'data_request' ? ' active open' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-food-menu"></i>
      <div data-i18n="Account Settings">Data Pengajuan</div>
    </a>
    <ul class="menu-sub">
      @foreach($request as $req)
      <li class="menu-item {{ (route('data_request',['id_surat'=>$req->id_surat,'singkatan'=>$req->singkatan]) == url()->current()) ? ' active' : '' }}">
        <a href="{{route('data_request',['id_surat'=>$req->id_surat,'singkatan'=>$req->singkatan])}}" class="menu-link">
          <div data-i18n="Notifications">{{$req->nama_surat}}</div>
        </a>
      </li>
      @endforeach
    </ul>
  </li>
  @elseif(Auth::user()->level=="Staff")
  <li class="menu-header small text-uppercase">
    <span class="menu-header-text">Dashboard</span>
  </li>
  <li class="menu-item {{ request()->routeIs('dashboard_staff') ? ' active' : '' }}">
    <a href="{{route('dashboard_staff')}}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-home"></i>
      <div data-i18n="Basic">Dashboard</div>
    </a>
  </li>
  <li class="menu-header small text-uppercase">
    <span class="menu-header-text">Pengajuan Surat</span>
  </li>
  <li class="menu-item{{ $isDataMaster && $currentRoute == 'staff_acc' ? ' active open' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-file-find"></i>
      <div data-i18n="Account Settings">Belum Acc</div>
    </a>
    <ul class="menu-sub">
      @foreach($request as $req)
      <li class="menu-item{{ (route('staff_acc',['id_surat'=>$req->id_surat,'surat'=>$req->singkatan]) == url()->current()) ? ' active' : '' }}">
        <a href="{{ route('staff_acc',['id_surat'=>$req->id_surat,'surat'=>$req->singkatan]) }}" class="menu-link">
          <div data-i18n="Notifications">{{ $req->nama_surat }}</div>
        </a>
      </li>
      @endforeach
    </ul>
  </li>
  <li class="menu-item{{ $isDataMaster && $currentRoute == 'staff_cetak' ? ' active open' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-printer"></i>
      <div data-i18n="Account Settings">Cetak Surat</div>
    </a>
    <ul class="menu-sub">
      @foreach($request as $req)
      <li class="menu-item{{ (route('staff_cetak',['id_surat'=>$req->id_surat,'surat'=>$req->singkatan]) == url()->current()) ? ' active' : '' }}">
        <a href="{{route('staff_cetak',['id_surat'=>$req->id_surat,'surat'=>$req->singkatan])}}" class="menu-link">
          <div data-i18n="Notifications">{{$req->nama_surat}}</div>
        </a>
      </li>
      @endforeach
    </ul>
  </li>
  <li class="menu-item {{ request()->routeIs('surat_selesai') ? ' active' : '' }}">
    <a href="{{route('surat_selesai')}}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-archive"></i>
      <div data-i18n="Basic">Surat Selesai</div>
    </a>
  </li>
  <li class="menu-header small text-uppercase">
    <span class="menu-header-text">Laporan</span>
  </li>
  <li class="menu-item {{ request()->routeIs('laporan') ? ' active' : '' }}">
    <a href="{{route('laporan')}}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-file"></i>
      <div data-i18n="Basic">Laporan</div>
    </a>
  </li>
  @elseif(Auth::user()->level=="Dekan")
  <li class="menu-header small text-uppercase">
    <span class="menu-header-text">Dashboard</span>
  </li>
  <li class="menu-item {{ request()->routeIs('dashboard_kepaladesa') ? ' active' : '' }}">
    <a href="{{route('dashboard_kepaladesa')}}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-home"></i>
      <div data-i18n="Basic">Dashboard</div>
    </a>
  </li>
  <li class="menu-header small text-uppercase">
    <span class="menu-header-text">Pengajuan Surat</span>
  </li>
  <li class="menu-item {{ $isDataMaster && $currentRoute == 'kepaladesa_acc' ? ' active open' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-check"></i>
      <div data-i18n="Account Settings">ACC dan TTD</div>
    </a>
    <ul class="menu-sub">
      @foreach($request as $req)
      <li class="menu-item {{ (route('kepaladesa_acc',['id_surat'=>$req->id_surat,'surat'=>$req->singkatan]) == url()->current()) ? ' active' : '' }}">
        <a href="{{route('kepaladesa_acc',['id_surat'=>$req->id_surat,'surat'=>$req->singkatan])}}" class="menu-link">
          <div data-i18n="Notifications">{{$req->nama_surat}}</div>
        </a>
      </li>
      @endforeach
    </ul>
  </li>
  @endif
    </ul>