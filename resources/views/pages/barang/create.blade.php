<div class="modal fade" id="modal-barang-create" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Tambah Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form-barang-create" action="{{ route('barang.store') }}" method="POST">
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label for="kode" class="form-label">Kode</label>
              <input type="text" id="kode" name="kode" class="form-control" placeholder="Kode Barang" />
              <div class="invalid-feedback kode_error"></div>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Barang" />
              <div class="invalid-feedback nama_error"></div>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="harga" class="form-label">Harga</label>
              <input type="number" id="harga" name="harga" class="form-control" placeholder="Harga Barang" />
              <div class="invalid-feedback harga_error"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>