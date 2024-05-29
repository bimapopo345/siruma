<div class="modal fade" id="modal_form_user" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content" style="border-bottom:1px solid blue;">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33"></h4>
                <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form method="post" id="userForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <label>EMAIL <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="text" id="id" name="id" hidden="">
                                <input type="email" id="email" name="email" value=""
                                class="form-control">
                                <span class="invalid-feedback" role="alert" id="emailError">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <input type="" hidden="" id="role" name="role" value="{{$level}}">
                            <label>PASSWORD <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="password" id="password" name="password" value=""
                                class="form-control">
                                <span class="invalid-feedback" role="alert" id="passwordError">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>NAME <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="text" id="name" name="name" value=""
                                class="form-control">
                                <span class="invalid-feedback" role="alert" id="nameError">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            @if($level == 'Pengaju')
                            <label>PROGRAM STUDI <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan">
                                <span class="invalid-feedback" role="alert" id="pekerjaanError">
                                    <strong></strong>
                                </span>
                            </div>
                            @else
                            <label>ROLE <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <select class="form-control" id="level" name="level">
                                    <option value="">-- PILIH JABATAN --</option>
                                    <option value="Staff">Staff</option>
                                    <option value="Dekan">Dekan/Wakil Dekan</option>
                                </select>
                                <span class="invalid-feedback" role="alert" id="levelError">
                                    <strong></strong>
                                </span>
                            </div>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <label>PONSEL <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="number" id="telepon" name="telepon" value="" 
                                class="form-control">
                                <span class="invalid-feedback" role="alert" id="teleponError">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>
                                @if($level == 'Pengaju')
                                NIM
                                @else
                                NIP
                                @endif
                                <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="number" name="nik" value="" id="nik" 
                                    class="form-control">
                                    <span class="invalid-feedback" role="alert" id="nikError">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>AGAMA <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" id="agama" name="agama" value=""
                                    class="form-control">
                                    <span class="invalid-feedback" role="alert" id="agamaError">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>TEMPAT LAHIR <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" id="tempat" name="tempat"
                                    class="form-control">
                                    <span class="invalid-feedback" role="alert" id="tempatError">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>JENIS KELAMIN <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                        <option value="">-- PILIH JENIS KELAMIN --</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    <span class="invalid-feedback" role="alert" id="jenis_kelaminError">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>TANGGAL LAHIR <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="date" id="tgl_lahir" name="tgl_lahir" value=""
                                    class="form-control">
                                    <span class="invalid-feedback" role="alert" id="tgl_lahirError">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>FOTO PROFIL</label>
                                    <input type="file" class="form-control" name="foto" id="foto">
                                    <input type="text" hidden="" id="fotoLama" name="fotoLama">
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <label>ALAMAT <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <textarea class="form-control" id="alamat" rows="4" name="alamat"></textarea>
                                    <span class="invalid-feedback" role="alert" id="alamatError">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-loading" id="modal-loading" style="display: none;">
                        <span class="fa fa-circle-o-notch fa-pulse fa-3x"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary"
                        data-bs-dismiss="modal">
                        <span class="">Tutup</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">
                        <i class="bx bx-save"></i>
                        <span class="">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>