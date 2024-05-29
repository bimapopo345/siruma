            <div class="col-lg-6" style="padding: 3%;display: none;" id="pageRegister">
                <form id="registerForm" method="POST">
                    @csrf
                    @if($dt->logo != NULL)
                    <center><img src="{{asset('foto')}}/{{$dt->logo}}" class="" width="120"></center>
                    @endif
                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center fw-bold mx-3 mb-0">AUTH REGISTER FORM</p>
                    </div>
                    <p class="text-center">
                        KANTOR DESA {{$dt->name_village}} KECAMATAN {{$dt->name_district}} {{$dt->name_city}}
                    </p>
                    <div class="form-outline mb-4">
                        <input type="text" required="" name="name" id="form3Example3" class="form-control form-control-lg"
                        placeholder="Nama " />
                    </div>
                    <div class="form-outline mb-4">
                        <input type="email" required="" name="email" id="form3Example3" class="form-control form-control-lg"
                        placeholder="Email" />
                    </div>
                    <div class="form-outline mb-3">
                        <input type="password" required="" id="password" name="password" class="form-control form-control-lg"
                        placeholder="Password" />
                    </div>
                    <div class="form-outline mb-3">
                        <input type="password" id="confirm" required="" name="confirm" class="form-control form-control-lg"
                        placeholder="Konfirmasi Password" />
                    </div>
                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button class="btn btn-primary btn-lg submit_register"
                        style="padding-left: 2.5rem; padding-right: 2.5rem;">DAFTAR</button>
                        <p class="small fw-bold mt-2 pt-1 mb-0">Sudah punya Akun? <a href="javascript:void(0)" 
                            class="link-danger btn_form_login">Login</a></p>
                        </div>
                    </form>
                    <div class="loading"></div>
                </div>

                @section('js')
                <script type="text/javascript">
                    $(function () {
                        $('#registerForm').submit(function(e) {
                            e.preventDefault();
                            let formData = new FormData(this);
                            $(".submit_register").html('<div class="spinner-border spinner-border-md" role="status"></div>').attr('disabled',true);
                            $.ajax({
                                method: "POST",
                                headers: {
                                    Accept: "application/json"
                                },
                                contentType: false,
                                processData: false,
                                url: " {{route('daftar')}} ",
                                data: formData,
                                success: function (response) {
                                    $(".submit_register").html('DAFTAR').attr('disabled',false);
                                    if (response.status == 'true') {
                                        $("#registerForm")[0].reset();
                                        Swal.fire({
                                            icon: 'success',
                                            type: 'success',
                                            title: 'Success',
                                            text: response.message
                                        });
                                        $(".btn_form_login").trigger('click');
                                    }else if(response.status == 'warning'){
                                        Swal.fire({
                                            icon: 'warning',
                                            type: 'warning',
                                            title: 'Warning',
                                            text: response.message
                                        });
                                    }else {
                                        Swal.fire({
                                            icon: 'error',
                                            type: 'error',
                                            title: 'Gagal',
                                            dangerMode: true,
                                            text: response.message
                                        });
                                    }
                                },
                                error: function (response) {
                                    $(".submit_register").html('DAFTAR').attr('disabled',false);
                                    swal({
                                        icon: 'error',
                                        type: 'error',
                                        title: 'Gagal',
                                        dangerMode: true,
                                        text: response.message
                                    });
                                }
                            });
                        });
                    });
                </script>
                @endsection