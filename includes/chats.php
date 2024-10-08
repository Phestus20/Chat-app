<?php 
$arr['userid']= null;

if(isset($DATA_OBJ->find->userid))
{ // we get the currently selected user to chat with
    $arr['userid']= $DATA_OBJ->find->userid;
   
}  


        $refresh = false;
        $seen = false;
        if($DATA_OBJ->dataType == "chats_refresh")
        {
            $refresh = true;
            $seen = $DATA_OBJ->find->seen; //to mark if msg is seen
        }

    $sql ="SELECT * FROM `users` WHERE userid =  :userid LIMIT 1";
    $result = $DB->read($sql, $arr);

    if(is_array($result))
    {
        $row = $result[0];// we get the currently selected user to chat with

        $image = ($row->gender == "male")  ? "images/malecolor.png" : "images/female.png";

        if(file_exists($row->image))
        {
            $image = $row->image;
        }
        $row->image = $image; // add the image to the row

        $mydata ="";
        if(!$refresh)
        {
        // this is the full info to be sent that will display on the left,
            $mydata = " Now chating with <br>
            <div id='active_contact'>
                <img src='$image'  alt='user photo'>
                $row->username 
            </div>";             
        }

        // note this div is actually inner right panel
        // this is the full messages to be sent that will display,
         $messages = "";
         $new_message = false;
        if(!$refresh)
        {
        $messages = "

    <div id='messages_holder_parent' onclick='setSeen(event)' style='height: 630px;'>
        <div id='messages_holder' style='height: 480px;overflow-y:scroll;'>";
        }     
       // $messages .=  message_left($data,$row); // function to display user conversation
       /// $messages .=  message_right($data,$row);
       
       // read from db
       $a['sender'] = $_SESSION['userid'];
       $a['receiver'] = $arr['userid'];

       $sqlS ="SELECT * FROM `messages` WHERE (sender =  :sender AND receiver = :receiver && deleted_sender = 0) || (receiver = :sender  AND  sender = :receiver  && deleted_receiver = 0) ORDER BY id DESC LIMIT 10";
       $result2 = $DB->read($sqlS, $a);

            $mydata = "Previous chats <br>";
           if(is_array($result2))
           {

                   

              $result2 = array_reverse($result2);// reverse the latest message to be under
               foreach($result2 as $data)
               {
                //$data['sender'] array, // $data->sender object
                    $myuser = $DB->getUser($data->sender);
 
                      // check for ne messages
                      if($data->receiver == $_SESSION['userid'] && $data->received == 0)
                      {
                        $new_message = true;
                      }
                    if($data->receiver == $_SESSION['userid'] && $data->received == 1 && $seen )
                    {
                        // mark message as been seen
                        $DB->write("UPDATE `messages` SET seen = 1 WHERE id = '$data->id' LIMIT 1");
                    }

                    if($data->receiver == $_SESSION['userid'])
                    {
                        // mark message as been seen
                        $DB->write("UPDATE `messages` SET received = 1 WHERE id = '$data->id' LIMIT 1");
                    }
                    if($_SESSION['userid'] == $data->sender)
                    {
                        $messages .=  message_right($data,$myuser);
                    }else
                    {
                        $messages .=  message_left($data,$myuser);
                    }
                   
               }


            // start when you select a contact to start 
            //chating with,it shows the contact on the left
            $mydata .= "
                            
            <div id='active_contact' >

                <img src='$image'  alt='user photo'>
                $myuser->username  <br>
                <span style='font-size:11px;'>'$data->message'</span><!-- to display the last message under user-->
               
            </div>";
                  // start when you select a contact to start 
            //chating with,it shows the contact on the left
            $mydata .='
                    <style>
                      @media screen and (min-width: 200px) and (max-width: 800px) 
                         {


                         #below-contact-container{
                            display: block;
                            }
                    #left_panel{
                        display: none;
                    }
                
                .below-contact{
                            
                            height: 20px;
                            display: block;
                            background-color: /*#404b56;*/#a7b5c2;
                            border-bottom: solid thin #ffffff55;
                            cursor: pointer;
                            padding: 5px;
                            transition: all  1s ease;
                            }
                
                            .below-contact:hover{
                                background-color: #778593;
                                border-bottom: solid thin #ffffff55;
                                cursor: pointer;
                                padding: 5px;
                            
                            }
                        .below-contact  img{
                                float: right;
                                width: 25px;
                                
                                }

                        }
                    </style>
                    <div class="div" id="below-contact-container" style="margin-top: 50px;">
                    <label class= "below-contact"  for="radio_chat"  id="label_chat">Chat <img src="./images/chat1.png" alt="chating icon" style="width:15px;"></label>

                    <label  class= "below-contact"  for="radio_contact" id="label_contact">Contacts <img src="./images/contact.png" alt="friends icon" style="width:15px;"></label>
                  
                    <label  class= "below-contact"   for="radio_settings" id="label_settings">Settings <img src="./images/settings.png" alt="settings" style="width:15px;"></label>
                   
                    <label  class= "below-contact"  for="radio_logout" name="logout" id="logout">Logout <img src="./images/logout.png" alt="logout icon" style="width:15px;"></label>
                    </div>';


           }
            
       // the refresh is  is causing a problem function but not the function, 
       // it makes messsages not to load wen 2 are chating
           if(!$refresh)
           {
             $messages .= message_controls();// contains message input layout send btn
           }
     // contains the object that will be carried to send with img, name, etc,
        //$mydata = $mydata;


            $html = " <!-- only for small screens bte 300 and 500 start-->
                    <div class='div' id='small-screens' style='width: 100%; '>
                        <label for='radio_chat'  id='label_chat'>Chat <img src='./images/chat1.png' alt='chating icon'></label>
                        <label for='radio_contact' id='label_contact'>Contacts <img src=''./images/contact.png' alt='friends icon'></label>
                        <label for='radio_settings' id='label_settings'>Settings <img src='./images/settings.png' alt='settings'></label>
                        <label for='radio_logout' name='logout' id='logout'>Logout <img src='./images/logout.png' alt='logout icon'></label>
                    </div>
                     <!-- only for small screens bte 300 and 500 end -->";


        $info->user = $mydata;
        $info->messages = $messages;
        $info->new_message = $new_message;// checking for new msg to play bip
        $info->dataType = "chats";
        if($refresh)
        {
            $info->dataType = "chats_refresh";
            
        } 
        
        echo json_encode($info);// encode to send
    
    }else
    {

        // read from db
        $a['userid'] = $_SESSION['userid'];

        $sqlS = "SELECT m.*, u.username, u.gender, u.image
                 FROM (
                     SELECT 
                         CASE 
                             WHEN sender = :userid THEN receiver
                             ELSE sender
                         END AS contact_id,
                         MAX(date) AS last_message_date
                     FROM messages
                     WHERE sender = :userid OR receiver = :userid
                     GROUP BY contact_id
                 ) AS latest_messages
                 JOIN messages m ON (
                     (m.sender = :userid AND m.receiver = latest_messages.contact_id) OR
                     (m.receiver = :userid AND m.sender = latest_messages.contact_id)
                 )
                 JOIN users u ON u.userid = latest_messages.contact_id
                 WHERE m.date = latest_messages.last_message_date
                 ORDER BY latest_messages.last_message_date DESC
                 LIMIT 25";
        
        $result2 = $DB->read($sqlS, $a);
        
        $mydata = "Previous chats <br>";
        
        if(is_array($result2))
        {
            foreach($result2 as $data)
            {
                $other_user = $data->sender;
                if($data->sender == $_SESSION['userid'])
                {
                    $other_user = $data->receiver;
                }
        
                $image = ($data->gender == "male") ? "images/malecolor.png" : "images/female.png";
        
                if(file_exists($data->image))
                {
                    $image = $data->image;
                }
        
                $mydata .= "
                <div id='active_contact' userid='$other_user' onclick='startChat(event)' style='cursor:pointer;'>
                    <img src='$image'  alt='user photo'>
                    $data->username<br>
                    <span style='font-size:11px;'>'$data->message'</span><br>
           <span style='font-size:11px;color:#999;'>" . date("jS M Y H:i:s a", strtotime($data->date))  . "</span>
                </div>"; 
            }
        }
            $info->user = $mydata;
            $info->messages = "";
            $info->dataType = "chats";

            echo json_encode($info);// encode to send
        
    }
?>

