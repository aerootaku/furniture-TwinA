<?php
define('ROOT_DIR', dirname(__FILE__));
define('ROOT_URL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(ROOT_DIR))));
ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );
ini_set('allow_url_include', 0);
date_default_timezone_set("Asia/Manila");
include ROOT_DIR. '/../system/constant.php';
session_start();
include ROOT_DIR. '/../system/config.php';
include ROOT_DIR. '/../system/FlashMessages.php';




//initialize the settings

$DB_con = db_connect();

$action = new action($DB_con);

class action
{
    private $db;

    function __construct($DB_con)
    {
        $this->db = $DB_con;
    }


//LOGIN CLASS
    public function login($username, $password) //login to owner of the system
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM tbl_users WHERE username=:username LIMIT 1");
            $stmt->execute(array(':username' => $username));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                if (password_verify($password, $row['password'])) {
                    if($row['status']=='Active'){ // for owner of the system
                        if($row['role']=='Super Admin'){
                            $_SESSION['id'] = $row['id'];
                            $_SESSION['password'] = $row['password'];
                            $_SESSION['username'] = $row['username'];
                            $_SESSION['firstname'] = $row['firstname'];
                            $_SESSION['middlename'] = $row['middlename'];
                            $_SESSION['lastname'] = $row['lastname'];
                            $_SESSION['declared'] = $row['password'];
                            $_SESSION['role'] = $row['role'];
                            $_SESSION['contact'] = $row['contact'];
                            $_SESSION['email'] = $row['email'];

                            $this->redirect("superadmin/");
                        }
                        else if($row['role']=='Admin'){
                            $_SESSION['id'] = $row['id'];
                            $_SESSION['password'] = $row['password'];
                            $_SESSION['username'] = $row['username'];
                            $_SESSION['firstname'] = $row['firstname'];
                            $_SESSION['middlename'] = $row['middlename'];
                            $_SESSION['lastname'] = $row['lastname'];
                            $_SESSION['declared'] = $row['password'];
                            $_SESSION['role'] = $row['role'];
                            $_SESSION['contact'] = $row['contact'];
                            $_SESSION['email'] = $row['email'];
                            $this->redirect("admin/");
                        }
                        elseif($row['role']=='Accountant'){
                            $_SESSION['id'] = $row['id'];
                            $_SESSION['password'] = $row['password'];
                            $_SESSION['username'] = $row['username'];
                            $_SESSION['firstname'] = $row['firstname'];
                            $_SESSION['middlename'] = $row['middlename'];
                            $_SESSION['lastname'] = $row['lastname'];
                            $_SESSION['declared'] = $row['password'];
                            $_SESSION['role'] = $row['role'];
                            $_SESSION['contact'] = $row['contact'];
                            $_SESSION['email'] = $row['email'];
                            $this->redirect("accountant/");
                        }
                        elseif ($row['role']=='Secretary'){
                            $_SESSION['id'] = $row['id'];
                            $_SESSION['password'] = $row['password'];
                            $_SESSION['username'] = $row['username'];
                            $_SESSION['firstname'] = $row['firstname'];
                            $_SESSION['middlename'] = $row['middlename'];
                            $_SESSION['lastname'] = $row['lastname'];
                            $_SESSION['declared'] = $row['password'];
                            $_SESSION['role'] = $row['role'];
                            $_SESSION['contact'] = $row['contact'];
                            $_SESSION['email'] = $row['email'];
                            $this->redirect("secretary/");
                        }
                        elseif ($row['role']=='Client'){
                            $_SESSION['id'] = $row['id'];
                            $_SESSION['password'] = $row['password'];
                            $_SESSION['username'] = $row['username'];
                            $_SESSION['firstname'] = $row['firstname'];
                            $_SESSION['middlename'] = $row['middlename'];
                            $_SESSION['lastname'] = $row['lastname'];
                            $_SESSION['declared'] = $row['password'];
                            $_SESSION['role'] = $row['role'];
                            $_SESSION['contact'] = $row['contact'];
                            $_SESSION['email'] = $row['email'];
                            $this->redirect("client/");
                        }
                        else{
                            return false;
                        }

                    }
                    else {
                        return false;
                    }
                }
                else {
                    return false;
                }

            } else {
                return false;
                //
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function is_loggedin()
    {
        if (isset($_SESSION['id'])) {
            return true;
        }
    }

    public function redirect($url)
    {
        header("Location: $url");
    }

    public function logout()
    {
        session_destroy();
        unset($_SESSION['id']);
        return true;
    }

}