@extends('layouts.wrapper')
@section('content')
<form class="form" action="/order/submit" method="post">
  <div class="row">
    <div class="col-lg-4">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Form Pemesanan</h3>
          </div>
            <div class="card-body">
              <div class="form-group">
                <label>Kode Transaksi</label>
                <div class="input-group">
                  <input name="code" class="form-control" value="{{strtoupper(Str::random(10))}}" readonly id="codeInput">
                  {{-- <div class="input-group-append">
                    <button type="button" class="btn input-group-btn btn-info" id="editCode">Ubah Kode</button>
                  </div> --}}
                </div>
              </div>
              <div class="form-group">
                <label>Tanggal</label>
                <p class="form-control-static">{{\Carbon\Carbon::now()->format('Y-m-d')}}</p>
              </div>
              {{-- <div class="form-group">
                <label>Admin</label>
                <p class="form-control-static">{{Auth::user()->name}}</p>
              </div>
              <div class="form-group">
                <label>Subtotal Biaya</label>
                <div class="input-group">
                  <div class="input-group-append">
                    <span class="input-group-text">Rp.</span>
                  </div>
                  <input type="number" class="form-control" name="amount_charge" value="0">
                  <div class="input-group-prepend">
                    <span class="input-group-text">,-</span>
                  </div>
                </div>
              </div> --}}
              {{-- <div class="form-group">
                <label>PPn</label>
                <div class="input-group">
                  <div class="input-group-append">
                    <span class="input-group-text">Rp.</span>
                  </div>
                  <input type="number" class="form-control" name="tax" value="0">
                  <div class="input-group-prepend">
                    <span class="input-group-text">,-</span>
                  </div>
                </div>
              </div> --}}
              <div class="form-group">
                <label>Alamat Pengiriman</label>
                {{-- <div class="input-group">
                  <div class="input-group-append">
                    <span class="input-group-text">Rp.</span>
                  </div>
                  <input type="number" class="form-control" name="delivery" value="0">
                  <div class="input-group-prepend">
                    <span class="input-group-text">,-</span>
                  </div>
                </div> --}}
                <textarea name="delivery_address" class="form-control" rows="8" cols="80"></textarea>
              </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Form Transaksi</h3>
        </div>
        <div class="card-body">
          <fieldset id="fieldset">
            <legend>Barang</legend>
            <div  id="itemsCol"></div>
            <button type="button" class="btn btn-flat btn-info" id="addItem">
              <i class="fa fa-plus"></i> Tambah barang
            </button>
          </fieldset>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-flat btn-success">
            <i class="fa fa-save"></i> Buat Transaksi
          </button>
        </div>
      </div>
    </div>
  </div>
  @csrf
  <input type="hidden" name="items" value="0" id="itemsCount">
  <input type="hidden" name="method" value="out" id="formMethod">
  <input type="hidden" name="user_id" value="{{Auth::user()->id}}" id="formMethod">
</form>
@endsection
