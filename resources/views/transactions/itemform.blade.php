<div class="row">
  <div class="form-group col-7">
    <label>Barang ke-{{$index}}</label>
    <select class="select2 form-control" name="item_{{$index}}">
      <option value="0" selected disabled>pilih barang...</option>
      @foreach ($items as $i)
        <option value="{{$i->id}}">{{$i->item_name}}</option>
      @endforeach
    </select>
  </div>
  <div class="col-3 form-group">
    <label>Ukuran</label>
    <select class="form-control" name="size_{{$index}}">
      <option selected disabled>pilih ukuran...</option>
      <option value="XS">XS</option>
      <option value="S">S</option>
      <option value="M">M</option>
      <option value="L">L</option>
      <option value="XL">XL</option>
      <option value="XXL">XXL</option>
    </select>
  </div>
  <div class="col-2 form-group">
    <label>Jumlah</label>
    <input type="number" name="qty_{{$index}}" class="form-control" value="1">
  </div>
</div>
<script type="text/javascript">
  $("select").select2();
</script>
