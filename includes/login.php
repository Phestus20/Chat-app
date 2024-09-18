<?php
@session_start();
$info = (object)[];// changes the array to object

    // validating email
    $data['email'] = $DATA_OBJ->email;
    
        $Error = '';
    if(empty($DATA_OBJ->email)) {
        $Error .= "Please enter a valid email<br>";
    }
    if(empty($DATA_OBJ->password)) {
        $Error .= "Please enter a valid password<br>";
    }


    if($Error == "")
    {
        //print_r("Error");
        $query = "SELECT * FROM `users` WHERE email = :email LIMIT 1";
        $result = $DB->read($query,$data);
        if(is_array($result))
        {
            $result = $result[0];
            if($result->password == $DATA_OBJ->password)
            {
               
                $_SESSION['userid'] = $result->userid;
               
                $info->message = "You are successfully logged in";
                $info->dataType = "info";
                echo json_encode($info);// encode to send
                
            }else
            {
                $info->message = "Wrong password";
                $info->dataType = "error";
                echo json_encode($info);// encode to send
             
            }

        }else
            {
                $info->message = "Wrong email";
                $info->dataType = "error";
                echo json_encode($info);// encode to send
                die;
            }
    }else
        {
            $info->message = "Oops something went wrong";
            $info->dataType = "error";
            echo json_encode($info);// encode to send
          
        }
        
      
?>