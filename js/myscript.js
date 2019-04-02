jQuery( document ).ready(function($) {
    $('form').submit(function(e){
        e.preventDefault();
        var data = Array;
        data['distrito_nombre'] = $('select').val();
        data['longitud'] = $('input[name=longitud').val();
        data['latitud'] = $('input[name=latitud').val();
        data['distancia'] = $('input[name=distancia').val();
        console.log(data);
        $.ajax({
            url: '/justTable',
            type: 'POST',
            data: data,
            success: function(data){
                $('#result').html(data);
            }
        });
    });
});
