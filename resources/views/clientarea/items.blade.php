@extends('layouts.wrapper')
@section('content')
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Data Barang</h3>
    </div>
    <div class="card-body">
      <table class="table table-striped table-hed-fixed datatable">
        <thead>
          <tr>
            <th>Kode Barang <small>(klik untuk detail)</small> </th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            {{-- <th>Ukuran</th> --}}
            {{-- <th>Vendor</th> --}}
            <th>Harga Satuan</th>
            <th class="none">Stok</th>
            <th class="none">Gambar</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($items as $item)
            @php
              $stock = \App\Models\Stock::where('item_id',$item->id)->get();
            @endphp
            <tr>
              <td>{{$item->code}}</td>
              <td>{{$item->item_name}}</td>
              <td>{{\App\Models\Category::find($item->category)->category}}</td>
              {{-- <td>{{\App\Models\Vendor::find($item->vendor_id)->name}}</td> --}}
              <td>Rp. {{$item->price}},-</td>
              <td>
                <table class="table-bordered">
                  <tr>
                    @foreach ($stock as $s)
                      <td><b>{{$s->size}}</b></td>
                      <td class="bg-white">{{$s->stock}}</td>
                      <td class="bg-white" style="border-top:1px solid white !important;border-bottom:1px solid white !important">&nbsp;</td>
                    @endforeach
                </tr>
                </table>
              </td>
              <td><img src="{{asset('images/items/'.$item->image)}}" width="200" class="img-responsive"></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
