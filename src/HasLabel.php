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
        $locale = $this->getLabelLocale();
        $class = static::class;
        $basename = class_basename($class);
        $value = $this->name;

        $keysToTry = $key ? [$key] : [
            "enums.{$class}.{$value}",
            "enums.{$basename}.{$value}",
            "{$class}.{$value}",
            "{$basename}.{$value}",
            $value,
        ];

        foreach ($keysToTry as $tryKey) {
            if (! Lang::has($tryKey, $locale)) {
                continue;
            }

            $translated = __($tryKey, [], $locale);

            if (is_string($translated)) {
                return $translated;
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
        $default = config('app.locale');
        $requestLocale = request()->header($this->getLocaleHeaderKey());

        if (! $requestLocale) {
            return $default;
        }

        $availableLocales = config('localized-enum.available_locales');

        // Without a configured whitelist, any locale value supplied by the
        // client is trusted as-is (existing behavior for backwards compatibility).
        if (empty($availableLocales)) {
            return $requestLocale;
        }

        return in_array($requestLocale, $availableLocales, true) ? $requestLocale : $default;
    }

    /**
     * Define the request header key to be used for locale detection.
     * Defaults to `localized-enum.header_key` config, falling back to `X-Locale`.
     * Developers can override this method if they want to customize the header
     * on a per-enum basis without touching the config.
     */
    protected function getLocaleHeaderKey(): string
    {
        return config('localized-enum.header_key', 'X-Locale');
    }
}
