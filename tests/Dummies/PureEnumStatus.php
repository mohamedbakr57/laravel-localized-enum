<?php

namespace Bakr\LocalizedEnum\Tests\Dummies;

use Bakr\LocalizedEnum\HasLabel;

enum PureEnumStatus
{
    use HasLabel;

    case Active;
    case Inactive;
}
