<?php

use core\classes\Store;

?>
<div class="container-fluid custom-nav">
    <div class="row">
        <div class="col-6 p-3">
            <a href="?action=index"><h3><?= APP_NAME ?></h3></a>
        </div>
        <div class="col-6 p-3 text-end">
            <a href="?action=index" class="custom-nav-item">Ínicio</a>
            <a href="?action=store" class="custom-nav-item">Loja</a>
            <?php if (Store::validateLoggedUser()): ?>
                <a href="?action=dashboard" class="custom-nav-item">Minha conta</a>
                <a href="?action=logout" class="custom-nav-item">Sair</a>
            <?php else: ?>
                <a href="?action=login" class="custom-nav-item">Login</a>
                <a href="?action=create_account" class="custom-nav-item">Criar conta</a>
            <?php endif; ?>
            <a href="?action=cart"><em class="fa-solid fa-cart-shopping"></em></a>
            <span class="badge bg-warning">1</span>
        </div>
    </div>
</div>
