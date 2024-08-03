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
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaksi /</span> Create</h4>

<div class="card">
  <div class="card-header"></div>
  <div class="card-body">
    <div class="container">
      <h2>Buat Transaksi Baru</h2>
      <form action="{{ route('transaction.store') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="tgl" class="form-label">Tanggal</label>
          <input type="datetime-local" class="form-control" id="tgl" name="tgl" required>
        </div>
        <div class="mb-3">
          <label for="cust_id" class="form-label">Customer</label>
          <select class="form-control" id="cust_id" name="cust_id" required>
            <option value="" disabled selected>Pilih</option>
            @foreach ($customers as $customer)
            <option value="{{ $customer->id }}">{{ $customer->nama }}</option>
            @endforeach
          </select>
        </div>
        <h4>Detail Barang</h4>
        <div class="table-responsive">
          <table class="table table-bordered mb-3" id="detailsTable">
            <thead>
              <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Qty</th>
                <th>Harga Bandrol</th>
                <th>Diskon (%)</th>
                <th>Diskon (Rp)</th>
                <th>Harga Diskon</th>
                <th>Total</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="width: 150px;">
                  <select class="form-control" name="barang_id[]" required>
                    <option value="" disabled selected>Pilih</option>
                    @foreach ($barangs as $barang)
                    <option value="{{ $barang->id }}" data-harga="{{ $barang->harga }}">{{ $barang->nama }}</option>
                    @endforeach
                  </select>
                </td>
                <td class="barang-nama"></td>
                <td><input type="number" class="form-control qty" name="qty[]" required></td>
                <td class="barang-harga"></td>
                <td><input type="number" class="form-control diskon-persen" name="diskon_pct[]" required></td>
                <td><input type="text" readonly class="form-control diskon-rupiah" name="diskon_nilai[]" required>
                </td>
                <td>
                  <input type="text" readonly class="form-control barang-harga-diskon" name="harga_diskon[]" required>
                </td>
                <td>
                  <input type="text" readonly class="form-control barang-total" name="total[]" required>
                </td>
                <td><button type="button" class="btn btn-danger remove-row">Hapus</button></td>
              </tr>
            </tbody>
          </table>
        </div>
        <button type="button" class="btn btn-primary mb-3" id="addRow">Tambah Barang</button>
        <div class="mb-3">
          <table class="table table-borderless">
            <tbody>
              <tr>
                <th>Sub Total</th>
                <td>
                  <input type="text" readonly class="form-control" id="subTotal" name="subtotal" required>
                </td>
              </tr>
              <tr>
                <th>Diskon</th>
                <td><input type="number" class="form-control" id="diskon" name="diskon" required></td>
              </tr>
              <tr>
                <th>Ongkir</th>
                <td><input type="number" class="form-control" id="ongkir" name="ongkir" required></td>
              </tr>
              <tr>
                <th>Total Bayar</th>
                <td>
                  <input type="text" readonly class="form-control" id="totalBayar" name="total_bayar" required>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <a href="{{ route('transaction.index') }}" class="btn btn-danger">Kembali</a>
        <button type="submit" class="btn btn-success">Simpan</button>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    function calculateTotals() {
        let subTotal = 0;
        $('#detailsTable tbody tr').each(function() {
            let qty = parseFloat($(this).find('.qty').val()) || 0;
            let harga = parseFloat($(this).find('.barang-harga').text()) || 0;
            let diskonPersen = parseFloat($(this).find('.diskon-persen').val()) || 0;

            let hargaDiskon = harga - (harga * (diskonPersen / 100));
            let diskonRupiah = harga * (diskonPersen / 100);
            let total = hargaDiskon * qty;

            $(this).find('.barang-harga-diskon').val(hargaDiskon);
            $(this).find('.barang-total').val(total);
            $(this).find('.diskon-rupiah').val(diskonRupiah);

            subTotal += total;
        });

        let diskon = parseFloat($('#diskon').val()) || 0;
        let ongkir = parseFloat($('#ongkir').val()) || 0;
        let totalBayar = subTotal - diskon - ongkir;

        $('#subTotal').val(subTotal);
        $('#totalBayar').val(totalBayar);
    }

    function checkRowCount() {
        var rowCount = $('#detailsTable tbody tr').length;
        if (rowCount <= 1) {
            $('#detailsTable .remove-row').prop('disabled', true);
        } else {
            $('#detailsTable .remove-row').prop('disabled', false);
        }
    }

    // Initial check on page load
    checkRowCount();

    $('select[name="barang_id[]"]').on('change', function() {
        var selectedOption = $(this).find('option:selected');
        var row = $(this).closest('tr');
        row.find('.barang-nama').text(selectedOption.text());
        row.find('.barang-harga').text(selectedOption.data('harga'));

        calculateTotals();
        checkRowCount();
    });

    $('#addRow').on('click', function() {
        var tableBody = $('#detailsTable').find('tbody');
        var newRow = tableBody.find('tr:first').clone();
        newRow.find('input').val('');
        tableBody.append(newRow);

        newRow.find('select[name="barang_id[]"]').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var row = $(this).closest('tr');
            row.find('.barang-nama').text(selectedOption.text());
            row.find('.barang-harga').text(selectedOption.data('harga'));

            calculateTotals();
            checkRowCount();
        });

        checkRowCount();
    });

    $(document).on('click', '.remove-row', function() {
        $(this).closest('tr').remove();
        calculateTotals();
        checkRowCount();
    });

    $(document).on('input', '.qty, .diskon-persen, .diskon-rupiah, #diskon, #ongkir', function() {
        calculateTotals();
    });
  })
</script>
@endpush