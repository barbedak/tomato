<?php

namespace App\Services;

use App\Models\Theme;

class ThemeService
{
    public static function update(Theme $theme, array $data): Theme
    {
        $theme->update($data);
        return $theme->refresh();
    }
}
