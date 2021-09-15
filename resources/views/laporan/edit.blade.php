@extends('layouts.app')

@section('title')
  Edit Laporan
@endsection

@section('page-header')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Edit Laporan</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('laporan.index') }}">Laporan</a></li>
        <li class="breadcrumb-item active">Edit Laporan</li>
      </ol>
    </div><!-- /.col -->
  </div><!-- /.row -->
@endsection

@section('content')
  @php
  function rupiah($angka)
  {
      $hasil_rupiah = 'Rp ' . number_format($angka, 2, ',', '.');
      return $hasil_rupiah;
  }
  @endphp
  <div class="container-fluid">
    @include('partials.alerts')

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Edit Laporan</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-5 col-sm-3">
                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active" id="vert-tabs-laporan-tab" data-toggle="pill" href="#vert-tabs-laporan"
                    role="tab" aria-controls="vert-tabs-laporan" aria-selected="true">Laporan</a>
                  <a class="nav-link" id="vert-tabs-laporan-pengurus-tab" data-toggle="pill"
                    href="#vert-tabs-laporan-pengurus" role="tab" aria-controls="vert-tabs-laporan-pengurus"
                    aria-selected="false">Laporan Pengurus</a>
                  <a class="nav-link" id="vert-tabs-laporan-simpan-pinjam-tab" data-toggle="pill"
                    href="#vert-tabs-simpan-pinjam" role="tab" aria-controls="vert-tabs-simpan-pinjam"
                    aria-selected="false">Laporan Simpan Pinjam</a>
                </div>
              </div>
              <div class="col-7 col-sm-9">
                <div class="tab-content" id="vert-tabs-tabContent">
                  <div class="tab-pane text-left fade show active" id="vert-tabs-laporan" role="tabpanel"
                    aria-labelledby="vert-tabs-laporan-tab">
                    <form action="{{ route('laporan.update', $laporan->id) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <div class="form-group">
                        <label for="tanggal">Tanggal <code>*</code></label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control"
                          value="{{ $laporan->tanggal->format('Y-m-d') }}">
                      </div>
                      <div class="form-group">
                        <label for="tempat">Tempat <code>*</code></label>
                        <input type="text" name="tempat" id="tempat" class="form-control"
                          value="{{ $laporan->tempat }}">
                      </div>
                      <div class="form-group">
                        <label for="informasi">Informasi Ketua PKK RW GANAM</label>
                        <textarea class="summernote" name="informasi">{{ $laporan->informasi }}</textarea>
                      </div>
                      <div class="form-group">
                        <label for="serap_info">Serap info dari RT dan Lain-lain</label>
                        <textarea class="summernote" name="serap_info">{{ $laporan->serap_info }}</textarea>
                      </div>
                      <div class="form-group mt-3">
                        <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                      </div>
                    </form>
                  </div>
                  <div class="tab-pane fade" id="vert-tabs-laporan-pengurus" role="tabpanel"
                    aria-labelledby="vert-tabs-laporan-pengurus-tab">
                    <div class="d-flex justify-content-end align-items-center mb-3">
                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#modalTambahLaporanPengurus">
                        <i class="fa fa-plus"></i> Tambah
                      </button>
                    </div>
                    @php
                      $laporan_pengurus = $laporan->laporanPengurus;
                    @endphp
                    <div class="table-responsive">
                      <table class="table table-head-fixed text-nowrap table-bordered table-hover"
                        id="tabelLaporanPengurus">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Pengurus</th>
                            <th>Posisi</th>
                            <th>Saldo Awal</th>
                            <th>Keluar</th>
                            <th>Masuk</th>
                            <th>Saldo Akhir</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($laporan_pengurus as $i => $item)
                            <tr>
                              <td>{{ ++$i }}</td>
                              <td>{{ $item->pengurus->nama }}</td>
                              <td>{{ $item->pengurus->posisi->nama }}</td>
                              <td>{{ rupiah($item->saldo_awal) }}</td>
                              <td>{{ rupiah($item->keluar) }}</td>
                              <td>{{ rupiah($item->masuk) }}</td>
                              <td>{{ rupiah($item->saldo_akhir) }}</td>
                              <td class="text-center py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                  <button type="button" data-href="{{ route('laporan_penguruses.edit', $item->id) }}"
                                    class="btn btn-info btn__edit" data-toggle="tooltip" data-placement="left"
                                    title="Edit">
                                    <i class="fas fa-pencil-alt"></i>
                                  </button>
                                  <button type="button"
                                    data-href="{{ route('laporan_penguruses.destroy', $item->id) }}"
                                    class="btn btn-danger btn__delete" data-toggle="tooltip" data-placement="left"
                                    title="Hapus">
                                    <i class="fas fa-trash"></i>
                                  </button>
                                </div>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="vert-tabs-simpan-pinjam" role="tabpanel"
                    aria-labelledby="vert-tabs-laporan-simpan-pinjam-tab">
                    @php
                      $simpan_pinjam = $laporan->laporanSimpanPinjam;
                    @endphp
                    <form action="{{ route('laporan_simpan_pinjam', $simpan_pinjam->id) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <div class="form-group">
                        <label for="saldo_awal">Saldo Awal</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">IDR</span>
                          </div>
                          <input type="number" name="saldo_awal" id="saldo_awal" class="form-control"
                            value="{{ $simpan_pinjam->saldo_awal }}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tabungan">Tabungan</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">IDR</span>
                          </div>
                          <input type="number" name="tabungan" id="tabungan" class="form-control"
                            value="{{ $simpan_pinjam->tabungan }}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="jasa">Jasa</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">IDR</span>
                          </div>
                          <input type="number" name="jasa" id="jasa" class="form-control"
                            value="{{ $simpan_pinjam->jasa }}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="angsuran">Angsuran</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">IDR</span>
                          </div>
                          <input type="number" name="angsuran" id="angsuran" class="form-control"
                            value="{{ $simpan_pinjam->angsuran }}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="denda">Denda</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">IDR</span>
                          </div>
                          <input type="number" name="denda" id="denda" class="form-control"
                            value="{{ $simpan_pinjam->denda }}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="piutang">Piutang</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">IDR</span>
                          </div>
                          <input type="number" name="piutang" id="piutang" class="form-control"
                            value="{{ $simpan_pinjam->piutang }}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="saldo_akhir">Saldo Akhir</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">IDR</span>
                          </div>
                          <input type="number" name="saldo_akhir" id="saldo_akhir" class="form-control"
                            value="{{ $simpan_pinjam->saldo_akhir }}">
                        </div>
                      </div>
                      <div class="form-group mt-3">
                        <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->

  <form hidden id="form-delete-laporan-pengurus" method="POST">@csrf @method('DELETE')</form>
@endsection

@section('modals')
  <div class="modal fade" id="modalTambahLaporanPengurus">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Laporan Pengurus</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('laporan_penguruses.store') }}" method="POST">
          @csrf
          <input type="hidden" name="laporan_id" value="{{ $laporan->id }}" hidden>
          <div class="modal-body">
            <div class="form-group">
              <label for="pengurus_id">Pengurus <code>*</code></label>
              <select name="pengurus_id" id="pengurus_id" class="form-control">
                <option selected disabled hidden>-- Pilih Pegurus --</option>
                @foreach ($pengurus as $item)
                  <option value="{{ $item->id }}">{{ $item->nama }} ({{ Str::upper($item->posisi->nama) }})
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="saldo_awal">Saldo Awal</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">IDR</span>
                </div>
                <input type="number" name="saldo_awal" id="saldo_awal" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label for="masuk">Masuk</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">IDR</span>
                </div>
                <input type="number" name="masuk" id="masuk" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label for="keluar">Keluar</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">IDR</span>
                </div>
                <input type="number" name="keluar" id="keluar" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label for="saldo_akhir">Saldo Akhir</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">IDR</span>
                </div>
                <input type="number" name="saldo_akhir" id="saldo_akhir" class="form-control">
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modalEditLaporanPengurus">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Laporan Pengurus</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" class="form__edit">
          @csrf
          @method('PUT')
          <input type="hidden" name="laporan_id" value="{{ $laporan->id }}" hidden>
          <div class="modal-body">
            <div class="form-group">
              <label for="pengurus_id">Pengurus <code>*</code></label>
              <select name="pengurus_id" id="pengurus_id" class="form-control">
                <option selected disabled hidden>-- Pilih Pegurus --</option>
                @foreach ($pengurus as $item)
                  <option value="{{ $item->id }}">{{ $item->nama }} ({{ Str::upper($item->posisi->nama) }})
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="saldo_awal">Saldo Awal</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">IDR</span>
                </div>
                <input type="number" name="saldo_awal" id="saldo_awal" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label for="masuk">Masuk</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">IDR</span>
                </div>
                <input type="number" name="masuk" id="masuk" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label for="keluar">Keluar</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">IDR</span>
                </div>
                <input type="number" name="keluar" id="keluar" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label for="saldo_akhir">Saldo Akhir</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">IDR</span>
                </div>
                <input type="number" name="saldo_akhir" id="saldo_akhir" class="form-control">
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
@endpush

@push('scripts')
  <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
  <script>
    $(function() {
      $('.summernote').summernote({
        toolbar: [
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['height', ['height']]
        ],
      });

      $('#tabelLaporanPengurus').on('click', '.btn__delete', function() {
        $('#form-delete-laporan-pengurus').prop('action', $(this).data('href'));
        Swal.fire({
          title: 'Apa kamu yakin?',
          text: 'Laporan Pengurus yang sudah dihapus tidak bisa dikembalikan!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Hapus',
          cancelButtonText: 'Batal',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            $('#form-delete-laporan-pengurus').trigger('submit');
          }
        })
      });

      $('#tabelLaporanPengurus').on('click', '.btn__edit', function() {
        $.ajax({
          url: $(this).data('href'),
          dataType: 'json',
          success: function(data) {
            $('.form__edit').prop('action', '/laporan_penguruses/' + data.id)
            $('.form__edit select[name=pengurus_id]').val(data.pengurus_id);
            $('.form__edit input[name=saldo_awal]').val(data.saldo_awal);
            $('.form__edit input[name=masuk]').val(data.masuk);
            $('.form__edit input[name=keluar]').val(data.keluar);
            $('.form__edit input[name=saldo_akhir]').val(data.saldo_akhir);
            $('#modalEditLaporanPengurus').modal('show');
          }
        })
      });
    });
  </script>
@endpush
