<?php

declare(strict_types=1);

namespace Shared\Enums;

enum ToastType: string
{
    case SUCCESS = 'success';
    case ERROR   = 'error';
    case WARNING = 'warning';
    case INFO    = 'info';
    case DEFAULT = 'default';
}
