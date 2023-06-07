<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
  $('#provinces').change(function() {
    var id_province = $(this).val();

      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {id:id_province,function:'provinces'},
      success: function(data){
          $('#district').html(data); 
          $('#subdistrict').html(data); 
          $('#zip_code').attr('placeholder', 'กรุณาเลือกอำเภอ/เขต');
      }
    });
  });

  $('#district').change(function() {
    var id_district = $(this).val();

      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {id:id_district,function:'district'},
      success: function(data){
          $('#subdistrict').html(data); 
          $('#zip_code').attr('placeholder', 'กรุณาเลือกตำบล/แขวง');
      }
    });
  });

   $('#subdistrict').change(function() {
    var id_subdistrict= $(this).val();

      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {id:id_subdistrict,function:'subdistrict'},
      success: function(data){
          $('#zip_code').val(data)
      }
    });
  
  });

  $("#id_chk").change(() => {
    if($("#id_chk").is(":checked")) {
      console.log("checked");
      $("body").css("background-color", "greenyellow");
      $("#title").text("ON");
      Swal.fire({
        icon: 'success',
        title: 'success',
        text: "wait a sec",
        timer: 1000
      })
    } else {
      console.log("unchecked");
      $("body").css("background-color", "unset");
      $("#title").text("OFF");
      Swal.fire({
        icon: 'success',
        title: 'success',
        text: "wait a sec",
        timer: 1000
      })
    }
  });


</script>