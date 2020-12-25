@extends('layouts.wrapper')
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          @if (!$data->accepted)
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              Pesanan ini belum kami terima. mohon tunggu admin kami memproses pesanan anda
            </div>
          @endif


          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  {{-- <img src="{{asset('images/logo-alt.png')}}" > --}}
                  <small class="float-right">Date: {{$data->updated_at ?? "-"}}</small>
                </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                Dari
                <address>
                  <strong>Supplier.</strong><br>
                  Jl. Raya Pasar Minggu No. 10A RT 5 RW 12<br>
                  Pasar Minggu, Jakarta Selatan<br>
                  No. telp: +62 812-1309-8830<br>
                  Email: info@supplier.com
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                Kepada
                <address>
                  <strong>{{\App\Models\User::find($data->user_id)->name}}</strong><br>
                  {{$data->delivery_address}}<br>
                  No. telp: {{\App\Models\User::find($data->user_id)->phone}}<br>
                  Email: {{\App\Models\User::find($data->user_id)->email}}
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                <b>Invoice #{{sprintf("%04s", $data->id)}}</b><br>
                <br>
                <b>Request Date:</b> {{$data->request_date}}<br>
                <b>Confirm Date:</b> {{$data->accept_date ?? "-"}}<br>

              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
              <div class="col-12">
                <table class="table table-striped w-100" style="width:200px">
                  <thead>
                    <tr>
                      <th>Barang</th>
                      <th>Ukuran</th>
                      <th>Harga Satuan</th>
                      <th>Jumlah</th>
                      <th>Subtotal</th>
                    </tr>
                  </thead>

                  <tbody style="width:100%">
                    @php
                      $total = 0;
                    @endphp
                    @foreach ($details as $d)
                      @php
                        $subtotal = \App\Models\Item::find($d->item_id)->price * $d->quantity;
                        $total += $subtotal;
                      @endphp
                      <tr>
                        <td>
                          {{\App\Models\Item::find($d->item_id)->item_name}}
                          {{-- <br> --}}
                          {{-- <small>
                            size : {{\App\Models\Stock::find($d->stock_id)->size}}
                          </small> --}}
                        </td>
                        <td>
                          {{\App\Models\Stock::find($d->stock_id)->size}}
                        </td>
                        <td>Rp. {{\App\Models\Item::find($d->item_id)->price}},-</td>
                        <td>{{$d->quantity}} potong</td>
                        <td class="text-right">Rp. {{$subtotal}},-</td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="3"></td>
                      <td><b>Total</b></td>
                      <td class="text-right"><b>Rp. {{$total}},-</b></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

          <!-- /.invoice -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
@endsection
