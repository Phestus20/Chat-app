<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatup</title>
</head>
<style type="text/css">
    @font-face{
        font-family: summerHeadFont;
        src: url(./ui/fonts/Summer-Vibes-OTF.otf);
    }
    @font-face{
        font-family:myRegularFont;
        src: url(./ui/fonts/OpenSans-Semibold.ttf);
    }
      
    #wrapper {
    max-width: 900px;
    min-height: 500px;
    max-height: 630px;
 
    display: flex;
    margin: 0 auto;
    margin-top: 5%;
    color: #fff;
    font-family: myRegularFont;
    font-size: 13px;
    /* Remove box-shadow */
    
    /* Add elevation effect */
    background: rgba(255, 255, 255, 0.1); /* Light background for contrast */
    border-radius: 12px; /* Optional: round the corners */
    filter: drop-shadow(0px 24px 24px rgba(0, 0, 0, 0.5)); /* Simulates elevation */
    transform: translateY(-4px); /* Slightly lift the element */
}
    
    /* #wrapper{
            max-width: 900px;
            min-height: 500px;
            max-height: 630px;
            display: flex;
            margin: auto;
            color: #fff;
            font-family: myRegularFont;
            font-size: 13px;
            box-shadow: 0px 0px 10px #aaa;
    
        }*/
        #left_panel{
            min-height: 500px;
            background-color: /*#27344b*/#767a81ab;
            flex: 1;
            text-align: center;
        }
        #profile_img{
            width: 50%;
            border-radius: 50%;
            border: 2px solid white;
            text-align: center;
            margin: 10px;
        }
        #left_panel label{
            width: 100%;
            height: 20px;
            display: block;
            background-color: /*#404b56;*/#a7b5c2;
            border-bottom: solid thin #ffffff55;
            cursor: pointer;
            padding: 5px;

            transition: all  1s ease;
           
        }

        #left_panel label:hover{
            background-color: #778593;
            border-bottom: solid thin #ffffff55;
            cursor: pointer;
            padding: 5px;
           
        }


        #left_panel label img{
           float: right;
           width: 25px;
           
        }
        #right_panel{
            min-height: 500px;
            box-shadow: 0px 0px 10px #aaa;
        
            flex: 4;/*to share the same value*/
        }
        #header{
            height: 70px;
            background-color: /*#485b6c*/ #B8C3CE;
            font-size: 40px;
            text-align: center;
            font-family: summerHeadFont;
            position: relative;
          /*  box-shadow: 0px 0px 10px #aaa;*/
        }
        #inner_left_panel{
            background-color: /*#383e48*/ #ABBCCD;
            min-height: 430px;
            max-height: 530px;
            flex: 1;
            text-align: center;
        }

       
       #inner_right_panel{
            background-color: #f2f7f8;
            min-height: 430px;
            max-height: 530px;
            flex: 2;
            transition: all 1s ease;
            text-align: center;
        }

         /* when the #radio_chat is checked, ~(siblinds), render the inner_right_panel, 
        for it to work there must be siblings and the controller must come b4*/
       #radio_settings:checked ~ #inner_right_panel{
            flex: 0;
        }
        #radio_contact:checked ~ #inner_right_panel{
            flex: 0;
        }

        #contact{
            width: 100px;
            height: 120px;
            margin: 10px;
            display: inline-block;
            vertical-align: top;
            
        }

        #contact img{
            width: 100px;
            height: 100px;
            border: 2px solid #fff;
            border-radius: 50%;
            object-fit:cover;
        }

    
/* active contact, a distinct selected user*/
        #active_contact{
            height: 70px;
            margin: 10px;
            border: solid thin #aaa;
            padding: 2px;
            border-radius: 6%;

            background-color: #eee;
            color: #444;
            cursor:pointer;
            transition: all .5s ease/*cubic-bezier(0.68, -2, 0.265, 1.55)*/;
        }

        #active_contact img{
            width: 50px;
            height: 50px;
            float: left;
           margin: 6px;
            
            border: 2px solid #fff;
            border-radius: 50%;
          object-fit:cover;
        }

        #active_contact:hover{
        transform: scale(1.1);
     }

        #message_left{
            margin: 10px;
            padding: 2px;
            padding-bottom: 12px;
            padding-left: 10px;
            background-color: #e996143b; 
            color: #444;
            float: left;
            box-shadow: 0px 0px 10px #aaa;
            border-radius: 0 0 0 50%;
           
            position: relative;
            width: 60%;
            min-width: 200px;
        }

/* note this div is actually inner right panel*/
        #message_left #prof_img{
            width: 60px;
            height: 60px;
            float: left;
            margin: 2px;
          object-fit:cover;
           border-radius: 50%;
           border: 2px solid #fff;
        }

        #message_left div{
            width: 20px;
            height: 20px;
           
            border-radius: 50%;
            position: absolute;
            left: -5px;
            top: 5px;
          
        }

        #message_right{
            margin: 10px;
            padding: 2px;
            padding-right: 10px;
            background-color: #b9e3f04d;
            color: #444;
            float: right;
           /* box-shadow: 0px 0px 10px #aaa;*/
            border-radius: 0 50% 0 0;
            position: relative;
            width: 60%;
            min-width: 200px;
        }

/* note this div is actually inner right panel left message*/
        #message_right #prof_img{
            width: 60px;
            height: 60px;
            float: left;
            margin: 2px;
          object-fit:cover;
           border-radius: 50%;
           border: 2px solid #fff;
        }

        #message_right div img{
            width: 20px;
            height: 18px;
            float: none;
            margin: 0px;
           object-fit:cover;
           border-radius: 50%;
           border: none;
           position: absolute;
           top: 30px;
           right: 10px;
        }

        #message_right #trash{
            width: 12px;
            height: 12px;
            
           position: absolute;
           bottom: 5px;
           left: -10px;
           cursor: pointer;
        }

        #message_left #trash{
            width: 12px;
            height: 12px;
            
           position: absolute;
           bottom: 5px;
           right: -10px;
           cursor: pointer;
        }




        #message_right div{
            width: 20px;
            height: 20px;
            background-image: url('./images/chat2.png');
            border-radius: 50%;
            position: absolute;
            right: -5px;
            top: 5px;
          
        }
        #message_right div #img22{
            background-color: red;
        }
        
        
        .loader_on{
            position: absolute;
          
            width: 30%;
            margin-top: 10px;
        }

        .loader_off{
        display: none;
        }

        .image_on{
            position: absolute;
            width: 650px;
            height: 540px;
            cursor: pointer;
            margin: auto;
            z-index: 10;
            top: 50px;
            left: 50px;
        }

        .image_off{
        display: none;
        }

/* small screens*/
        #menu {
            background-color: /*#383e48*/ #ABBCCD;
            min-height: 430px;
            max-height: 530px;
            flex: 1;
            text-align: center;
        }

    #below-contact-container{
    display: none;
    }


        @media screen and (min-width: 200px) and (max-width: 800px) {
        #message_left #prof_img,
        #message_right #prof_img {
        width: 25px;
        height: 25px;
        }

        #message_left div img,
        #message_right div img {
            width: 10px;
            height: 10px;
            object-fit: cover;
            }

            #contact img {
            width: 60px;
            height: 60px;
            }

            #anim {
            overflow: hidden;
            width: 100%;
            }

            #message_text{
                width: 50%;
            }
            
          

            #message_left > span{
            float: right;
            }

            #chatup{
                font-size: medium;
            }

            #active_contact{
             
                display: flex;
                flex-direction: column;
                align-items: center;
                height: auto;
                width: auto;
            }

            #active_contact img{
                width: 40px;
                height: 40px;
            }

            
} 
</style>
<body>
 
    <div id="wrapper">

        <div id="left_panel">
            <div  id="user_info" style="padding:10px;">
                <img id="profile_img" src="./images/friend.png" alt="profile image"
                style="width: 100px; height:100px;" >
                <br>
               <span id="username">Username</span>
                <br>
               <span style="font-size: 12px; opacity:.5" id="email">email@gmail.com</span>
               <br><br><br>

               <div class="div">
                    <label for="radio_chat"  id="label_chat">Chat <img src="./images/chat1.png" alt="chating icon"></label>
                    <label for="radio_contact" id="label_contact">Contacts <img src="./images/contact.png" alt="friends icon"></label>
                    <label for="radio_settings" id="label_settings">Settings <img src="./images/settings.png" alt="settings"></label>
                    <label for="radio_logout" name="logout" id="logout">Logout <img src="./images/logout.png" alt="logout icon"></label>
               </div>
            
               
            </div>
            
           
        </div>



        <div id="right_panel">

            <div id="header"> 
            <div class="loader_on" id="loader_holder"><img src="./images/loading.gif" alt="loading" style="width: 70px;" ></div>
                <div id="image_viewer" class="image_off" onclick="closeImage(event)"></div>
                <span id="chatup"> Chatup </span>
            </div>
                
          

            <div id="container" style="display:flex;">

              
    <!-- menu items --> 
    <div id='menu'>
               <div id="inner_left_panel"> 
                 <!-- menu labels here -->
                </div>
    </div>
   <!-- menu items --> 


                <input type="radio" id="radio_chat" name="my_radio" style="display: none;">
                <input type="radio" id="radio_contact" name="my_radio" style="display: none;">
                <input type="radio" id="radio_settings" name="my_radio" style="display: none;">
                <input type="radio" id="radio_logout" name="my_radio" style="display: none;">

                

                <div id="inner_right_panel">
                </div>


            </div>

        </div>


    </div>
  
</body>
</html>
<?php sleep(.3) // sleep for the dom elements to load?>
<script type="text/javascript"> 











    var sent_audio = new Audio("./images/send.mp3");
    var receive_audio = new Audio("./images/receive.mp3");
var CURRENT_CHAT_USER = "";
var SEEN_STATUS = false;
    //document.addEventListener('DOMContentLoaded', makes sure the content 
    //is loaded b4 the script runs 

   //    document.addEventListener('DOMContentLoaded', function() {
    function _(element) {
        return document.getElementById(element);
    }

    var labelContact = _("label_contact");
    labelContact.addEventListener('click',getContacts);

    var logout = _("logout");
    logout.addEventListener('click',LogoutUser);

    var labelChat = _("label_chat");
    labelChat.addEventListener('click',getChats);

    var labelSettings = _("label_settings");
    labelSettings.addEventListener('click',getSettings);

    function _e(listener, func) {
        return addEventListener(listener, func);
    }

    function getData(find, type) {

        var xml = new XMLHttpRequest();

         // loader gif display when loading request
        var loader_holder = _('loader_holder');
        loader_holder.className = "loader_on";

        xml.onload = () => {
            if (xml.readyState == 4 || xml.status == 200) {
                // loader gif off when request is ready
                loader_holder.className = "loader_off";
                handleResult(xml.responseText, type);
            }
        }
        var data = {};
        data.find = find;
        data.dataType = type;
        var data = JSON.stringify(data);
        xml.open('POST', 'api.php', true);
        xml.send(data);
    }

    function handleResult(result, type) {
       // alert(result)
        if (result.trim() != "") {

            var inner_right_panel = _('inner_right_panel');
            inner_right_panel.style.overflow = "visible";//visible untile clicked on contact


            var obj = JSON.parse(result);
            if (typeof(obj.logged_in) != "undefined" && !obj.logged_in) {

                window.location = "login.php"

            } else {

             
                switch (obj.dataType) {// where the sent messages are received

                    case "user_info":
                        var username = _('username');
                        var email = _('email');
                        var profile_img = _('profile_img');

                        if (username && email) {// works during change image alone
                            username.innerHTML = obj.username;
                            email.innerHTML = obj.email;
                            profile_img.src = obj.image;
                        } else {
                            console.error("Username or Email element not found");
                        }
                        break;

                        case "contacts":
                            SEEN_STATUS = false;
                            var inner_left_panel = _('inner_left_panel');
                           
                            inner_right_panel.style.overflow = "hidden";
                            inner_left_panel.innerHTML = obj.message;
                        break;

                        case "chats_refresh":
                            SEEN_STATUS = false;
                            var messages_holder = _('messages_holder');
                            messages_holder.innerHTML = obj.messages;
                            if(typeof obj.new_message != 'undefined')
                                {
                                    if(obj.new_message)
                                        {
                                          receive_audio.play(); 
                                           //auto scrows when new message
                                        setTimeout(function(){
                                        messages_holder.scrollTo(0,messages_holder.scrollHeight);
                                        var message_text = _('message_text');
                                        message_text.focus();// so the input should be focused
                                        },100);
                                           
                                        }
                                }
                            
                            break;

                        case "send_message":
                            sent_audio.play();

                        case "chats"://where  we receive chats
                            SEEN_STATUS = false;
                        var inner_left_panel = _('inner_left_panel');
                        inner_left_panel.innerHTML = obj.user;//display in left panel
                        inner_right_panel.innerHTML = obj.messages;//display in right panel
                       
                        var left_panel = _('left_panel');

                        if(window.innerWidth < 600 && window.innerWidth > 300){

                        left_panel.style.display = 'none';

                        document.getElementById('wrapper').style.overflowX = 'hidden';

                        //add these
                        var rightPanel = document.getElementById('right_panel');
                        rightPanel.style.width = '100%';

                        var innerRightPanel = document.getElementById('inner_right_panel'); 
                        innerRightPanel.style.width = '70%';
                        }


                        // scroll down after receving or sending to show current sent msg
                        var messages_holder = _('messages_holder');
                           // messages_holder.scrollTo(0,messages_holder.scrollHeight);
                            // incase it is not auto scrolling use settimer
                            setTimeout(function(){
                            messages_holder.scrollTo(0,messages_holder.scrollHeight);
                            var message_text = _('message_text');
                            message_text.focus();// so the input should be focused
                            },100);
                            if(typeof obj.new_message != 'undefined')
                                {
                                    if(obj.new_message)
                                        {
                                          receive_audio.play();  
                                        }
                                }
                        break;

                        case "settings":

                        var inner_left_panel = _('inner_left_panel');
                        inner_left_panel.innerHTML = obj.message;

                        break;

                        case "send_image":
                            alert(obj.message);
                            break;

                        case "save_settings":
                        alert(obj.message);
                        //var inner_left_panel = _('inner_left_panel');
                        getData({}, "user_info"); //this reloads the user_info page
                        getSettings(true);//this reloads the settings page
                        break;
                        
                }
               
            }
        }
    }

    function LogoutUser()
    {
        var answer = confirm("Are you sure you want to logout?");
        if(answer)
        {
            getData({}, "logout");  
        }
        
    }

    getData({}, "user_info");

    // loads the contact immi. as the page loads, 
    getData({}, "contacts");
    //and also check the contact radio for it to work!
    var radio_contact = _('radio_contact');
    radio_contact.checked = true;
  

    function getContacts(e)
    {
        getData({}, "contacts");
    }

    function getChats(e)
    {
        getData({}, "chats");
    }

    function getSettings(e)
    {
        getData({}, "settings");
    }

    function sendMessage(e)
    {
        var message_text = _('message_text');
        
        if(message_text.value.trim() == "")
        {
            alert("The message box is empty")
            return;
        }
     //   alert(message_text.value.trim())
        getData({ message:message_text.value.trim(),//bulding obj to send
                   userid:CURRENT_CHAT_USER//bulding obj to send
                                            }, "send_message");
          

        
    }

    //to send message when press enter
    function enterPressed(e)
    {
        //alert(event.keyCode);// to know the exact number of a key
        if(event.keyCode == 13)
        {
            sendMessage(e);
        }

        SEEN_STATUS = true;
    }

    // to refresh the data base to we can get new messages
    setInterval(function(){
        var radio_chat = _("radio_chat"); // to stop refresh when chat is not checked
        var radio_contact = _("radio_contact"); // to stop refresh when chat is not checked
        if(CURRENT_CHAT_USER != "" && radio_chat.checked)
        {
            getData({userid:CURRENT_CHAT_USER,
                       seen:SEEN_STATUS
                                              }, "chats_refresh");// to go to chat section once we click on a photo

        }
        // to notify if unread messages
        if(radio_contact.checked)
        {
            getData({}, "contacts");// refresh contacts only
        }
       
    },7000);

    function setSeen(e)
    {
        SEEN_STATUS = true;
    }

    function deleteMessage(e)
    {
        if(confirm("Are you sure you want to delete this message?"))
        {
            var msgid = e.target.getAttribute("msgid");

            getData({rowid:msgid}, "delete_message"); // the delete data

            getData({userid:CURRENT_CHAT_USER,
                       seen:SEEN_STATUS
                                              }, "chats_refresh")// get data to refresh
        }
    }

    function deleteThread(e)
    {
        if(confirm("Are you sure you want to delete this whole thread?"))
        {
            getData({userid:CURRENT_CHAT_USER}, "delete_thread"); // the delete data

            getData({userid:CURRENT_CHAT_USER,
                       seen:SEEN_STATUS
                                              }, "chats_refresh")// get data to refresh
        }
    }
//});



    </script>















<!-- NEW SCRIPT TAGS FOR SETTINGS-->

<script type="text/javascript">

   
        // function _(element){
        //    return document.getElementById(element);
        // }


        function collectData ()
        {
            save_settings_btn = document.getElementById("save_settings_btn");
            save_settings_btn.disabled = true;//disable while sending;
            save_settings_btn.value = "Loading please wait...";//disable while sending;

            var myForm = _('my_form');
            var inputs = myForm.getElementsByTagName('INPUT');// gives array of input

            var data = {};
            for(var i = inputs.length - 1; i >=0; i--){
                var key = inputs[i].name;

                switch(key)
                {
                    case 'username':
                        data.username = inputs[i].value;
                        break;

                    case 'email':
                        data.email = inputs[i].value;
                        break;

                    case 'gender':
                        if(inputs[i].checked)
                        {
                        data.gender = inputs[i].value;
                        }
                        break;

                    case 'password':
                        data.password = inputs[i].value;
                        break;

                    case 'password2':
                        data.password2 = inputs[i].value;
                        break;
                    
                }
            }
            sendData(data,'save_settings');
           
            //alert(data.username); to check sngle input
           // alert(JSON.stringify(data)); // check all input in JSON format
        }


        function sendData(data,type)
        {
            var xml = new XMLHttpRequest();
            xml.onload = function()// this function is only for the response
            {
                if(xml.readyState == 4 || xml.status == 200)
                {
                    //alert(xml.responseText);// our response is from here
                    handleResult(xml.responseText);// our response is from here

                    save_settings_btn = document.getElementById("save_settings_btn");

                    save_settings_btn.disabled = false;//enable after sending;
                    save_settings_btn.value = "Signup";

                }
            }
                data.dataType = type;
                var dataString = JSON.stringify(data);
                xml.open('POST','api.php',true);
                xml.send(dataString);
           
        }


getData({}, "user_info");



function uploadProfileImage(files)
{
    var filename = files[0].name // check format
        var ext_start = filename.lastIndexOf(".");
        var ext = filename.substr(ext_start+1,3);
        if(!(ext == "jpg" || ext == "png") && !(ext == "JPG" || ext == "PNG"))
            {
              alert("Only jpg and png formats are allow");
              return;
            }
           

    change_image_btn = document.getElementById("change_image_btn");
    change_image_btn.disabled = true;//enable after sending;
    change_image_btn.innerHTML = "Uploading image...";

    var myform = new FormData();// gets the for data that will be sent

    var xml = new XMLHttpRequest();
            xml.onload = function()// this function is only for the response
            {
                if(xml.readyState == 4 || xml.status == 200)
                {
                   
                   // handleResult(xml.responseText);// our response is from here
                   getData({}, "user_info"); //this refeshes the user_info page
                   getSettings(true);//this refeshes the settings page
                   change_image_btn.disabled = false;//enable after sending;
                   change_image_btn.innerHTML = "Change image";

                }
            }
             
                myform.append('file', files[0]) 
                myform.append('dataType', "change_profile_image");

                xml.open('POST','uploader.php',true);
                xml.send(myform);

}

// handles drag and drop images
    function handleDragDrop(e)
    {
        if(e.type == "dragover")
        {
            e.preventDefault();
           e.target.className = "dragging" ;
        }else if(e.type == "dragleave")
        {
            e.preventDefault();
            e.target.className = "";
             
        }else if(e.type == "drop")
        {
            e.preventDefault();
            e.target.className = ""; // upload/move the image
            uploadProfileImage(e.dataTransfer.files)
        }
    }

    // to go to chat section once we click on a photo
    function startChat(e)
    {
        var userid = e.target.getAttribute("userid");
        if(e.target.id == "")
        {
            userid = e.target.parentNode.getAttribute("userid"); // if we miss clicking child we get parent
        }

        CURRENT_CHAT_USER = userid;
        var radio_chat = _('radio_chat');
        radio_chat.checked = true;
        getData({userid:CURRENT_CHAT_USER}, "chats");// to go to chat section once we click on a photo

    }
   


// sending files
    function sendImage(files)
    {
        var filename = files[0].name
        var ext_start = filename.lastIndexOf(".");
        var ext = filename.substr(ext_start+1,3);
        if(!(ext == "jpg" || ext == "png") && !(ext == "JPG" || ext == "PNG"))
            {
              alert("Only jpg and png formats are allow");
              return;
            }
           
            var myform = new FormData();// gets the for data that will be sent

          var xml = new XMLHttpRequest();
            xml.onload = function()// this function is only for the response
            {
                if(xml.readyState == 4 || xml.status == 200)
                {
                    handleResult(responseText,"send_image");
                    getData({userid:CURRENT_CHAT_USER,
                       seen:SEEN_STATUS
                                              }, "chats_refresh")// get data to refresh
                }
            }
             
                myform.append('file', files[0]) 
                myform.append('dataType', "send_image");
                myform.append('userid', CURRENT_CHAT_USER);

                xml.open('POST','uploader.php',true);
                xml.send(myform);
      
    }

    function closeImage(e)
    {
        e.target.className = "image_off";
    }

    function imageShow(e)
    {
       var image =  e.target.src;
       var image_viewer = _("image_viewer");
       image_viewer.innerHTML = "<img src='"+image+"' style='width:100%' />";
       image_viewer.className = "image_on";
    }
    </script>
