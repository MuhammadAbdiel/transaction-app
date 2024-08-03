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
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaksi /</span> Home</h4>

<!-- Basic Bootstrap Table -->
<div class="card">
  <h5 class="card-header">Daftar Transaksi</h5>
  <div class="card-body">

    @if (session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <a href="{{ route('transaction.create') }}" class="btn btn-primary mb-3">Buat Transaksi Baru</a>
    <div class="table-responsive text-nowrap">
      <table class="table" id="transaction-table">
        <thead>
          <tr>
            <th>No. Transaksi</th>
            <th>Tanggal</th>
            <th>Nama Customer</th>
            <th>Sub Total</th>
            <th>Diskon</th>
            <th>Ongkir</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        </tbody>
        <tfoot>
          <tr>
            <th colspan="6" class="text-end">Total Keseluruhan</th>
            <th id="grandTotal" class="text-right"></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
<!--/ Basic Bootstrap Table -->
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    $('#transaction-table').DataTable({
      paging: true,
      lengthChange: true,
      searching: true,
      ordering: true,
      responsive: false,
      ajax: {
        url: "{{ route('transaction.index') }}",
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
          data: 'tgl',
          className: 'text-center align-middle',
        },
        {
          targets: 2,
          data: 'customer.nama',
          className: 'text-center align-middle',
        },
        {
          targets: 3,
          data: 'subtotal',
          className: 'text-right align-middle',
          render: $.fn.dataTable.render.number('.', '.', 0),
        },
        {
          targets: 4,
          data: 'diskon',
          className: 'text-right align-middle',
          render: $.fn.dataTable.render.number('.', '.', 0),
        },
        {
          targets: 5,
          data: 'ongkir',
          className: 'text-right align-middle',
          render: $.fn.dataTable.render.number('.', '.', 0),
        },
        {
          targets: 6,
          data: 'total_bayar',
          className: 'text-right align-middle',
          render: $.fn.dataTable.render.number('.', '.', 0),
        }
      ],
      drawCallback: function() {
        var api = this.api();
        var total = api.column(6).data().reduce(function(a, b) {
          return parseFloat(a) + parseFloat(b);
        }, 0);
        $('#grandTotal').html(total.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }));
      }
    });
  })
</script>
@endpush