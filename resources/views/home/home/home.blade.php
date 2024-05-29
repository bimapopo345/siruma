@foreach($data as $dt)
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta property="og:image" content="{{asset('foto')}}/{{$dt->logo}}">
  <title>{{$dt->nama_profil}}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link rel="shortcut icon" type="image/x-generic" href="{{asset('foto')}}/{{$dt->logo}}">
  <!-- Favicons -->
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('green/assets/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('green/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('green/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('green/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('green/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('green/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">    

  <!-- Template Main CSS File -->
  <link href="{{asset('green/assets/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('green/assets/css/styletwo.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<style type="text/css">
  @media only screen and (max-width: 600px) {
    /* Styles for screens with a maximum width of 600px */
    #button_web{display: none;}

  }

  @media only screen and (min-width: 601px) {
    #button_mobile{display: none;}

  }

  #drop:hover{
    color: #f73859;
  }
  #preloader {
    height: 100%;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 99999999999;
    background: #fff; 
  }

  .loader {
    position: absolute;
    width: 10rem;
    height: 10rem;
    top: 50%;
    margin: 0 auto;
    left: 0;
    right: 0;
    transform: translateY(-50%); 
  }
  .popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 999;
    display: none;
  }

  .popup {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: #fff;
    transform: translateY(100%);
    transition: transform 0.3s ease-in-out;
    border-top-right-radius: 25px;
    border-top-left-radius: 25px;
    z-index: 1000;
  }

  .popup.open {
    transform: translateY(0);
  }

  .popup-content {
    padding: 20px;
    border-top-right-radius: 10px;
    border-top-left-radius: 10px;
  }

  .close-btn {
    background-color: #ccc;
    padding: 8px 12px;
    border-radius: 4px;
    border: none;
    cursor: pointer;
  }

  .close-btn:hover {
    background-color: #999;
  }

</style>
<?php  
$surat=DB::table('surat')->orderBy(DB::RAW('RAND()'))->get();
$layanan=DB::table('layanan')->first();
$prosedur=DB::table('prosedur')->get();
?>
<body>
  <div itemprop="image" itemscope="itemscope" itemtype="http://schema.org/ImageObject">
    <meta content="{{asset('foto')}}/{{$dt->logo}}" itemprop="url"/> </div>

    <div id="preloader">
      <div class="loader">
        <center>
          @if($dt->logo != NULL)
          <img src="{{asset('foto')}}/{{$dt->logo}}" width="60">
          @else
          Masukkan Logo<br>Desa Anda
          @endif
        </center>
      </div>
    </div>

    <!-- <section id="topbar" class="d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope-fill"></i><a href="mailto:{{$dt->email_desa}}">{{$dt->email_desa}}</a>
        </div>
      </div>
    </section> -->
    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
      <div class="container d-flex align-items-center">

        <!-- <h1 class="logo me-auto"></h1> -->
        <h1 class="logo me-auto text-center">
          <a href="" style="color: #435ebe;" class="text">
            @if($dt->logo != NULL)
            <img src="{{asset('foto')}}/{{$dt->logo}}">
            @endif
            {{$dt->nama_profil}}
          </a>
        </h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo me-auto"><img src="{{asset('green/assets/img/logo.png')}}" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar">
          <ul>
            <li><a class="nav-link scrollto active" href="#hero">Beranda</a></li>
            <li><a class="nav-link scrollto" href="#services">Layanan</a></li>
            <li><a class="nav-link scrollto" href="#about">Surat & Prosedur</a></li>
            <!-- <li><a class="nav-link scrollto" href="#featured-services">Waktu Pelayanan</a></li> -->
            <li><a class="nav-link scrollto" href="#contact">Kontak</a></li>
            @if(Auth::user())
            <li class="dropdown"><a href="#"><span>{{Auth::user()->name}}</span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                @if(Auth::user()->level=="Desa")
                <li><a href="{{route('profil_desa')}}" id="drop">Profil</a></li>
                @else
                <li><a href="{{route('profil_pengaju')}}" id="drop">Profil</a></li>
                @endif
                <li><a href="{{route('logout')}}" id="drop">Logout</a></li>
              </ul>
            </li>
            @else
            <!-- <li><a class="getstarted scrollto" href="{{route('login')}}">LOGIN</a></li> -->
            @endif
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

      </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero">
      <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">


        <div class="carousel-inner" role="listbox">

          <!-- Slide 1 -->
          <div class="carousel-item active">
            <div class="carousel-container">
              <div class="container-fluid">
                <div class="row">
                <div class="col-lg-6">
                  <h2 class="animate__animated animate__fadeInDown">{{$dt->nama_profil}}</h2>
                  <p class="animate__animated animate__fadeInUp">
                    Platform inovatif yang dirancang untuk memudahkan proses pengajuan surat bagi mahasiswa. Aplikasi ini menawarkan solusi yang efisien dan berintegrasi untuk administratif mahasiswa.
                  </p>
                  <a href="{{route('login',['utm'=>'daftar'])}}" class="btn-get-started animate__animated animate__fadeInUp scrollto">Daftar</a>
                  <a href="{{route('login')}}" class="btn-get-started animate__animated animate__fadeInUp scrollto">Login</a>
                </div>
                <div class="col-lg-6 text-right">
                  <img src="{{asset('logosurat.png')}}" style="background-size: 100% 100%;width: 100%;">
                </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Slide 2 -->

        </div>

      </div>
    </section><!-- End Hero -->

    <main id="main">
      <section id="services" class="services">
        <div class="container">

          <div class="section-title">
            <h2>Layanan Kami</h2>
            <h5>{{$dt->nama_profil}} hadir menjadi solusi bagi kamu</h5>
          </div>

          <div class="row">
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
              <div class="icon-box iconbox-blue text-white" style="background: #f73859;">
                <div class="icon" style="background: white;border-radius: 50%;">
                  <i class="bx bx-layer"></i>
                </div>
                <h4 class="text-white"><a href="" class="text-white">Formulir Pengajuan</a></h4>
                <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
              <div class="icon-box iconbox-blue text-white" style="background: #f73859;">
                <div class="icon" style="background: white;border-radius: 50%;">
                  <i class="bx bx-layer"></i>
                </div>
                <h4 class="text-white"><a href="" class="text-white">Informasi Proses</a></h4>
                <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
              <div class="icon-box iconbox-blue text-white" style="background: #f73859;">
                <div class="icon" style="background: white;border-radius: 50%;">
                  <i class="bx bx-layer"></i>
                </div>
                <h4 class="text-white"><a href="" class="text-white">Keuntungan</a></h4>
                <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
              </div>
            </div>

          </div>

        </div>
      </section><!-- End Services Section -->
      <!-- ======= Featured Services Section ======= -->

      <!-- ======= About Us Section ======= -->
      <section id="about" class="about">
        <div class="container-fluid">



          <div class="row">
            <div class="col-lg-12">

              <div class="section-title">
                <h2>Surat & Prosedur</h2>
                <!-- <p>Prosedur Registrasi dan Pengajuan/Permohonan Surat</p> -->
              </div>

              <div class="row">
                <div class="col-lg-6 pt-4 content text-white" style="background: #f73859;">
                  Kami menyediakan layanan surat sebagai berikut:
                  <ol start="1" class="mt-3">
                    @foreach($surat as $srt)
                    <li>{{$srt->nama_surat}}</li>
                    @endforeach
                  </ol>
                </div>
                <div class="col-lg-6 pt-4 content text-white" style="background: linear-gradient(90deg,#2d499d,#3f5491);">
                  Panduan prosedur pengajuan:
                  <ol class="mt-3" start="1">
                    @foreach($prosedur as $prd)
                    <?php
                    $array = explode(PHP_EOL, $prd->prosedur);
                    $total = count($array);
                    foreach($array as $item) {
                     echo "<li>".$item;"</li>";
                   }
                   ?>
                   @endforeach
                 </ol>
               </div>
             </div>

           </div>

         </div>

       </div>
     </section><!-- End About Us Section -->

     <!-- ======= Contact Section ======= -->
     <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Kontak</h2>
          <!-- <p>Kontak Kami</p> -->
        </div>

        <div class="row">

          <div class="col-xl-12 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Alamat:</h4>
                <p>
                  <?php
                  $array = explode(PHP_EOL, $dt->lokasi_desa);
                  $total = count($array);
                  foreach($array as $item) {
                    echo "<span>". $item . "</span><br>";
                  }
                  ?>
                </p>
              </div>
              <div class="address">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>
                  {{$dt->email_desa}}
                </p>
              </div>
              <div class="address">
                <i class="bi bi-phone"></i>
                <h4>Telepon:</h4>
                <p>
                  {{$dt->telepon_desa}}
                </p>
              </div>
              @if(!empty($layanan))
               <div class="address">
                <i class="bi bi-clock"></i>
                <h4>Waktu Layanan:</h4>
                <p>
                  <b>{{$layanan->hari}}</b><br>{{$layanan->waktu}} - {{$layanan->sampai}}
                </p>
              </div>
              @endif

              <iframe class="form-control"  height="290" style="width: 100%;" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=720&amp;height=600&amp;hl=en&amp;q={{$dt->lokasi_desa}}+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
            </div>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <footer id="footer" class="footer">

    <div class="footer-top">
      <div class="container">
        <h3>{{$dt->nama_profil}}</h3>
        <div class="row gy-4">

          <div class="col-lg-4 footer-links">
            <h4>Pengajuan</h4>
            - Register/Buat akun <br>
            - Login <br>
            - Membuat Surat <br>
            - Unduh Surat
          </div>

          <div class="col-lg-4 footer-links">
            <h4>Kontak Kami</h4>
            Email : {{$dt->email_desa}} <br>
            Telepon : {{$dt->telepon_desa}} 
          </div>

          <div class="col-lg-4 footer-contact text-center text-md-start">
            <h4>Alamat</h4>
            <p>
              {{$dt->lokasi_desa}}
            </p>

          </div>
          <div class="container-fluid">
            <div class="row border-top justify-content-center align-content-center pt-4">
              <div class="col-auto text-gray-500 font-weight-light">
                2024 {{$dt->nama_profil}} • All rights reserved • By Sekolah Vokasi<a href="" class="text text-primary"></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </footer>

  <!-- <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> -->

  <!-- Vendor JS Files -->
  <script src="{{asset('green/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('green/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('green/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('green/assets/vendor/php-email-form/validate.js')}}"></script>
  <!--<script src="{{asset('green/assets/js/not.js')}}"></script>-->
  <!--<script src="{{asset('green/assets/js/disabledi.js')}}"></script>-->
  <script src="{{asset('green/assets/js/default.js')}}"></script>
  <script src="{{asset('green/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('template/dist/assets/js/extensions/sweetalert2.js')}}"></script>
  <script src="{{asset('template/dist/assets/vendors/sweetalert2/sweetalert2.all.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- Template Main JS File -->
  <script src="{{asset('green/assets/js/main.js')}}"></script>
  <script type="text/javascript">
    // let id = $(this).attr("more_id");

    document.addEventListener("DOMContentLoaded", function() {
      var openBtn = document.getElementsByClassName("popup-trigger");
      var closeBtn = document.querySelector(".close-btn");

      // for (var i = 0; i < openBtn.length; i++) {
        $(".popup-trigger").click(function() {
          let id_open = $(this).attr("more_id_open");
        // openBtn[i].addEventListener("click", function() {
          var popupOverlay = document.getElementById("popup-overlay-"+id_open);
          var popup = document.getElementById("popup-"+id_open);
          // alert(id)
          popupOverlay.style.display = "block";
          setTimeout(function() {
            popup.classList.add("open");
          }, 100);
        });
        $(".close-btn").click(function() {
          let id_close = $(this).attr("more_id_close");
        // closeBtn.addEventListener("click", function() {
          var popupOverlay = document.getElementById("popup-overlay-"+id_close);
          var popup = document.getElementById("popup-"+id_close);

          popup.classList.remove("open");
          setTimeout(function() {
            popupOverlay.style.display = "none";
          }, 300);
        });
      // }

    });


  </script>
</body>
<script type="text/javascript">
  jQuery(window).on("load", function() {
    $('#preloader').fadeOut(500);
    $('#main-wrapper').addClass('show');

    $('body').attr('data-sidebar-style') === "mini" ? $(".hamburger").addClass('is-active') : $(".hamburger").removeClass('is-active')
  });
</script>
</html>
@endforeach