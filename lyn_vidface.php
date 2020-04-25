<?php
$filename = "%%-".md5($_SERVER['REQUEST_URI'].'chatlakturk-lynvideo')."-%%.txt";
$cachefile = "cache/".$filename;
$cachetime = 3 * 3600; // Cache Süresi
if (file_exists($cachefile))
{
if(time() - $cachetime < filemtime($cachefile))
{
$dt = fopen($cachefile, "rb");
$cachefile1 = stream_get_contents($dt);
fclose($dt);
header("Location:http://$cachefile1");
exit;
}
else
{
unlink($cachefile);
}
}
ob_start();
function baglan($url){
$oturum = curl_init();
curl_setopt($oturum, CURLOPT_URL, $url);
$h4 = $_SERVER['HTTP_USER_AGENT'];
curl_setopt($oturum, CURLOPT_USERAGENT, $h4);
curl_setopt($oturum, CURLOPT_HEADER, 0);
curl_setopt($oturum, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($oturum, CURLOPT_RETURNTRANSFER, true);
$source=curl_exec($oturum);
curl_close($oturum);
return $source;
}
function facelink($link) { 
	$link = str_replace ("\u00253A",":",$link); 
	$link = str_replace ("\u00252F","/",$link);
	$link = str_replace ("\u002526","&",$link);
	$link = str_replace ("\u00253F","?",$link);
	$link = str_replace ("\u00253D","=",$link);
	return $link;
}
function faceduzelt($urele)
{
    $explode=explode("/",$urele);
    $say=count($explode);
    $son=$explode[$say-1];
    $explode2=explode("_",$son);
    $videoaydi=$explode2[0];
    $al = baglan("http://www.facebook.com/ajax/flash/expand_inline.php?target_div=u879823_18&__a=1&v=$videoaydi");
    $al = stripslashes($al);
    $exp=explode("\"video_src\", \"",$al);
    $exp=explode("\");",$exp[1]);
	$l=facelink($exp[0]);
	$l=str_replace('http://','',$l);
    return $l;
}  
$facele = $_GET['link'];
if ((strpos($facele,'facebook.com')) or (strpos($facele,'fbcdn.net')))  {
$facele = faceduzelt($facele);
}
$facele = str_replace('http://','',$facele);
echo $facele;
header("Location:http://$facele");
$fp = fopen($cachefile, 'w+');
fwrite($fp, ob_get_contents());
fclose($fp);
ob_end_flush();
?>