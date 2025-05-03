<?php

namespace App\Validation;

class MyRules
{
    public function notSameAsOldPassword(string $newPassword, string $email): bool
    {
        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('email', $email)->first();

        if ($user) {
            // Check if the password doesn't match the old password
            return !password_verify($newPassword, $user['password']);
        }

        return true; // If user doesn't exist, allow the password change (this shouldn't happen in this flow)
    }


}
