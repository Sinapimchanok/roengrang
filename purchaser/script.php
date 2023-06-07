<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        sendRequest();

        function sendRequest() {
            var st = $('#st').val();
            var review_status = $('#review_status').val();
            var Reason = $('#Reason').val();
            $.ajax({
                type: 'POST',
                url: 'checkst.php',
                data: { id: $('#id').val() }, // Sending data as an object
                success: function(data) {
                    if (data != st) {
                        switch (parseInt(data)) {
                            case 0:
                                $('#status').text("สั่งซื้อสินค้าแล้ว");
                                $('#oparetion').html('<div><button type="button" data-toggle="modal" data-target="#cancleModal" class="btn btn-danger">ยกเลิกคำสั่งซื้อ</button></div>');
                                break;
                            case 1:
                                $('#status').html("กรุณาตรวจสอบค่าจัดส่ง<br>ที่ร้านค้าแจ้งใหม่อีกครั้ง");
                                $('#oparetion').html('<div class="row mb-1"><div><button id="st1" type="button" class="btn btn-primary">ตอบรับคำสั่งซื้อ</button></div></div><div class="row mb-1"><div><button type="button" data-toggle="modal" data-target="#cancleModal" class="btn btn-danger">ยกเลิกคำสั่งซื้อ</button></div></div>');
                                break;
                            case 2:
                                $('#status').text("อยู่ระหว่างเตรียมสินค้า");
                                $('#oparetion').html('');
                                break;
                            case 3:
                                $('#status').text("อยู่ระหว่างขนส่งสินค้า");
                                $('#oparetion').html('');
                                break;
                            case 4:
                                $('#status').html("สินค้าถูกจัดส่งแล้ว<br>กรุณารับสินค้า");
                                $('#oparetion').html('<div><button type="button" data-toggle="modal" data-target="#receiveModal" class="btn btn-primary">ได้รับสินค้าแล้ว</button></div>');
                                break;
                            case 5:
                                if($('#review_status').val()==0){
                                    $('#status').text("คำสั่งซื้อสำเร็จแล้ว");
                                    $('#oparetion').html('<div class="row mb-1"><div><button type="button" data-toggle="modal" data-target="#reviewModal" class="btn btn-primary">ให้คะแนน และรีวิวสินค้า</button></div></div>');
                                    break;
                                }else{
                                    $('#status').text("คำสั่งซื้อสำเร็จแล้ว");
                                    $('#oparetion').html('ขอบคุณสำหรับความคิดเห็น');
                                    break;
                                }
                            case 6:
                                $('#status').text("คำสั่งซื้อถูกยกเลิก");
                                $('#oparetion').html('<p>เหตุผล</p><p>'+ Reason +'</p>');
                                break;
                        }
                        $('#st').val(data);
                    }else{
                        switch (parseInt(data)) {
                            case 0:
                                $('#status').text("สั่งซื้อสินค้าแล้ว");
                                $('#oparetion').html('<div><button type="button" data-toggle="modal" data-target="#cancleModal" class="btn btn-danger">ยกเลิกคำสั่งซื้อ</button></div>');
                                break;
                            case 1:
                                $('#status').html("กรุณาตรวจสอบค่าจัดส่ง<br>ที่ร้านค้าแจ้งใหม่อีกครั้ง");
                                $('#oparetion').html('<div class="row mb-1"><div><button id="st1" type="button" class="btn btn-primary">ตอบรับคำสั่งซื้อ</button></div></div><div class="row mb-1"><div><button type="button" data-toggle="modal" data-target="#cancleModal" class="btn btn-danger">ยกเลิกคำสั่งซื้อ</button></div></div>');
                                break;
                            case 2:
                                $('#status').text("อยู่ระหว่างเตรียมสินค้า");
                                $('#oparetion').html('');
                                break;
                            case 3:
                                $('#status').text("อยู่ระหว่างขนส่งสินค้า");
                                $('#oparetion').html('');
                                break;
                            case 4:
                                $('#status').html("สินค้าถูกจัดส่งแล้ว<br>กรุณารับสินค้า");
                                $('#oparetion').html('<div><button type="button" data-toggle="modal" data-target="#receiveModal" class="btn btn-primary">ได้รับสินค้าแล้ว</button></div>');
                                break;
                            case 5:
                                if($('#review_status').val()==0){
                                    $('#status').text("คำสั่งซื้อสำเร็จแล้ว");
                                    $('#oparetion').html('<div class="row mb-1"><div><button type="button" data-toggle="modal" data-target="#reviewModal" class="btn btn-primary">ให้คะแนน และรีวิวสินค้า</button></div></div>');
                                    break;
                                }else{
                                    $('#status').text("คำสั่งซื้อสำเร็จแล้ว");
                                    $('#oparetion').html('ขอบคุณสำหรับความคิดเห็น');
                                    break;
                                }
                            case 6:
                                $('#status').text("คำสั่งซื้อถูกยกเลิก");
                                $('#oparetion').html('<p>เหตุผล</p><p>'+ Reason +'</p>');
                                break;
                        }
                        $('#st').val(data);
                    }
                },
                complete: function() {
                    // Schedule the next request when the current one is complete
                    setTimeout(sendRequest, 5000); // Using setTimeout instead of setInterval
                }
            });
        }
    });
    
    $(document).on('click', '#st1', function() {
        $.ajax({
            type: 'POST',
            url: 'update.php',
            data: { id: $('#id').val(), order_status: 2, function: 'update_order_status1' },
            success: function(response) {
                console.log(response);
                if (response == "2") {
                    $('#st').val(response);
                    $('#status').html("อยู่ระหว่างเตรียมสินค้า");
                    $('#oparetion').html('');
                } else {
                    console.log("Failed to fetch the updated order status.");
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    $(document).on('click', '#st4', function() {
        $.ajax({
            type: 'POST',
            url: 'update.php',
            data: { id: $('#id').val(), order_status: 5, function: 'update_order_status' },
            success: function(response) {
                console.log(response);
                if (response == "5") {
                    $('#st').val(response);
                    $('#status').text("คำสั่งซื้อสำเร็จแล้ว");
                    $('#oparetion').html('<div class="row mb-1"><div><button type="button" class="btn btn-primary">ให้คะแนน และรีวิวสินค้า</button></div></div>');
                } else {
                    console.log("Failed to fetch the updated order status.");
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
    $(document).on('click', '#st6', function() {
        var cancleReason = $('#cancleReason').val();
        if(cancleReason==""){
            alert("กรุณาใส่เหตุผลในการยกเลิก");
        }else{
            $.ajax({
            type: 'POST',
            url: 'update.php',
            data: { id: $('#id').val(), order_status: 6,cancleReason: cancleReason, function: 'update_order_status6' },
            success: function(response) {
                console.log(response);
                if (response == "6") {
                    location.reload();
                } else {
                    console.log("Failed to fetch the updated order status.");
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
        }
    });
</script>