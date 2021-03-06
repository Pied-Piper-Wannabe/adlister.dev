<div class="container">
    <section id="login">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1 class="section-title">Edit Account</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <p>Please fill out the information below so we can update your account.</p>
                <?php if (isset($_SESSION['ERROR_MESSAGE'])) : ?>
                    <div class="alert alert-danger">
                        <p class="error"><?= $_SESSION['ERROR_MESSAGE']; ?></p>
                    </div>
                    <?php unset($_SESSION['ERROR_MESSAGE']); ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['SUCCESS_MESSAGE'])) : ?>
                    <div class="alert alert-success">
                        <p class="success"><?= $_SESSION['SUCCESS_MESSAGE']; ?></p>
                    </div>
                    <?php unset($_SESSION['SUCCESS_MESSAGE']); ?>
                <?php endif; ?>
                <form method="POST" action="" data-validation data-required-message="This field is required">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="<?= $name; ?>" data-required>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?= $email; ?>" data-required>
                    </div>
                    <div class="form-group">
                        <label>Username:</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= $username; ?>" data-required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="password" value="" data-required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="passwordVerify" name="passwordVerify" placeholder="re-enter password" value="" data-required>
                        <p class="sidenote">Please re-enter or change your password for changes to take effect.</p>
                    </div>
                    <button type="submit" class="btn btn-success">Update Account</button>
                </form>
            </div>
        </div>
    </section>
</div>
