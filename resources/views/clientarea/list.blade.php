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
            <th>Kode Transaksi</th>
            <th>Admin</th>
            <th>Biaya</th>
            <th>Tindakan</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($transactions as $t)
            <tr>
              <td><b>{{$t->code}}</b></td>
              <td>{{\App\Models\User::find($t->admin_id)->name}}</td>
              <td>
                <b>Rp. {{\App\Models\Payment::where('transaction_id',$t->id)->first()->amount_charge}},-</b>
                <br>(Biaya dasar : Rp. {{\App\Models\Payment::where('transaction_id',$t->id)->first()->amount_charge - $t->tax - $t->delivery}},-
                <br>Ppn : Rp. {{$t->tax}},-
                <br>Pengiriman : Rp. {{$t->delivery}},-)
              </td>
              <td>
                @if ($t->type == 'out')
                  <a href="/client/invoice&order={{$t->id}}">
                    <i class="fa fa-receipt"></i> | Invoice
                  </a>
                @else
                  <a href="/transaction/po&id={{$t->id}}" class="text-info">
                    <i class="fa fa-file-invoice"></i> | Purchase Order
                  </a>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
