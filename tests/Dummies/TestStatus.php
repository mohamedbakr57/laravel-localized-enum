<?php

namespace Bakr\LocalizedEnum\Tests\Dummies;

use Bakr\LocalizedEnum\HasLabel;

enum TestStatus: string
{
    use HasLabel;

    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';
}
