<?php

namespace jycr753\Models;

class Password
{
    const STRENGTH_VERY_WEAK = 0;
    const STRENGTH_WEAK = 1;
    const STRENGTH_FAIR = 2;
    const STRENGTH_STRONG = 3;
    const STRENGTH_VERY_STRONG = 4;

    protected $attributes = [
        'score',
        'strength',
        'text',
    ];
}
