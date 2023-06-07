	
	<script>
		$('#searchbtn').click(function() {
			// Get the values of cat and search
			var cat = $('#cat').val();
			var search = $('#search').val();
			if(cat=='shop'){
				var url = 'shop.php?search=' + search;
			}else{
				var url = 'search.php?cat=' + cat + '&search=' + search;
			}
			
			window.location.href = url;
		});
	</script>
	<script>
        function likes(productId) {
			var button = document.getElementById('Like' + productId);
            $.ajax({
                url: "ajax_db.php",
                type: "POST",
                data: { product_id: productId,function:'addlike' },
                success: function(response) {
					if(response==productId){
					button.innerHTML = '<i class="fa fa-heart"></i><span>ยกเลิกถูกใจสินค้า</span>';
					button.setAttribute('title', 'ยกเลิกกดถูกใจ');
					button.setAttribute('onclick', "unlikes('" + productId + "')");
					}
                }
            });
        }
		function unlikes(productId) {
			var button = document.getElementById('Like' + productId);
            $.ajax({
                url: "ajax_db.php",
                type: "POST",
                data: { product_id: productId,function:'unlike'},
                success: function(response) {
					if(response==productId){
						button.innerHTML = '<i class="ti-heart"></i><span>ถูกใจสินค้า</span>';
						button.setAttribute('title', 'กดถูกใจ');
						button.setAttribute('onclick', "likes('" + productId + "')");
					}
                }
            });
        }
		function addcart(productId) {
            $.ajax({
                url: "ajax_db.php",
                type: "POST",
                data: { product_id: productId,product_amount: 1,function:'addcart' },
                success: function(response) {
					if(response=="shop"){
						alert("คุณไม่สามารถซื้อสินค้าภายในร้านของคุณได้");
            		}
					if(response=="amount"){
						alert("จำนวนสินค้าในคลัง ไม่เพียงพอต่อความต้องการของคุณ");
					}
					else {
						$('#cartcount').text(response); 
					}
                }
            });
        }
		function addcartamount(productId) {
			var quant = $('#quant').val();
            $.ajax({
                url: "ajax_db.php",
                type: "POST",
                data: { product_id: productId,product_amount: quant,function:'addcart' },
                success: function(response) {
					if(response=="shop"){
						alert("คุณไม่สามารถซื้อสินค้าภายในร้านของคุณได้");
            		}
					if(response=="amount"){
						alert("จำนวนสินค้าในคลัง ไม่เพียงพอต่อความต้องการของคุณ");
					}
					else {
						$('#cartcount').text(response); 
					}
                }
            });
        }
    </script>