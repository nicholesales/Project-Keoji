<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>Register | Project Keoji<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Background animation -->
<div class="blog-particles"></div>

<div class="container py-5 register-container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            
            <div class="card shadow-lg border-0 rounded-lg animate__animated animate__fadeIn">
                <div class="decorative-dots">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                
                <div class="card-header bg-white border-0 pt-4">
                    <h3 class="text-center font-weight-bold mb-2">Create an Account</h3>
                    <p class="text-center text-muted mb-4">Join our community and start sharing</p>
                </div>
                <div class="card-body px-4 py-3">
                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger animate__animated animate__shakeX">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    
                    <form action="<?= site_url('auth/process-registration') ?>" method="post" class="register-form" id="registration-form">
                        <?= csrf_field() ?>
                        
                        <div class="form-floating mb-3 input-group-animation">
                            <input type="text" class="form-control" id="username" name="username" value="<?= old('username') ?>" placeholder="Username" required>
                            <label for="username">Username</label>
                            <div class="focus-border"></div>
                            <div class="invalid-feedback" id="username-feedback"></div>
                        </div>
                        
                        <div class="form-floating mb-3 input-group-animation">
                            <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" placeholder="Email" required>
                            <label for="email">Email</label>
                            <div class="focus-border"></div>
                            <div class="invalid-feedback" id="email-feedback"></div>
                        </div>
                        
                        <div class="form-floating mb-1 input-group-animation">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            <label for="password">Password</label>
                            <div class="focus-border"></div>
                            <button type="button" class="btn-toggle-password" onclick="togglePassword('password')">
                                <i class="fa fa-eye"></i>
                            </button>
                            <div class="invalid-feedback" id="password-feedback"></div>
                        </div>
                        
                        <div class="password-requirements mb-3">
                            <small class="form-text text-muted ps-2">Password must contain:</small>
                            <div class="d-flex flex-wrap gap-2 mt-1 ps-2">
                                <span id="length-check" class="password-check"><i class="fa fa-times-circle"></i> 8+ characters</span>
                                <span id="uppercase-check" class="password-check"><i class="fa fa-times-circle"></i> 1 uppercase</span>
                                <span id="number-check" class="password-check"><i class="fa fa-times-circle"></i> 1 number</span>
                                <span id="special-check" class="password-check"><i class="fa fa-times-circle"></i> 1 special character</span>
                            </div>
                        </div>
                        
                        <div class="form-floating mb-3 input-group-animation">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                            <label for="confirm_password">Confirm Password</label>
                            <div class="focus-border"></div>
                            <button type="button" class="btn-toggle-password" onclick="togglePassword('confirm_password')">
                                <i class="fa fa-eye"></i>
                            </button>
                            <div class="invalid-feedback" id="confirm-password-feedback"></div>
                        </div>
                        
                        <div class="form-floating mb-3 input-group-animation">
                            <select class="form-select" id="security_question" name="security_question" required>
                                <option value="">Select a security question</option>
                                <?php foreach($securityQuestions as $question): ?>
                                    <option value="<?= $question ?>" <?= (old('security_question') == $question) ? 'selected' : '' ?>>
                                        <?= $question ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="security_question">Security Question</label>
                            <div class="focus-border"></div>
                            <div class="invalid-feedback" id="security-question-feedback"></div>
                        </div>
                        
                        <div class="form-floating mb-4 input-group-animation">
                            <input type="text" class="form-control" id="security_answer" name="security_answer" value="<?= old('security_answer') ?>" placeholder="Answer to Security Question" required>
                            <label for="security_answer">Answer to Security Question</label>
                            <div class="focus-border"></div>
                            <div class="invalid-feedback" id="security-answer-feedback"></div>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary py-3 fw-bold pulse-on-hover">
                                <span>Create Account</span>
                                <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="M12 5l7 7-7 7"></path></svg>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-white text-center border-0 py-4">
                    <p class="mb-0">Already have an account? <a href="<?= site_url('auth/login') ?>" class="text-decoration-none fw-bold hover-effect">Sign in</a></p>
                </div>
            </div>
            
            <!-- Featured blog post preview -->
            <div class="featured-post animate__animated animate__fadeInUp">
                <div class="featured-tag">Community</div>
                <h4>Join 10,000+ bloggers sharing their stories</h4>
                <p>Create your personal blog and connect with readers around the world...</p>
                <a href="#">Learn More</a>
            </div>
        </div>
    </div>
</div>

<style>
/* Fonts */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
@import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');

:root {
    --primary: #6d5bf1;
    --primary-light: #8a7cf5;
    --primary-dark: #4c6ef5;
    --accent: #ff7b54;
    --accent-light: #ffb26b;
    --text-dark: #333;
    --text-muted: #777;
    --bg-light: #f8f9fd;
    --bg-gradient: linear-gradient(135deg, #f8f9fd 0%, #eef1f9 100%);
    --white: #fff;
    --shadow-sm: 0 5px 15px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 10px 30px rgba(0, 0, 0, 0.08);
    --shadow-lg: 0 15px 35px rgba(0, 0, 0, 0.1);
    --radius-sm: 0.8rem;
    --radius-md: 1.5rem;
    --success: #2ecc71;
    --warning: #f39c12;
    --danger: #e74c3c;
    
    /* Dark theme variables */
    --dark-bg: #1a1c25;
    --dark-bg-secondary: #282c34;
    --dark-bg-tertiary: #2d3748;
    --dark-border: #3a3f4b;
    --dark-text: #e0e0e0;
    --dark-text-muted: #a0a0a0;
    --dark-shadow-sm: 0 5px 15px rgba(0, 0, 0, 0.2);
    --dark-shadow-md: 0 10px 30px rgba(0, 0, 0, 0.25);
    --dark-shadow-lg: 0 15px 35px rgba(0, 0, 0, 0.3);
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: var(--bg-light);
    position: relative;
    overflow-x: hidden;
    color: var(--text-dark);
    transition: background-color 0.3s ease, color 0.3s ease;
}

/* Animated background */
.blog-particles {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    background: var(--bg-gradient);
    overflow: hidden;
    transition: background 0.3s ease;
}

.blog-particles:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 30% 20%, rgba(109, 91, 241, 0.05) 0%, transparent 150px),
        radial-gradient(circle at 70% 65%, rgba(76, 110, 245, 0.05) 0%, transparent 150px);
    animation: pulse 15s infinite alternate;
    transition: background-image 0.3s ease;
}

@keyframes pulse {
    0% { transform: scale(1); }
    100% { transform: scale(1.2); }
}

/* Register card */
.register-container {
    margin-top: 2rem;
    margin-bottom: 2rem;
}

.card {
    border-radius: 1.5rem;
    overflow: hidden;
    backdrop-filter: blur(10px);
    background-color: rgba(255, 255, 255, 0.95);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    transition: all 0.5s ease, background-color 0.3s ease, border-color 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
}

.decorative-dots {
    position: absolute;
    top: 20px;
    left: 20px;
    display: flex;
    gap: 6px;
}

.decorative-dots span {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    display: block;
}

.decorative-dots span:nth-child(1) {
    background-color: #ff7b54;
}

.decorative-dots span:nth-child(2) {
    background-color: #ffb26b;
}

.decorative-dots span:nth-child(3) {
    background-color: #6d5bf1;
}

/* Form styling */
.form-floating input, .form-floating select {
    border-radius: 0.8rem;
    border: 1px solid #e0e0e0;
    padding: 1.2rem 1rem 0.6rem;
    transition: all 0.3s ease, background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    background-color: #f8f9fd;
}

.form-floating label {
    padding: 1rem 1rem 0;
    color: #888;
    transition: color 0.3s ease;
}

.input-group-animation {
    position: relative;
}

.focus-border {
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, #6d5bf1, #4c6ef5);
    transition: all 0.4s ease;
    transform: translateX(-50%);
}

.form-floating input:focus ~ .focus-border,
.form-floating select:focus ~ .focus-border {
    width: 100%;
}

.btn-toggle-password {
    position: absolute;
    right: 10px;
    top: 30%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #888;
    cursor: pointer;
    z-index: 10;
    transition: color 0.3s ease;
}

/* Password requirements */
.password-requirements {
    font-size: 0.8rem;
}

.password-check {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    color: var(--text-muted);
    padding: 2px 8px;
    border-radius: 12px;
    background-color: rgba(0, 0, 0, 0.03);
    transition: all 0.3s ease;
}

.password-check.valid {
    color: var(--success);
    background-color: rgba(46, 204, 113, 0.1);
}

.password-check.valid i {
    color: var(--success);
}

.password-check i {
    color: var(--danger);
    transition: color 0.3s ease;
}

/* Button styling */
.btn-primary {
    border-radius: 0.8rem;
    background: linear-gradient(135deg, #6d5bf1 0%, #4c6ef5 100%);
    border: none;
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-primary span {
    transition: all 0.3s ease;
    display: inline-block;
}

.btn-arrow {
    position: absolute;
    right: 20px;
    opacity: 0;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(108, 95, 241, 0.4);
}

.btn-primary:hover span {
    transform: translateX(-10px);
}

.btn-primary:hover .btn-arrow {
    opacity: 1;
    right: 15px;
}

.pulse-on-hover:hover {
    animation: pulse-animation 1.5s infinite;
}

@keyframes pulse-animation {
    0% { box-shadow: 0 0 0 0 rgba(108, 95, 241, 0.7); }
    70% { box-shadow: 0 0 0 10px rgba(108, 95, 241, 0); }
    100% { box-shadow: 0 0 0 0 rgba(108, 95, 241, 0); }
}

/* Link effects */
.hover-effect {
    position: relative;
    color: #6d5bf1;
    transition: all 0.3s ease;
}

.hover-effect:after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: -2px;
    left: 0;
    background-color: #6d5bf1;
    transition: all 0.3s ease;
}

.hover-effect:hover:after {
    width: 100%;
}

/* Featured post */
.featured-post {
    margin-top: 2rem;
    padding: 1.5rem;
    border-radius: 1.5rem;
    background-color: rgba(255, 255, 255, 0.9);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
    position: relative;
    transition: all 0.3s ease, background-color 0.3s ease;
    cursor: pointer;
}

.featured-post:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.08);
}

.featured-tag {
    position: absolute;
    top: -10px;
    left: 20px;
    background: linear-gradient(135deg, #ff7b54 0%, #ffb26b 100%);
    color: white;
    font-size: 0.8rem;
    padding: 4px 12px;
    border-radius: 20px;
    font-weight: 500;
}

.featured-post h4 {
    margin-top: 10px;
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    transition: color 0.3s ease;
}

.featured-post p {
    color: #777;
    font-size: 0.9rem;
    margin-bottom: 12px;
    transition: color 0.3s ease;
}

.featured-post a {
    color: #6d5bf1;
    font-weight: 500;
    text-decoration: none;
    font-size: 0.9rem;
    position: relative;
}

.featured-post a:after {
    content: '→';
    margin-left: 5px;
    transition: all 0.3s ease;
}

.featured-post a:hover:after {
    margin-left: 10px;
}

/* Animations for element entrance */
.register-form {
    animation: fadeIn 1s 0.3s both;
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Form text helpers */
.form-text {
    font-size: 0.75rem;
    margin-top: 0.25rem;
    transition: color 0.3s ease;
}

/* Form validation styling */
.is-invalid {
    border-color: var(--danger) !important;
}

.invalid-feedback {
    color: var(--danger);
    font-size: 0.8rem;
    margin-top: 0.25rem;
    display: none;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .card {
        margin-bottom: 2rem;
    }
    
    .featured-post {
        margin-bottom: 2rem;
    }
}

/* Dark theme styles */
body.dark-theme {
    color: var(--dark-text);
}

/* Dark mode background */
body.dark-theme .blog-particles {
    background: linear-gradient(135deg, #1a1c25 0%, #262a3c 100%);
}

body.dark-theme .blog-particles:before {
    background-image: 
        radial-gradient(circle at 30% 20%, rgba(109, 91, 241, 0.1) 0%, transparent 150px),
        radial-gradient(circle at 70% 65%, rgba(76, 110, 245, 0.1) 0%, transparent 150px);
}

/* Card styling in dark mode */
body.dark-theme .card {
    background-color: var(--dark-bg-secondary);
    border-color: var(--dark-border);
    box-shadow: var(--dark-shadow-md);
}

body.dark-theme .card-header,
body.dark-theme .card-footer {
    background-color: var(--dark-bg-secondary) !important;
    border-color: var(--dark-border);
}

/* Form controls in dark mode */
body.dark-theme .form-control,
body.dark-theme .form-select {
    background-color: var(--dark-bg-tertiary);
    border-color: var(--dark-border);
    color: var(--dark-text);
}

body.dark-theme .form-floating label {
    color: var(--dark-text-muted);
}

body.dark-theme .btn-toggle-password {
    color: var(--dark-text-muted);
}

body.dark-theme .form-text.text-muted {
    color: var(--dark-text-muted) !important;
}

/* Password requirements in dark mode */
body.dark-theme .password-check {
    background-color: rgba(255, 255, 255, 0.05);
}

/* Text colors in dark mode */
body.dark-theme .text-muted {
    color: var(--dark-text-muted) !important;
}

body.dark-theme h4 {
    color: var(--dark-text);
}

/* Featured post in dark mode */
body.dark-theme .featured-post {
    background-color: var(--dark-bg-secondary);
    box-shadow: var(--dark-shadow-md);
}

body.dark-theme .featured-post h4 {
    color: var(--dark-text);
}

body.dark-theme .featured-post p {
    color: var(--dark-text-muted);
}

/* Alert styling in dark mode */
body.dark-theme .alert-danger {
    background-color: rgba(255, 92, 92, 0.15);
    color: #ff7a7a;
}

/* Transition styles for smoother theme changes */
body, body * {
    transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
}
</style>

<script>
// Function to toggle password visibility
function togglePassword(inputId) {
    const passwordInput = document.getElementById(inputId);
    const toggleButton = passwordInput.parentNode.querySelector('.btn-toggle-password i');
    
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

// Validate password strength
function validatePassword() {
    const password = document.getElementById('password').value;
    
    // Password requirements
    const lengthValid = password.length >= 8;
    const uppercaseValid = /[A-Z]/.test(password);
    const numberValid = /[0-9]/.test(password);
    const specialValid = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password);
    
    // Update requirement indicators
    updateRequirementCheck('length-check', lengthValid);
    updateRequirementCheck('uppercase-check', uppercaseValid);
    updateRequirementCheck('number-check', numberValid);
    updateRequirementCheck('special-check', specialValid);
    
    return lengthValid && uppercaseValid && numberValid && specialValid;
}

// Update requirement check indicators
function updateRequirementCheck(id, isValid) {
    const element = document.getElementById(id);
    const icon = element.querySelector('i');
    
    if (isValid) {
        element.classList.add('valid');
        icon.classList.remove('fa-times-circle');
        icon.classList.add('fa-check-circle');
    } else {
        element.classList.remove('valid');
        icon.classList.remove('fa-check-circle');
        icon.classList.add('fa-times-circle');
    }
}

// Validate email format
function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

// Initialize form validation
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registration-form');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm_password');
    const usernameInput = document.getElementById('username');
    const securityQuestionInput = document.getElementById('security_question');
    const securityAnswerInput = document.getElementById('security_answer');
    
    // Real-time password validation
    passwordInput.addEventListener('input', validatePassword);
    
    // Check if passwords match
    confirmPasswordInput.addEventListener('input', function() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        
        if (password !== confirmPassword) {
            confirmPasswordInput.classList.add('is-invalid');
            document.getElementById('confirm-password-feedback').textContent = 'Passwords do not match';
            document.getElementById('confirm-password-feedback').style.display = 'block';
        } else {
            confirmPasswordInput.classList.remove('is-invalid');
            document.getElementById('confirm-password-feedback').style.display = 'none';
        }
    });
    
    // Email validation
    emailInput.addEventListener('blur', function() {
        if (!validateEmail(emailInput.value) && emailInput.value !== '') {
            emailInput.classList.add('is-invalid');
            document.getElementById('email-feedback').textContent = 'Please enter a valid email address';
            document.getElementById('email-feedback').style.display = 'block';
        } else {
            emailInput.classList.remove('is-invalid');
            document.getElementById('email-feedback').style.display = 'none';
        }
    });
    
    // Form submission validation
    form.addEventListener('submit', function(event) {
        let isValid = true;
        
        // Validate username
        if (usernameInput.value.trim() === '') {
            usernameInput.classList.add('is-invalid');
            document.getElementById('username-feedback').textContent = 'Username is required';
            document.getElementById('username-feedback').style.display = 'block';
            isValid = false;
        } else {
            usernameInput.classList.remove('is-invalid');
            document.getElementById('username-feedback').style.display = 'none';
        }
        
        // Validate email
        if (!validateEmail(emailInput.value)) {
            emailInput.classList.add('is-invalid');
            document.getElementById('email-feedback').textContent = 'Please enter a valid email address';
            document.getElementById('email-feedback').style.display = 'block';
            isValid = false;
        } else {
            emailInput.classList.remove('is-invalid');
            document.getElementById('email-feedback').style.display = 'none';
        }
        
        // Validate password
        if (!validatePassword()) {
            passwordInput.classList.add('is-invalid');
            document.getElementById('password-feedback').textContent = 'Password does not meet requirements';
            document.getElementById('password-feedback').style.display = 'block';
            isValid = false;
        } else {
            passwordInput.classList.remove('is-invalid');
            document.getElementById('password-feedback').style.display = 'none';
        }
        
        // Validate password confirmation
        if (passwordInput.value !== confirmPasswordInput.value) {
            confirmPasswordInput.classList.add('is-invalid');
            document.getElementById('confirm-password-feedback').textContent = 'Passwords do not match';
            document.getElementById('confirm-password-feedback').style.display = 'block';
            isValid = false;
        } else {
            confirmPasswordInput.classList.remove('is-invalid');
            document.getElementById('confirm-password-feedback').style.display = 'none';
        }
        
        // Validate security question
        if (securityQuestionInput.value === '') {
            securityQuestionInput.classList.add('is-invalid');
            document.getElementById('security-question-feedback').textContent = 'Please select a security question';
            document.getElementById('security-question-feedback').style.display = 'block';
            isValid = false;
        } else {
            securityQuestionInput.classList.remove('is-invalid');
            document.getElementById('security-question-feedback').style.display = 'none';
        }
        
        // Validate security answer
        if (securityAnswerInput.value.trim() === '') {
            securityAnswerInput.classList.add('is-invalid');
            document.getElementById('security-answer-feedback').textContent = 'Security answer is required';
            document.getElementById('security-answer-feedback').style.display = 'block';
            isValid = false;
        } else {
            securityAnswerInput.classList.remove('is-invalid');
            document.getElementById('security-answer-feedback').style.display = 'none';
        }
        
        // Prevent form submission if validation fails
        if (!isValid) {
            event.preventDefault();
            
            // Scroll to the first invalid input
            const firstInvalidInput = document.querySelector('.is-invalid');
            if (firstInvalidInput) {
                firstInvalidInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstInvalidInput.focus();
            }
        }
    });
    
    // Check for saved dark mode preference
    const isDarkMode = localStorage.getItem('darkMode') === 'enabled';
    
    // Apply dark mode if enabled
    if (isDarkMode) {
        enableDarkMode();
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
        .particle {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }
        
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
    const inputs = document.querySelectorAll('.form-control, .form-select');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });
});

// Function to enable dark mode (called when dark mode is detected from localStorage)
function enableDarkMode() {
    // Add class to body
    document.body.classList.add('dark-theme');
    
    // Update particles color
    document.querySelectorAll('.particle').forEach(particle => {
        particle.style.backgroundColor = `rgba(${Math.floor(Math.random() * 70) + 50}, ${Math.floor(Math.random() * 70) + 50}, ${Math.floor(Math.random() * 120) + 50}, 0.7)`;
    });
}
</script>
<?= $this->endSection() ?>