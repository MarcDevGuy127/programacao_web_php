<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_title = $_POST['email_title'];
    $email_body = $_POST['email_body'];
    $email_author = $_POST['email_author'];


    $to = "ficticious@gmail.com";
    $subject = $email_title;
    $body = "Hi! My name is: $email_author\nEmail: $email_title\n$email_body";

    $headers = "From: $email_title";

    if (mail($to, $subject, $body, $headers)) {
        echo "E-mail submited!";
    } else {
        echo "\n";
        echo "\n The PHP submit button don't make a PHP server operation. That PHP code doesn't work on server.";
        echo "\n I am using JS for show a demonstration while that alert is showed!";
    }

    $errors = [];

    if (empty($email_title)) {
        $errors[] = "Type a title for the email is mandatory.";
    }

    if (empty($email_body)) {
        $errors[] = "Type a text for the email is mandatory.";
    }

    if (empty($email_author)) {
        $errors[] = "Identify yourself is mandatory.";
    }

    if (!empty($errors)) {
        echo "<h1 style='color: red;background-color: white;'>The following errors was found:</h1>";
        echo "<ul style='color: red; background-color: white;'>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
        echo "<a href='../index.html'>Retorne to the main page</a>";
        exit;
    }
}

?>
