<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        checkOrder();

        function checkOrder() {
            var numdoing = parseInt($('#numdoing').val());
            $.ajax({
                type: 'POST',
                url: 'checkorder.php',
                data: { row: numdoing,function: 'numdoing' }, 
                success: function(data) {
                    if (data == 1) {
                        location.reload();
                    } 
                }
            });
            var numprepare = parseInt($('#numprepare').val());
            $.ajax({
                type: 'POST',
                url: 'checkorder.php',
                data: { row: numprepare,function: 'numprepare' }, 
                success: function(data) {
                    if (data == 1) {
                        location.reload();
                    } 
                }
            });

            var numship = parseInt($('#numship').val());
            $.ajax({
                type: 'POST',
                url: 'checkorder.php',
                data: { row: numship,function: 'numship' }, 
                success: function(data) {
                    if (data == 1) {
                        location.reload();
                    } 
                }
            });

            var numshiped = parseInt($('#numshiped').val());
            $.ajax({
                type: 'POST',
                url: 'checkorder.php',
                data: { row: numshiped,function: 'numshiped' }, 
                success: function(data) {
                    if (data == 1) {
                        location.reload();
                    } 
                }
            });

            var numsuccess = parseInt($('#numsuccess').val());
            $.ajax({
                type: 'POST',
                url: 'checkorder.php',
                data: { row: numsuccess,function: 'numsuccess' }, 
                success: function(data) {
                    if (data == 1) {
                        location.reload();
                    } 
                }
            });

            var numcancle = parseInt($('#numcancle').val());
            $.ajax({
                type: 'POST',
                url: 'checkorder.php',
                data: { row: numcancle,function: 'numcancle' }, 
                success: function(data) {
                    if (data == 1) {
                        location.reload();
                    } 
                }
            });

            var numall = parseInt($('#numall').val());
            $.ajax({
                type: 'POST',
                url: 'checkorder.php',
                data: { function: 'numall' }, 
                success: function(data) {
                    if (data == 1) {
                        location.reload();
                    } 
                }
            });
            var numnew = $('#numnew').val();
            $.ajax({
                type: 'POST',
                url: 'checkorder.php',
                data: { row:$('#numnew').val(),function: 'numnew' }, 
                success: function(data) {
                    if (data == 1) {
                        location.reload();
                    } 
                },
                complete: function() {
                    setTimeout(checkOrder, 5000); 
                }
            });
        }
    });

</script>