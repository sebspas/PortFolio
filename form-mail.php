<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');


	/*--------- Header ---------*/
	$TO = "sebspas@gmail.com";
	$head = "From : " . ($email = $_POST['mail']);
	/*--------- Categories ---------*/
	$phone = $_POST['phone'];
	$name = utf8_decode($_POST['name']);
	$objet = utf8_decode($_POST['objet']);
	$content = utf8_decode($_POST['content']);
	$subject = "[Formulaire site PortFolio] ";

    $error = '';
	/*--------- Contenu Mis en Forme ---------*/
	$erreurs = 0;
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
        $content =  'Objet : ' . $objet . "\n\n"
         . 'Name : ' . $name . "\n"
         . 'Phone : ' . $tel . "\n"
         . 'Content : ' . $content . "\n\n" ;
		if(mail($TO, $subject, $content, $head)) {
			$error = "Ok";
		} else {
			$error = "An error appear while sending your mail...";
			$erreurs++;
		}

	}
	else
	{

	}

    echo json_encode($error);
?>