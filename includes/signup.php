<?php
$info = (object)[];// changes the array to object

// process the data and validation // create a sigup
    
    $data = false;// to make sure it's empty to avoid errors
    $data['userid'] = $DB->generateId(20);
    $data['date'] = date("y-m-d H:i:s");

    //validate username
    $data['username'] = $DATA_OBJ->username;
    if(empty($DATA_OBJ->username))
    {
        $Error .= "Please enter a valide username <br>";
    }else
    {
        if(strlen($DATA_OBJ->username) < 3)
        {
         $Error .= "Username must be at least 3 characters .<br>";;
        }

        if(!preg_match("/^[a-z A-Z]*$/", $DATA_OBJ->username))
        {
         $Error .= "Please enter a valide username" ."<br>";
        }
    }


    // validating email
    $data['email'] = $DATA_OBJ->email;
    if(empty($DATA_OBJ->email))
    {
        $Error .= "Please enter a valid email <br>";
    }else
    {
        if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $DATA_OBJ->email))
        {
         $Error .= "Please enter a valid email" ."<br>";
        }
    }

    // validating password
    $data['password'] = $DATA_OBJ->password;
    $password2['password2'] = $DATA_OBJ->password2;
    if(empty($DATA_OBJ->password))
    {
        $Error .= "Please enter a valid password <br>";
    }else
    {


        if($DATA_OBJ->password != $DATA_OBJ->password2)
        {
         $Error .= "Both passwords must match .<br>";;
        }
        
        
        if(strlen($DATA_OBJ->password) < 6)
        {
         $Error .= "Password must have at least 6 characters mix with letters .<br>";;
        }
    }

    $data['gender'] = isset($DATA_OBJ->gender) ? $DATA_OBJ->gender : null;
    if(empty($DATA_OBJ->gender))
    {
        $Error .= "Please select a gender <br>";
    }else
    {
        if($DATA_OBJ->gender != 'male' && $DATA_OBJ->gender != 'female')
        {
         $Error .= "Please select a valid gender" ."<br>";
       
        }
    }


   

    if($Error == "")
    {

        $query = "INSERT INTO `users`(userid,username,email,gender,password,date)VALUES(:userid,:username,:email,:gender,:password,:date)";
        $result = $DB->write($query,$data);

        if($result)
        {
           
            $info->message = "Your profile was created successfully";
            $info->dataType = "info";
            echo json_encode($info);// encode to send
            die;
        }
        
        $info->message = "Oops something went wrong";
        $info->dataType = "error";
        echo json_encode($info);// encode to send
        //die;
        
    }else
    {
        
        $info->message = $Error;
        $info->dataType = "error";
        echo json_encode($info);// encode to send
    }
?>