<?php
@session_start();
$info = (object)[];
// check if login
if(!isset($_SESSION['userid']))
{
   
   //err line if(isset($DATA_OBJ->dataType) && $DATA_OBJ->dataType != 'login')
   
   if(isset($DATA_OBJ->dataType) && $DATA_OBJ->dataType != 'login'
                                        && $DATA_OBJ->dataType != 'signup')
    {
        $info->logged_in = false;
        echo json_encode($info);
        die;
    }
   
}
//print_r($_POST);
require_once('./classes/autoload.php');
$DB = new Database();


$dataType = "";
if(isset($_POST['dataType']))
{
    $dataType = $_POST['dataType'];
}

$destination = '';
if(isset($_FILES['file']) && $_FILES['file']['name'] != "")
{
    $allowed[] = "image/jpeg";
    $allowed[] = "image/JPEG";
    $allowed[] = "image/jpg";
    $allowed[] = "image/JPG";
    $allowed[] = "image/png";
    $allowed[] = "image/PNG";
    // check if file does not have error 
    if($_FILES['file']['error'] == 0 && in_array($_FILES['file']['type'], $allowed))
    {
        // upload file
        $folder = "uploads/";
        if(!file_exists($folder))
        {
            mkdir($folder,0777,true);// create a folder and grant access rules
        }
        $destination = $folder . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $destination);

        $info->message = "Your image was uploaded";
        $info->dataType = $dataType;
        echo json_encode($info);// encode to send
       
    }else
    {
        return;
    }
}


if($dataType == "change_profile_image")
{
    if($destination != "")
    {
        // save to database
        $id = $_SESSION['userid'];
        $query = "UPDATE users SET image = '$destination' WHERE userid = '$id' LIMIT 1";
        $DB->write($query,[]);
    }
}else if($dataType == "send_image")
    {
        $arr['userid']= null;

    if(isset($_POST['userid']))
    { // we get the currently selected user to chat with
        $arr['userid']= addslashes($_POST['userid']);
    
    }  
  
    $arr['message'] = "";
    $arr['date'] = date('Y-m-d H:i:s');
    $arr['sender'] = $_SESSION['userid'];
    $arr['msgid'] =  getRandomStringMax(60);
    $arr['file'] =  $destination;
   // $arr['receiver'] = getRandomStringMax(60);

    $arr2['sender'] = $_SESSION['userid'];
    $arr2['receiver'] = $arr['userid'];

    $sqlS ="SELECT * FROM `messages` WHERE (sender =  :sender AND receiver = :receiver) || (sender = :receiver  AND receiver = :sender) LIMIT 1";
    $result2 = $DB->read($sqlS, $arr2);


        if(is_array($result2))
        {
            $arr['msgid'] = $result2[0]->msgid;
        }
        
    $sqlI = "INSERT INTO `messages`(sender, receiver, message,date,msgid,files) VALUES(:sender, :userid, :message, :date, :msgid,:file)";
    $DB->write($sqlI, $arr);

}


function getRandomStringMax($length)
{
   $array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h',
   'i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','z',
   'y','z','A','B','C','D','E','F','G','H','I','J','K','L','M',
        'N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

        $text ='';
        $length = rand(0,61);

        for($i=0; $i < $length; $i++)
        {
            $random = rand(0,61);
            $text .= $array[$random];
        }

        return $text;
}