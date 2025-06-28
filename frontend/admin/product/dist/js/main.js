jQuery(document).ready(function($){
    $.ajax({
        url:"./../../delete_select.php",
        method:"get",
        dataType:"json",
        success:function(response){
            if(response.status == 200){
                response.message.forEach(function(products){
                        alert("Delete?")
                })
            }
        }
    })
    
})