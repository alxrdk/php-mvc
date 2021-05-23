<div class="container">
    <div class="row">
        <div class="center-block box" style="width:300px;">
            <h1>Admin</h1>
            <form action='/login' method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Login</label>
                <input type="text" name="username" class="form-control" id="username" value="<?php echo htmlspecialchars($username) ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" value="<?php echo htmlspecialchars($password) ?>">
            </div>
            <?php if (!empty($errors)) foreach($errors as $error) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error ?>
            </div>
            <?php } ?>
            <button type="submit" class="btn btn-primary">Sign in</button>
            </form>
        </div>
    </div>
</div>