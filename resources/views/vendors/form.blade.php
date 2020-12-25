@extends('layouts.wrapper')
@section('content')
  <div class="row">
    <div class="col-lg-8 offset-2">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tambah Vendor</h3>
        </div>
        <form class="" action="/vendors/{{$method}}" method="post">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label>Nama Vendor</label>
              <input type="text" name="name" class="form-control" placeholder="masukkan nama vendor">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control" placeholder="masukkan email vendor">
            </div>
            <div class="form-group">
              <label>Nomor Telepon</label>
              <input type="number" name="phone" class="form-control" placeholder="masukkan no. telepon vendor">
            </div>
            <div class="form-group">
              <label>Alamat Vendor</label>
              <textarea name="address" class="form-control" rows="4" cols="80" placeholder="masukkan alamat vendor"></textarea>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-success">
              <i class="fa fa-save"></i>Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
