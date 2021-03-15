<?php
if (isset($_POST["name"]) and isset($_POST["last_name"]) and isset($_POST["mail"]) and isset($_POST["password"])){
    if (strlen($_POST["name"]) > 0 and strlen($_POST["last_name"]) > 0 and strlen($_POST["mail"]) > 0 and strlen($_POST["password"]) > 6 and strlen($_POST["phone"]) > 8){
        $name = htmlspecialchars($_POST['name']);
        $last_name = htmlspecialchars($_POST['last_name']);
        $mail = htmlspecialchars($_POST['mail']);
        $password = htmlspecialchars($_POST['password']);
        $phone = htmlspecialchars($_POST['phone']);
        $birth = htmlspecialchars($_POST['birth']);
        $token = bin2hex(random_bytes(5));
        $query = $conn->prepare("SELECT mail FROM users WHERE mail = '$mail'");
        $query->execute();
        $exist = $query->fetch();
        if($exist == False){
            $password = password_hash($password, PASSWORD_BCRYPT);
            echo "INSERT INTO users VALUES (Null, '$name', '$last_name', '$password', '$mail', '$phone', '$birth', 1, Null, '$token')";
            $query= $conn->prepare("INSERT INTO users VALUES (Null, '$name', '$last_name', '$password', '$mail', '$phone', '$birth', 3, Null, '$token')");
            $query->execute();
            $query = $conn->prepare("SELECT id, title_id FROM users where token = '$token'");
            $query->execute();
            $result = $query->fetch();
            $_SESSION["role"] = $result["title_id"];
            $_SESSION["id"] = $result["id"];
            $_SESSION["token"] = $token;
            $cart = array();
            $_SESSION["cart"] = $cart;
            header('Location: index.php?id=6');
        } else {
            echo <<<HTML
            <div class="alert alert-danger" role="alert">
                <h4 class="text-center">Cette utilisateur existe déjà</h4>
            </div>
            HTML;
        }
    } else if (count($_POST) > 1) {
        echo <<<HTML
        <div class="alert alert-danger" role="alert">
            <h4 class="text-center">Veuillez renseigner tout les champs</h4>
        </div>
        HTML;  
    }
}
?>
<div class="container mt-5 w-50">
    <form method="post">
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Prénom</label>
                    <input name="name" type="text" class="form-control" title="Entrez un nom valide" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Nom</label>
                    <input name="last_name" type="text" class="form-control" title="Entrez un prénom valide" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Numéro de téléphone</label>
                    <input name="phone" type="tel" class="form-control" pattern="[0][0-9]{9}" title="Entrez un numéro de télephone valide" required>
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Date de naissance</label>
                    <input name="birth" type="date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Adresse email</label>
                    <input name="mail" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" pattern="^\w+.?\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$" title="Veuillez renseignez une adresse email valide" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                    <input name="password" type="password" class="form-control" pattern="^(?=\D*\d)\S{6,}$" title="Votre mot de passe doit contenir 6 caractères dont un chiffre" required>
                </div>
            </div>
        </div>
    </form>
</div>