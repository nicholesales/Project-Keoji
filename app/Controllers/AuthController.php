<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected $userModel;
    protected $email;
    protected $session;
    
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->email = \Config\Services::email();
        $this->session = \Config\Services::session();
        helper(['form', 'url']);
    }
    
    public function index()
    {
        return redirect()->to('auth/login');
    }
    
    // Show registration form
    public function register()
    {
        // Get security questions
        $data['securityQuestions'] = [
            'What was your first pet\'s name?',
            'What is your mother\'s maiden name?',
            'What city were you born in?',
            'What was the name of your elementary school?',
            'What is the name of your favorite childhood friend?'
        ];
        
        return view('auth/register', $data);
    }
    
    // Process registration
    public function processRegistration()
    {
        // Validate form data
        $rules = [
            'username' => 'required|min_length[3]|max_length[30]|is_unique[user_table.username]',
            'email' => 'required|valid_email|is_unique[user_table.email]',
            'password' => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]',
            'security_question' => 'required',
            'security_answer' => 'required'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Save user to database
        $userData = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'security_question' => $this->request->getPost('security_question'),
            'security_answer' => $this->request->getPost('security_answer'),
            'is_admin' => false
        ];
        
        $this->userModel->insert($userData);
        
        // Send welcome email
        $this->sendWelcomeEmail($userData['email'], $userData['username']);
        
        // Set flash message and redirect to login
        return redirect()->to('auth/login')->with('message', 'Registration successful! You can now login.');
    }
    
    // Send welcome email
    private function sendWelcomeEmail($to, $username)
    {
        $this->email->setFrom('noreply@yourdomain.com', 'Your Social Media Platform');
        $this->email->setTo($to);
        $this->email->setSubject('Welcome to Our Platform');
        
        $message = "
            <h1>Welcome to Our Platform, {$username}!</h1>
            <p>Thank you for joining our community. We're excited to have you on board.</p>
            <p>You can now login and start sharing posts, liking content, and connecting with others.</p>
            <p>Best regards,<br>The Team</p>
        ";
        
        $this->email->setMessage($message);
        $this->email->send();
    }
    
    // Show login form
    public function login()
    {
        return view('auth/login');
    }
    
    // Process login
    public function processLogin()
    {
        // Validate form data
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        
        // Check if username exists
        $user = $this->userModel->where('username', $username)->first();
        
        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password');
        }
        
        // Verify password
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password');
        }
        
        // Set session data
        $sessionData = [
            'user_id' => $user['user_id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'is_admin' => $user['is_admin'],
            'isLoggedIn' => true
        ];
        
        $this->session->set($sessionData);
        
        // Redirect to feed page
        return redirect()->to('posts');
    }
    
    // Logout
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('auth/login')->with('message', 'You have been logged out successfully');
    }
    
    // Forgot password page
    public function forgotPassword()
    {
        return view('auth/forgot_password');
    }
    
    // Process forgot password request
    public function processForgotPassword()
    {
        // Validate form data
        $rules = [
            'email' => 'required|valid_email'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $email = $this->request->getPost('email');
        
        // Check if email exists
        $user = $this->userModel->where('email', $email)->first();
        
        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'Email not found in our records');
        }
        
        // Store email in session for security question verification
        $this->session->set('reset_email', $email);
        
        // Redirect to security question page
        return redirect()->to('auth/security-question');
    }
    
    // Security question page
    public function securityQuestion()
    {
        if (!$this->session->has('reset_email')) {
            return redirect()->to('auth/forgot-password');
        }
        
        $email = $this->session->get('reset_email');
        $user = $this->userModel->where('email', $email)->first();
        
        $data['security_question'] = $user['security_question'];
        
        return view('auth/security_question', $data);
    }
    
    // Process security question answer
    public function processSecurityQuestion()
    {
        if (!$this->session->has('reset_email')) {
            return redirect()->to('auth/forgot-password');
        }
        
        // Validate form data
        $rules = [
            'security_answer' => 'required'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $email = $this->session->get('reset_email');
        $securityAnswer = $this->request->getPost('security_answer');
        
        // Check if answer is correct
        $user = $this->userModel->where('email', $email)->first();
        
        if ($user['security_answer'] !== $securityAnswer) {
            return redirect()->back()->with('error', 'Incorrect security answer');
        }
        
        // Redirect to reset password page
        $this->session->set('can_reset_password', true);
        return redirect()->to('auth/reset-password');
    }
    
    // Reset password page
    public function resetPassword()
    {
        if (!$this->session->has('reset_email') || !$this->session->get('can_reset_password')) {
            return redirect()->to('auth/forgot-password');
        }
        
        return view('auth/reset_password');
    }
    
    // Process password reset
    public function processResetPassword()
    {
        if (!$this->session->has('reset_email') || !$this->session->get('can_reset_password')) {
            return redirect()->to('auth/forgot-password');
        }
    
        // Get email from session
        $email = $this->session->get('reset_email');
    
        // Define validation rules
        $rules = [
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|notSameAsOldPassword[' . $email . ']',
                'errors' => [
                    'notSameAsOldPassword' => 'New password must not match the old password.'
                ]
            ],
            'confirm_password' => 'required|matches[password]'
        ];
    
        // Validate the form
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        // Proceed with resetting the password
        $password = $this->request->getPost('password');
        $this->userModel->where('email', $email)->set([
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ])->update();
    
        // Clear session and redirect to login
        $this->session->remove(['reset_email', 'can_reset_password']);
        return redirect()->to('auth/login')->with('message', 'Password has been reset successfully!');
    }
    
    
}