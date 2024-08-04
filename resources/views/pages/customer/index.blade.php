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

@include('pages.customer.edit')

<!--/ Basic Bootstrap Table -->
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    $('.modal').on('hidden.bs.modal', function(e) {
      $('form').trigger('reset');
      $('*').removeClass('is-invalid');
      $('.invalid-feedback').html('');
    });

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
        {
          targets: 3,
          data: null,
          className: 'text-center align-middle',
          render: function(data, type, row) {
            return `
              <button type="button" class="btn btn-sm btn-warning btn-edit" data-bs-toggle="modal" data-bs-target="#modal-customer-update" data-id="${row.id}">
                Edit
              </button>
              <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="${row.id}">
                Delete
              </button>
            `
          }
        }
      ],
    });

    $('#form-customer-create').submit(function(e) {
      e.preventDefault()

      let formData = new FormData($(this)[0])

      $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function() {
            $('*').removeClass('is-invalid');
            $('.invalid-feedback').html('');
        },
        success: function() {
          $('#modal-customer-create').modal('hide')
          Swal.fire({
              icon: 'success',
              title: 'Berhasil!',
              text: 'Customer berhasil ditambahkan!',
          })
          table.ajax.reload()
        },
        error: function(xhr, ajaxOptions, thrownError) {
          switch (xhr.status) {
            case 422:
                var errors = xhr.responseJSON.errors;
                $.each(errors, function(key, value) {
                    $('*[name="' + key + '"]').addClass('is-invalid');
                    $('.invalid-feedback.' + key + '_error').html(value);
                });
                break;
            case 409:
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: xhr.responseJSON.errors,
                })
                break;
            case 500:
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: xhr.responseJSON.errors,
                })
                break;
            default:
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan!',
                })
                break;
          }
        }
      })
    })

    $('#customer-table tbody').on('click', '.btn-edit', function() {
      var data = table.row($(this).parents('tr')).data();

      $('input[name="id"]').val(data.id)
      $('input[name="kode"]').val(data.kode)
      $('input[name="nama"]').val(data.nama)
      $('input[name="telp"]').val(data.telp)
    })
    
    $('#form-customer-update').submit(function(e) {
      e.preventDefault()
      
      let formData = new FormData($(this)[0])

      $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function() {
            $('*').removeClass('is-invalid');
            $('.invalid-feedback').html('');
        },
        success: function() {
          $('#modal-customer-update').modal('hide')
          Swal.fire({
              icon: 'success',
              title: 'Berhasil!',
              text: 'Customer berhasil diupdate!',
          })
          table.ajax.reload()
        },
        error: function(xhr, ajaxOptions, thrownError) {
          switch (xhr.status) {
            case 422:
                var errors = xhr.responseJSON.errors;
                $.each(errors, function(key, value) {
                    $('*[name="' + key + '"]').addClass('is-invalid');
                    $('.invalid-feedback.' + key + '_error').html(value);
                });
                break;
            case 409:
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: xhr.responseJSON.errors,
                })
                break;
            case 500:
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: xhr.responseJSON.errors,
                })
                break;
            default:
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan!',
                })
                break;
          }
        }
      })
    })

    $('#customer-table tbody').on('click', '.btn-delete', function() {
        var data = table.row($(this).parents('tr')).data();

        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('customer.destroy') }}",
                    data: {
                        id: data.id
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data berhasil dihapus!',
                        })
                        table.ajax.reload();
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        switch (xhr.status) {
                            case 500:
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Server Error!',
                                })
                                break;
                            default:
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Terjadi kesalahan!',
                                })
                                break;
                        }
                    }
                });
            }
        })
    });
  })
</script>
@endpush