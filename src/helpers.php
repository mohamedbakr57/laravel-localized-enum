<?php

/**
 * Return the localized label of a PHP enum if it uses the HasLabel trait.
 *
 * @param  BackedEnum  $enum
 * @return string
 */
if (! function_exists('enum_label')) {
    function enum_label(BackedEnum $enum): string
    {
        return method_exists($enum, 'label') ? $enum->label() : $enum->name;
    }
}
