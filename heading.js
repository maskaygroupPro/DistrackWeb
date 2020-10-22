function leerCookie(nombre) {
   a = document.cookie.substring(document.cookie.indexOf(nombre + '=') + nombre.length + 1,document.cookie.length);
   if(a.indexOf(';') != -1)a = a.substring(0,a.indexOf(';'))
   return a;
}
//document.write(leerCookie("Nombre"));
//alert(leerCookie("x1"));
//alert(leerCookie("ico"));
function heading_to_angle_index(heading)
{
    return heading == 'NNE' ? 1  :
           heading == 'NE'  ? 2  :
           heading == 'ENE' ? 3  :
           heading == 'E'   ? 4  :
           heading == 'ESE' ? 5  :
           heading == 'SE'  ? 6  :
           heading == 'SSE' ? 7  :
           heading == 'S'   ? 8  :
           heading == 'SSW' ? 9  :
           heading == 'SW'  ? 10 :
           heading == 'WSW' ? 11 :
           heading == 'W'   ? 12 :
           heading == 'WNW' ? 13 :
           heading == 'NW'  ? 14 :
           heading == 'NNW' ? 15 : 0;
}

function color_icon(speed)
{
    return speed >= 0 && speed<=80 ? 0 :6;
}