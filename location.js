      $("#numero").focusout(function(){
        //Início do Comando AJAX
        var tudo  = ('https://api.mapbox.com/geocoding/v5/mapbox.places/'+$("#endereco").val() +'%20'+ $("#numero").val() +'%20'+ $("#cidade").val() +'%20'+ $("#cep").val()+'.json?proximity=-51.5470092,-22.2344993&limit=1&access_token=pk.eyJ1Ijoiam9obmxjcnV6MjIiLCJhIjoiY2swczQ5azZjMDU4bTNtbnhnaWIyZjh1biJ9.dMjg8smievnyZ-D86AB6CQ');
        var busca = tudo.replace(' ', '%20');
        $.ajax({
            url     :  busca,
            dataType: 'json',

            success: function(resposta){
                $("#latlong").val(resposta['features']['0']['center']);
                $("#latlong").hide();
                $("#cidade").hide();
                $("#professor").focus();
            }
        });
    });
