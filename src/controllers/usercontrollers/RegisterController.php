<?php

class RegisterController extends Controller
{
    const MIN_PASSWORD_LENGTH = 8;
    const ERROR_PASSWORD_MISMATCH = "Les mots de passe ne correspondent pas.";
    const ERROR_USERNAME_TAKEN = "Ce nom d'utilisateur est déjà pris.";
    const ERROR_REGISTRATION_FAILED = "L'inscription a échoué. Veuillez réessayer.";
    const ERROR_PASSWORD_REQUIREMENTS = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, un chiffre et un symbole.";
    const ERROR_INVALID_USERNAME = "Le nom d'utilisateur ne doit contenir que des lettres, des chiffres et des underscores.";
    public function index($params = [])
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // if (!isset($_POST['username']) && !isset($_POST['password'])) {
            //     $user = new User(username: $_POST['username'], password: $_POST['password'], PASSWORD_DEFAULT);
            //     User::insert($user->getUserByName(),$user->getPassword());
            // }
            $user = new User($username, '');
            $user->setPassword($password);
            UserRepository::insert($user);
            header('Location: /login');
        }
        include_once "../views/register.php";
    }
    private function isPasswordValid($password)
    {
        if (strlen(string: $password) < self::MIN_PASSWORD_LENGTH) {
            return false;
        }
        if (!preg_match(pattern: '/[A-Z]/', subject: $password)) {
            return false;
        }
        if (!preg_match(pattern: '/[0-9]/', subject: $password)) {
            return false;
        }
        if (!preg_match(pattern: '/[!@#$%^&*(),.?":{}|<>]/', subject: $password)) {
            return false;
        }
        return true;
    }
}
