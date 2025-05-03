<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>Forgot Password<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="auth-container">
    <h2 class="text-center mb-4">Forgot Password</h2>
    
    <form action="<?= site_url('auth/process-forgot-password') ?>" method="post">
        <?= csrf_field() ?>
        
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" required>
            <small class="text-muted">Enter the email address associated with your account</small>
        </div>
        
        <div class="d-grid gap-2 mb-3">
            <button type="submit" class="btn btn-primary">Continue</button>
        </div>
        
        <div class="text-center">
            <p><a href="<?= site_url('auth/login') ?>">Back to Login</a></p>
        </div>
    </form>
</div>
<?= $this->endSection() ?>