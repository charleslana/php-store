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
            echo 'Account successfully validated';
            return;
        }
        echo 'The account has not been validated';
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
            $_SESSION['error'] = 'Passwords are not the same';
            $this->createAccount();
            return;
        }
        $user = new User();
        $userEmail = strtolower(trim($_POST['email']));
        $userName = trim($_POST['fullName']);
        if ($user->validateExistsEmail($_POST['email'])) {
            $_SESSION['error'] = 'Email already exists';
            $this->createAccount();
            return;
        }
        $purl = $user->createAccount();
        $email = new Email();
        $result = $email->sendEmailNewAccount($userEmail, $userName, $purl);
        if ($result) {
            echo 'E-mail sent';
        } else {
            echo 'Error';
        }
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
    public function store(): void
    {
        $this->showRoute('store');
    }
}