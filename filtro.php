<?php
function HTML_filtro($contenido){
      $contenido=preg_replace("/ñ/","&ntilde;",$contenido);
      $contenido=preg_replace("/Ñ/","&Ntilde;",$contenido);
      $contenido=preg_replace("/á/","&aacute;",$contenido);
      $contenido=preg_replace("/Á/","&Aacute;",$contenido);
      $contenido=preg_replace("/é/","&eacute;",$contenido);
      $contenido=preg_replace("/É/","&Eacute;",$contenido);
      $contenido=preg_replace("/í/","&iacute;",$contenido);
      $contenido=preg_replace("/Í/","&Iacute;",$contenido);
      $contenido=preg_replace("/ó/","&oacute;",$contenido);
      $contenido=preg_replace("/Ó/","&Oacute;",$contenido);
      $contenido=preg_replace("/ú/","&uacute;",$contenido);
      $contenido=preg_replace("/Ú/","&Uacute;",$contenido);
      $contenido=preg_replace("/Ì/","&Igrave;",$contenido);
      $contenido=preg_replace("/Ò/","&Ograve;",$contenido);
      $contenido=preg_replace("/Ù/","&Ugrave;",$contenido);
      $contenido=preg_replace("/Nº/","N&ordm;",$contenido);
      $contenido=preg_replace("/N°/","N&ordm;",$contenido);
      $contenido=preg_replace("/1º/","1&ordm;",$contenido);
      $contenido=preg_replace("/2º/","2&ordm;",$contenido);
      $contenido=preg_replace("/3º/","3&ordm;",$contenido);
      $contenido=preg_replace("/4º/","4&ordm;",$contenido);
      $contenido=preg_replace("/5º/","5&ordm;",$contenido);
      $contenido=preg_replace("/6º/","6&ordm;",$contenido);
      $contenido=preg_replace("/7º/","7&ordm;",$contenido);
      $contenido=preg_replace("/8º/","8&ordm;",$contenido);
      $contenido=preg_replace("/9º/","9&ordm;",$contenido);
      $contenido=preg_replace("/1°/","1&ordm;",$contenido);
      $contenido=preg_replace("/2°/","2&ordm;",$contenido);
      $contenido=preg_replace("/´/","'",$contenido);
      $contenido=preg_replace("/°C/","&ordm;C",$contenido);
      return $contenido;
   }
   
?>