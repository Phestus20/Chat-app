<?php 
 sleep(0.4);
 $myId = $_SESSION['userid'];
 $sql ="SELECT * FROM `users` WHERE userid !=  $myId";
  $myusers = $DB->read($sql, []);



    $mydata = "
    <style>
     @keyframes appear{
            0%{opacity:0; transform: translateY(100px) rotate(15deg); transform-origin:100% 100%}
           /* 50%{opacity: .5; transform: translateY(50px) rotate(10deg); transform-origin:100% 100%}*/
            100%{opacity: 1; transform: translateY(0px) rotate(0deg);}
     }
    
     #contact{
        cursor:pointer;
        transition: all .5s ease/*cubic-bezier(0.68, -2, 0.265, 1.55)*/;
     }

     #contact:hover{
        transform: scale(1.1);
     }
    
     #anim{
       /* animation: appear 0.7s ease;
        text-align: center; */
     }

    </style>

    <div id='anim' style=''>";

    // notification for unread message
    if(is_array($myusers))
    {
        //check for new messages
        $msgs = array();
        $me = $_SESSION['userid'];
        $query = "SELECT * FROM `messages` WHERE receiver = '$me' AND received = 0";
        $mymgs = $DB->read($query, []);

        if(is_array($mymgs))
        {
            foreach($mymgs as $row2)
            {
                $sender = $row2->sender;
                if(isset($msgs[$sender]))
                {
                    $msgs[$sender]++;
                }else
                {
                    $msgs[$sender] = 1;
                }
            }
        }

        foreach($myusers as $row)
        {
            $image = ($row->gender == "male")  ? "images/malecolor.png" : "images/female.png";

            if(file_exists($row->image))
            {
                $image = $row->image;
            }

            // contains the info to be sent that wiill display,
            $mydata .= "
            <div id='contact' userid='$row->userid' onclick='startChat(event)'
            style='position:relative;'>
                <img src='$image'  alt='user photo'>
                <br> $row->username ";
                
                if(count($msgs) > 0 && isset($msgs[$row->userid])){ //if new message display notification
$mydata .= "<div style='width:20px;height:20px; border-radius:50%; 
                background-color:orange;color:#fff;position:absolute;left:0;top:0;'>".$msgs[$row->userid]. "</div>";
                }
$mydata .= "</div>";
        }

    }
    $mydata .= "</div>";



    //$result = $result[0];
    
    $info->message = $mydata;// contains the object that will be carried to send with img, name, etc,
    $info->dataType = 'contacts';
    echo json_encode($info);// encode to send
    die;

    $info->message = 'No contacts were found';
    $info->dataType = 'error';
    echo json_encode($info);// encode to send
?>

