<?php

namespace Bakr\LocalizedEnum;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

trait HasLabel
{
    /**
     * Get the localized label for the enum case.
     *
     * @param  string|null  $key  Optional custom translation key.
     * @param  string|null  $default  Optional fallback value if no translation is found.
     */
    public function label(?string $key = null, ?string $default = null): string
    {
        $class = static::class;
        $basename = class_basename($class);
        $value = $this->name;

        $keysToTry = [];

        if ($key) {
            $keysToTry[] = $key;
        } else {
            $keysToTry = [
                "enums.{$class}.{$value}",
                "enums.{$basename}.{$value}",
                "{$class}.{$value}",
                "{$basename}.{$value}",
            ];
        }

        foreach ($keysToTry as $tryKey) {
            if (Lang::has($tryKey)) {
                return __($tryKey);
            }
        }

        return $default ?? Str::headline($value);
    }
}
