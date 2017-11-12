<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');


        /*--------- Header ---------*/
        $TO = "sebspas@gmail.com";
        $head = "From : no-replay@51.255.41.18";
        /*--------- Categories ---------*/
        $phone = $_POST['phone'];
        $name = utf8_decode($_POST['name']);
        $objet = utf8_decode($_POST['objet']);
        $content = utf8_decode($_POST['content']);
        $subject = "[Formulaire site PortFolio] ";
        $email = $_POST['mail'];

    $erreurs = 0;
    if(isset($_POST['g-recaptcha-response'])){
        $captcha=$_POST['g-recaptcha-response'];
    }

    $error = '';
    $erreurs = 0;
    if(isset($_POST['g-recaptcha-response'])){
        $captcha=$_POST['g-recaptcha-response'];
    }

    /*--------- Contenu Mis en Forme ---------*/
    if(!$captcha){
        $error = 'Please check the the captcha form.';
        $erreurs++;
    }
        if ($name == "")
        {
        $error = "Please enter a valid Name Info";
                $erreurs++;
        }
    else if ($objet == "")
    {
        $error = "Please enter an object for your mail";
        $erreurs++;
    }
        else if ($email == "")
        {
        $error = "Please enter an mail address";
                $erreurs++;
        }
        else if ($content == "")
        {
        $error = "Enter some text in content...";
                $erreurs++;
        }
        if ($erreurs == 0)
        {
        // check google captcha
        $secretKey = "";
        $ip = $_SERVER['REMOTE_ADDR'];
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
        $responseKeys = json_decode($response,true);
        if(intval($responseKeys["success"]) !== 1) {
            $error = 'You are spammer ! Get the @$%K out';
        } else {
            $content =  'Objet : ' . $objet . "\n\n"
            . 'Name : ' . $name . "\n"
            . 'Mail : ' . $email . "\n"
            . 'Phone : ' . $phone . "\n"
            . 'Content : ' . $content . "\n\n" ;
           if(mail($TO, $subject, $content, $head)) {
               $error = "Ok";
           } else {
               $error = "An error appear while sending your mail...";
           }
        }
        }

    echo json_encode($error);
?>