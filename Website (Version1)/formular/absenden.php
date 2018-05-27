<!doctype html>
<html>
<head>
<meta charset="utf-8">

</head>
<body>

<?php

if(isset($_POST['email'])) {

/*
Gebe hier deine Email Adresse ein und deinen Betreff
 */


    $email_to = "bahss.kabasele@gmail.com";

    $email_subject = "Email Betreff hier eingeben";





    function died($error) {

        // Deinen Fehlercode kannst du hier eintragen.

        echo "Entschuldigung, aber das abgeschickte Formular enthielt Fehler. ";

        echo "Die Fehler werden unten aufgeführt<br /><br />";

        echo $error."<br /><br />";

        echo "Gehen Sie bitte zurück und beheben Sie die Fehler.<br /><br />";

        die();

    }



// Hier wird überprüft, ob die Emailfelder überhaupt existieren, nicht ob etwas eingegben wurde.
//first_name ist ein Formularfeld mit name="first_name" man nennt es auch Variablenname
//wenn weitere Formularfelder im Emailformular enthalten sind, muss man diese hier nach dem gleichen Schema einfügen


    if(!isset($_POST['name']) ||

        //!isset($_POST['last_name']) ||
		//hier kann man nach gleichem Schema ein weiteres Feld einfügen z.B. ort es muss aber dann auch
		//ein input Feld mit name="ort" vorhanden sein. ort ist natürich nur ein Beispielname.
		//!isset($_POST['ort']) ||

        !isset($_POST['email']) ||

        !isset($_POST['subject']) ||

        !isset($_POST['message'])) {

        died('Entschuldigung, aber das abgeschickte Formular enthielt Fehler.');

    }

 /* Hier werden die Variablen abgeholt $first_name ist eine PHP Variable
Dabei ist first_name ein selbst vergebener Name. Der darf keine Sonderzeichen/ Leerzeichen enthalten
und darf nicht mit einer Zahl beginnen. Der Einfachheit halber habe ich PHP Variable und empfangene Variable gleich benannt */

    $name = $_POST['name']; // required

    //$last_name = $_POST['last_name']; // required
	//nächste Zeile Beispiel, nicht vergessen  ort 2mal eintragen

	//$ort = $_POST['ort'];

    $email_from = $_POST['email']; // required

    $subject = $_POST['subject']; // not required

    $message = $_POST['message']; // required

/*
Im folgenden werden Pflichtfelder überprüft. In diesem Falle sind es die Pflichtfelder
email, first_name, last_name, comments
Wenn du weitere Felder überprüfen willst, kopiere die Zeilen 103 bis 107 füge sie darunter ein
und ersetze $last_name durch eine andere Variable und passe den Fehlertext an.
*/

    $error_message = "";

    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if(!preg_match($email_exp,$email_from)) {

    $error_message .= 'Sie haben keine gültige Email Adresse eingegeben.<br />';

  }

    $string_exp = "/^[A-Za-z .'-]+$/";

  if(!preg_match($string_exp,$name)) {

    $error_message .= 'Der Vorname wurde nicht korrekt eingegeben.<br />';

  }


  if(strlen($message) < 2) {

    $error_message .= 'Ihre Nachricht wurde nicht korrekt eingegeben.<br />';

  }

  if(strlen($error_message) > 0) {

    died($error_message);

  }

    $email_message = "Details des Formulars unten.\n\n";



    function clean_string($string) {

      $bad = array("content-type","bcc:","to:","cc:","href");

      return str_replace($bad,"",$string);

    }

 // hier wird die email zusammengebaut, auch hier muss evt. noch die Variable angehängt werden

    $email_message .= "Vorname: ".clean_string($name)."\n";

    //$email_message .= "Nachname: ".clean_string($last_name)."\n";
	//Beispiel ort nächste Zeile
	//$email_message .= "Wohnort: ".clean_string($ort)."\n";

    $email_message .= "Email: ".clean_string($email_from)."\n";

    $email_message .= "Telefon: ".clean_string($subject)."\n";

    $email_message .= "Nachricht: ".clean_string($message)."\n";



// create email headers
$headers   = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/plain; charset=utf-8";
$headers[] = "From: {$email_from}";
$headers[] = "Reply-To: {$email_from}";
$headers[] = "Subject: {$email_subject}";
$headers[] = "X-Mailer: PHP/".phpversion();



@mail($email_to, $email_subject, $email_message, implode("\r\n",$headers));

?>



<!-- Füge hier deinen eigenen Text für den erfolgreichen Emailversand ein. -->



Vielen Dank für Ihre Kontaktaufnahme. Wir werden uns bald möglichst bei Ihnen melden.



<?php

}

?>
</body>
</html>
