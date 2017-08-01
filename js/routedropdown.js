$.getJSON("http://rondevanjoris.com/routes.php", function(json){
        $('#routedropdown').empty();
        $('#routedropdown').append($('<option>').text("Selecteer een route").attr('value', ''));
        $.each(json, function(i, obj){
                $name = obj.date + " " + obj.route + " ("+ obj.places + ")"
                if (obj.places > 0){
                    $('#routedropdown').append($('<option>').text($name).attr('value', obj.id));
                }
        });
});
