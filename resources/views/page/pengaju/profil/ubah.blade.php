            <div class="modal fade" data-bs-backdrop="static" id="modal_form_profil" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable"
                role="document">
                <div class="modal-content" style="border-bottom:1px solid blue;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1"></h5>
                        <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="profilForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <label>EMAIL:</label>
                                    <div class="form-group">
                                        <input type="email" id="email" value="{{$cst->email}}" name="email"
                                        class="form-control">
                                        <span class="invalid-feedback" role="alert" id="emailError">
                                            <strong></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>NAME:</label>
                                    <div class="form-group">
                                        <input type="text" id="name" value="{{$cst->name}}" name="name"
                                        class="form-control">
                                        <span class="invalid-feedback" role="alert" id="nameError">
                                            <strong></strong>
                                        </span>
                                    </div>
                                </div>
                                @if(Auth::user()->level == "Pengaju")
                                <div class="col-lg-6">
                                    <label>PROGRAM STUDI:</label>
                                    <div class="form-group">
                                        <input type="text" id="pekerjaan" value="{{$cst->pekerjaan}}" name="pekerjaan"
                                        class="form-control">
                                        <span class="invalid-feedback" role="alert" id="pekerjaanError">
                                            <strong></strong>
                                        </span>
                                    </div>
                                </div>
                                @else
                                <div class="col-lg-6">
                                    <label>ROLE:</label>
                                    <div class="form-group">
                                        <select class="form-control" disabled="" id="level" name="level">
                                            <option <?php if($cst->level=="Staff"){echo "selected";} ?> value="Staff">Staff</option>
                                            <option <?php if($cst->level=="Kepala Desa"){echo "selected";} ?> value="Kepala Desa">Kepala Desa</option>
                                            <option <?php if($cst->level=="Desa"){echo "selected";} ?> value="Desa">Admin Desa</option>
                                        </select>
                                        <span class="invalid-feedback" role="alert" id="levelError">
                                            <strong></strong>
                                        </span>
                                    </div>
                                </div>

                                @endif
                                <div class="col-lg-6">
                                    <label>PONSEL:</label>
                                    <div class="form-group">
                                        <input type="number" id="telepon" value="{{$cst->telepon}}" name="telepon" 
                                        class="form-control">
                                        <span class="invalid-feedback" role="alert" id="teleponError">
                                            <strong></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>
                                        @if($cst->level == 'Pengaju')
                                        NIM:
                                        @else
                                        NIP:
                                        @endif
                                    </label>
                                    <div class="form-group">
                                        <input type="number" id="nik" name="nik" value="{{$cst->nik}}"
                                        class="form-control">
                                        <span class="invalid-feedback" role="alert" id="nikError">
                                            <strong></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>AGAMA:</label>
                                    <div class="form-group">
                                        <input type="text" id="agama" name="agama" value="{{$cst->agama}}"
                                        class="form-control">
                                        <span class="invalid-feedback" role="alert" id="agamaError">
                                            <strong></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>TEMPAT LAHIR:</label>
                                    <div class="form-group">
                                        <input type="text" id="tempat" name="tempat" value="{{$cst->tempat}}"
                                        class="form-control">
                                        <span class="invalid-feedback" role="alert" id="tempatError">
                                            <strong></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>JENIS KELAMIN:</label>
                                    <div class="form-group">
                                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                            <option <?php if($cst->jenis_kelamin=="Laki-Laki"){echo "selected";} ?> value="Laki-Laki">Laki-Laki</option>
                                            <option <?php if($cst->jenis_kelamin=="Perempuan"){echo "selected";} ?> value="Perempuan">Perempuan</option>
                                        </select>
                                        <span class="invalid-feedback" role="alert" id="jenis_kelaminError">
                                            <strong></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>TANGGAL LAHIR:</label>
                                    <div class="form-group">
                                        <input type="date" name="tgl_lahir" id="tgl_lahir" value="{{$cst->tgl_lahir}}"
                                        class="form-control">
                                        <span class="invalid-feedback" role="alert" id="tgl_lahirError">
                                            <strong></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <label>FOTO PROFIL:</label>
                                    <div class="form-group">
                                        <input type="file" name="foto"
                                        class="form-control">
                                        <input type="text" hidden="" value="{{$cst->foto_profil}}" name="fotoLama">
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <label>ALAMAT: </label>
                                    <div class="form-group">
                                        <textarea class="form-control" id="alamat" rows="4" name="alamat">{{$cst->alamat}}</textarea>
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
                            <span>Tutup</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                            <span><i class="fa fa-save"></i> Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>