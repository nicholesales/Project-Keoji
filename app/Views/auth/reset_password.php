<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>Reset Password<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="auth-container">
    <h2 class="text-center mb-4">Reset Password</h2>
    
    <form action="<?= site_url('auth/process-reset-password') ?>" method="post">
        <?= csrf_field() ?>
        
        <div class="form-group">
            <label for="password" class="form-label">New Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
            <small class="text-muted">Password must be at least 8 characters long</small>
        </div>
        
        <div class="form-group">
            <label for="confirm_password" class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        
        <div class="d-grid gap-2 mb-3">
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>