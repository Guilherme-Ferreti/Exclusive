<?php

declare(strict_types=1);

namespace App\Account\Actions\SignUp;

use Illuminate\Http\Request;

final class SignUpData
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->name,
            email: $request->email,
            password: $request->password
        );
    }
}
