<?php 
$id = $_SESSION['userid'];
$sql = "SELECT * FROM users WHERE userid = :userid LIMIT 1";
$data = $DB->read($sql,['userid'=>$id]);
$mydata = '';
if(is_array($data))
{
    $data = $data[0];

    // check if image exist
    $image = ($data->gender == "male")  ? "./images/malecolor.png" : "./images/female.png";
 // check if image file exist
    if(file_exists($data->image))
    {
        $image = $data->image;
    }

    $gender_female = '';
    $gender_male = '';
    if($data->gender == "male")
    {
        $gender_male = "checked";
    }else if ($data->gender == "female")
    {
        $gender_female = "checked";
    }

    // this is the full info to be sent that will display,
        $mydata = '
    <style type="text/css">

    @keyframes appear{
            0%{opacity:0; transform: translateY(-100px) rotate(15deg); trnsform-origin:50% 50%}
           /* 50%{opacity: .5; transform: translateY(-50px) rotate(10deg); trnsform-origin:50% 50%}*/
            100%{opacity: 1; transform: translateY(0px) rotate(0deg);}
     }
 

        form{
            text-align: left;
            margin: auto;
            padding: 10px;
            width: 100%;
            max-width: 400px;
        }

        input[type=text],input[type=password],input[type=button],input[type=email]{
            padding: 10px;
            margin: 10px;
            width: 80%;
            border-radius: 6px;
            border: solid thin grey;
        }

        input[type=button]{
            width: 85.5%;
            cursor: pointer;
            background-color: #2b5488;
            color: #fff;
        }

        input[type=radio]{
            transform: scale(1.2);/*adds the size*/
            cursor: pointer;
        }

        
        #error{
            text-align: center; 
            padding: 0.5em;
            color:orangered;
            display:none
        }
       .dragging{

            border: 2px dashed #aaa;
            }
        
</style>

    <div id="error">Error</div>

    <div style="display:flex; animation: appear 0.7s ease">
       
            <div style="margin:0 auto;"> 
            <span style="font-size:11px;opacity:0.7;display:block; margin-top:5px;">Drag and drop image</span>
                <img ondragover="handleDragDrop(event)"   src="./'.$image.'" alt="profile image" style=" width:150px; 
                height:180px; margin:10px;object-fit:cover; border-radius:16px;"
                ondrop="handleDragDrop(event)" ondragleave="handleDragDrop(event)" /><br>
            
                <label for="change_image_input" id="change_image_btn" style="display:inline-block; 
                background-color:#406089; padding: .7em; border-radius:5px;cursor:pointer">
                Change image
                </label>
                <input type="file" id="change_image_input" onchange="uploadProfileImage(this.files)" style="display:none;">
                
            </div> 

            <form action="" id="my_form">
                <input type="text" name="username"  value="'.$data->username.'">
                <input type="email" name="email"  value="'.$data->email.'">
                <div style="padding:10px;">
                    <br>Gender:<br>
                    <input type="radio" id="gender_male" value="male" name="gender" '.$gender_male.'>Male<br>
                    <input type="radio" id="gender_female"  value="female" name="gender" '.$gender_female.'>Female<br>
                </div>
                
                <input type="password" name="password" value="'.$data->password.'"><br>
                <input type="password" name="password2" value="'.$data->password.'" Password"><br>
                <input type="button" value="Save settings" id="save_settings_btn" onclick="collectData(event)">
            
            </form>
    </div>

    
  



';

   // contains the object that will be carried to send with img, name, etc,
    $info->message = $mydata;
    $info->dataType = "contacts";
    echo json_encode($info);// encode to send
 
}else
{
    $info->message = "No contacts were found";
    $info->dataType = "error";
    echo json_encode($info);// encode to send
}
   
?>

