
            $(document).on('click', 'button#buy', function(){
    			$('#coin').html();
                $.ajax({
                    url:'/coin/buy',
                    type: "POST",
                    dataType: "json",
                    async: true,
                    success: function (data)
                    {

                        $('#verify-code').val(data.hash);
                        $('#coin').html(data.coin);

                    }
                });
                return false;

            });
            $(document).on('click', 'button#verify', function(){
            	$('.result').html();
                $.ajax({
                    url:'/coin/check',
                    type: "POST",
                    data:"code=" + $('#verify-code').val(),
                    dataType: "json",
                    async: true,
                    success: function (data)
                    {
                
                          

                        $('.result').html('<p>' + data.coin + '<p>');

                    },
                    error :function(data){
                         $('.result').html('<p class="text-danger">' + data.responseJSON.error + '<p>');
                    }
                });
                return false;

            });