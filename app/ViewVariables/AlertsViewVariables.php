<?php declare(strict_types=1);

namespace App\ViewVariables;

class AlertsViewVariables implements ViewVariables
{
    public function getName(): string
    {
        return 'alert';
    }

    public function getValue(): array
    {
        return $_SESSION['alerts'] ?? [];
    }
}