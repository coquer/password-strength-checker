<?php
namespace jycr753\PasswordStrengthChecker;


class GeneralInString extends GeneralInStringAbstract{

    public function hasCharactersOnly( array $password )
    {
        $passwordLength = strlen( $password[ 'raw' ] );

        return (
            $password[ 'lower' ][ 'count' ] + $password[ 'upper' ][ 'count' ] == $passwordLength
        ) ? - $passwordLength : 0;
    }

    public function hasExtra( array $password )
    {
        $score = 0;
        if ( strlen( $password[ 'raw' ] ) >= 8 ) {
            $score += 2;
        }
        foreach ( [ 'upper', 'lower', 'number', 'symbol' ] as $type ) {
            if ( $password[ $type ][ 'count' ] > 0 ) {
                $score += 2;
            }
        }

        return $score;
    }

    public function hasNumbersOnly( array $password )
    {
        $passwordLength = strlen( $password[ 'raw' ] );

        return (
            $password[ 'number' ][ 'count' ] == $passwordLength
        ) ? - $passwordLength : 0;
    }

    public function hasAnyNumberInTheMiddle( array $password )
    {
        $password = substr( $password[ 'raw' ], 1, strlen( $password[ 'raw' ] ) - 2 );
        preg_match_all( '/[0-9]{1}/', $password, $matches );

        return ( isset( $matches[ 0 ] ) ) ? count( $matches[ 0 ] ) * 2 : 0;
    }
}