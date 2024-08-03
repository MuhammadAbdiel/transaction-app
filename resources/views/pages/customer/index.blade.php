@extends('main')

@push('styles')
<style>
  div.dt-container .dt-paging .dt-paging-button {
    box-sizing: border-box;
    display: inline-block;
    min-width: 1.5em;
    padding: 0;
    margin-left: 0;
    text-align: center;
    text-decoration: none !important;
    cursor: pointer;
    color: inherit !important;
    border: 1px solid transparent;
    border-radius: 2px;
    background: transparent;
  }

  div.dt-container .dt-paging .dt-paging-button:hover {
    background: transparent;
    border: 1px solid transparent;
  }
</style>
@endpush

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Customer /</span> Home</h4>

<!-- Basic Bootstrap Table -->
<div class="card">
  <h5 class="card-header">Daftar Customer</h5>
  <div class="card-body">

    @if (session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modal-customer-create">
      Tambah Customer
    </button>
    <div class="table-responsive text-nowrap">
      <table class="table" id="customer-table">
        <thead>
          <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>No. Telp</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        </tbody>
      </table>
    </div>
  </div>
</div>

@include('pages.customer.create')

<!--/ Basic Bootstrap Table -->
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    let table = $('#customer-table').DataTable({
      paging: true,
      lengthChange: true,
      searching: true,
      ordering: true,
      responsive: false,
      ajax: {
        url: "{{ route('customer.index') }}",
        dataSrc: '',
        type: 'GET'
      },
      columnDefs: [
        {
          targets: 0,
          data: 'kode',
          className: 'text-center align-middle',
        },
        {
          targets: 1,
          data: 'nama',
          className: 'text-center align-middle',
        },
        {
          targets: 2,
          data: 'telp',
          className: 'text-center align-middle',
        },
      ],
    });
  })
</script>
@endpush