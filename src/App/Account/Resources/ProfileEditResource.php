<?php

declare(strict_types=1);

namespace App\Account\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Shared\Models\User;

/**
 * @mixin User
 */
final class ProfileEditResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name'    => $this->name,
            'email'   => $this->email,
            'address' => $this->address,
        ];
    }
}
