<?php

/**
 * Return the localized label of a PHP enum if it uses the HasLabel trait.
 */
if (! function_exists('enum_label')) {
    function enum_label(UnitEnum $enum): string
    {
        return method_exists($enum, 'label') ? $enum->label() : $enum->name;
    }
}
