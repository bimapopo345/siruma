<!DOCTYPE html>
<html
lang="en"
class="light-style layout-menu-fixed"
dir="ltr"
data-theme="theme-default"
data-template="vertical-menu-template-free"
>
<?php 
date_default_timezone_set('Asia/Jakarta');
$logodesa = App\Models\Village::getDesa();
$tanggal_live = date('Y-m-d');
?>
<head>
  <meta charset="utf-8" />
  <meta
  name="viewport"
  content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
  />
  <meta property="og:image" content="{{asset('foto')}}/{{$logodesa->logo}}">
  <title>@yield('title') | {{$logodesa->nama_profil}}</title>
  <link rel="shortcut icon" type="image/x-generic" href="{{asset('foto')}}/{{$logodesa->logo}}">

  <meta name="description" content="" />

  <!-- Favicon -->

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
  href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
  rel="stylesheet"
  />
  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="{{asset('template_new/assets/vendor/fonts/boxicons.css')}}" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{asset('template_new/assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{asset('template_new/assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{asset('template_new/assets/css/demo.css')}}" />
  <link rel="stylesheet" href="{{asset('template/dist/assets/vendors/simple-datatables/style.css')}}">

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{asset('template_new/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

  <!-- <link rel="stylesheet" href="{{asset('template_new/assets/vendor/libs/apex-charts/apex-charts.css')}}" /> -->
  <link rel="stylesheet" href="{{asset('custom.css')}}" />
  <link rel="stylesheet" href="{{asset('foto.css')}}" />
  <!-- Helpers -->
  <script src="{{asset('template_new/assets/vendor/js/helpers.js')}}"></script>
  <script src="{{asset('template_new/assets/js/config.js')}}"></script>
  <script src="{{asset('canva.js')}}"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript" 
  src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <link type="text/css" 
  href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/southstreet/jquery-ui.css" rel="stylesheet">
  <script type="text/javascript" 
  src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"> 
</script>
<script type="text/javascript" src="https://keith-wood.name/js/jquery.signature.js"> 
</script>

<link rel="stylesheet" type="text/css" href="https://keith- 
wood.name/css/jquery.signature.css">
</head>
@yield('css')
<body>
  <div itemprop="image" itemscope="itemscope" itemtype="https://schema.org/ImageObject">
    <meta content="{{asset('foto')}}/{{$logodesa->logo}}" itemprop="url"/> </div>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <?php 
        $request=DB::table('surat')->where('template_id','!=',NULL)->get();
        $logoutuser=DB::table('users')->get();
        $userporfil=DB::table('info_lengkap')->where('user_id',Auth::user()->id)->get();
        ?>
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          @include('page/desa/layout/sidebar')
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
          class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
          id="layout-navbar"
          >
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
              <div class="nav-item d-flex align-items-center" style="font-family: Times New Roman;text-align: center;font-weight: bold;">
                @if($logodesa->logo != NULL)
                <img src="{{asset('foto')}}/{{$logodesa->logo}}" width="40" height="40">
                @endif
                <!-- <marquee>
                 {{$logodesa->nama_profil}}
                 {{tanggal_indonesia($tanggal_live)}} <span id="clock"></span>
               </marquee> -->
             </div>
           </div>
           <!-- /Search -->

           <ul class="navbar-nav flex-row align-items-center ms-auto" style="text-align: left;">
            <!-- Place this tag where you want the button to render. -->
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
              <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                  @include('page/desa/layout/foto-header')
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item" href="javascript:void(0)">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar avatar-online">
                          @include('page/desa/layout/foto-header')
                          <!-- <img src="{{asset('template_new/assets/img/avatars/1.png')}}" alt class="w-px-40 h-auto rounded-circle" /> -->
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <span class="fw-semibold d-block">{{Auth::user()->name}}</span>
                        <small class="text-muted">{{Auth::user()->level}}</small>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <div class="dropdown-divider"></div>
                </li>
                <li>
                  <li>
                    <a class="dropdown-item" href="{{route('profil_pengaju')}}">
                      <i class="bx bx-user me-2"></i>
                      <span class="align-middle">My Profile</span>
                    </a>
                  </li>
                  <div class="dropdown-divider"></div>
                </li>
                <li>
                  @if(Auth::user()->level == 'Admin')
                  <a class="dropdown-item" href="{{route('logout',['page'=>'true'])}}">
                    @else
                    <a class="dropdown-item" href="{{route('logout')}}">
                      @endif
                      <i class="bx bx-power-off me-2"></i>
                      <span class="align-middle">Log Out</span>
                    </a>
                  </li>
                </ul>
              </li>
              <!--/ User -->
            </ul>
          </div>
        </nav>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              <div class="col-lg-12 mb-4 order-0">
                @yield('content')
              </div>
            </div>
          </div>
          <!-- / Content -->

          <!-- Footer -->
          <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
              <div class="mb-2 mb-md-0">
                ©
                <script>
                  document.write(new Date().getFullYear());
                </script>
                by 
                <a href="" target="_blank" class="footer-link fw-bolder">{{$logodesa->nama_profil}}</a>
              </div>
           <!--  <div>
              <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
              <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

              <a
              href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
              target="_blank"
              class="footer-link me-4"
              >Documentation</a
              >

              <a
              href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
              target="_blank"
              class="footer-link me-4"
              >Support</a
              >
            </div> -->
          </div>
        </footer>
        <!-- / Footer -->

        <div class="content-backdrop fade"></div>
      </div>
      <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
  </div>

  <!-- Overlay -->
  <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->

<!-- <div class="buy-now">
  <a
  href="https://wa.me/6285748275403"
  target="_blank"
  class="btn btn-success btn-buy-now"
  ><i class="bx bxl-whatsapp"></i>WhatsApp Only</a
  >
</div> -->

<!-- <script src="{{asset('template_new/assets/vendor/libs/jquery/jquery.js')}}"></script> -->
<script src="{{asset('template_new/assets/vendor/libs/popper/popper.js')}}"></script>
<script src="{{asset('template_new/assets/vendor/js/bootstrap.js')}}"></script>
<script src="{{asset('template_new/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

<script src="{{asset('template_new/assets/vendor/js/menu.js')}}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<!-- <script src="{{asset('template_new/assets/vendor/libs/apex-charts/apexcharts.js')}}"></script> -->

<!-- Main JS -->
<script src="{{asset('template_new/assets/js/main.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
<!-- Page JS -->
<!-- <script src="{{asset('template_new/assets/js/dashboards-analytics.js')}}"></script> -->
<!-- <script src="{{asset('template_new/assets/js/ui-modals.js')}}"></script> -->

<!-- Place this tag in your head or just before your close body tag. -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script> -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
</body>
<script type="text/javascript">
  $("#table1").DataTable();
</script>
<!-- <script type="text/javascript">
  var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
  $('#clear').click(function(e) {
    e.preventDefault();
    sig.signature('clear');
    $("#signature64").val('');
  });
</script> -->
<script>
  function updateClock() {
    var currentTime = new Date();
    var hours = currentTime.getHours();
    var minutes = currentTime.getMinutes();
    var seconds = currentTime.getSeconds();
    hours = (hours < 10 ? "0" : "") + hours;
    minutes = (minutes < 10 ? "0" : "") + minutes;
    seconds = (seconds < 10 ? "0" : "") + seconds;

    var timeString = hours + ":" + minutes + ":" + seconds;
    document.getElementById("clock").innerText = timeString;
  }
  setInterval(updateClock, 1000);
  window.onload = updateClock;
</script>
<!-- <script type="text/javascript">
  $(document).ready(function() {
    $("#copy").hide();
    $("#add-more").click(function(){ 
      var html = $("#copy").html();
      $("#after-add-more").after(html);
    });
    $("body").on("click","#remove",function(){ 
      $(this).parents("#control-group").remove();
    });
  });
</script> -->
<script>
  function readURL(input) {
    if (input.files && input.files[0]) {

      var reader = new FileReader();

      reader.onload = function(e) {
        $('.image-upload-wrap').hide();

        $('.file-upload-image').attr('src', e.target.result);
        $('.file-upload-content').show();

        $('.image-title').html(input.files[0].name);
      };

      reader.readAsDataURL(input.files[0]);

    } else {
      removeUpload();
    }
  }

  function removeUpload() {
    $('.file-upload-input').replaceWith($('.file-upload-input').clone());
    $('.file-upload-content').hide();
    $('.image-upload-wrap').show();
  }
  $('.image-upload-wrap').bind('dragover', function () {
    $('.image-upload-wrap').addClass('image-dropping');
  });
  $('.image-upload-wrap').bind('dragleave', function () {
    $('.image-upload-wrap').removeClass('image-dropping');
  });
</script>
<script type="text/javascript">
  function show_loading() {
    var elemenModalLoading = document.getElementsByClassName('modal-loading');
    var ModalBody = document.getElementsByClassName('modal-body');
    for (var i = 0; i < elemenModalLoading.length; i++) {
      elemenModalLoading[i].style.display = "block";
    }
    for (var i = 0; i < ModalBody.length; i++) {
      ModalBody[i].style.pointerEvents = "none";
      ModalBody[i].style.background = 'white';
      ModalBody[i].style.opacity = '0.4';
    }
  }
  function hide_loading() {
    var elemenModalLoading = document.getElementsByClassName('modal-loading');
    var ModalBody = document.getElementsByClassName('modal-body');
    for (var i = 0; i < elemenModalLoading.length; i++) {
      elemenModalLoading[i].style.display = "none";
    }
    for (var i = 0; i < ModalBody.length; i++) {
      ModalBody[i].style.pointerEvents = "auto";
      ModalBody[i].style.background = "transparent";
      ModalBody[i].style.opacity = '1';
    }
  }
</script>
<script type="text/javascript">
 $(document).ready(function() {
    // Mendapatkan URL saat ini
    var currentUrl = window.location.href;

    // Menemukan elemen yang sesuai dengan URL
    var activeLink = $("ul#menu a").filter(function() {
      return this.href == currentUrl;
    });

    // Menambahkan kelas 'active' pada elemen yang sesuai
    activeLink.addClass("active");

    // Menambahkan kelas 'active' pada parent elemen (li) jika ada
    activeLink.parents("li").addClass("active");

    // Menambahkan kelas 'in' pada parent elemen (ul) dari submenu
    activeLink.parents("ul.menu-sub").addClass("in");

    // Menambahkan kelas 'active' pada parent elemen (li) dari submenu
    activeLink.parents("li.menu-item").addClass("active");

    // Membuka submenu yang sesuai dengan hierarki
    activeLink.parents("ul.menu-sub").slideDown();
  });
</script>
@include('page/desa/layout/notif')
@yield('scripts')
</html>