            <div class="modal fade text-left" id="modal_form_profil" data-bs-backdrop="static" tabindex="-1"
            role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered"
            role="document">
            <div class="modal-content" style="border-bottom:1px solid blue;">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">SETING PROFIL </h4>
                    <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="profilDesaForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <label>NAMA:</label>
                                <div class="form-group">
                                    <input type="text" id="nama_profil" name="nama_profil" value="{{$cst->nama_profil}}"
                                    class="form-control">
                                    <span class="invalid-feedback" role="alert" id="nama_profilError">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>EMAIL:</label>
                                <input type="" hidden="" name="id_profil" value="{{$cst->id_profil}}">
                                <div class="form-group">
                                    <input type="email" id="email_desa" name="email_desa" value="{{$cst->email_desa}}"
                                    class="form-control">
                                    <span class="invalid-feedback" role="alert" id="email_desaError">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>PONSEL:</label>
                                <div class="form-group">
                                    <input type="number" id="telepon_desa" name="telepon_desa" value="{{$cst->telepon_desa}}" 
                                    class="form-control">
                                    <span class="invalid-feedback" role="alert" id="telepon_desaError">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>LOGO:</label>
                                <div class="form-group">
                                    <input type="file" name="foto"
                                    class="form-control" id="foto">
                                    <input type="text" hidden="" id="fotoLama" value="{{$cst->logo}}" name="fotoLama">
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <label>LOKASI: </label>
                                <div class="form-group">
                                    <textarea class="form-control" id="lokasi_desa" rows="4" name="lokasi_desa">{{$cst->lokasi_desa}}</textarea>
                                    <span class="invalid-feedback" role="alert" id="lokasi_desaError">
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
                        <i class="fa fa-edit"></i>
                        <span class="">Ubah</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>