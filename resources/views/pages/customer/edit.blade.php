<div class="modal fade" id="modal-customer-update" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Edit Customer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form-customer-update" action="{{ route('customer.update') }}" method="POST">
        @method('PUT')
        <input type="hidden" id="id" name="id">
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label for="kode" class="form-label">Kode</label>
              <input type="text" id="kode" name="kode" class="form-control" placeholder="Kode Customer" />
              <div class="invalid-feedback kode_error"></div>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Customer" />
              <div class="invalid-feedback nama_error"></div>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="telp" class="form-label">No. Telp</label>
              <input type="number" id="telp" name="telp" class="form-control" placeholder="No. Telp Customer" />
              <div class="invalid-feedback telp_error"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn btn-success">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>