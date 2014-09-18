<?php 
# Basado en 
# https://code.google.com/p/sliderkit/downloads/detail?name=jquery.sliderkit.1.9.2.zip 
#
# Script  bajo los términos y Licencia
# GNU GENERAL PUBLIC LICENSE
# Ver Terminos en:
# http://www.gnu.org/copyleft/gpl.html
# 
# Héctor A. Mantellini (xombra)
# http://xombra.com | http://viserproject.com
#
# ---------------------------------------
# Funciones NO TOCAR
# ---------------------------------------
function BUFFER_INICIO($buffer)
{ if (!empty($buffer)) { $buffer = ob_start("$buffer"); }
  else { $buffer = ob_start();  }  
  return $buffer;
}
function compress_page($buffer) { 
 $search  = array('/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s'); 
 $replace = array('> ',' <','\\1'); 
 return preg_replace($search, $replace, $buffer);   } 
function DECODE($origen) {
 $origen = html_entity_decode($origen, ENT_QUOTES, "ISO-8859-1");
 $origen = htmlspecialchars($origen, ENT_QUOTES, "ISO-8859-1");
return $origen; }
function ENCABEZADO($lenguaje,$timezone_set,$charset){
  global $ExpStr;
  setlocale(LC_TIME, $lenguaje);
  header('Accept-Ranges: bytes');
  $tiempo =  $_SERVER['REQUEST_TIME'] + 3600;
  $ExpStr = 'Expires: '.gmdate("D, d M Y H:i:s", $tiempo) . " GMT"; 
  session_cache_limiter('private_no_expire');
  session_cache_expire(3600);
  header($ExpStr); 
  header("Cache-Control: maxage=$tiempo"); 
  header("Cache-Control: public, must-revalidate");
  header("Cache-Control: public");
  header("pragma: public"); 
  header("Content-Transfer-Encoding:gzip;q=1.0, identity; q=0.5, *;q=0"); 
  header("Cache-Control: cache");  
  header("Pragma: cache");
  header("Content-Type: text/html; charset=$charset");
  $etag = md5($_SERVER['REQUEST_URI'] . $ExpStr);
  header("Etag: $etag");
return $ExpStr; }
function HEADERS_($charset,$lenguaje) { ?>
 <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" />
 <meta http-equiv="cache-control" content ="cache" />
 <meta http-equiv="pragma" content="cache" />
 <meta http-equiv="vary" content="content-language" />
 <meta content='IE=EmulateIE7, chrome=1' http-equiv='X-UA-Compatible'/>
 <meta name="adblock" content="disable" />
 <meta name="apple-mobile-web-app-capable" content="yes" />
 <meta name="apple-mobile-web-app-status-bar-style" content="black" />
 <meta name="author" content="Programacion por ViSerProject" />
 <meta name="copyright" content="CopyLeft (c) <?php echo date("Y",time()); ?> by ViSerProject" />
 <meta name="distribution" content="Global" />
 <meta name="generator" content="Aptana" />
 <meta name="language" content="<?php echo $lenguaje; ?>" />
 <meta name="medium" content="mult" />
 <meta name="no-email-collection" content="http://www.unspam.com/noemailcollection/" />
 <meta name="rating" content="adult" />
 <meta name="resource-type" content="document" />
 <meta name="revisit-after" content="7 day" />
 <meta name="robots" content="noindex,nofollow,noarchive" />
 <meta name="viewport" content="width=device-width, initial-scale=0.9" />
 <link rel="apple-touch-icon" href="img/apple.png" />
 <link rel="icon" href="favicon.ico" type="image/x-icon" />
 <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<!--[if lt IE 8]>
    <script  async  src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE8.js" type="text/javascript" defer="defer"></script>
<![endif]-->
<?php
return; }
function LIMPIAR_VALORES()
{ $_SERVER['QUERY_STRING'] = trim(strip_tags($_SERVER['QUERY_STRING']));
  URL();
  if (!empty($_GET)){ 
  foreach($_GET as $variable=>$valor){
     $_GET[$variable] = strip_tags($_GET[$variable]);
     $_GET[$variable] = str_replace("'","\'",$_GET[$variable]);
     $_GET[$variable] = DECODE($_GET[$variable]);  } }
  if (!empty($_POST) ){
  foreach($_POST as $variable=>$valor){
     $_POST[$variable] = strip_tags($_POST[$variable]);
     $_POST[$variable] = str_replace("'","\'",$_POST[$variable]);
     $_POST[$variable] = DECODE($_POST[$variable]); } }
return; }
function URL() { 
  if (empty($_SERVER["HTTP_REFERER"])) { $_SERVER["HTTP_REFERER"] = '';}
  $valor = strip_tags($_SERVER["HTTP_REFERER"]);
  $replace = "%20"; 
  $search = array(">", "<", "|", ";", "-","'",'"'); 
  $_SERVER["HTTP_REFERER"] = str_replace($search, $replace, $valor); 
return;  }

# ----------------------------------------

LIMPIAR_VALORES();
ENCABEZADO('es_ES','America/Caracas','iso-8859-1');
BUFFER_INICIO("compress_page");
?> 
<html lang="es_ve">
<head>
<link rel="stylesheet" type="text/css" href="css/sliderkit-core.css" media="screen, projection" />
<link rel="stylesheet" type="text/css" href="css/sliderkit-demos.css" media="screen, projection" />
<!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/sliderkit-demos-ie7.css" /><![endif]-->
<!--[if IE 8]><link rel="stylesheet" type="text/css" href="css/sliderkit-demos-ie8.css" /><![endif]-->
<link rel="stylesheet" type="text/css" href="css/sliderkit-site.css" media="screen, projection" />
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
<?php HEADERS_("iso-8859-1","es_ES"); ?>
<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="js/sliderkit/jquery.sliderkit.1.9.2.pack.js"></script>
<script type="text/javascript" src="js/sliderkit/addons/sliderkit.timer.1.0.pack.js"></script>
<script type="text/javascript" src="js/sliderkit/addons/sliderkit.imagefx.1.0.pack.js"></script>
<script async type="text/javascript">
    $(window).load(function(){  		
    $(".transition-demo01").sliderkit({
	 auto:1,
	 autostill:true,
	 timer:true,
         circular:true,
	 panelfx:'fancy',
         autospeed:10000,
         imagefx:{ fxType: 'random'  
	 },
	 debug:1
     }); });
	</script> 
</head>
<?php flush(); ?>
<body>
<div id="slider2014">
  <?php
  microtime(true);
  $imagen = array();
  if ($carpeta = opendir('img_promos')) {
    while (false !== ($archivo = readdir($carpeta))) {
        if (substr($archivo, 0, 1) != '.' && $archivo != 'index.html')
           { $imagen[] = $archivo; }
    }
    closedir($carpeta);
    $cant = count($imagen);
    shuffle($imagen);
    if ($cant < 5) { $leer = $cant; } 
    else { $leer = 5; }
    $rand_keys = array_rand($imagen, $leer);
  }
  else
  { $imagen[] = 'default_promos.jpg'; }
   echo '<div class="sliderkit photoslider-mini transition-demo01">						
            <div class="sliderkit-panels">';
		    foreach ($imagen as $key => $valor) {
		      echo '<div class="sliderkit-panel">
			          <img src="img_promos/'.$valor.'" alt="'.$valor.'" width="982" height="260" />
	                </div>';
			}
echo '					 
	        </div>
        <div class="sliderkit-timer-wrapper">
           <div class="sliderkit-timer"></div>
        </div>
 </div>';
?>
</body>
</html>
<?php ob_flush(); ?>
