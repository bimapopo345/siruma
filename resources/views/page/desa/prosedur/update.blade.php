<div class="modal fade text-left" id="edit{{$dt->id_prosedur}}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1"><i class="fa fa-edit"></i> Form Ubah Prosedur</h5>
                <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                ></button>
            </div>

            <div class="modal-body">
                <form method="post" action="{{route('edit_prosedur',$dt->id_prosedur)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Isi Prosedur</label>
                                <textarea class="form-control" rows="5" name="prosedur">{{$dt->prosedur}}</textarea>
                            </div> 
                        </div>
                    </div>
                    <button class="btn btn-sm btn-primary form-control mt-2"><i class="fa fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>