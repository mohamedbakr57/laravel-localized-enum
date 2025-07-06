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
     * @return string
     */
    public function label(?string $key = null, ?string $default = null): string
    {
        $locale = $this->getLabelLocale();
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
                $value,
            ];
        }

        foreach ($keysToTry as $tryKey) {
            if (Lang::has($tryKey, $locale)) {
                return __($tryKey, [], $locale);
            }
        }

        return $default ?? Str::headline($value);
    }

    /**
     * Determine the locale to use for translation.
     * You can override this method in your enum to change the behavior.
     */
    protected function getLabelLocale(): string
    {
        // Check for locale in request header (default: X-Locale)
        $headerKey = $this->getLocaleHeaderKey();
        $requestLocale = request()->header($headerKey);

        return $requestLocale ?: config('app.locale');
    }

    /**
     * Define the request header key to be used for locale detection.
     * Developers can override this method if they want to customize the header.
     */
    protected function getLocaleHeaderKey(): string
    {
        return 'X-Locale'; // You can override this method to change the header key
    }
}
