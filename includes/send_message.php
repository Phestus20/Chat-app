<?php 
$arr['userid']= null;

if(isset($DATA_OBJ->find->userid))
{ // we get the currently selected user to chat with
    $arr['userid']= $DATA_OBJ->find->userid;
   
}  
    $sql ="SELECT * FROM `users` WHERE userid =  :userid LIMIT 1";
    $result = $DB->read($sql, $arr);


    if(is_array($result))
    {
        $arr['message'] = $DATA_OBJ->find->message;
        $arr['date'] = date('Y-m-d H:i:s');
        $arr['sender'] = $_SESSION['userid'];
        $arr['msgid'] =  getRandomStringMax(60);
       // $arr['receiver'] = getRandomStringMax(60);

        $arr2['sender'] = $_SESSION['userid'];
        $arr2['receiver'] = $arr['userid'];

        $sqlS ="SELECT * FROM `messages` WHERE (sender =  :sender AND receiver = :receiver) || (sender = :receiver  AND receiver = :sender) LIMIT 1";
        $result2 = $DB->read($sqlS, $arr2);


            if(is_array($result2))
            {
                $arr['msgid'] = $result2[0]->msgid;
            }
            
        $sqlI = "INSERT INTO `messages`(sender, receiver, message,date,msgid) VALUES(:sender, :userid, :message, :date, :msgid)";
        $DB->write($sqlI, $arr);

        $row = $result[0];// we get the currently selected user to chat with

        $image = ($row->gender == "male") ? "images/malecolor.png" : "images/female.png";

        if(file_exists($row->image))
        {
            $image = $row->image;
        }

        $row->image = $image; // add the image to the row

      // this is the full info to be sent that will display on the left,
        $mydata = " Now chating with:<br>
        <div id='active_contact'>
            <img src='$image'  alt='user photo'>
            $row->username 
        </div>";

        
        // note this div is actually inner right panel
        // this is the full messages to be sent that will display,
        $messages = "

    <div id='messages_holder_parent' style='height: 630px;'>
        <div id='messages_holder' style='height: 480px;overflow-y:scroll;'>";
            
      //  $messages .=  message_left($row); // function to display user conversation

       // $messages .=  message_right($row);

       // read from db

       $a['msgid'] = $arr['msgid'];

       $sqlS ="SELECT * FROM `messages` WHERE msgid =  :msgid ORDER BY id DESC";
       $result2 = $DB->read($sqlS, $a);


           if(is_array($result2))
           {
              $result2 = array_reverse($result2);// reverse the latest message to be under
               foreach($result2 as $data)
               {
                //$data['sender'] array, // $data->sender object
                    $myuser = $DB->getUser($data->sender);

                    if($_SESSION['userid'] == $data->sender)
                    {
                        $messages .=  message_right($data,$myuser);
                    }else
                    {
                        $messages .=  message_left($data,$myuser);
                    }
                   
               }
               
           }
       
       
            
       

        $messages .= message_controls();// contains message input layout send btn

     // contains the object that will be carried to send with img, name, etc,
        $mydata = $mydata;
        $info->user = $mydata;
        $info->messages = $messages;
        $info->dataType = "send_message";
        echo json_encode($info);// encode to send
    
    }else
    {

        $info->message = "That contact was not found";
        $info->dataType = "chats";
        echo json_encode($info);// encode to send
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

   
?>

