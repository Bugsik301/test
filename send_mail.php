<?php

    header('Content-Type: text/html; charset=utf-8');

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {   
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $message = trim($_POST['message']);

        if (empty($name) || empty($email) || empty($phone) || empty($message))
        {
            echo "Wszystkie pola są wymagane.";
            #header('contact.html');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            echo "Niepoprawny adres e-mail.";
            #header('contact.html');
        }

        $to = "pb.patryk.bujak@gmail.com";
    
        $subjectText = "Formularz kontaktowy od: $name";
        $subject = '=?UTF-8?B?' . base64_encode($subjectText) . '?=';

        $body  = "Imię i nazwisko: $name\n";
        $body .= "E-mail: $email\n";
        $body .= "Telefon: $phone\n";
        $body .= "Wiadomość:\n$message\n";

        $headers  = "From: =?UTF-8?B?" . base64_encode($name) . "?= <$email>\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

        if (mail($to, $subject, $body, $headers))
        {
            echo "Wiadomość została wysłana pomyślnie!";
           #header('contact.html');
        } else 
        {
            echo "Wystąpił błąd podczas wysyłania wiadomości.";
           # header('contact.html');
        }
    } else 
    {
        echo "Błędne wywołanie skryptu.";
        #header('contact.html');
    }
?>
