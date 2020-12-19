<?php

// send SMS
function SMS($phone_number){
    $username="YOUR_USERNAME";   
    $password ="YOUR_PASSWORD";
    $senderid  = "YOUR_SENDERID";
    $number = $phone_number;
    $message = "Hi there.";
    // $message = str_replace(" ","%20","Hi there.");
    
    $url2= "http://bulksms.saakshisoftware.in/api/mt/SendSMS?user=".urlencode($username)."&password=".urlencode($password)."&senderid=".urlencode($senderid)."&channel=trans&DCS=0&flashsms=0&number=".urlencode($number)."&text=".urlencode($message)."&route=04";

    $ch2 = curl_init($url2);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);


    $curl_scraped_page = curl_exec($ch2);
    curl_close($ch2); 
}

if(isset($_POST['sub'])){

    $phone_number = $_POST['phone_number'];
    SMS($phone_number);
}

$username="YOUR_USERNAME";   
    $password ="YOUR_PASSWORD";
// How many SMS remaining?
    //http://bulksms.saakshisoftware.in/api/mt/GetBalance?User=demo&Password=demo123
    $url="bulksms.saakshisoftware.in/api/mt/GetBalance?User=$username&password=$password"; 
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


    $curl_scraped_page = curl_exec($ch);
    curl_close($ch); 

    $b = $curl_scraped_page;
    $array = json_decode($b,true);
    $b = explode('|',$array["Balance"]);
    $remainingcredits = $b[1];




    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS</title>
</head>
<body>
    <h1>Quantity Of Remainnig SMS ?</h1>
    <p><b><?php echo $remainingcredits;?></b></p>
</body>
</html>







<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SEND SMS</title>
</head>
<body>
<div id="homepage">
   
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">

                    

                    <div class="panel-heading">
                        <h3 class="panel-title">Welcome to my site</h3>
                    </div>
                    <div class="panel-body">
                        <form id="myForm1" method="POST"  role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Your Phone Number" name="phone_number" type="number" autofocus>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button id="submitBtn" name="sub" type="submit" class="btn btn-success btn-block">Send Message</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /.container -->

</div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script>
    $('#myForm').submit(function(){
        $('#submitBtn').html('Sending...');
    });
</script>

</html>
