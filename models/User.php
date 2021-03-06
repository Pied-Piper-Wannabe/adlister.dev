<?php

require_once __DIR__ . '/Model.php';

class User extends Model {
    protected static $table = 'users';

    // override the __set method so that we can hash passwords. if the
    // given key is not a password, just call the parent method
    public function __set($name, $value)
    {
        if ($name == 'password') {
            $value = password_hash($value, PASSWORD_DEFAULT);
        }
        parent::__set($name, $value);
    }

    /**
     * find a user by username or email
     *
     * @param string $usernameOrEmail
     * @return User|null returns null if no matching record is found
     */
    public static function findByUsernameOrEmail($usernameOrEmail)
    {
        self::dbConnect();

        $query = 'SELECT * FROM ' . self::$table . ' WHERE username = :username OR email = :email OR id = :id';

        $stmt = self::$dbc->prepare($query);
        $stmt->bindValue(':username', $usernameOrEmail, PDO::PARAM_STR);
        $stmt->bindValue(':email', $usernameOrEmail, PDO::PARAM_STR);
        $stmt->bindValue(':id', $usernameOrEmail, PDO::PARAM_INT);
        $stmt->execute();

        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        $instance = null;
        if ($results) {
            $instance = new static;
            $instance->attributes = $results;
        }

        return $instance;
    }



    public static function attempt($username, $password) {
        self::dbConnect();
        $userInfo = self::findByUsernameOrEmail($username);
        if ($userInfo !== null) {
            if (($username === $userInfo->username || $username === $userInfo->email) && (password_verify($password, $userInfo->password))) {
                $log = new Log();
                $log->info("User $username logged in.");
                $_SESSION['LOGGED_IN_USER'] = $userInfo->username;
            return true;
            }else{
                $log = new Log();
                $log->error("User $username failed to log in!");
                return false;
            }
        }else{
            return false;
        }


    }
    public static function check() {
        if(isset($_SESSION['LOGGED_IN_USER'])) {
            return true;
        }else{
            return false;
        }
    }

    // public static function user() {
    //     if(Auth::check() === true) {
    //         return $_SESSION['LOGGED_IN_USER'];
    //     }else {
    //         return null;
    //     }
    // }

    public static function logout() {
        session_unset();
        session_regenerate_id();
        session_destroy();
        session_start();
    }

    public static function insertUser($name, $email, $username, $password) {
        self::dbConnect();

        $insert = "INSERT INTO " . self::$table . " (name, email, username, password)
        VALUES (:name, :email, :username, :password)";
        $statement = self::$dbc->prepare($insert);

        $statement->bindValue(':name', $name, PDO::PARAM_STR);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->bindValue(':username', $username, PDO::PARAM_STR);
        $statement->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
        $statement->execute();
    }

    public function updateUser($newUsername){
        self::dbConnect();
        $this->update();

        //Update User Session
        $userInfo = self::findByUsernameOrEmail($newUsername);
        $_SESSION['LOGGED_IN_USER'] = $userInfo->username;
    }


}
