<?php

namespace core\classes;

use core\exception\CustomException;

class Store
{

    /**
     * @throws CustomException
     */
    public static function showLayout(array|string $structures, array|string $data = null): void
    {
        if (!is_array($structures)) {
            throw new CustomException('Coleção de estrutura inválida');
        }
        if (!empty($data) && is_array($data)) {
            extract($data);
        }
        foreach ($structures as $structure) {
            include("../core/views/$structure.php");
        }
    }

    public static function validateLoggedUser(): bool
    {
        return isset($_SESSION['user']);
    }

    public static function createHash(int $numberCharacters = 12): string
    {
        $characters = '0123456789#abcdefghilkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($characters), 0, $numberCharacters);
    }

}