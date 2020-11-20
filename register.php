<?php

/**
 * @file
 * Register form backend.
 * @author Supreeth <supreeth.b@outlook.com>
 */

$title = "Sign Up";

require_once "./includes/header.php";
require_once "./includes/config.php";
require_once "./includes/classes/FormSanitizer.php";
require_once "./includes/classes/Constants.php";
require_once "./includes/classes/Account.php";



$account = new Account($db);


if (isset($_POST["submit"])) {
    $firstname = FormSanitizer::sanitizeText($_POST['firstname']);
    $lastname = FormSanitizer::sanitizeText($_POST['lastname']);
    $email = FormSanitizer::sanitizeEmail($_POST['email']);
    $username = FormSanitizer::sanitizeUsername($_POST['username']);
    $password = FormSanitizer::sanitizePassword($_POST['password']);
    $confirm_password = FormSanitizer::sanitizePassword($_POST['confirm_password']);
    $is_registered = $account->register($firstname, $lastname, $username, $email, $password, $confirm_password);
}

if ($is_registered || $_SESSION["is_loggedIn"]) {
    $_SESSION["is_loggedIn"] = $username;
    header("Location: index.php");
}

?>

<body>
    <main>
        <div class="row" style="margin: 0;">
            <div class="col-lg-6 p-4">
                <div class="form">
                    <h2 class="title text-center mb-5">Subscribe Now!</h2>
                    <form action="register.php" method="POST">
                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" name="firstname" class="form-control"
                                value="<?php $account->getInput("firstname")?>">
                            <div class="is-invalid">
                                <?=$account->getError(Constants::$FirstNameError)?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" name="lastname" class="form-control"
                                value="<?php $account->getInput("lastname")?>">
                            <div class="is-invalid">
                                <?=$account->getError(Constants::$LastNameError)?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control"
                                value="<?php $account->getInput("username")?>">
                            <div class="is-invalid">
                                <?=$account->getError(Constants::$UsernameError)?>
                                <br>
                                <?=$account->getError(Constants::$UsernameExistError)?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control"
                                value="<?php $account->getInput("email")?>">
                            <div class="is-invalid">
                                <?=$account->getError(Constants::$EmailExistError)?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control">
                            <div class="is-invalid">
                                <?=$account->getError(Constants::$PasswordLengthError)?>
                                <br>
                                <?=$account->getError(Constants::$PasswordMatchError)?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm password</label>
                            <input type="password" name="confirm_password" class="form-control">
                        </div>
                        <div class="mt-4">
                            <input type="submit" class="btn form-btn" value="Sign Up" name="submit">
                        </div>
                        <div class="form-group mt-5">
                            <p>Already have an account? <a href="login.php">Login here</a></p>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 p-0">
                <div class="signup-img mobile-invisible">
                </div>
            </div>
        </div>
    </main>
</body>

</html>