<div class="container">
    <div class="row my-5">
        <div class="col-sm-6 offset-sm-3">
            <h3 class="text-center">Create account</h3>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger text-center p-2">
                    <?= $_SESSION['error'] ?>
                    <?php unset($_SESSION['error']) ?>
                </div>
            <?php endif; ?>
            <form action="?action=create_account_submit" method="post">
                <div class="my-3">
                    <label for="email">Email *</label>
                    <input type="email" name="email" id="email" placeholder="Email" class="form-control" required>
                </div>
                <div class="my-3">
                    <label for="password">Password *</label>
                    <input type="password" name="password" id="password" placeholder="Password" class="form-control"
                           required>
                </div>
                <div class="my-3">
                    <label for="confirmationPassword">Confirm password *</label>
                    <input type="password" name="confirmationPassword" id="confirmationPassword"
                           placeholder="Repeat password"
                           class="form-control" required>
                </div>
                <div class="my-3">
                    <label for="fullName">Full name *</label>
                    <input type="text" name="fullName" id="fullName" placeholder="Full name" class="form-control"
                           required>
                </div>
                <div class="my-3">
                    <label for="address">Address *</label>
                    <input type="text" name="address" id="address" placeholder="Address" class="form-control" required>
                </div>
                <div class="my-3">
                    <label for="city">City *</label>
                    <input type="text" name="city" id="city" placeholder="City" class="form-control" required>
                </div>
                <div class="my-3">
                    <label for="phoneNumber">Phone number</label>
                    <input type="text" name="phoneNumber" id="phoneNumber" placeholder="Phone number" class="form-control">
                </div>
                <div class="my-4">
                    <input type="submit" value="Create account" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

