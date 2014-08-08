<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
$con = new MongoClient("mongodb://localhost");
$db = $con->fingerprints;
$collection = $db->createCollection("csie");
//judge whether is mobile device or not
$iPod = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
$iPhone = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$iPad = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
if(stripos($_SERVER['HTTP_USER_AGENT'],"Android") && stripos($_SERVER['HTTP_USER_AGENT'],"mobile")){
    $Android = true;
}else if(stripos($_SERVER['HTTP_USER_AGENT'],"Android")){
    $Android = false;
    $AndroidTablet = true;
}else{
    $Android = false;
    $AndroidTablet = false;
}
$webOS = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
$BlackBerry = stripos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
$RimTablet= stripos($_SERVER['HTTP_USER_AGENT'],"RIM Tablet");


//deal with Ajax request content and add some attribute into DB
$request_body = file_get_contents('php://input');

$data = json_decode($request_body,true);

$ip=array('ip'=>$_SERVER['REMOTE_ADDR']);
array_push($data,$ip);
date_default_timezone_set('Asia/Taipei');   
array_push($data,date("Y-m-d H:i:s"));

//Filter device type
if( $iPod || $iPhone ){
    $ipod_d=array('iPod'=>$iPod);
    $iphone_d=array('iPhone'=>$iPhone);
    array_push($data,$ipod_d);
    array_push($data,$iphone_d);
}else if($iPad){
 $ipad_d=array('iPad'=>$iPad);
 array_push($data,$ipad_d);
}else if($Android){
    $android_d=array('Android'=>$Android);
    array_push($data,$android_d);
}else if($AndroidTablet){
    $androidTablet_d=array('AndroidTablet'=>$AndroidTablet);
    array_push($data,$androidTablet_d);
}else if($webOS){
    $webOS_d=array('webOS'=>$webOS);
    array_push($data,$webOS_d);
}else if($BlackBerry){
    $BlackBerry_d=array('BlackBerry'=>$BlackBerry);
    array_push($data,$BlackBerry_d);
}else if($RimTablet){
    $RimTablet_d=array('RimTablet'=>$RimTablet);
    array_push($data,$RimTablet_d);
}else{

    $no_moblie=false;
    $no_moblie_d=array('moblie'=>$no_moblie);
    array_push($data,$no_moblie_d);
}
//store and filter the elements in variable $_SERVER  
if(!function_exists('getallheaders'))
{
   function getallheaders() 
   {
      foreach($_SERVER as $name => $value)
      {
         if(substr($name, 0, 5) == 'HTTP_')
         {
            $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
        }
    }
    return $headers;
}
}
$count=0;

foreach (getallheaders() as $name => $value) 
{
    if(preg_match("/^(Accept|Accept-Encoding|Accept-Language|Cookie|Referer)/i", trim($name)))
    {
        $header1[$count]=array($name => $value);
        $count++;
    }
    $header1[$count]=array($name => $value);
   // array_push($data, $header1);
}





array_push($data, $header1);
$collection->insert($data); 
//print_r($_POST['data']);
//$collection->insert($_POST['data']);
//print_r($_POST);
//print_r($_GET);
//echo $profile;
//var_dump($_post);  
//$collection->insert($_POST['data']); 
//$json = json_encode($profile);
 //file_put_contents('your_data.txt', $json);




?>

