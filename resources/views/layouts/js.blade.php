<script type="text/javascript">
  @if (Session::has('message'))
    toastr.{{Session::get('message-type')}}("{{Session::get('message')}}");
    Swal.fire("{{Session::get('message-title')}}","{{Session::get('message')}}","{{Session::get('message-type')}}");
  @endif
  $(".select2").select2();
  $(".datatable").DataTable({
    responsive:true
  });
  function showImage(input)
  {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(event) {
          $("#displayImage").attr('src',event.target.result);
        }
        reader.readAsDataURL(input.files[0])
      }
  }
  $("#imageInput").on('change', function() {
    showImage(this);
  })
  $("#newCategoryBtn").on('click',function()
  {
    if ($(this).data('method') == true) {
      $("#newCategoryCol").slideDown(100);
      $(this).data('method','false');
      $(this).removeClass('btn-info');
      $(this).addClass('btn-danger');
      $(this).html('Batal Tambah');

      $("#categorySelect")[0].prop('readonly',false).attr('selected',true);
      $("#categorySelect")[0].prop('readonly',true);
      // var new_cat = '<option selected disabled value="new" id="newCatOpt">kategori baru..</option>';
      // $("#categorySelect").append(new_cat);
    }
    else
    {
      $("#newCategoryCol").slideUp(100);
      $(this).data('method','true');
      $(this).removeClass('btn-danger');
      $(this).addClass('btn-info');
      $(this).html('Tambah Kategori');
      $("#newCatInput").val("");
      $("#categorySelect")[0].prop('readonly',false).attr('selected',true);
      $("#categorySelect")[0].prop('readonly',true);
      $("#newCatOpt").remove();
    }
  });
  var itemIndex = 0;
  $("#vendorSelect,#clientSelect").on('change',function() {
    $("#fieldset").slideDown(250);
    $("#itemsCol").html();
    itemIndex = 0;
  });
  $("#vendorSelect").on('change',function() {
    $("#fieldset").slideDown(250);
    $("#itemsCol").html();
    itemIndex = 0;
  });
  $("#addItem").on('click',function() {
    var nextIndex = itemIndex+1;
    var vendor = $("#vendorSelect").val();
    if ($("#formMethod").val() == 'in') {
      var action = "/transaction/get_items&index="+nextIndex+"&vendor="+vendor;
    }
    else {
      var action = "/transaction/get_all_items&index="+nextIndex;
    }
    $.get({
      url:action,
      dataType : "HTML",
      success:function(response)
      {
          $("#itemsCol").append(response);
          itemIndex += 1;
          $("#itemsCount").val(parseInt($("#itemsCount").val())+1);
      }
    });
  });
  $("#editCode").on('click',function() {
    $("#codeInput").prop('readonly',false);
  });
  $(".printBtn").on('click',function() {
    $(".invoice").printThis({
      importCSS: true,
      loadCSS: "{{asset('alt/dist/css/adminlte.min.css')}}",
      importStyle: true,
    });
  })
</script>
