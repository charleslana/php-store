<?php

namespace core\controller;

use core\classes\Email;
use core\classes\Store;
use core\exception\CustomException;
use core\model\User;

class Main
{

    /**
     * @throws CustomException
     */
    public function cart(): void
    {
        $this->showRoute('cart');
    }

    /**
     * @throws CustomException
     */
    public function confirmEmail(): void
    {
        if (Store::validateLoggedUser()) {
            $this->index();
            return;
        }
        if (!isset($_GET['purl'])) {
            $this->index();
            return;
        }
        $purl = $_GET['purl'];
        if (strlen($purl) != 12) {
            $this->index();
            return;
        }
        $user = new User();
        $result = $user->validatePurlEmail($purl);
        if ($result) {
            $this->showRoute('account_confirmed');
            return;
        }
        Store::redirect();
    }

    /**
     * @throws CustomException
     */
    public function createAccount(): void
    {
        if (Store::validateLoggedUser()) {
            $this->index();
            return;
        }
        $this->showRoute('create_account');
    }

    /**
     * @throws CustomException
     */
    public function createAccountSubmit(): void
    {
        if (Store::validateLoggedUser()) {
            $this->index();
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->index();
            return;
        }
        if ($_POST['password'] !== $_POST['confirmationPassword']) {
            $_SESSION['error'] = 'As senhas não são iguais';
            $this->createAccount();
            return;
        }
        $user = new User();
        $userEmail = strtolower(trim($_POST['email']));
        $userName = trim($_POST['fullName']);
        if ($user->validateExistsEmail($_POST['email'])) {
            $_SESSION['error'] = 'E-mail já existe';
            $this->createAccount();
            return;
        }
        $purl = $user->createAccount();
        $email = new Email();
        $result = $email->sendEmailNewAccount($userEmail, $userName, $purl);
        if ($result) {
            $this->showRoute('create_account_success');
            return;
        }
        echo 'Ocorreu um erro';
    }

    /**
     * @throws CustomException
     */
    public function index(): void
    {
        $this->showRoute('index');
    }

    /**
     * @throws CustomException
     */
    public function login(): void
    {
        if (Store::validateLoggedUser()) {
            Store::redirect();
            return;
        }
        $this->showRoute('login');
    }

    /**
     * @throws CustomException
     */
    public function loginSubmit(): void
    {
        if (Store::validateLoggedUser()) {
            Store::redirect();
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Store::redirect();
            return;
        }
        if (!isset($_POST['email']) || !isset($_POST['password']) || !filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Login inválido';
            Store::redirect('login');
            return;
        }
        $email = trim(strtolower($_POST['email']));
        $password = trim(strtolower($_POST['password']));
        $user = new User();
        $result = $user->validateLogin($email, $password);
        if (is_bool($result)) {
            $_SESSION['error'] = 'Login inválido';
            Store::redirect('login');
            return;
        }
        $_SESSION['user'] = $result->id;
        $_SESSION['email'] = $result->email;
        $_SESSION['name'] = $result->full_name;
        Store::redirect();
    }

    public function logout(): void
    {
        unset($_SESSION['user']);
        unset($_SESSION['email']);
        unset($_SESSION['name']);
        Store::redirect();
    }

    /**
     * @throws CustomException
     */
    public function store(): void
    {
        $this->showRoute('store');
    }

    /**
     * @throws CustomException
     */
    private function showRoute(string $route, ?array $data = null): void
    {
        Store::showLayout([
            'layout/header_html',
            'layout/header',
            $route,
            'layout/footer',
            'layout/footer_html'
        ], $data);
    }
}