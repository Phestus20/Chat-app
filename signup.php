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
        #wrapper{
            max-width: 900px;
            min-height: 500px;
            margin: auto;
            color: grey;
            font-family: myRegularFont;
            font-size: 13px;
    
        }

        form{
            margin: auto;
            padding: 10px;
            width: 100%;
            max-width: 400px;
        }

        input[type=text],input[type=password],input[type=button],input[type=email]{
            padding: 10px;
            margin: 10px;
            width: 98%;
            border-radius: 6px;
            border: solid thin grey;
        }

        input[type=button]{
            width: 104.5%;
            cursor: pointer;
            background-color: #2b5488;
            color: #fff;
        }

        input[type=radio]{
            transform: scale(1.2);/*adds the size*/
            cursor: pointer;
        }

        #header{
            background-color: #485b6c;
            font-size: 40px;
            text-align: center;
            font-family: summerHeadFont;
            width: 100%;
            color: #fff;
        }

        #error{
            text-align: center; 
            padding: 0.5em;
            color:orangered;
            display:none
        }
        
</style>
<body>
 
    <div id="wrapper">
        <div id="header">Chatup
        <div style="font-size:22px; font-family:myRegularFont;">Sign up</div>
        </div>
        <div id="error"></div>
        <form action="" id="my_form">
            <input type="text" name='username' placeholder="Username">
            <input type="email" name='email' placeholder="Email">
            <div style="padding:10px;">
                <br>Gender:<br>
                <input type="radio" id="gender_male" value='male' name='gender' >Male<br>
                <input type="radio" id="gender_female"  value='female' name='gender' >Female<br>
            </div>
            
            <input type="password" name='password' placeholder="Password"><br>
            <input type="password" name='password2' placeholder="Retype Password"><br>
            <input type="button" value='Sign up' id="signup_btn">
            <p style=" text-align:center;"> Already have an account   <a href="login.php" class="" >   Login here</a></p>
        </form>

        


    </div>
  
</body>
</html>

<script type="text/javascript">

   
        function _(element){
           return document.getElementById(element);
        }

        var signupBtn = _('signup_btn');
        signupBtn.addEventListener('click', collectData);

        function collectData ()
        {
            signupBtn.disabled = true;//disable while sending;
            signupBtn.value = "Loading please wait...";//disable while sending;

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
            sendData(data,'signup');
           
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
                     signupBtn.disabled = false;//enable after sending;
                     signupBtn.value = "Signup";

                }
            }
                data.dataType = type;
                var dataString = JSON.stringify(data);
                xml.open('POST','api.php',true);
                xml.send(dataString);
           
        }

        // handle flash message
        function handleResult(result)
        {
            var data = JSON.parse(result);
            if(data.dataType == 'info')
            {
                window.location = "index.php";
            }else
            {
                var error = _("error");
                error.innerHTML = data.message;
                error.style.display = 'block';
            }
        }
    </script>