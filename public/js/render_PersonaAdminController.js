  $(document).ready(function() {

/*var MyAppUrlSettings = {
    MyUsefulUrl : '@Url.Action("arrayGus","PersonaAdminController")'
}

alert(MyAppUrlSettings.MyUsefulUrl);
var $local = "http://localhost/muni/public";*/

var pathname = window.location.pathname;
//alert(pathname);

var URLactual = window.location;
//alert(URLactual);


var URLactual = window.location.href;
var URLactual = jQuery(location).attr('href');
//alert(URLactual);
   
var URLdomain = window.location.host;
//alert(URLdomain);

var URLhash = window.location.hash;
//alert(URLhash);

var URLsearch = window.location.search;
//alert(URLsearch);

console.log ($('#ruta_Admin').attr('href'));
var $directionAbs = $('#ruta_Admin').attr('href');

var $res = $directionAbs.replace("aca", "");
console.log($res);
    $('#num').on("keyup", function() {
   //$('button#boton').on('click', function(e) {

        //alert( '¡Hola, Mundo!' );
       // ver => window.location hash: ""
// host: "127.0.0.1:8000"
// hostname: "127.0.0.1"
// href: "http://127.0.0.1:8000/admin/persona"
// origin: "http://127.0.0.1:8000"
// pathname: "/admin/persona"
// port: "8000"
        
        $.ajax({
            method: 'GET',
            //url: $local + "/admin/arrayGus/" +  $('.valorDNI').val(),
            url: $res  + "admin/arrayGus/"+  $('.valorDNI').val(),
        }).done(function(data) {
            //console.log($('.valorDNI').val());
            console.log(data);
            if (data) {
              //alert("success: " + data[0]);
                //console.log(data.personas.length);
                //Array.isArray(data.personas)
                //console.log($local + "/admin/arrayGus/" +  $('.valorDNI').val())
                console.log(data)
                //alert(data)
                $('div#sidebar1').html(data)
               // var content = JSON.parse(data[1]);
                // console.log(content)
                // console.log(whichIsVisible(data))
                

                
                         
                
                //var obj = data.valors
                //console.log(obj);
            }
        });
    })
    });