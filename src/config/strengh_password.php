<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Minimum length for password
    |--------------------------------------------------------------------------
    |
    */
    'min_length'    => 8,

    /*
    |--------------------------------------------------------------------------
    | Default Strength
    |--------------------------------------------------------------------------
    */
    'min_strength'  => 70,

    /*
    |--------------------------------------------------------------------------
    | Return strength in number or text
    |--------------------------------------------------------------------------
    */
    'print_text'    => false,

    /*
    |--------------------------------------------------------------------------
    | Return Json or XML
    |--------------------------------------------------------------------------
    */
    'json'          => true,

    /*
    |--------------------------------------------------------------------------
    | Define it being used as an api
    |--------------------------------------------------------------------------
    |
    */
    'api'           => true,

    /*
    |--------------------------------------------------------------------------
    | Define response text
    |--------------------------------------------------------------------------
    */
    'response_text' => [
        0 => 'Very Weak',
        1 => 'Weak',
        2 => 'Fair',
        3 => 'Strong',
        4 => 'Very Strong',
    ],

    'order' => [
        'countLength',
        'countLowerCase',
        'countNumbers',
        'countSymbols',
        'countUpperCase',
        'hasCharactersOnly',
        'hasExtra',
        'hasNumbersOnly',
        'hasAnyNumberInTheMiddle',
        'doesChartRepeats',
        'doesHasSequentialChars',
        'doesHasSequentialNumbers',
        'doesHasSequentialUpperCase',
        'doesHasSequentialLowerCase',
    ],
];
