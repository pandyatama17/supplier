@extends('layouts.wrapper')
@section('content')
  <div class="row">
    <div class="col-12">
      <div class="callout callout-info">
        <h5><i class="fas fa-info"></i> Note:</h5>
        This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
      </div>


      <!-- Main content -->
      <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
          <div class="col-12">
            <h4>
              <i class="fas fa-globe"></i> LucuBanget.
              <small class="float-right">Tanggal: {{\Carbon\Carbon::parse($data->created_at)->format('d/m/Y')}}</small>
            </h4>
          </div>
          <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-4 invoice-col">
            dari
            <address>
              <strong>LucuBange, Alamat.</strong><br>
              Jl. kenangan<br>
              Kalibata, Jakarta Timur 14045<br>
              No. Telp: (021) 140 45<br>
              Email: admin@supplier.com
            </address>
          </div>
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            kepada
            <address>
              <strong>{{\App\Models\Client::find($data->user_id)->name}}</strong><br>
              {{\App\Models\Client::find($data->user_id)->address}}<br>
              No. Telp: {{\App\Models\Client::find($data->user_id)->phone}}<br>
              Email: {{\App\Models\Client::find($data->user_id)->email}}
            </address>
          </div>
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            <b>Invoice #{{$data->code}}</b><br>
            <br>
            <b>No. Pesanan:</b> {{$data->code}}<br>
            <b>Tgl. Pembayaran:</b> {{\Carbon\Carbon::parse($payment->updated_at)->format('d/m/Y')}}<br>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
          <div class="col-12 table-responsive">
            <table class="table table-striped">
              <thead>
              <tr>
                <th>Barang</th>
                <th>Qty</th>
                <th>Ukuran</th>
                {{-- <th>Subtotal</th> --}}
              </tr>
              </thead>
              <tbody>
              @foreach ($details as $d)
                @php
                  $item = \App\Models\Item::find($d->item_id);
                @endphp
                <tr>
                  <td>{{$item->item_name}}</td>
                  <td>{{$d->quantity}}</td>
                  <td>{{$item->size}}</td>
                  {{-- <td>{{$d->subtotal}}</td> --}}
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-6 offset-6">
            <p class="lead">Telah dibayar pada {{\Carbon\Carbon::parse($payment->updated_at)->format('d/m/Y')}}</p>

            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th style="width:50%">Subtotal:</th>
                  <td>Rp. {{$payment->amount_charge - $data->tax - $data->delivery}},-</td>
                </tr>
                <tr>
                  <th>Ppn </th>
                  <td>Rp. {{$data->tax}},-</td>
                </tr>
                <tr>
                  <th>Pengiriman:</th>
                  <td>Rp. {{$data->delivery}},-</td>
                </tr>
                <tr>
                  <th>Total:</th>
                  <td>Rp. {{$payment->amount_charge}},-</td>
                </tr>
              </table>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
          <div class="col-12">
            {{-- <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a> --}}
            <button type="button" class="btn btn-success float-right printBtn">
              <i class="far fa-print"></i>
              Cetak Invoice
            </button>
            {{-- <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
              <i class="fas fa-download"></i> Generate PDF
            </button> --}}
          </div>
        </div>
      </div>
      <!-- /.invoice -->
    </div><!-- /.col -->
  </div><!-- /.row -->
@endsection
