<?php

class Users
{
    public function REGISTER(array $POST)
    {
        $conn = new Database();

        $firstname = htmlspecialchars(trim($POST['firstname']));
        $lastname = htmlspecialchars(trim($POST['lastname']));
        $email = htmlspecialchars(trim($POST['email']));
        $password = htmlspecialchars(trim($POST['password']));

        $errors = [];

        if (empty($firstname)) {
            $errors['error_firstname'] = "Your first name is required.";
        } elseif (!preg_match("/^([a-zA-Z' ]+)$/", $firstname)) {
            $errors['error_firstname'] = "Provide a valid firstname.";
        }

        if (empty($lastname)) {
            $errors['error_lastname'] = "Your last name is required.";
        } elseif (!preg_match("/^([a-zA-Z' ]+)$/", $lastname)) {
            $errors['error_lastname'] = "Provide a valid lastname.";
        }

        if (empty($email)) {
            $errors['error_email'] = "Your email is required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['error_email'] = "Provide a valid email.";
        }
        //CHECK IF EMAIL ALREADY EXISTS
        $queryEmailExist = "SELECT email FROM users WHERE email = :email LIMIT 1";
        $queryEmailExist = $conn->READ_DB($queryEmailExist, ['email' => $email]);

        showPrint($queryEmailExist);
        if (is_array($queryEmailExist) && count($queryEmailExist) > 0) {
            $errors['error_email'] = "Email already exists.";
        }

        if (empty($password)) {
            $errors['error_password'] = "Your password is required.";
        } elseif (strlen($password) < 6) {
            $errors['error_password'] = "Your password must be at least 6 characters long.";
        }

        if (!empty($errors)) {
            return $errors;
        } else {

            //INSERTING IN THE USERS TABLE
            $role = htmlspecialchars("user");
            $user_url = $this->getRandomUrl(60);

            $data = [];
            $data['firstname'] = $firstname;
            $data['lastname'] = $lastname;
            $data['email'] = $email;
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            $data['user_url'] = $user_url;

            $query = "INSERT INTO `users` (`firstname`, `lastname`, `email`, `password`, `user_url`) VALUES (:firstname, :lastname, :email, :password, :user_url)";

            $result = $conn->WRITE_DB($query, $data);

            //AFTER INSERTING INTO USERS, WE WILL RETRIEVE THE LAST ID INSERTED WITH THE SELECT QUERY

            $querySelect = "SELECT id FROM `users` ORDER BY `id` DESC LIMIT 1";
            $resultSelect = $conn->READ_DB($querySelect);

            showPrint($resultSelect);
            //INSERTING IN THE ROLES TABLE

            $queryRole = "INSERT INTO `role_users` (`role`, `user_id`) VALUES (:role, :user_id)";
            $resultRole = $conn->WRITE_DB($queryRole, ['role' => $role, 'user_id' => $resultSelect[0]->id]);

            if ($result == true && $resultRole == true) {
                header("Location: " . ROOT . "login");
                die;
            } else {
                return $errors;
            }
        }
    }

    public function LOGIN(array $POST)
    {
        $conn = new Database();

        $email = htmlspecialchars(trim($POST['email']));
        $password = htmlspecialchars(trim($POST['password']));

        $errors = [];

        if (empty($email)) {
            $errors['error_email'] = "Your Email is required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['error_email'] = "Provide a valid Email.";
        }

        if (empty($password)) {
            $errors['error_password'] = "Your password is required.";
        } elseif (strlen($password) < 6) {
            $errors['error_password'] = "Your password must be at least 6 characters long.";
        }

        if (!empty($errors)) {
            return $errors;
        } else {
            $query = "SELECT * FROM `users` WHERE email = :email LIMIT 1";
            $query = $conn->READ_DB($query, ['email' => $email]);

            if (is_array($query) && count($query) > 0) {
                if (password_verify($password, $query[0]->password)) {


                    // $_SESSION['userDetails'] = $query;
                    // header("Location: " . ROOT . "dashboard");
                    // die;

                    $queryUserRole = "SELECT * FROM `users`, `role_users`";
                    $resultUserRole = $conn->READ_DB($queryUserRole);
                    // ['users.id' => $query[0]->id]
                    //REDIRCTING TO THE USER DASHBOARD
                    // if(is_array($resultUserRole) && $resultUserRole[0]->role === "user") {
                    //     header("Location: ". ROOT. "dashboard/user_dashboard/user_dashboard");
                    //     die;
                    // }

                    showPrint($resultUserRole);
                    // showPrint($resultUserRole[0]->role);
                }
            } else {
                $errors['error_email_password'] = "Email or password not correct!";
                return $errors;
            }
        }
    }

    private function getRandomUrl($length)
    {
        $array = array(
            0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o',
            'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
            'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
        );

        $text = "";

        $length = rand(4, $length);

        for ($i = 0; $i < $length; $i++) {
            $random = rand(0, 61);
            $text .= $array[$random];
        }
        return $text;
    }
}