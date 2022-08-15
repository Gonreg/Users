//Скрипт с ajax запросом

$(document).ready(function() {
    $('form').submit(function(event) {
        var json;
        event.preventDefault();
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(result) {
                json = jQuery.parseJSON(result);
                if(json.url) {
                    window.location.href = json.url;
                } else {
                    let mess = $('.' + json.message.split(',')[0] + '_invalid-feedback');
                    mess.html('<div class = alert>' + json.message.split(',')[1] + '</div>')
                }
            },

        });
    });
});