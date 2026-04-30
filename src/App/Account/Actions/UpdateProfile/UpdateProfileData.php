<?php

declare(strict_types=1);

namespace App\Account\Actions\UpdateProfile;

use Illuminate\Http\Request;

final class UpdateProfileData
{
    public function __construct(
        public string $name,
        public string $email,
        public ?string $address
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->name,
            email: $request->email,
            address: $request->address
        );
    }
}
