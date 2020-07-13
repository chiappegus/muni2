    



var $local = "http://localhost/muni/public";
var $dni = $('.valorDNI').val()

var $directionAbs = $('#ruta_Admin').attr('href');

var $res = $directionAbs.replace("aca", "");
//console.log($res);


function consultaDNI($dni) {

    $.ajax({
        method: 'GET',
        //url: $local + "/admin/controlDni/" + $dni,
        url:   $res + "admin/controlDni/" + $dni,
    }).done(function(data) {
        //console.log($('.valorDNI').val());
        console.log(data.valor);
        if (data.valor) {
            console.log('aca estoy');
            cambiarColor();
        } else {
            cambiarColorFalse();
        }
    });
}
var $local = "http://localhost/muni/public";

function cambiarColor() {
    //$('.valorDNI').addClass("text-green");;
    //$("p").css("background-color", "yellow");
    $('.valorDNI').css("background-color", "grey");
    //$('.valorDNI').css({ display: "block" });;
}

function cambiarColorFalse() {
    $('.valorDNI').css("background-color", "white");
}
//alert( '¡Hola, Mundo!' );
//console.log('Hola');
$(document).ready(function() {


var $local = "http://localhost/muni/public";
   

/*   $('button#boton').on('click', function(e) {

        alert( '¡Hola, Mundo!' );
       
        
        $.ajax({
            method: 'GET',
            url: $local + "/admin/arrayGus/" +  $('.valorDNI').val(),
        }).done(function(data) {
            //console.log($('.valorDNI').val());
            console.log(data);
            if (data) {
            	alert("success: " + data.message);
                //console.log(data.personas.length);
                //Array.isArray(data.personas)
                console.log($local + "/admin/arrayGus/" +  $('.valorDNI').val())
                console.log(data.toString())
               // var content = JSON.parse(data[1]);
                // console.log(content)
                // console.log(whichIsVisible(data))
                

                
                         
                
                //var obj = data.valors
                //console.log(obj);
            }
        });
    })*/




    $('#num').on("keyup", function() {
        if (!this.value == "") {
            consultaDNI(this.value);
        } else {
            console.log('no pasas');
        }
    });
    //$( "p" ).removeClass( "myClass noClass" ).addClass( "yourClass" );
    $('.buscar').addClass("myClass yourClass");
    $('.buscar').on('click', function(e) {
        $('.buscar').removeClass('myClass yourClass').addClass("spinner-border").html('')
        //e.preventDefault();
        //$('.buscar').button('loading');
        //$('.buscar').button('btn-success');
        //alert( '¡Hola, Mundo!' );
    });
    $('.corazon').on('click', function(e) {
        console.log($res);
        //alert( '¡Hola, Mundo!' );
        e.preventDefault();
        var URLactual = window.location;
        //alert(URLactual);
        var $link = $(e.currentTarget);
        //alert( $link[0] );
        var $dni = $('.valorDNI').val()
        var $local = "http://localhost/muni/public";
        $link.toggleClass('spinner-grow spinner-grow-sm').toggleClass('glyphicon glyphicon-envelope ');
        $.ajax({
           // url: $local + "/admin/controlDni/" + $dni,
            url: $res + "admin/controlDni/" + $dni,
            method: "GET",
            // method: 'GET',
            ///admin/persona
            //  url:"/admin/controlDni/"+ $dni,
            //url: '/Controller/Search', 
            //data: "{queryString:'" + searchVal + "'}",
            // url: 'http://localhost/muni/public/admin/controlDni/' + $dni,
            // url:"{{ path('persona_admin_dni', {'q': 26258210}) }}",
            //url:"{{ (path('persona_admin_dni'), {'q': 26258210}) }}",
            //  url: " {{(path('persona_admin_dni'),{'q':" + $dni +"})}}",
            // data: "",
        }).done(function(data) {
            console.log($('.valorDNI').val());
           console.log(data.valor);
        });
        /* var MyAppUrlSettings = {
    			MyUsefulUrl : '@Url.Action("recentArticles","PersonaAdmin")'
		}*/
        //alert(MyAppUrlSettings)
    });

});