$(function(){
    $('.btn-form').click(function(){
        var $data = {}
        $(this).parent().find('input').each(function(){
            $data[this.name] = $(this).val()
        })
        console.log($data)
        $.ajax({
            type: "POST",
            url: "success.php",
            data: $data,
            dataType: "html",
            success: function (response) {
                console.log(response)
                if(response == 'error'){
                    location.reload();
                }
                if(response == 'redirect'){
                    $(location).attr("href", '/')
                }
                if(response == 'reg'){
                    $(location).attr("href", '/login')
                }
            }
        })
        .fail(function(){
            console.log('error')
        })
    })



})