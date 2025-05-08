<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('auth/login', 'AuthController::login');
$routes->get('auth/register', 'AuthController::register');
$routes->post('auth/process-registration', 'AuthController::processRegistration');
$routes->post('auth/process-login', 'AuthController::processLogin');
$routes->get('auth/forgot_password', 'AuthController::forgotPassword');
$routes->post('auth/process-forgot-password', 'AuthController::processForgotPassword');
$routes->get('auth/security-question', 'AuthController::securityQuestion');
$routes->post('auth/process-security-question', 'AuthController::processSecurityQuestion');
$routes->get('auth/reset-password', 'AuthController::resetPassword');
$routes->post('auth/process-reset-password', 'AuthController::processResetPassword');
// Posts routes
$routes->get('/posts', 'PostsController::index');
$routes->post('/posts/create', 'PostsController::create');
$routes->get('/posts/edit/(:num)', 'PostsController::edit/$1');
$routes->post('/posts/update/(:num)', 'PostsController::update/$1');
$routes->post('/posts/delete/(:num)', 'PostsController::delete/$1');
