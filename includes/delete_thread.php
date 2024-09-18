<?php 
$arr['userid']= null;

if(isset($DATA_OBJ->find->userid))
{ // we get the currently selected user to chat with
    $arr['userid']= $DATA_OBJ->find->userid;
   
}  

$arr['sender'] = $_SESSION['userid'];
$arr['receiver'] = $arr['userid'];    

$sqlS ="SELECT * FROM `messages` WHERE (sender =  :sender AND receiver = :receiver) || (receiver = :sender  AND  sender = :receiver)";

    $result = $DB->read($sqlS, $arr);

    if(is_array($result))
    {
        foreach($result as $row)
        {

       
        // deleting multiple messages
            if($_SESSION['userid'] == $row->sender)
            {

                $sql ="UPDATE `messages` SET deleted_sender = 1 WHERE id = '$row->id' LIMIT 1";
                $DB->write($sql);
            
            }

            if($_SESSION['userid'] == $row->receiver)
            {
                $sql ="UPDATE `messages` SET deleted_receiver = 1 WHERE id = '$row->id' LIMIT 1";
                $DB->write($sql);
            }
        }
    }

    ?>