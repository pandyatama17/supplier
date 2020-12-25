@extends('layouts.wrapper')
@section('content')
@if ($method == 'in')
  <form class="form" action="/transaction/in/submit" method="post">
@else
  <form class="form" action="/transaction/out/submit" method="post">
@endif
  <div class="row">
    <div class="col-lg-4">
      @if ($method == 'in')
        <div class="card card-danger">
      @else
        <div class="card card-success">
      @endif
        <div class="card-header">
          @if ($method == 'in')
            <h3 class="card-title">Transaksi Masuk</h3>
          @else
            <h3 class="card-title">Transaksi Keluar</h3>
          @endif
        </div>
        <div class="card-body">
          <div class="form-group">
            <label>Kode Transaksi</label>
            <div class="input-group">
              <input name="code" class="form-control" value="{{strtoupper(Str::random(10))}}" readonly id="codeInput">
              <div class="input-group-append">
                <button type="button" class="btn input-group-btn btn-info" id="editCode">Ubah Kode</button>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Tanggal</label>
            <p class="form-control-static">{{\Carbon\Carbon::now()->format('Y-m-d')}}</p>
          </div>
          <div class="form-group">
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
          </div>
          <div class="form-group">
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
          </div>
          <div class="form-group">
            <label>Biaya Pengiriman</label>
            <div class="input-group">
              <div class="input-group-append">
                <span class="input-group-text">Rp.</span>
              </div>
              <input type="number" class="form-control" name="delivery" value="0">
              <div class="input-group-prepend">
                <span class="input-group-text">,-</span>
              </div>
            </div>
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
          @if ($method == 'in')
            <div class="form-group">
              <label>Vendor</label>
              <select class="select2 form-control" name="vendor" id="vendorSelect">
                <option value="0" selected disabled>Pilih vendor...</option>
                @foreach ($vendors as $v)
                  <option value="{{$v->id}}">{{$v->name}}</option>
                @endforeach
              </select>
            </div>
          @else
            <div class="form-group">
              <label>Klien</label>
              <select class="select2 form-control" name="client" id="clientSelect">
                <option value="0" selected disabled>Pilih klien...</option>
                @foreach ($clients as $c)
                  <option value="{{$c->id}}">{{$c->name}}</option>
                @endforeach
              </select>
            </div>
          @endif
          <fieldset style="display:none" id="fieldset">
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
  <input type="hidden" value="{{$method}}" id="formMethod">
</form>
@endsection
