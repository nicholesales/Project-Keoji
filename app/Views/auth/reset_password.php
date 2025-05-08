<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>Reset Password | YourBlog<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Background animation -->
<div class="blog-particles"></div>

<div class="container py-5 login-container">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8">
            <div class="card shadow-lg border-0 rounded-lg animate__animated animate__fadeIn">
                <div class="decorative-dots">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                
                <div class="card-header bg-white border-0 pt-4">
                    <h3 class="text-center font-weight-bold mb-2">Reset Password</h3>
                    <p class="text-center text-muted mb-4">Enter your new password below</p>
                </div>
                
                <div class="card-body px-4 py-3">
                    <!-- This section shows before the password is reset -->
                    <div id="resetForm" class="login-form">
                        <form id="passwordResetForm" onsubmit="simulateReset(event)">
                            <div class="form-floating mb-3 input-group-animation">
                                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password" required>
                                <label for="newPassword">New Password</label>
                                <div class="focus-border"></div>
                                <button type="button" class="btn-toggle-password" onclick="togglePassword('newPassword')">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                            
                            <div class="form-floating mb-4 input-group-animation">
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
                                <label for="confirmPassword">Confirm Password</label>
                                <div class="focus-border"></div>
                                <button type="button" class="btn-toggle-password" onclick="togglePassword('confirmPassword')">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                            
                            <div class="password-strength mb-3">
                                <div class="progress" style="height: 5px;">
                                    <div id="passwordStrength" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small id="passwordFeedback" class="form-text text-muted">Password strength</small>
                            </div>
                            
                            <div class="password-requirements mb-3">
                                <p class="text-muted mb-2">Password must contain:</p>
                                <ul class="requirements-list">
                                    <li id="req-length" class="text-muted"><small><i class="fa fa-circle"></i> At least 8 characters</small></li>
                                    <li id="req-uppercase" class="text-muted"><small><i class="fa fa-circle"></i> At least one uppercase letter</small></li>
                                    <li id="req-number" class="text-muted"><small><i class="fa fa-circle"></i> At least one number</small></li>
                                    <li id="req-special" class="text-muted"><small><i class="fa fa-circle"></i> At least one special character</small></li>
                                </ul>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary py-3 fw-bold pulse-on-hover">
                                    <span>Reset Password</span>
                                    <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="M12 5l7 7-7 7"></path></svg>
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- This section shows after successful password reset -->
                    <div id="resetSuccess" style="display: none;" class="animate__animated animate__fadeIn">
                        <div class="checkmark-container">
                            <div class="checkmark-circle">
                                <span class="checkmark"></span>
                            </div>
                            <h4 class="text-center mb-3">Password Reset Successful!</h4>
                        </div>
                        <p class="text-center text-muted mb-4">Your password has been successfully reset. You can now log in with your new password.</p>
                        <div class="d-grid">
                            <a href="<?= site_url('auth/login') ?>" class="btn btn-primary py-3 fw-bold pulse-on-hover">
                                <span>Back to Login</span>
                                <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="M12 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer bg-white text-center border-0 py-4">
                    <p class="mb-0">Remember your password? <a href="<?= site_url('auth/login') ?>" class="text-decoration-none fw-bold hover-effect">Back to Login</a></p>
                </div>
            </div>
            
            <!-- Featured blog post preview -->
            <div class="featured-post animate__animated animate__fadeInUp">
                <div class="featured-tag">Latest Post</div>
                <h4>10 Tips for Better Blog Writing</h4>
                <p>Discover how to engage your audience with captivating content...</p>
                <a href="#">Read More</a>
            </div>
        </div>
    </div>
</div>

<script>
// Function to toggle password visibility
function togglePassword(inputId) {
    const passwordInput = document.getElementById(inputId);
    const toggleButton = passwordInput.parentElement.querySelector('.btn-toggle-password i');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleButton.classList.remove('fa-eye');
        toggleButton.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleButton.classList.remove('fa-eye-slash');
        toggleButton.classList.add('fa-eye');
    }
}

// Function to check password strength
function checkPasswordStrength(password) {
    const progressBar = document.getElementById('passwordStrength');
    const feedback = document.getElementById('passwordFeedback');
    
    // Password strength criteria
    const lengthValid = password.length >= 8;
    const hasUppercase = /[A-Z]/.test(password);
    const hasLowercase = /[a-z]/.test(password);
    const hasNumber = /[0-9]/.test(password);
    const hasSpecial = /[^A-Za-z0-9]/.test(password);
    
    // Calculate strength score (0-100)
    let score = 0;
    if (lengthValid) score += 20;
    if (hasUppercase) score += 20;
    if (hasLowercase) score += 20;
    if (hasNumber) score += 20;
    if (hasSpecial) score += 20;
    
    // Store validation state
    window.passwordMeetsRequirements = lengthValid && hasUppercase && hasNumber && hasSpecial;
    
    // Update progress bar
    progressBar.style.width = score + '%';
    progressBar.setAttribute('aria-valuenow', score);
    
    // Update color based on strength
    if (score < 40) {
        progressBar.classList.remove('bg-warning', 'bg-success');
        progressBar.classList.add('bg-danger');
        feedback.textContent = 'Weak password';
        feedback.className = 'form-text text-danger';
    } else if (score < 80) {
        progressBar.classList.remove('bg-danger', 'bg-success');
        progressBar.classList.add('bg-warning');
        feedback.textContent = 'Medium strength password';
        feedback.className = 'form-text text-warning';
    } else {
        progressBar.classList.remove('bg-danger', 'bg-warning');
        progressBar.classList.add('bg-success');
        feedback.textContent = 'Strong password';
        feedback.className = 'form-text text-success';
    }
    
    // Update requirement indicators
    document.getElementById('req-length').className = lengthValid ? 'text-success' : 'text-muted';
    document.getElementById('req-length').querySelector('i').className = lengthValid ? 'fa fa-check-circle' : 'fa fa-circle';
    
    document.getElementById('req-uppercase').className = hasUppercase ? 'text-success' : 'text-muted';
    document.getElementById('req-uppercase').querySelector('i').className = hasUppercase ? 'fa fa-check-circle' : 'fa fa-circle';
    
    document.getElementById('req-number').className = hasNumber ? 'text-success' : 'text-muted';
    document.getElementById('req-number').querySelector('i').className = hasNumber ? 'fa fa-check-circle' : 'fa fa-circle';
    
    document.getElementById('req-special').className = hasSpecial ? 'text-success' : 'text-muted';
    document.getElementById('req-special').querySelector('i').className = hasSpecial ? 'fa fa-check-circle' : 'fa fa-circle';
}

// Password input event listener
document.addEventListener('DOMContentLoaded', function() {
    const newPasswordInput = document.getElementById('newPassword');
    if (newPasswordInput) {
        newPasswordInput.addEventListener('input', function() {
            checkPasswordStrength(this.value);
        });
    }
    
    // Initialize dark mode based on stored preference
    const isDarkMode = localStorage.getItem('darkMode') === 'enabled';
    
    // Apply dark mode if enabled
    if (isDarkMode) {
        document.body.classList.add('dark-theme');
    }
    
    // Add animation to particles
    const particles = document.querySelector('.blog-particles');
    
    // Create floating particles
    for (let i = 0; i < 50; i++) {
        const particle = document.createElement('span');
        particle.classList.add('particle');
        
        // Random styling
        particle.style.left = Math.random() * 100 + 'vw';
        particle.style.top = Math.random() * 100 + 'vh';
        particle.style.width = Math.random() * 5 + 3 + 'px';
        particle.style.height = particle.style.width;
        particle.style.opacity = Math.random() * 0.5;
        
        // Set particle color based on current theme
        if (isDarkMode) {
            particle.style.backgroundColor = `rgba(${Math.floor(Math.random() * 70) + 50}, ${Math.floor(Math.random() * 70) + 50}, ${Math.floor(Math.random() * 120) + 50}, 0.7)`;
        } else {
            particle.style.backgroundColor = `rgba(${Math.floor(Math.random() * 100) + 100}, ${Math.floor(Math.random() * 100) + 100}, ${Math.floor(Math.random() * 155) + 100}, 0.7)`;
        }
        
        // Set animation
        const duration = Math.random() * 20 + 10;
        particle.style.animation = `float ${duration}s infinite alternate`;
        
        particles.appendChild(particle);
    }
    
    // Add animation keyframes
    const style = document.createElement('style');
    style.textContent = `
        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }
            100% {
                transform: translate(${Math.random() * 100 - 50}px, ${Math.random() * 100 - 50}px) rotate(360deg);
            }
        }
    `;
    document.head.appendChild(style);
    
    // Add input focus animations
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });
});

// Function to simulate password reset
function simulateReset(event) {
    event.preventDefault();
    
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    
    // Check if password meets all requirements
    const lengthValid = newPassword.length >= 8;
    const hasUppercase = /[A-Z]/.test(newPassword);
    const hasNumber = /[0-9]/.test(newPassword);
    const hasSpecial = /[^A-Za-z0-9]/.test(newPassword);
    
    // Display detailed validation error messages
    if (newPassword !== confirmPassword) {
        alert('Passwords do not match!');
        return;
    }
    
    if (!lengthValid || !hasUppercase || !hasNumber || !hasSpecial) {
        let errorMessage = 'Password must contain:\n';
        if (!lengthValid) errorMessage += '- At least 8 characters\n';
        if (!hasUppercase) errorMessage += '- At least one uppercase letter\n';
        if (!hasNumber) errorMessage += '- At least one number\n';
        if (!hasSpecial) errorMessage += '- At least one special character\n';
        
        alert(errorMessage);
        return;
    }
    
    // If we get here, password meets all requirements
    // Simulate successful reset
    document.getElementById('resetForm').style.display = 'none';
    document.getElementById('resetSuccess').style.display = 'block';
}
</script>

<style>
/* Particle styling - needed for floating particles */
.particle {
    position: absolute;
    border-radius: 50%;
    pointer-events: none;
}
</style>
<?= $this->endSection() ?>