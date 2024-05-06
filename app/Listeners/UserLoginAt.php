<?php

declare(strict_types=1);

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class UserLoginAt
{
    /**
     * Handle the login event.
     *
     * @param Login $event the login event
     */
    public function handle(Login $event): void
    {
        $event->user->update([
            'last_login_at' => now()->toDateTimeString(),
        ]);
    }
}
