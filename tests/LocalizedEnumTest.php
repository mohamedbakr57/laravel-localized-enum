<?php

use Bakr\LocalizedEnum\Tests\Dummies\PlainTestStatus;
use Bakr\LocalizedEnum\Tests\Dummies\PureEnumStatus;
use Bakr\LocalizedEnum\Tests\Dummies\TestStatus;
use Illuminate\Support\Facades\Lang;

test('it returns a translated label (FQCN)', function () {
    app()->setLocale('en');

    Lang::addLines([
        'enums.Bakr\LocalizedEnum\Tests\Dummies\TestStatus.Approved' => 'Approved by Admin',
    ], 'en');

    expect(TestStatus::Approved->label())->toBe('Approved by Admin');
});

test('it returns a translated label (class basename)', function () {
    Lang::addLines([
        'enums.TestStatus.Approved' => 'Approved Short',
    ], 'en');

    expect(TestStatus::Approved->label())->toBe('Approved Short');
});

test('it returns a translated label (no enums. prefix)', function () {
    Lang::addLines([
        'TestStatus.Approved' => 'Approved Generic',
    ], 'en');

    expect(TestStatus::Approved->label())->toBe('Approved Generic');
});

test('it returns translation using a custom key', function () {
    Lang::addLines([
        'custom.status.approved' => 'Approved from custom key',
    ], 'en');

    expect(TestStatus::Approved->label('custom.status.approved'))->toBe('Approved from custom key');
});

test('it falls back to default label if custom key is missing', function () {
    expect(TestStatus::Approved->label('non.existing.key', 'Fallback Approved'))->toBe('Fallback Approved');
});

test('it falls back to default label if all keys are missing', function () {
    expect(TestStatus::Approved->label(null, 'Manual Fallback'))->toBe('Manual Fallback');
});

test('it falls back to Str::headline if no translation or default is provided', function () {
    expect(TestStatus::Rejected->label())->toBe('Rejected');
});

test('it uses the locale from the X-Locale request header', function () {
    Lang::addLines([
        'enums.TestStatus.Approved' => 'Approved (EN)',
    ], 'en');

    Lang::addLines([
        'enums.TestStatus.Approved' => 'موافق عليه',
    ], 'ar');

    request()->headers->set('X-Locale', 'ar');

    expect(TestStatus::Approved->label())->toBe('موافق عليه');
});

test('it falls back to config(app.locale) when no header is present', function () {
    app()->setLocale('en');

    Lang::addLines([
        'enums.TestStatus.Approved' => 'Approved (EN)',
    ], 'en');

    expect(TestStatus::Approved->label())->toBe('Approved (EN)');
});

test('it reads the header key from config', function () {
    config()->set('localized-enum.header_key', 'Accept-Language');

    Lang::addLines([
        'enums.TestStatus.Approved' => 'موافق عليه',
    ], 'ar');

    request()->headers->set('Accept-Language', 'ar');

    expect(TestStatus::Approved->label())->toBe('موافق عليه');
});

test('it ignores a header locale not in the configured whitelist', function () {
    config()->set('app.locale', 'en');
    config()->set('localized-enum.available_locales', ['en', 'ar']);

    Lang::addLines([
        'enums.TestStatus.Approved' => 'Approved (EN)',
    ], 'en');

    request()->headers->set('X-Locale', 'fr');

    expect(TestStatus::Approved->label())->toBe('Approved (EN)');
});

test('it accepts a header locale that is in the configured whitelist', function () {
    config()->set('localized-enum.available_locales', ['en', 'ar']);

    Lang::addLines([
        'enums.TestStatus.Approved' => 'موافق عليه',
    ], 'ar');

    request()->headers->set('X-Locale', 'ar');

    expect(TestStatus::Approved->label())->toBe('موافق عليه');
});

test('enum_label() helper returns the label', function () {
    Lang::addLines([
        'enums.TestStatus.Approved' => 'Approved via helper',
    ], 'en');

    expect(enum_label(TestStatus::Approved))->toBe('Approved via helper');
});

test('enum_label() helper falls back to the enum name when label() is unavailable', function () {
    expect(enum_label(PlainTestStatus::Active))->toBe('Active');
});

test('enum_label() helper works with pure (non-backed) enums using HasLabel', function () {
    expect(enum_label(PureEnumStatus::Active))->toBe('Active');
});
