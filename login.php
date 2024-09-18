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

        input[type=password],input[type=submit],input[type=email]{
            padding: 10px;
            margin: 10px;
            width: 98%;
            border-radius: 6px;
            border: solid thin grey;
        }

        input[type=submit]{
            width: 104.5%;
            cursor: pointer;
            background-color: #2b5488;
            color: #fff;
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
        <div style="font-size:22px; font-family:myRegularFont;">Login</div>
        </div>
        <div id="error">fvdfvbdf</div>
        <form action="" id="my_form">
            
            <input type="email" name='email' placeholder="Email">
    
            <input type="password" name='password' placeholder="Password"><br>
            
            <input type="submit" value='Login' id="login_btn">
            <br>
           <p style=" text-align:center;"> Don't have an account yet?   
            <a href="signup.php" class="" >   Signup here </a></p>
        </form>

        


    </div>
  
</body>
</html>

<script type="text/javascript">

   
document.addEventListener('DOMContentLoaded', function() {
        function _(element){
           return document.getElementById(element);
        }

        var signupBtn = _('login_btn');
        signupBtn.addEventListener('click', collectData);

        function collectData (e)
        {
            e.preventDefault();// stop it from refreshing
            signupBtn.disabled = true;//disable while sending;
            signupBtn.value = "Loading please wait...";//disable while sending;

            var myForm = _('my_form');
            var inputs = myForm.getElementsByTagName('INPUT');// gives array of input

            var data = {};
            for(var i = inputs.length - 1; i >=0; i--){
                var key = inputs[i].name;

                switch(key)
                {
                    case 'email':
                        data.email = inputs[i].value;
                        break;


                    case 'password':
                        data.password = inputs[i].value;
                        break;

                }
            }
            sendData(data,'login');
           
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
                     signupBtn.value = "Login";

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

    }
)
    </script>