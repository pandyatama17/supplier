<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Str;
use App\Models\Item;
use \App\Models\Category;
use App\Models\Vendor;
use App\Models\Client;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Payment;
use App\Models\Stock;

use Auth;

class MainController extends Controller
{
    public function showItems()
    {
      $i = Item::all();
      return view('items.show')
      ->with('items', $i);
    }
    public function addItem()
    {
      $cats = Category::all();
      $vends = Vendor::all();
      return view('items.form')
      ->with('method', 'submit')
      ->with('categories', $cats)
      ->with('vendors', $vends);
    }
    public function submitItem(Request $r)
    {
      // $test = [];
      // foreach ($r->size as $key => $s) {
      //   array_push($test,$key.':'.$s);
      // }
      // return $test;
      $code = strtoupper(Str::random(10));
      $i = new Item;
      $i->code = $code;
      $i->item_name = $r->name;
      // $i->size = $r->size;
      // $i->stock = $r->stock;
      $i->vendor_id = $r->vendor_id;
      $i->price = $r->price;

      $img = $r->file("file");
      $ext = $img->extension();
      $filename = $code.'.'.$ext;

      $i->image = $filename;

      if ($r->new_category != "")
      {
        $c = new Category;
        $c->category = $r->new_category;
        $c->save();
        $i->category = $c->id;
      } else {
        $i->category = $r->category;
      }

      try {
        $i->save();
        foreach ($r->size as $key => $value) {
          $s = new Stock;
          $s->item_id = $i->id;
          $s->size = $key;
          $s->stock = $value;

          $s->save();
        }
        $path = $img->move(public_path('/images/items/'),$filename);
        session()->flash('message-type', 'success');
        session()->flash('message-title', 'Berhasil');
        session()->flash('message', $i->item_name.' berhasil disimpan!');
        // $arr = ['err'=>false,'msg'=>$i->item_name.' berhasil disimpan!', 'type'=>"success"];
        // return 'sabi';
      } catch (\Exception $e) {
        session()->flash('message-type', 'error');
        session()->flash('message-title', 'Gagal');
        session()->flash('message', $i->item_name.' gagal disimpan!');
        // $arr = ['err'=>true,'msg'=>$i->item_name.' gagal disimpan! '.$e->getMessage(), 'type'=>"error"];
        // return $e->getMessage();
      }
      return redirect()->route('show_items');
    }
    public function addVendor()
    {
      return view('vendors.form')
      ->with('method', 'submit');
    }
    public function submitVendor(Request $r)
    {
      $v = new Vendor;
      $v->name = $r->name;
      $v->email = $r->email;
      $v->phone = $r->phone;
      $v->address = $r->address;

      try {
        $v->save();
        session()->flash('message-type', 'success');
        session()->flash('message-title', 'Berhasil');
        session()->flash('message', 'Vendor berhasil ditambahkan');
        // $arr = ['err'=>false,'msg'=>'Vendor berhasil ditambahkan','type'=>"success"];
      } catch (\Exception $e) {
        session()->flash('message-type', 'error');
        session()->flash('message-title', 'Gagal');
        session()->flash('message', 'Vendor gagal ditambahkan');
        // $arr = ['err'=>true,'msg'=>'Vendor gagal ditambahkan '.$e->getMessage(),'type'=>"error"];
      }
      return redirect()->back();
      // echo json_encode($arr);
    }
    public function addClient()
    {
      return view('clients.form')
      ->with('method', 'submit');
    }
    public function submitClient(Request $r)
    {
      $v = new Client;
      $v->name = $r->name;
      $v->email = $r->email;
      $v->phone = $r->phone;
      $v->address = $r->address;

      try {
        $v->save();
        session()->flash('message-type', 'success');
        session()->flash('message-title', 'Berhasil');
        session()->flash('message', 'Klien baru berhasil ditambahkan');
        // $arr = ['err'=>false,'msg'=>'Klien baru berhasil ditambahkan','redirect'=>"#"];
      }
      catch (\Exception $e)
      {
        session()->flash('message-type', 'error');
        session()->flash('message-title', 'Gagal');
        session()->flash('message', 'Klien baru gagal ditambahkan');
        // $arr = ['err'=>true,'msg'=>'Klien baru gagal ditambahkan '.$e->getMessage(),'redirect'=>"#"];
      }
      return redirect()->back();
      // echo json_encode($arr);
    }
    public function showTransactions()
    {
      $t = Transaction::all();

      return view('transactions.show')
      ->with('transactions', $t);
    }
    public function addTransactionIn()
    {
      $v = Vendor::all();
      $i = Item::all();
      return view('transactions.form')
      ->with('method', 'in')
      ->with('items', $i)
      ->with('vendors', $v);
    }
    public function getItemsofVendor($index,$vendor)
    {
      $items = Item::where('vendor_id',$vendor)->get();
      return view('transactions.itemform')
      ->with('index', $index)
      ->with('items', $items);
    }
    public function submitTransactionIn(Request $r)
    {
      // return $r;
      $t = new Transaction;
      $p = new Payment;
      $amt = $r->amount_charge + $r->tax + $r->delivery;

      $t->code = $r->code;
      $t->type = 'in';
      $t->admin_id = Auth::user()->id;
      $t->user_id = $r->vendor;
      $t->tax = $r->tax;
      $t->delivery = $r->delivery;
      $t->accepted = true;

      $p->amount_charge = $amt;
      $p->amount_paid = $amt;
      try
      {
        $t->save();
        $p->transaction_id = $t->id;
        $p->save();
        session()->flash('message-type', 'success');
        session()->flash('message-title', 'Berhasil');
        session()->flash('message', 'Transaksi berhasil dibuat');
        for ($i=1; $i < $r->items+1; $i++)
        {
          $td = new TransactionDetail;
          $item = Item::find($r->input('item_'.$i));
          $stock = Stock::where('item_id',$item->id)->where('size', $r->input('size_'.$i))->first();

          $td->parent_id = $t->id;
          $td->item_id = $r->input('item_'.$i);
          $td->stock_id = $stock->id;
          $td->quantity = $r->input('qty_'.$i);
          $td->subtotal = 0;
          $stock->stock += $r->input('qty_'.$i);

            try
            {
              $td->save();
              $stock->save();
            } catch (\Exception $e) {
              session()->flash('message-type', 'error');
              session()->flash('message-title', 'Gagal');
              session()->flash('message', 'Transaksi gagal dibuat'.$e->getMessage());
            }
        }
      }
      catch (\Exception $e) {
        session()->flash('message-type', 'error');
        session()->flash('message-title', 'Gagal');
        session()->flash('message', 'Transaksi gagal dibuat'.$e->getMessage());
      }
      return redirect()->route('show_transactios');
    }
    public function addTransactionOut()
    {
      $c = Client::all();
      $i = Item::all();
      return view('transactions.form')
      ->with('method', 'out')
      ->with('items', $i)
      ->with('clients', $c);
    }
    public function submitTransactionOut(Request $r)
    {
      // return $r;
      $t = new Transaction;
      $p = new Payment;
      $amt = $r->amount_charge + $r->tax + $r->delivery;

      $t->code = $r->code;
      $t->type = 'out';
      $t->admin_id = Auth::user()->id;
      $t->user_id = $r->client;
      $t->tax = $r->tax;
      $t->delivery = $r->delivery;
      $t->accepted = false;

      $p->amount_charge = $amt;
      $p->amount_paid = $amt;
      try
      {
        $t->save();
        $p->transaction_id = $t->id;
        $p->save();
        session()->flash('message-type', 'success');
        session()->flash('message-title', 'Berhasil');
        session()->flash('message', 'Transaksi berhasil dibuat');
        for ($i=1; $i < $r->items+1; $i++)
        {
          $td = new TransactionDetail;
          $item = Item::find($r->input('item_'.$i));

          $td->parent_id = $t->id;
          $td->item_id = $r->input('item_'.$i);
          $td->quantity = $r->input('qty_'.$i);
          $td->subtotal = 0;

          $item->stock -=  $r->input('qty_'.$i);
          try
          {
            $td->save();
            $item->save();
          } catch (\Exception $e) {
            session()->flash('message-type', 'error');
            session()->flash('message-title', 'Gagal');
            session()->flash('message', 'Transaksi gagal dibuat'.$e->getMessage());
          }
        }
      }
      catch (\Exception $e) {
        session()->flash('message-type', 'error');
        session()->flash('message-title', 'Gagal');
        session()->flash('message', 'Transaksi gagal dibuat'.$e->getMessage());
      }
      return redirect()->route('show_transactios');
    }
    public function getAllItems($index)
    {
      $items = Item::all();
      return view('transactions.itemform')
      ->with('index', $index)
      ->with('items', $items);
    }
    public function showInvoice($id)
    {
      $t = Transaction::find($id);
      $td = TransactionDetail::where('parent_id',$id)->get();
      $p = Payment::where('transaction_id',$id)->first();

      return view('transactions.invoice')
      ->with('data', $t)
      ->with('details', $td)
      ->with('payment', $p);
    }

    public function clientOrderForm()
    {
      $i = Item::all();
      return view('clientarea.form')
      ->with('items', $i);
    }

    public function clientOrderSubmit(Request $r)
    {
      // return $r;
      $t = new Transaction;
      $p = new Payment;
      $delivery = 0;
      $tax = 0;
      $amt = 0;
      for ($i=1; $i < $r->items+1; $i++)
      {
        $item = Item::find($r->input('item_'.$i));
        $amt += $item->price;
      }
      $t->code = $r->code;
      $t->type = 'out';
      $t->admin_id = 1;
      $t->user_id = $r->user_id;
      $t->tax = $tax;
      $t->delivery = $delivery;
      $t->delivery_address = $r->delivery_address;
      $t->accepted = false;

      $p->amount_charge = $amt;
      $p->amount_paid = 0;
      try
      {
        $t->save();
        $p->transaction_id = $t->id;
        $p->save();
        session()->flash('message-type', 'success');
        session()->flash('message-title', 'Berhasil');
        session()->flash('message', 'Transaksi berhasil dibuat');
        for ($i=1; $i < $r->items+1; $i++)
        {
          $td = new TransactionDetail;
          $item = Item::find($r->input('item_'.$i));
          $stock = Stock::where('item_id',$item->id)->first();

          $td->parent_id = $t->id;
          $td->item_id = $r->input('item_'.$i);
          $td->quantity = $r->input('qty_'.$i);
          $td->subtotal = 0;
          $td->stock_id = $stock->id;

          $stock->stock -=  $r->input('qty_'.$i);
          try
          {
            $td->save();
            $item->save();
          } catch (\Exception $e) {
            session()->flash('message-type', 'error');
            session()->flash('message-title', 'Gagal');
            session()->flash('message', 'Transaksi gagal dibuat'.$e->getMessage());
          }
        }
      }
      catch (\Exception $e) {
        session()->flash('message-type', 'error');
        session()->flash('message-title', 'Gagal');
        session()->flash('message', 'Transaksi gagal dibuat'.$e->getMessage());
      }
      return redirect()->route('client_order_invoice',$t->id);
    }

    public function clientOrderInvoice($id)
    {
      $t = Transaction::find($id);
      $td = TransactionDetail::where('parent_id',$id)->get();

      return view('clientarea.invoice')
      ->with('data', $t)
      ->with('details', $td);
    }

    public function clientOrderList($id)
    {
      $t = Transaction::where('user_id',$id)->get();

      return view('clientarea.list')
      ->with('transactions', $t);
    }
}
