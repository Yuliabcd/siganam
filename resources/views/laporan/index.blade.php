@extends('layouts.app')

@section('title')
  Laporan
@endsection

@section('page-header')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Laporan</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
    </div><!-- /.col -->
  </div><!-- /.row -->
@endsection

@section('content')
  <div class="container-fluid">
    @include('partials.alerts')

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Kelola Laporan</h3>
            <div class="card-tools">
              <a href="{{ route('laporan.create') }}" class="btn btn-primary btn-block btn-sm"><i
                  class="fa fa-plus"></i>
                Tambah</a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-head-fixed text-nowrap table-bordered table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Tempat</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($laporan as $i => $item)
                    <tr>
                      <td>{{ ($laporan->currentpage() - 1) * $laporan->perpage() + $i + 1 }}</td>
                      <td>{{ $item->tanggal->isoFormat('DD MMMM YYYY') }}</td>
                      <td>{{ $item->tempat }}</td>
                      <td class="text-center py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                          <a href="{{ route('laporan.show', $item->id) }}" class="btn btn-primary" data-toggle="tooltip"
                            data-placement="left" title="Lihat">
                            <i class="fas fa-eye"></i>
                          </a>
                          <a href="{{ route('laporan.edit', $item->id) }}" class="btn btn-info" data-toggle="tooltip"
                            data-placement="left" title="Edit">
                            <i class="fas fa-pencil-alt"></i>
                          </a>
                          <button type="button" data-href="{{ route('laporan.destroy', $item->id) }}"
                            class="btn btn-danger btn__delete" data-toggle="tooltip" data-placement="left" title="Hapus">
                            <i class="fas fa-trash"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div>{{ $laporan->links() }}</div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->


  <form hidden id="form-delete" method="post">@csrf @method('DELETE')</form>
@endsection

@push('scripts')
  <script>
    $(function() {
      $('table').on('click', '.btn__delete', function() {
        $('#form-delete').prop('action', $(this).data('href'));
        Swal.fire({
          title: 'Apa kamu yakin?',
          text: 'Laporan yang sudah dihapus tidak bisa dikembalikan!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Hapus',
          cancelButtonText: 'Batal',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            $('#form-delete').trigger('submit');
          }
        })
      });
    });
  </script>
@endpush
