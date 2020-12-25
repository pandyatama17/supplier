@extends('layouts.wrapper')
@section('content')
  <form enctype="multipart/form-data" action="/items/{{$method}}" method="post">
    <div class="row">
      @csrf
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Tambah Barang</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-7 form-group">
                <label>Nama Barang</label>
                <input type="text" name="name" class="form-control" placeholder="masukkan nama barang">
              </div>
              <div class="col-5 form-group">
                <label>Vendor</label>
                <select class="select2 form-control" name="vendor_id">
                  <option selected disabled value="0">pilih vendor...</option>
                  @foreach ($vendors as $v)
                    <option value="{{$v->id}}">{{$v->name}}</option>
                  @endforeach
                </select>
              </div>
              {{-- <div class="col-3 form-group">
                <label>Ukuran</label>
                <select class="form-control" name="size">
                  <option selected disabled>pilih ukuran...</option>
                  <option value="XS">XS</option>
                  <option value="S">S</option>
                  <option value="M">M</option>
                  <option value="L">L</option>
                  <option value="XL">XL</option>
                  <option value="XXL">XXL</option>
                  <option value="XXXL">XXXL</option>
                </select>
              </div> --}}
              {{-- <div class="col-2 form-group">
                <label>Stok</label>
                <input type="number" name="stock" class="form-control" value="1">
              </div> --}}
            </div>
            <div class="row">
              <div class="col-8">
                <div class="form-group">
                  <label>Kategori</label>
                  <div class="input-group">
                    <select class="select2 form-control" name="category" id="categorySelect">
                      <option selected disabled id="categorySelectPlaceholder">pilih kategori...</option>
                      @foreach ($categories as $c)
                        <option value="{{$c->id}}">{{$c->category}}</option>
                      @endforeach
                    </select>
                    <span class="input-group-append">
                      <button class="input-group-btn btn btn-flat btn-info" id="newCategoryBtn" data-method="true" type="button">Tambah Kategori</button>
                    </span>
                  </div>
                </div>
              </div>
              <div class="col-4" id="newCategoryCol" style="display: none">
                <div class="form-group">
                  <label>Kategori Baru</label>
                  <input type="text" name="new_category" id="newCatInput" class="form-control" placeholder="nama kategori baru">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Ukuran</label>
              @php
                $sizes = ['XS','S','M','L','XL','XXL'];
              @endphp
              <div class="row">
                @foreach ($sizes as $s_index => $s)
                  <div class="col-2 input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><b>{{$s}}</b></span>
                    </div>
                    <input type="number" name="size[{{$s}}]" value="0" class="form-control">
                  </div>
                @endforeach
              </div>
            </div>
            <div class="form-group col-6">
              <label>Harga Satuan <small>(per pcs)</small></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Rp.</span>
                </div>
                <input type="number" name="price" class="form-control" value="0">
                <div class="input-group-append">
                  <span class="input-group-text">,-</span>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-success" name="button">
              <i class="fa fa-save"></i> Simpan Barang
            </button>
          </div>
        </div>
      </div>
      <div class="col-4">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Gambar</h3>
          </div>
          <div class="card-body">
            <img src="" id="displayImage" class="img-responsive img-fluid" width="100%">
            <br>
            <div class="clearfix"></div>
            <br>
            <div class="form-group">
              <input type="file" name="file" accept="image/jpeg" class="form-control" id="imageInput">
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

@endsection
