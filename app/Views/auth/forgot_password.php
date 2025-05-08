    <?= $this->extend('layout/main') ?>

    <?= $this->section('title') ?>Forgot Password | YourBlog<?= $this->endSection() ?>

    <?= $this->section('content') ?>
    <!-- Background animation -->
    <div class="blog-particles"></div>

    <div class="container py-5 login-container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <div class="card shadow-lg border-0 rounded-lg animate__animated animate__fadeIn">
                    <div class="decorative-dots">
                        <span></span><span></span><span></span>
                    </div>
                    <div class="card-header bg-white border-0 pt-4">
                        <h3 class="text-center font-weight-bold mb-2">Password Recovery</h3>
                        <p class="text-center text-muted mb-4">Enter your email to reset your password</p>
                    </div>
                    <div class="card-body px-4 py-3">
                        <?php if(session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger animate__animated animate__shakeX d-flex align-items-center" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <?php if(session()->getFlashdata('success')): ?>
                            <div class="alert alert-success animate__animated animate__fadeInDown d-flex align-items-center" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= site_url('auth/process-forgot-password') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="form-floating mb-4 input-group-animation">
                                <input type="email" class="form-control" id="email" name="email" 
                                    value="<?= old('email') ?>" placeholder="name@example.com" required>
                                <label for="email">Email address</label>
                                <div class="focus-border"></div>
                            </div>
                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-primary py-3 fw-bold pulse-on-hover">
                                    <span>Reset Password</span>
                                    <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        viewBox="0 0 24 24">
                                        <path d="M5 12h14"></path>
                                        <path d="M12 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-white text-center border-0 py-4">
                        <p class="mb-0">Remember your password?
                            <a href="<?= site_url('auth/login') ?>" class="text-decoration-none fw-bold hover-effect">Sign In</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional alert styling -->
    <style>
    .alert {
        border-radius: 0.75rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }
    .alert i {
        font-size: 1.2rem;
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function () {
                this.parentElement.classList.add('focused');
            });
            input.addEventListener('blur', function () {
                this.parentElement.classList.remove('focused');
            });
        });
    });
    </script>
    <?= $this->endSection() ?>
