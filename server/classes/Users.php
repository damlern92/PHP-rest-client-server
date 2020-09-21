<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/rest/server/config/config.php");

if(isset($_POST['action']) && $_POST['action'] == "register") {
    $users = new Users();
    // data and make the registration:
    $users->userRegister();
}


class Users
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }



    public function userRegister()
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $conf_pass = $_POST['conf_pass'];

        $rand = mt_rand(1000, 100000);

        $licence_key = md5($rand);

        $sql = "INSERT INTO users (username, email, password, licence_key) VALUES ('$username','$email', '$password', '$licence_key')";

        $result = $this->db->insert($sql);



        if($result){
            $data = array(
                "message" => "You are succcessfully registered on our aplication"
            );

            // Return in json:
            header("Content-Type: application/json");
            echo json_encode($data);

        }else{

            $data = array(
                "error" => "Something went wrong! Please try again"
            );

            header("Content-Type: application/json");
            echo json_encode($data);

        }

    } // End of userRegister method


    public function userLogin()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' ";
        $result = $this->db->select($query);

        if(mysqli_num_rows($result) == 1)
        {
            $_SESSION['username'] = $username;
            header("Location: home.php ");

        }else{
            echo "Wrong username or password";
        }
    }


} // End of class Users
