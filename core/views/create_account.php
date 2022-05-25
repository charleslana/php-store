<div class="container">
    <div class="row my-5">
        <div class="col-sm-6 offset-sm-3">
            <h3 class="text-center">Criar conta</h3>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger text-center p-2">
                    <?= $_SESSION['error'] ?>
                    <?php unset($_SESSION['error']) ?>
                </div>
            <?php endif; ?>
            <form action="?action=create_account_submit" method="post">
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
                <div class="my-3">
                    <label for="confirmationPassword">Confirmar a senha *</label>
                    <input type="password" name="confirmationPassword" id="confirmationPassword"
                           placeholder="Confirme sua senha"
                           class="form-control" required>
                </div>
                <div class="my-3">
                    <label for="fullName">Nome completo *</label>
                    <input type="text" name="fullName" id="fullName" placeholder="Digite o nome completo"
                           class="form-control"
                           required>
                </div>
                <div class="my-3">
                    <label for="address">Endereço *</label>
                    <input type="text" name="address" id="address" placeholder="Digite o endereço" class="form-control"
                           required>
                </div>
                <div class="my-3">
                    <label for="city">Cidade *</label>
                    <input type="text" name="city" id="city" placeholder="Digite a cidade" class="form-control"
                           required>
                </div>
                <div class="my-3">
                    <label for="phoneNumber">Número de telefone</label>
                    <input type="text" name="phoneNumber" id="phoneNumber" placeholder="Digite o número de telefone"
                           class="form-control">
                </div>
                <div class="my-4">
                    <input type="submit" value="Criar conta" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

