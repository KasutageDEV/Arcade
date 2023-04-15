<?php
require('../../global.php');
if(isset($_SESSION['id'])) {
	die('Une erreur est survenue.');
}


if(!empty($_POST['username']) AND !empty($_POST['email']) AND !empty($_POST['password']) AND !empty($_POST['repassword']) AND !empty($_POST['captcha'])) {
    $captcha    = htmlspecialchars($_POST['captcha']);
    $username   = htmlspecialchars($_POST['username']);
    $email      = htmlspecialchars($_POST['email']);
    $date       = date('d-m-Y H:i:s');
    $password   = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $pseudo_exist = $bdd->prepare('SELECT id FROM users WHERE username = ?');
    $pseudo_exist->execute(array($username));

    $link   = file_get_contents('https://api.habbocity.me/avatar_info.php?user='.$username.'&key=Arcade_8757');
    $api_hc = json_decode($link);
    $motto  = $api_hc->{'motto'};
    $look   = $api_hc->{'avatar'};

    if($motto == $captcha)
    {
        if($pseudo_exist->rowCount() == 0) {
            if($username) {
                $mail_exist = $bdd->prepare('SELECT id FROM users WHERE email = ?');
                $mail_exist->execute(array($email));
                if($mail_exist->rowCount() == 0) {
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        if($_POST['password'] == $_POST['repassword']) {
                            if(strlen($_POST['password']) >= 6 AND strlen($_POST['repassword']) >= 6) {
                                $creation_account = $bdd->prepare('INSERT INTO users(username, password, email, motto, look, arcade_coins, points_gamer, points_gamer_all, is_ban, date_register, ip_last, ip_register) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
                                $creation_account->execute(array($username, $password, $email, $motto, $look, 0, 0, 0, 0, $date, $_SERVER['REMOTE_ADDR'], $_SERVER['REMOTE_ADDR']));
                                $_SESSION['id'] = $bdd->lastInsertId();
                                echo 'ok';
                            } else {
                                echo 'Ton mot de passe doit contenir plus de 6 caractères.';
                            }
                        } else {
                            echo 'Les mots de passe ne correspondent pas.';
                        }
                    } else {
                        echo 'Ton adresse e-mail est invalide.';
                    }
                } else {
                    echo 'Cette adresse e-mail est déjà utilisée.';
                }
            } else {
                echo 'Ton pseudo contient des caractères non-autorisés.';
            }
        } else {
            echo 'Ce pseudo est déjà utilisé.';
        }
    } else {
        echo "Le code secret inscrit dans votre humeur habbocity est incorrect !";
    }     
} else {
    echo 'Merci de remplir tous les champs.';
}