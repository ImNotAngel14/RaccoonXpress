<?php
class User
{
    private $id_user;
    private $email;
    private $username;
    private $password;
    private $gender;
    private $fullname;
    private $birthdate;
    private $profile_image;
    private $user_role;
    private $entry_date;

    public function __construct(
        $id_user,
        $email,
        $username,
        $password,
        $gender,
        $fullname,
        $birthdate,
        $profile_image,
        $user_role,
        $entry_date
    ) {
        $this->id_user = $id_user;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->gender = $gender;
        $this->fullname = $fullname;
        $this->birthdate = $birthdate;
        $this->profile_image = $profile_image;
        $this->user_role = $user_role;
        $this->entry_date = $entry_date;
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getFullname()
    {
        return $this->fullname;
    }

    public function setFullname($names)
    {
        $this->fullname = $fullname;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    public function getProfileImage()
    {
        return $this->profile_image;
    }

    public function setProfileImage($profile_image)
    {
        $this->profile_image = $profile_image;
    }

    public function getUserRol()
    {
        return $this->user_role;
    }

    public function setUserRol($user_role)
    {
        $this->user_role = $user_role;
    }

    public function getEntryDate()
    {
        return $this->entry_date;
    }

    public function setEntryDate($entry_date)
    {
        $this->entry_date = $entry_date;
    }

    static public function parseJson($json) {
        $user = new User(
            isset($json["id_user"]) ? $json["id_user"] : "",
            isset($json["email"]) ? $json["email"] : "",
            isset($json["username"]) ? $json["username"] : "",
            isset($json["user_password"]) ? $json["user_password"] : "",
            isset($json["gender"]) ? $json["gender"] : "",
            isset($json["fullname"]) ? $json["fullname"] : "",
            isset($json["birthdate"]) ? $json["birthdate"] : "",
            isset($json["profile_image"]) ? $json["profile_image"] : "",
            isset($json["user_role"]) ? $json["user_role"] : "",
            isset($json["entry_date"]) ? $json["entry_date"] : ""
        );
        return $user;
    }

    public static function AuthenticateUser($mysqli, $username, $password)
    {
        $sql = "SELECT id_user, username, user_role FROM users WHERE username = ? AND user_password = ? LIMIT 1;";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss",$username, $password);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $user = $result->fetch_assoc();
        return $user ? User::parseJson($user) : NULL;
    }

    public static function SaveUser(
        $mysqli,
        $_username, 
        $_password, 
        $_email,
        $_fullname,
        $_birthdate,
        $_gender,
        $_user_rol,
        $_profile_image
    )
    {
        $sql = "INSERT INTO `users`( `email`, `username`, `user_password`, `fullname`, `birthdate`, `gender`, `user_role`, `profile_image`) VALUES (?,?,?,?,?,?,?,?,?);";
        try
        {
            $stmt = $mysqli->prepare($sql);

            $stmt->bind_param
            (
                "sssssiis",
                $_email,
                $_username,
                $_password,
                $_fullname,
                $_birthdate,
                $_gender,
                $_user_rol,
                $_profile_image
            );
            $stmt->execute();
        }
        catch(mysqli_sql_exception $e)
        {
            // Verificar si el error es debido a una clave única duplicada
            if ($e->getCode() === 1062) 
            {
                echo "Error: El correo electrónico ya existe en la base de datos.";
            } 
            else 
            {
                // Manejar otros errores si es necesario
                echo "Error al insertar el registro: " . $e->getMessage();
            }
            return false;
        }
        finally
        {
            $stmt->close();
        }
        return true;
    }
}
?>