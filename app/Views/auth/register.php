<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>Register<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="auth-container">
    <h2 class="text-center mb-4">Create an Account</h2>
    
    <form action="<?= site_url('auth/process-registration') ?>" method="post">
        <?= csrf_field() ?>
        
        <div class="form-group">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= old('username') ?>" required>
        </div>
        
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" required>
        </div>
        
        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
            <small class="text-muted">Password must be at least 8 characters long</small>
        </div>
        
        <div class="form-group">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        
        <div class="form-group">
            <label for="security_question" class="form-label">Security Question</label>
            <select class="form-select" id="security_question" name="security_question" required>
                <option value="">Select a security question</option>
                <?php foreach($securityQuestions as $question): ?>
                    <option value="<?= $question ?>" <?= (old('security_question') == $question) ? 'selected' : '' ?>>
                        <?= $question ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="security_answer" class="form-label">Answer to Security Question</label>
            <input type="text" class="form-control" id="security_answer" name="security_answer" value="<?= old('security_answer') ?>" required>
        </div>
        
        <div class="d-grid gap-2 mb-3">
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
        
        <div class="text-center">
            <p>Already have an account? <a href="<?= site_url('auth/login') ?>">Login here</a></p>
        </div>
    </form>
</div>
<?= $this->endSection() ?>