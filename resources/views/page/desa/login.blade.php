@foreach($data as $dt)
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AUTH | {{$dt->nama_profil}}</title>
  <link rel="shortcut icon" type="image/x-generic" href="{{asset('foto')}}/{{$dt->logo}}">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.css">

  <link rel="stylesheet" href="{{asset('template/dist/assets/css/bootstrap.css')}}">
  <link rel="stylesheet" href="{{asset('template/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
  <link rel="stylesheet" href="{{asset('template/dist/assets/css/app.css')}}">
  <link rel="stylesheet" href="{{asset('template/dist/assets/css/pages/auth.css')}}">
  <link rel="stylesheet" href="{{asset('template/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
</head>
<style type="text/css">
  .divider:after,
  .divider:before {
    content: "";
    flex: 1;
    height: 1px;
    background: #eee;
  }
  .h-custom {
    height: calc(100% - 73px);
  }
  @media (min-width: 801px) {
    .col-lg-6{
      border-radius: 25px;box-shadow: 2px 3px;
    }
  }
  @media (max-width: 450px) {
    .h-custom {
      height: calc(100% - 73px);
      /*height: 100%;*/
    }
  }
  .col-lg-6 {
    /*display: flex;*/
    align-items: center;
    justify-content: center;
  }
  #loading {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /*background: rgba(255, 255, 255, 0.8);*/
    z-index: 9999;
    text-align: center;
  }
  @media (min-width: 801px) {
    #loading{
      padding-top: 20%;
    }
  }
  @media (max-width: 800px) {
    #loading{
      padding-top: 80%;
    }
  }
  .lds-spinner {
    color: official;
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
  }
  .lds-spinner div {
    transform-origin: 40px 40px;
    animation: lds-spinner 1.2s linear infinite;
  }
  .lds-spinner div:after {
    content: "";
    display: block;
    position: absolute;
    top: 3px;
    left: 37px;
    width: 6px;
    height: 18px;
    border-radius: 20%;
    background: #000;
  }
  .lds-spinner div:nth-child(1) {
    transform: rotate(0deg);
    animation-delay: -1.1s;
  }
  .lds-spinner div:nth-child(2) {
    transform: rotate(30deg);
    animation-delay: -1s;
  }
  .lds-spinner div:nth-child(3) {
    transform: rotate(60deg);
    animation-delay: -0.9s;
  }
  .lds-spinner div:nth-child(4) {
    transform: rotate(90deg);
    animation-delay: -0.8s;
  }
  .lds-spinner div:nth-child(5) {
    transform: rotate(120deg);
    animation-delay: -0.7s;
  }
  .lds-spinner div:nth-child(6) {
    transform: rotate(150deg);
    animation-delay: -0.6s;
  }
  .lds-spinner div:nth-child(7) {
    transform: rotate(180deg);
    animation-delay: -0.5s;
  }
  .lds-spinner div:nth-child(8) {
    transform: rotate(210deg);
    animation-delay: -0.4s;
  }
  .lds-spinner div:nth-child(9) {
    transform: rotate(240deg);
    animation-delay: -0.3s;
  }
  .lds-spinner div:nth-child(10) {
    transform: rotate(270deg);
    animation-delay: -0.2s;
  }
  .lds-spinner div:nth-child(11) {
    transform: rotate(300deg);
    animation-delay: -0.1s;
  }
  .lds-spinner div:nth-child(12) {
    transform: rotate(330deg);
    animation-delay: 0s;
  }
  @keyframes lds-spinner {
    0% {
      opacity: 1;
    }
    100% {
      opacity: 0;
    }
  </style>
  <body>
    <section class="vh-100">
      <div class="container-fluid h-custom">
        <div id="loading">
          <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div>
        <div class="row d-flex justify-content-center align-items-center h-100">
        <!-- <div class="col-lg-1" id="image">
        </div> -->
        <div class="col-lg-6" style="padding: 3%;" id="pageLogin">
          <form id="loginForm" method="POST" enctype="multipart/form-data">
            @csrf

            @if($dt->logo != NULL)
            <center><img src="{{asset('foto')}}/{{$dt->logo}}" class="" width="120"></center>
            @endif
            <div class="divider d-flex align-items-center my-4">
              <p class="text-center fw-bold mx-3 mb-0">AUTH LOGIN FORM</p>
            </div>
            <p class="text-center">
              AUTH LOGIN {{$dt->nama_profil}}
            </p>
            <div class="form-outline mb-4">
              <input type="email" required="" name="email" id="form3Example3" class="form-control form-control-lg"
              placeholder="Masukkan Email" />
            </div>
            <div class="form-outline mb-3">
              <input type="password" required="" id="password" name="password" class="form-control form-control-lg"
              placeholder="Masukkan Password" />
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <div class="form-check mb-0">
                <input class="form-check-input me-2" checked="" disabled="" type="checkbox" value="" id="form2Example3" />
                <label class="form-check-label" for="form2Example3">
                  Remember me
                </label>
              </div>
              <!-- <a href="javascript:void(0)" class="text-body btn_form_forgot">Lupa password?</a> -->
            </div>
            <div class="text-center text-lg-start mt-4 pt-2">
              <button class="btn btn-primary btn-lg submit_login"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">LOGIN</button>
              <p class="small fw-bold mt-2 pt-1 mb-0">Belum punya Akun? <a href="javascript:void(0)" 
                class="link-danger btn_form_register">Register</a></p>
              </div>
            </form>
            <div class="loading"></div>
          </div>
          @include('page.desa.register')
          @include('page.desa.forgot')
        </div>
      </div>
    </section>
  </body>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="{{asset('template/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('template/dist/assets/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('template/dist/assets/js/main.js')}}"></script>
  <script src="{{asset('template/dist/assets/js/extensions/sweetalert2.js')}}"></script>
  <script src="{{asset('template/dist/assets/vendors/sweetalert2/sweetalert2.all.min.js')}}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @if(session('yes'))
  <script type="text/javascript">
    document.getElementById('success');
    Swal.fire({
      icon: "success",
      title: "Register Berhasil, Silahkan Login",
    });
  </script>
  @endif
  @if(!empty($_GET['utm']))
  <script type="text/javascript">
    $(document).ready(function() {
      $(".btn_form_register").trigger('click');
    });
  </script>
  @endif

  <script type="text/javascript">
   $(function () {
    $('#loginForm').submit(function(e) {
      e.preventDefault();
      let formData = new FormData(this);
      $(".submit_login").html('<div class="spinner-border spinner-border-md" role="status"></div>');
      $(".submit_login").attr('disabled',true);
      $.ajax({
       method: "POST",
       headers: {
        Accept: "application/json"
      },
      contentType: false,
      processData: false,
      url: " {{route('ceklogin')}} ",
      data: formData,
      success: function(response) {
        $(".submit_login").attr('disabled',false);
        $(".submit_login").html('LOGIN');
        if(response.success) {
          window.location=response.url;
        }
        if (response.notmasuk) {
          $(".submit_login").html('LOGIN');
          Swal.fire({
            icon: "error",
            type: "error",
            title: 'Gagal Login',
            text: 'Email/Password tidak sesuai.'
          });
        }
      },
      error: function(response) {
        $(".submit_login").attr('disabled',false);
        $(".submit_login").html('LOGIN');
        Swal.fire({
          icon: "error",
          type: "error",
          title: 'Error',
          text: 'Terjadi Kesalahan [Permintaan data tidak dikirim]'
        });
      }
    });     
    }); 
  }); 
   $(".btn_form_register").click(function() {
    $("#loading").show();
    setTimeout(function() {
      $("#loading").hide();
      $("#pageLogin").hide();
      $("#pageRegister").show();
      $("#registerForm")[0].reset();
    }, 500);
  });
   $(".btn_form_login").click(function() {
    $("#loading").show();
    setTimeout(function() {
      $("#loading").hide();
      $("#pageLogin").show();
      $("#loginForm")[0].reset();
      $("#pageRegister").hide();
      $("#pageForgot").hide();
    }, 500);
  });
   $(".btn_form_forgot").click(function() {
    $("#loading").show();
    setTimeout(function() {
      $("#loading").hide();
      $("#pageLogin").hide();
      $("#pageForgot").show();
      $("#lupaPasswordForm")[0].reset();
    }, 500);
  });
   $(function () {
    $('#lupaPasswordForm').submit(function (e) {
      e.preventDefault();
      $(".submit_forgot").html('<div class="spinner-border spinner-border-md" role="status"></div>').attr('disabled',true);
      let formData = $(this).serializeArray();
      $.ajax({
        method: "POST",
        headers: {
          Accept: "application/json"
        },
        url: "{{route('proses_forgot')}}",
        data: formData,
        success: function (response) {
          $(".submit_forgot").html('KIRIM').attr('disabled',false);
          $("#lupaPasswordForm")[0].reset();
          if (response.status == 'true') {
            Swal.fire({
              icon: "success",
              type: "success",
              title: 'Success',
              text: response.message
            });
          }else if(response.status == 'warning'){
           Swal.fire({
            icon: "warning",
            type: "warning",
            title: 'Email Empty',
            text: response.message
          });
         }else{
          Swal.fire({
            icon: "error",
            type: "error",
            title: 'Error',
            text: 'Terjadi Kesalahan [Permintaan data tidak dikirim]'
          });
        }
      },
      error: function (response) {
        $(".submit_forgot").html('KIRIM').attr('disabled',false);
        Swal.fire({
          icon: "error",
          type: "error",
          title: 'Error',
          text: 'Terjadi Kesalahan [Permintaan data tidak dikirim]'
        });
      }
    });
    });
  });    
</script>
@yield('js')
</html>
@endforeach