<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>Login<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="auth-container">
    <h2 class="text-center mb-4">Login</h2>
    
    <form action="<?= site_url('auth/process-login') ?>" method="post">

    <?= csrf_field() ?>
        
        <div class="form-group">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= old('username') ?>" required>
        </div>
        
        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        
        <div class="d-grid gap-2 mb-3">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
        
        <div class="text-center">
            <p><a href="<?= site_url('auth/forgot_password') ?>">Forgot Password?</a></p>
            <p>Don't have an account? <a href="<?= site_url('auth/register') ?>">Register here</a></p>
        </div>
    </form>
</div>
<?= $this->endSection() ?>

