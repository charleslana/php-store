<?php

namespace core\model;

use core\classes\Database;
use core\classes\Store;
use core\exception\CustomException;

class User
{

    /**
     * @throws CustomException
     */
    public function createAccount(): string
    {
        $purl = Store::createHash();
        $parameters = [
            ':email' => strtolower(trim($_POST['email'])),
            ':password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            ':full_name' => trim($_POST['fullName']),
            ':address' => trim($_POST['address']),
            ':city' => trim($_POST['city']),
            ':phone_number' => !empty(trim($_POST['phoneNumber'])) ? trim($_POST['phoneNumber']) : null,
            ':purl' => $purl
        ];
        $db = new Database();
        $db->insert('
            INSERT INTO user (email, password, full_name, address, city, phone_number, purl)
            VALUES(
            :email,
            :password,
            :full_name,
            :address,
            :city,
            :phone_number,
            :purl)', $parameters);
        return $purl;
    }

    /**
     * @throws CustomException
     */
    public function validateExistsEmail(string $email): bool
    {
        $db = new Database();
        $parameters = [
            ':email' => strtolower(trim($email))
        ];
        $results = $db->select('SELECT email from user WHERE email = :email', $parameters);
        if (count($results) != 0) {
            return true;
        }
        return false;
    }

    /**
     * @throws CustomException
     */
    public function validateLogin(string $email, string $password): bool|object
    {
        $parameters = [
            ':email' => $email
        ];
        $db = new Database();
        $result = $db->select("SELECT id, email, full_name, password FROM user WHERE email = :email AND status = 'active' AND deleted_at IS NULL", $parameters);
        if (count($result) != 1) {
            return false;
        }
        $user = $result[0];
        if (!password_verify($password, $user->password)) {
            return false;
        }
        return $user;
    }

    /**
     * @throws CustomException
     */
    public function validatePurlEmail(string $purl): bool
    {
        $db = new Database();
        $parameters = [
            ':purl' => $purl
        ];
        $result = $db->select('SELECT id FROM user WHERE purl = :purl', $parameters);
        if (count($result) != 1) {
            return false;
        }
        $id = $result[0]->id;
        $parameters = [
            ':id' => $id
        ];
        return $db->update('UPDATE user SET purl = null, status = "active" WHERE id = :id', $parameters);
    }
}