<?php
if (isset($_SESSION["token"])) {
    $token = $_SESSION["token"];
    $query = $conn->prepare("SELECT id FROM users where token = '$token'");
    $query->execute();
    $result = $query->fetch();
    $_SESSION["id"] = $result["id"];
    if(isAdmin()){
        header('Location: index.php?id=5');
    } else if(isUser()){
        header('Location: index.php?id=6');
    }
}

if (isset($_POST["mail"]) and isset($_POST["password"])) {
    $password = $_POST["password"];
    $mail = $_POST["mail"];
    if (empty($password) or empty($mail)) {
        echo <<<HTML
        <div class="alert alert-danger" role="alert">
            <h4 class="text-center">Veuillez renseigner tout les champs</h4>
        </div>
        HTML;
    } else {
        $query = $conn->prepare("SELECT password FROM users where mail = '$mail'");
        $query->execute();
        $result = $query->fetch();
        if (isset($result["password"])) {
            if (password_verify($password, $result["password"])) {
                $token = bin2hex(random_bytes(5));
                if (isset($_POST["check"])) {
                    setcookie("token", $token, time() + (12 * 365 * 24 * 60 * 60));
                }
                $_SESSION["token"] = $token;
                $query = $conn->prepare("UPDATE users SET token = '$token' WHERE mail='$mail'");
                $query->execute();
                $query = $conn->prepare("SELECT id, title_id FROM users where token = '$token'");
                $query->execute();
                $result = $query->fetch();

                $_SESSION["id"] = $result["id"];
                $_SESSION["role"] = $result["title_id"];

                if(!isset($_SESSION["cart"])){
                    $cart = array();
                    $_SESSION["cart"] = $cart;
                }
                // Comparer les titre pour savoir qui se connecte
                $id = $result["id"];
                $query1 = $conn->prepare("SELECT title_id FROM users WHERE $id = id");
                $query1->execute();
                $res = $query1->fetch();
                if($res["title_id"] == "1")
                {
                    header('Location: index.php?id=5');
                } else if($res["title_id"] == "2")
                {
                    header('Location: index.php?id=6');
                }

            } else {
                echo <<<HTML
                <div class="alert alert-danger" role="alert">
                    <h4 class="text-center">Mot de passe erronée</h4>
                </div>
                HTML;
            }
        } else {
            echo <<<HTML
            <div class="alert alert-danger" role="alert">
                <h4 class="text-center">Cette utilisateur n'existe pas</h4>
            </div>
            HTML;
        }
    }
}
?>

<div class="container mt-5 w-25">
    <form method="post">
    <?php
        echo $hidden;
        ?>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Adresse email</label>
            <input name="mail" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
            <input name="password"  type="password" class="form-control" id="exampleInputPassword1" required>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
        <a class="btn btn-primary" href ="index.php?id=3">Créer un compte</a>
    </form>
</div>