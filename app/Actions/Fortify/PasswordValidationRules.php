<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array
     */
    protected function passwordRules()
    {
        $pwd = new Password;
        return ['required', 'string', $pwd->length(8)
                    ->requireUppercase()
                    ->requireNumeric()
                    ->requireSpecialCharacter(), 'confirmed'];
    }
}
