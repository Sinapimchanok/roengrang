<?php 
    session_start();

    if(!isset($_SESSION["intLine"]))    //เช็คว่าแถวเป็นค่าว่างมั๊ย ถ้าว่างให้ทำงานใน {}
    {
        $_SESSION["intLine"] = 0; 
        $_SESSION["strProductID"][0] = "";   //รหัสสินค้า
        $_SESSION["strQty"][0] = "";         //จำนวนสินค้า
    }

    include_once('functions.php'); 
    include_once('layout.php'); 
    include_once('include/nav.php');

    if ($_SESSION['id'] == "") {
        header("location: signin.php");
    } else {

    $sql = new DB_con();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ร้านค้าชุมชนเริงราง</title>

    <style>

        /* Style the tab */
        .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
        }

        /* Style the buttons inside the tab */
        .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
        background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
        background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
        display: none;
        padding: 6px 12px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-top: none;
        }
    </style>
</head>
<body>

    <div class="container px-4 px-lg-5 mt-5">
        <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'all')" id="defaultOpen">ทั้งหมด</button>
            <button class="tablinks" onclick="openCity(event, 'shipping')">กำลังเตรียมจัดส่ง</button>
            <button class="tablinks" onclick="openCity(event, 'recieve')">อยู่ระหว่างขนส่ง</button>
        </div>

        <div id="all" class="tabcontent">
            <div class="card m-2 p-2" href="#">
                <div class="row">
                    <div class="col-9">
                        ชื่อร้านค้า
                    </div>
                    <div class="col-3" ALIGN="right">
                        สถานะ
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-2">
                        <img src="img/<?=$procart['pro_img']?>.jpg" width="80px" height="90px" class="border" >
                    </div>
                    <div class="col-5">
                        ชื่อรายละเอียด
                    </div>
                    <div class="col-3">
                        ราคา:300
                    </div>
                    <div class="col-2">
                        จำนวน:
                    </div>
                </div>
            </div>
        </div>

        <div id="shipping" class="tabcontent">
            <div class="card m-2 p-2">
                <div class="row">
                    <div class="col-9">
                        ชื่อร้านค้า
                    </div>
                    <div class="col-3" ALIGN="right">
                        สถานะ
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-2">
                        <img src="img/<?=$procart['pro_img']?>.jpg" width="80px" height="90px" class="border" >
                    </div>
                    <div class="col-5">
                        ชื่อรายละเอียด
                    </div>
                    <div class="col-3">
                        ราคา:300
                    </div>
                    <div class="col-2">
                        จำนวน:
                    </div>
                </div>
            </div>
        </div>

        <div id="recieve" class="tabcontent">
            <div class="card m-2 p-2">
                <div class="row">
                    <div class="col-9">
                        ชื่อร้านค้า
                    </div>
                    <div class="col-3" ALIGN="right">
                        สถานะ
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-2">
                        <img src="img/<?=$procart['pro_img']?>.jpg" width="80px" height="90px" class="border" >
                    </div>
                    <div class="col-5">
                        ชื่อรายละเอียด
                    </div>
                    <div class="col-3">
                        ราคา:300
                    </div>
                    <div class="col-2">
                        จำนวน:
                    </div>
                </div>
            </div>
        </div>
    </div>
    

<script>
    function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
</body>
</html>


<?php 

}
?>
    