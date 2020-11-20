<?php
$title = "Sign In";
require_once './includes/header.php';
require_once "./includes/config.php";
require_once "./includes/classes/FormSanitizer.php";
require_once "./includes/classes/Constants.php";
require_once "./includes/classes/Account.php";

$account = new Account($db);


if (isset($_POST["login"])) {
    $username = FormSanitizer::sanitizeUsername($_POST['username']);
    $password = FormSanitizer::sanitizePassword($_POST['password']);
    $is_loggedIn = $account->login($username, $password);

    if ($is_loggedIn) {
        $_SESSION["is_loggedIn"] = $username;
        header("Location: index.php");
    }
}



?>

<body>
    <main>
        <div class="row" style="margin: 0;">
            <div class="col-lg-6 p-5">
                <div class="logo text-center">
                    <img src="./assets/icons/Logo.png" alt="logo" class="img-fluid w-25">
                </div>
                <div class="form">
                    <h2 class="title text-center mb-5">Login</h2>
                    <form action="login.php" method="POST">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control"
                                value="<?php $account->getInput("username")?>">
                            <div class="is-invalid">
                                <?=$account->getError(Constants::$LoginError)?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class=" mt-4">
                            <input type="submit" class="btn form-btn" value="Sign In" name="login">
                        </div>

                        <div class="form-group mt-5">
                            <p>New Here? <a href="register.php">Create an account now</a></p>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 p-0">
                <div class="signin-img mobile-invisible">
                </div>
            </div>
        </div>
    </main>
</body>

</html>