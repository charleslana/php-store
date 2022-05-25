<div class="container">
    <div class="row my-5">
        <div class="col-sm-6 offset-sm-3">
            <h3 class="text-center">Logar na conta</h3>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger text-center p-2">
                    <?= $_SESSION['error'] ?>
                    <?php unset($_SESSION['error']) ?>
                </div>
            <?php endif; ?>
            <form action="?action=login_submit" method="post">
                <div class="my-3">
                    <label for="email">E-mail *</label>
                    <input type="email" name="email" id="email" placeholder="Digite um e-mail" class="form-control"
                           required>
                </div>
                <div class="my-3">
                    <label for="password">Senha *</label>
                    <input type="password" name="password" id="password" placeholder="Digite uma senha"
                           class="form-control"
                           required>
                </div>
                <div class="my-4">
                    <input type="submit" value="Login" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>