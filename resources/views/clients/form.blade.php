@extends('layouts.wrapper')
@section('content')
  <div class="row">
    <div class="col-lg-8 offset-2">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tambah Klien</h3>
        </div>
        <form class="" action="/clients/{{$method}}" method="post">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label>Nama Klieb</label>
              <input type="text" name="name" class="form-control" placeholder="masukkan nama klien">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control" placeholder="masukkan email klien">
            </div>
            <div class="form-group">
              <label>Nomor Telepon</label>
              <input type="number" name="phone" class="form-control" placeholder="masukkan no. telepon klien">
            </div>
            <div class="form-group">
              <label>Alamat Klien</label>
              <textarea name="address" class="form-control" rows="4" cols="80" placeholder="masukkan alamat klien"></textarea>
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
