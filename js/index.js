$(function(){
    $('form').submit(function(event){
        var $data = {}
        $(this).find('input').each(function(){
            $data[this.name] = $(this).val()
        });
        event.preventDefault();
        // console.log($data)
        $.ajax({
            type: "POST",
            url: "success.php",
            data: $data,
            dataType: "html",
            success: function (response) {
                if(response == 'error'){
                    location.reload();
                }
                if(response == 'redirect'){
                    $(location).attr("href", '/')
                }
            }
        })
        .fail(function(){
            console.log('error')
        })
        
    });
})