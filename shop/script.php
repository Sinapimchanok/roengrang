<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    
    $(document).ready(function() {

        sendRequest();

        function sendRequest() {
            var st = $('#st').val();
            var Reason = $('#Reason').val();
            $.ajax({
                type: 'POST',
                url: 'checkst.php',
                data: { id: $('#id').val() }, // Sending data as an object
                success: function(data) {
                    if (data != st) {
                        switch (parseInt(data)) {
                            case 0:
                                $('#status').text("คำสั่งซื้อใหม่ กรุณาตอบรับคำสั่งซื้อ");
                                $('#oparetion').html('<div class="row mb-1"><div><button id="opensentPriceModal" type="button" class="btn btn-primary">ตอบรับคำสั่งซื้อ</button></div></div><div class="row mb-1"><div><button id="openCancleModal" class="btn btn-danger">ยกเลิกคำสั่งซื้อ</button></div></div>');
                                break;
                            case 1:
                                $('#status').html("แจ้งค่าจัดส่งสินค้าแล้ว<br>รอลูกค้ายืนยันคำสั่งซื้อ");
                                $('#oparetion').html('<div class="row mb-1"><div><button id="st1" type="button" class="btn btn-primary">เริ่มเตรียมสินค้า</button></div></div>');
                                break;
                            case 2:
                                $('#status').html("อยู่ระหว่างเตรียมสินค้า<br>กรุณาจัดส่งสินค้าเมื่อเสร็จสิ้น");
                                $('#oparetion').html('<div class="row mb-1"><div><button id="openshipModal" type="button" class="btn btn-primary">ส่งสินค้า</button></div></div>');
                                break;
                            case 3:
                                $('#status').text("อยู่ระหว่างขนส่งสินค้า");
                                $('#oparetion').html('<div class="row mb-1"><div><button id="opensentModal" type="button" class="btn btn-primary">ส่งสินค้าแล้ว</button></div></div>');
                                break;
                            case 4:
                                $('#status').text("จัดส่งสินค้าสำเร็จแล้ว");
                                $('#oparetion').html('<div class="row mb-1 text-center text-danger">*คำสั่งซื้อนี้จะสำเร็จต่อเมื่อลูกค้าได้รับสินค้าแล้ว</div>');
                                break;
                            case 5:
                                $('#status').text("คำสั่งซื้อสำเร็จแล้ว");
                                $('#oparetion').html('');
                                break;
                            case 6:
                                $('#status').text("คำสั่งซื้อถูกยกเลิก");
                                $('#oparetion').html('<p>เหตุผล</p><p>'+ Reason +'</p>');
                                break;
                        }
                        $('#st').val(data);
                    }else{
                        switch (parseInt(data)) {
                            case 0:
                                $('#status').text("คำสั่งซื้อใหม่ กรุณาตอบรับคำสั่งซื้อ");
                                $('#oparetion').html('<div class="row mb-1"><div><button id="opensentPriceModal" type="button" class="btn btn-primary">ตอบรับคำสั่งซื้อ</button></div></div><div class="row mb-1"><div><button id="openCancleModal" class="btn btn-danger">ยกเลิกคำสั่งซื้อ</button></div></div>');
                                break;
                            case 1:
                                $('#status').html("แจ้งค่าจัดส่งสินค้าแล้ว<br>รอลูกค้ายืนยันคำสั่งซื้อ");
                                $('#oparetion').html('');
                                break;
                            case 2:
                                $('#status').html("อยู่ระหว่างเตรียมสินค้า<br>กรุณาจัดส่งสินค้าเมื่อเสร็จสิ้น");
                                $('#oparetion').html('<div class="row mb-1"><div><button id="openshipModal" type="button" class="btn btn-primary">ส่งสินค้า</button></div></div>');
                                break;
                            case 3:
                                $('#status').text("อยู่ระหว่างขนส่งสินค้า");
                                $('#oparetion').html('<div class="row mb-1"><div><button id="opensentModal" type="button" class="btn btn-primary">ส่งสินค้าแล้ว</button></div></div>');
                                break;
                            case 4:
                                $('#status').text("จัดส่งสินค้าสำเร็จแล้ว");
                                $('#oparetion').html('<div class="row mb-1 text-center text-danger">*คำสั่งซื้อนี้จะสำเร็จต่อเมื่อลูกค้าได้รับสินค้าแล้ว</div>');
                                break;
                            case 5:
                                $('#status').text("คำสั่งซื้อสำเร็จแล้ว");
                                $('#oparetion').html('');
                                break;
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


    

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $(document).on('click', '#st0', function() {
        var sentprice = $('#sentprice').val();
        if(sentprice==""){
            alert("กรุณาใส่ค่าจัดส่ง");
        }else{
            $.ajax({
                type: 'POST',
                url: 'update.php',
                data: { id: $('#id').val(), order_status: 1,sentprice: sentprice, function: 'update_order_status0' },
                success: function(response) {
                    console.log(response);
                    if (response == "1") {
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

    $(document).on('click', '#st2', function() {
        var ship_img = $('#ship_img').val();
        if(ship_img==""){
            alert("กรุณาเพิ่มรูปถ่ายส่งสินค้า");
        }else{
            $.ajax({
                type: 'POST',
                url: 'update.php',
                data: { id: $('#id').val(), order_status: 3,ship_img: ship_img, function: 'update_order_status2' },
                success: function(response) {
                    console.log(response);
                    alert(response);
                    // if (response == "3") {
                    //     location.reload();
                    // } else {
                    //     console.log("Failed to fetch the updated order status.");
                    // }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });

    $(document).on('click', '#st3', function() {
        $.ajax({
            type: 'POST',
            url: 'update.php',
            data: { id: $('#id').val(), order_status: 4, function: 'update_order_status' },
            success: function(response) {
                console.log(response);
                if (response == "4") {
                    $('#st').val(response);
                    $('#status').text("จัดส่งสินค้าสำเร็จแล้ว");
                    $('#oparetion').html('<div class="row mb-1 text-center text-danger">*คำสั่งซื้อนี้จะสำเร็จต่อเมื่อลูกค้าได้รับสินค้าแล้ว</div>');
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
<script>
    $(document).on('click', '#openCancleModal', function() {
        document.getElementById('cancleModal').style.display = 'block';
    });
    var closeCancleModal = function() {
        document.getElementById('cancleModal').style.display = 'none';
    };

    document.getElementById('cancleModalCloseBtn').addEventListener('click', closeCancleModal);
    document.getElementsByClassName('close')[0].addEventListener('click', closeCancleModal);
</script>

<script>
    $(document).on('click', '#openConfermModal', function() {
        document.getElementById('confermModal').style.display = 'block';
    });
    var closeConfermModal = function() {
        document.getElementById('confermModal').style.display = 'none';
    };

    document.getElementById('confermModalCloseBtn').addEventListener('click', closeConfermModal);
    document.getElementsByClassName('close')[1].addEventListener('click', closeConfermModal);
</script>

<script>
    $(document).on('click', '#opensentPriceModal', function() {
        document.getElementById('sentPriceModal').style.display = 'block';
    });
    var closesentPriceModal = function() {
        document.getElementById('sentPriceModal').style.display = 'none';
    };

    document.getElementById('sentPriceModalCloseBtn').addEventListener('click', closesentPriceModal);
    document.getElementsByClassName('close')[2].addEventListener('click', closesentPriceModal);
</script>

<script>
    $(document).on('click', '#openshipModal', function() {
        document.getElementById('shipModal').style.display = 'block';
    });
    var closeshipModal = function() {
        document.getElementById('shipModal').style.display = 'none';
    };

    document.getElementById('shipModalCloseBtn').addEventListener('click', closeshipModal);
    document.getElementsByClassName('close')[3].addEventListener('click', closeshipModal);
</script>

<script>
    $(document).on('click', '#opensentModal', function() {
        document.getElementById('sentModal').style.display = 'block';
    });
    var closesentModal = function() {
        document.getElementById('sentModal').style.display = 'none';
    };

    document.getElementById('sentModalCloseBtn').addEventListener('click', closesentModal);
    document.getElementsByClassName('close')[4].addEventListener('click', closesentModal);
</script>
