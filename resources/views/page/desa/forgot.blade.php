            <div class="col-lg-6" style="padding: 3%;display: none;" id="pageForgot">
              <form id="lupaPasswordForm" method="POST">
                @csrf

                @if($dt->logo != NULL)
                <center><img src="{{asset('foto')}}/{{$dt->logo}}" class="" width="120"></center>
                @endif
                <div class="divider d-flex align-items-center my-4">
                  <p class="text-center fw-bold mx-3 mb-0">FORGOT PASSWORD FORM</p>
                </div>
                <p class="text-center">
                  KANTOR DESA {{$dt->name_village}} KECAMATAN {{$dt->name_district}} {{$dt->name_city}}
                </p>
                <div class="form-outline">
                  <input type="email" required="" name="email" id="emai" class="form-control form-control-lg"
                  placeholder="Masukkan Email Anda ..." />
                </div>
                <div class="text-center text-lg-start mt-4 pt-2">
                  <button class="btn btn-primary btn-lg submit_forgot"
                  style="padding-left: 2.5rem; padding-right: 2.5rem;">KIRIM</button>
                  <p class="small fw-bold mt-2 pt-1 mb-0">Kembali ke Login? <a href="javascript:void(0)" 
                    class="link-danger btn_form_login">Login</a></p>
                  </div>
                </form>
                <div class="loading"></div>
              </div>