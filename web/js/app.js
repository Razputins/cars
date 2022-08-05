function ChangeUrl(title, url) {
    if (typeof (history.pushState) != "undefined") {
        var obj = {Title: title, Url: url};
        history.pushState(obj, obj.Title, obj.Url);
    } else {
        alert("Browser does not support HTML5.");
    }
}

function ArrayToString(data){
    var string = '';
    console.log('asdasd');
    $.each(data, function(index, value){
        console.log("INDEX: " + index + " VALUE: " + value);
    });
}

$(document).ready(function () {
    $('.check-param').on('change', function () {
        var ajax_param = [];
        $('.param-cover').each(function () {
            var cat = $(this).attr('data-cat');
            var array = [];
            $(this).find('.check-param:checkbox:checked').each(function (){
                array.push($(this).val());
            });
            if(array.length > 0){
                ajax_param.push(cat+'='+array.join(','));
            }
        });
        var url = window.location.pathname;
        $.ajax({
            url: '/catalog/list',
            data: {url:url, ajax_str:ajax_param.join('&')},
            success: function (data) {
                if (data.length > 0) {
                    $('#car-list').html(data);
                    if (ajax_param.length > 0) {
                        ChangeUrl('', '?' + ajax_param.join('&'));
                    }else{
                        ChangeUrl('', window.location.pathname);
                    }
                }
            }
        });

    });
});