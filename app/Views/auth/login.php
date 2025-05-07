<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>Login | YourBlog<?= $this->endSection() ?>

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
                    <h3 class="text-center font-weight-bold mb-2">Welcome Back</h3>
                    <p class="text-center text-muted mb-4">Sign in to continue to your dashboard</p>
                </div>
                <div class="card-body px-4 py-3">
                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger animate__animated animate__shakeX">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    
                    <form action="<?= site_url('auth/process-login') ?>" method="post" class="login-form">
                        <?= csrf_field() ?>
                        
                        <div class="form-floating mb-3 input-group-animation">
                            <input type="text" class="form-control" id="username" name="username" value="<?= old('username') ?>" placeholder="Username" required>
                            <label for="username">Username</label>
                            <div class="focus-border"></div>
                        </div>
                        
                        <div class="form-floating mb-4 input-group-animation">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            <label for="password">Password</label>
                            <div class="focus-border"></div>
                            <button type="button" class="btn-toggle-password" onclick="togglePassword()">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                        
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label text-muted" for="remember">
                                Remember me
                            </label>
                            <a href="<?= site_url('auth/forgot_password') ?>" class="float-end text-decoration-none hover-effect">Forgot Password?</a>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary py-3 fw-bold pulse-on-hover">
                                <span>Sign In</span>
                                <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="M12 5l7 7-7 7"></path></svg>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-white text-center border-0 py-4">
                    <p class="mb-0">Don't have an account? <a href="<?= site_url('auth/register') ?>" class="text-decoration-none fw-bold hover-effect">Create an account</a></p>
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

<style>
/* Fonts */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
@import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');

body {
    font-family: 'Poppins', sans-serif;
    background-color: #f8f9fd;
    position: relative;
    overflow-x: hidden;
}

/* Animated background */
.blog-particles {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    background: linear-gradient(135deg, #f8f9fd 0%, #eef1f9 100%);
    overflow: hidden;
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
}

@keyframes pulse {
    0% { transform: scale(1); }
    100% { transform: scale(1.2); }
}



/* Login card */
.login-container {
    margin-top: 2rem;
}

.card {
    border-radius: 1.5rem;
    overflow: hidden;
    backdrop-filter: blur(10px);
    background-color: rgba(255, 255, 255, 0.95);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    transition: all 0.5s ease;
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
.form-floating input {
    border-radius: 0.8rem;
    border: 1px solid #e0e0e0;
    padding: 1.2rem 1rem 0.6rem;
    transition: all 0.3s ease;
    background-color: #f8f9fd;
}

.form-floating label {
    padding: 1rem 1rem 0;
    color: #888;
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

.form-floating input:focus ~ .focus-border {
    width: 100%;
}

.btn-toggle-password {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #888;
    cursor: pointer;
    z-index: 10;
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
    transition: all 0.3s ease;
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
}

.featured-post p {
    color: #777;
    font-size: 0.9rem;
    margin-bottom: 12px;
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


.login-form {
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

/* Responsive adjustments */
@media (max-width: 768px) {

    
    .card {
        margin-bottom: 2rem;
    }
    
    .featured-post {
        margin-bottom: 2rem;
    }
}
</style>

<script>
// Function to toggle password visibility
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleButton = document.querySelector('.btn-toggle-password i');
    
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

// Add animation to particles
document.addEventListener('DOMContentLoaded', function() {
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
        particle.style.backgroundColor = `rgba(${Math.floor(Math.random() * 100) + 100}, ${Math.floor(Math.random() * 100) + 100}, ${Math.floor(Math.random() * 155) + 100}, 0.7)`;
        
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
</script>
<?= $this->endSection() ?>