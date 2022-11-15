<?php



session_start();


if (isset($_POST['login'])  &&
    isset($_POST['e-mail']) &&
    isset($_POST['pass1'])  &&
    isset($_POST['pass2']))
{

    //Zmienna Ktora sprawadza czy zostaly spelnione wszystkie rzeczy
    $True_Condition=true;


    //Wiadomo
    $login = $_POST['login'];


    //Sprawdzenie Dlugosci Loginu
    if((strlen($login)<3 || strlen($login)>20)) {
        
        $_SESSION['log_info']="Nick Musi miec dlugosc pomiedzy 3 a 20"; 
        $True_Condition=false;
    }


    //Sprawdzenie Czy Login sklada sie z polskich znakow
    if(ctype_alnum($login)==false) {

        $True_Condition = false;
        $_SESSION['log_info']="Nick nie moze zawierac polskich znakow";
    }

    //Email
    $email = $_POST['e-mail'];
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

    
    if (filter_var($emailB, FILTER_VALIDATE_EMAIL)==false 
    ||
    ($emailB != $email)) {
        $True_Condition = false;
        $_SESSION['e-mail_info']="Podaj Poprawny email";
    }


    //Rownosc Hasel oraz Ich dlugosc

    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];


    if($pass1!=$pass2){
        $_SESSION['pass_log1'] = 
        "Hasla Nie sa tej samej nazwy";
    }




    if($True_Condition=true){
        echo "Udana walidacja";
        exit();
    }




    


}

?>




<!DOCTYPE html>


<html>

<head>
    
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<link rel="stylesheet" 
href="StronaRejestracyjnaFront1.css">


</head>

<body>

<div id="Tia">
    <form method="POST">

    <label> Podaj Login:    </label>
        <input type="text" name="login" placeholder="Podaj Login"
        required="required" >

        

    <!-- Pokazanie Komunikatu jeśli login nie zawiera poprawnej Długości :) :( -->
    <?php

        if(isset($_SESSION['log_info'])) {
            echo $_SESSION['log_info'];
            unset($_SESSION['log_info']);
        }

    ?>

    <br/>


    <label> Podaj Email: </label>
        <input type="email" name="e-mail" placeholder="Podaj E-mail"
        required="required" >

    <?php

        if(isset($_SESSION['e-mail_info'])) {
            echo $_SESSON['e-mail_info']; 
            unset($_SESSION['e-mail_info']);
        }

    ?>

    <br/>
    

    <label> Podaj Haslo: </label>
        <input type="password" name="pass1" placeholder="Podaj Haslo"
        required="required">


        <br/>
    <label> Powto Haslo: </label>
        <input type="password" name="pass2" placeholder="Powtorz Haslo"
        required="required">


        <?php


if(isset($_SESSION['e-mail_info'])) {
    echo $_SESSON['e-mail_info']; 
    unset($_SESSION['e-mail_info']);
}

        if(isset($_SESSION['pass_log1'])){
            echo(
            '<div id="pass_error">'
            .$_SESSION['pass_log1'].
            '</div>');
            unset($_SESSION['pass_log1']);
       }
   ?>

    

        <br/>
    <Label> Zaakceptuj Regulamin</Label>
        <input type="checkbox" name="Regulamin" required="required">

        <br/>
        <div class="g-recaptcha" data-sitekey="6LdNqgMjAAAAAHoucHLMxm3CzcmVuxpgvI0Yp0hf"></div>
        <input type="submit" value="Submit"> </input>

    </form>



</div>





</body>

</html>