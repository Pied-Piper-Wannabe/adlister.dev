<div class="container">
    <section id="login">
        <div class="row">
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
            <div class="col-md-6 offset-md-3 col-sm offset-sm-0">
                <div class="whiteBox">
                    <h1 class="section-title centerText">Login To Pie Piper</h1>
                    <p class="centerText">Login with your email/username and password</p>
                    <form method="POST" action="" data-validation data-required-message="This field is required">
                        <div class="form-group">
                            <input type="text" class="form-control" id="email_user" name="email_user" placeholder="Email or Username" data-required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" data-required>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success">Login</button>
                            </div>
                            <div class="col-sm-6 text-right">
                                <a href="/signup" class="btn btn-primary">Go To Signup</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
