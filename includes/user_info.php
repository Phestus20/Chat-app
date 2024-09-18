<?php
$info = (object)[];// changes the array to object


// err start

// err end
    // validating email
    $data['userid'] = $_SESSION['userid'];
    
    
    if($Error == "")
    {
        //print_r("Error");
        $query = "SELECT * FROM `users` WHERE userid = :userid LIMIT 1";
        $result = $DB->read($query,$data);
        if(is_array($result))
        {
            $result = $result[0];
            $result->dataType = "user_info";

                    // check if image exist
            $image = ($result->gender == "male")  ? "./images/malecolor.png" : "./images/female.png";
            // check if image file exist
            if(file_exists($result->image))
            {
                $image = $result->image;
            }

            $result->image = $image;
            echo json_encode($result);// encode to send
            
        }else
            {
                $info->message = "Wrong email";
                $info->dataType = "error";
                echo json_encode($info);// encode to send
                
            }
}else
        {
            $info->message = $Error;
            $info->dataType = "error";
            echo json_encode($info);// encode to send
            
        }
        
       
?>