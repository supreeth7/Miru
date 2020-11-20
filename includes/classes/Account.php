<?php



class Account
{
    private $db;
    private $errors = [];
    
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function register($firstname, $lastname, $username, $email, $password, $confirm_password)
    {
        $this->validateFirstName($firstname);
        $this->validateLastName($lastname);
        $this->validateUsername($username);
        $this->validateEmail($email);
        $this->validatePasswords($password, $confirm_password);

        if (empty($this->errors)) {
            return $this->insertDetails($firstname, $lastname, $username, $email, $password);
        }

        return false;
    }

    public function login($username, $password)
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE username=:un");
        $query->bindParam(":un", $username);
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $row['password'])) {
            return true;
        }
        

        array_push($this->errors, Constants::$LoginError);
        return false;
    }

    private function validateFirstName($input)
    {
        if (strlen($input) < 2 || strlen($input) > 25) {
            array_push($this->errors, Constants::$FirstNameError);
        }
    }


    private function validateLastName($input)
    {
        if (strlen($input) < 2 || strlen($input) > 25) {
            array_push($this->errors, Constants::$LastNameError);
        }
    }

    private function validateUsername($input)
    {
        if (strlen($input) > 12 || strlen($input) < 4) {
            array_push($this->errors, Constants::$UsernameError);
        }

        $query = $this->db->prepare("SELECT * FROM users WHERE username=:input");
        $query->bindParam(":input", $input);
        $query->execute();

        if ($query->rowCount() != 0) {
            array_push($this->errors, Constants::$UsernameExistError);
        }
    }

    private function validateEmail($input)
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE email=:input");
        $query->bindParam(":input", $input);
        $query->execute();

        if ($query->rowCount() != 0) {
            array_push($this->errors, Constants::$EmailExistError);
        }
    }

    private function validatePasswords($input1, $input2)
    {
        if ($input1 != $input2) {
            array_push($this->errors, Constants::$PasswordMatchError);
            return;
        }

        if (strlen($input1) < 5 || strlen($input1) > 20) {
            array_push($this->errors, Constants::$PasswordLengthError);
        }
    }

    public function getError($error)
    {
        if (in_array($error, $this->errors)) {
            return $error;
        }
    }

    private function insertDetails($fn, $ln, $un, $em, $pw)
    {
        $hashed_pw = password_hash($pw, PASSWORD_DEFAULT);

        $query = $this->db->prepare("INSERT into users (first_name, last_name, username, email, password) VALUES 
        (:fn, :ln, :un, :em, :pw)");

        $query->bindParam(":fn", $fn);
        $query->bindParam(":ln", $ln);
        $query->bindParam(":un", $un);
        $query->bindParam(":em", $em);
        $query->bindParam(":pw", $hashed_pw);

        return $query->execute();
    }

    public function getInput($input)
    {
        if (isset($_POST[$input])) {
            echo $_POST[$input];
        }
    }
}
