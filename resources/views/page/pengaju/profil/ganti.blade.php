<div class="modal fade" id="ganti" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content" style="border-bottom:1px solid blue;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">UBAH PASSWORD</h5>
        <button
        type="button"
        class="btn-close"
        data-bs-dismiss="modal"
        aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('ganti_password',$cst->id)}}">
          @csrf
          <div class="row">
            <div class="col-xl-12">
              <label>PASSWORD:</label>
              <div class="form-group">
                <input type="text" name="password"
                class="form-control">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Tutup
          </button>
          <button class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>