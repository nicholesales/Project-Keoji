<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>Security Question<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="auth-container">
    <h2 class="text-center mb-4">Security Verification</h2>
    
    <form action="<?= site_url('auth/process-security-question') ?>" method="post">
        <?= csrf_field() ?>
        
        <div class="form-group">
            <label class="form-label">Security Question:</label>
            <p class="form-control-static fw-bold"><?= $security_question ?></p>
        </div>
        
        <div class="form-group">
            <label for="security_answer" class="form-label">Your Answer</label>
            <input type="text" class="form-control" id="security_answer" name="security_answer" required>
        </div>
        
        <div class="d-grid gap-2 mb-3">
            <button type="submit" class="btn btn-primary">Verify</button>
        </div>
        
        <div class="text-center">
            <p><a href="<?= site_url('auth/login') ?>">Back to Login</a></p>
        </div>
    </form>
</div>
<?= $this->endSection() ?>