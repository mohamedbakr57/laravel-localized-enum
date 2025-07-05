<?php

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
