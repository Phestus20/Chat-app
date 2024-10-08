<?php
@session_start();

$DATA_RAW = file_get_contents("php://input");
$DATA_OBJ = json_decode($DATA_RAW);//adding true makes it an arr instead of obj

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

require_once('./classes/autoload.php');

$DB = new Database();

$Error ='';

// echo $myObject->gender; access information from objects
// echo $myObject['gender']; access information from objects

// process the data

if(isset($DATA_OBJ->dataType) && $DATA_OBJ->dataType == 'signup')
{

    // sigup
    include('./includes/signup.php');
  
}else if(isset($DATA_OBJ->dataType) && $DATA_OBJ->dataType == 'login')
    {
         // Login
    include('./includes/login.php');

    }else if(isset($DATA_OBJ->dataType) && $DATA_OBJ->dataType == 'logout')
    {
        // Logout
        include('./includes/logout.php');
        
    }else if(isset($DATA_OBJ->dataType) && $DATA_OBJ->dataType == 'user_info')
    {
        // Login
            include('./includes/user_info.php');
    }else if(isset($DATA_OBJ->dataType) && $DATA_OBJ->dataType == 'contacts')
    {
        // Login
            include('./includes/contacts.php');
    }else if(isset($DATA_OBJ->dataType) && ($DATA_OBJ->dataType == 'chats' || $DATA_OBJ->dataType == "chats_refresh"))
    {
        // chats
            include('./includes/chats.php');
    }else if(isset($DATA_OBJ->dataType) && $DATA_OBJ->dataType == 'settings')
    {
        // settings
            include('./includes/settings.php');
    }else if(isset($DATA_OBJ->dataType) && $DATA_OBJ->dataType == 'save_settings')
    {
        // settings
            include('./includes/save_settings.php');
    }else if(isset($DATA_OBJ->dataType) && $DATA_OBJ->dataType == 'send_message')
    {
       
           include('./includes/send_message.php');
    }else if(isset($DATA_OBJ->dataType) && $DATA_OBJ->dataType == 'delete_message')
    {
       
           include('./includes/delete_message.php');
    }else if(isset($DATA_OBJ->dataType) && $DATA_OBJ->dataType == 'delete_thread')
    {
       
           include('./includes/delete_thread.php');
    }


    function message_left($data,$row)
    {
        $image = ($row->gender == "male") ? "images/malecolor.png" : "images/female.png";

        if(file_exists($row->image))
        {
            $image = $row->image;
        }
        // echo will not work
      $a = "<div id='message_left'>
                <div> <img src='./images/chat2.png' alt='chat icon' style='width:100%;'/></div>
                <img id='prof_img' src='$image'  alt='user photo'>
                <b> $row->username </b> <br> 
                  $data->message<br>"; 
                  if($data->files != "" && file_exists($data->files)){
              $a .= "<img src='$data->files' alt='file'style='cursor:pointer;width:60%;object-fit:cover;' 
              onclick='imageShow(event)'/><br>";
                  }
           $a .=  "<span style='font-size:11px;color:#999;'>" . date("jS M Y H:i:s a", strtotime($data->date))  . "</span>
                <img id='trash' title='delete this mesage' src='./images/trashred.png' alt='trash can'
                onclick='deleteMessage(event)' msgid='$data->id'/>

            </div>";
            
            return $a;
    }

    function message_right($data,$row)
    {
        $image = ($row->gender == "male") ? "images/malecolor.png" : "images/female.png";

        if(file_exists($row->image))
        {
            $image = $row->image;
        }
       // echo will not work
       $a = "<div id='message_right'>
                <div>";
      
        if($data->seen)// seen 1 is same as true
        {
            $a .= " <img src='images/seeneyecolor.png'style=''/>";
        }else if($data->received)
        {
            $a .= " <img src='images/doubletickblack.png'style=''/>";
        }     
         
        $a .= "</div>
                <img id='prof_img' src='$image'  alt='user photo' style='float:right'>
                <b>$row->username </b> <br> 
                $data->message<br>";
                if($data->files != "" && file_exists($data->files)){
                    $a .= "<img src='$data->files' alt='file'style='width:60%;
                    cursor:pointer;object-fit:cover;' onclick='imageShow(event)'/><br>";
                        }
            $a .= "<span style='font-size:11px;color:#999;'>" . date("jS M Y H:i:s a", strtotime($data->date)) . "</span>
                <img id='trash' title='delete this mesage' src='./images/trashred.png' alt='trash can'
                onclick='deleteMessage(event)' msgid='$data->id'/>
            </div> ";
            return $a;
    }

    function message_controls()
    {
        
    return "
              </div> 
          
              <div style='height: 100px; width:100%;'> 
          
                <div style='display:flex; height: 100%; width:100%;'>
          
                   <div style='display:flex; flex-direction: row; justify-content: space-evenly; width:100%;height:40px;'>
                        <label for='message_file'><img src='./images/clip.png'/ alt='clip for attachment' 
                        style='opacity:0.8; width:25px; margin:5px;cursor:pointer;'title='attach a file'></label>
                        <input type='file' name='file' style='display:none;' id='message_file' onchange='sendImage(this.files)'/>
                        <input type='text' id='message_text' onkeyup='enterPressed(event)' style='flex:6;border:solid thin #ccc;border-bottom:none;font-size: 14px;padding:4px;'  
                        name='message_input' placeholder='Type your message here'>
                    
                        <input style='flex:1;cursor:pointer;background:#406089;color:#fff;border:solid 2px #fff;'
                        type='button' value='Send' name='send_btn' onclick='sendMessage(event)' id='send_btn'>
                    </div>
          
                </div>
          
              </div>
            ";
             
    }
?>