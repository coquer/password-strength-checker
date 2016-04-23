<?php
namespace jycr753\PasswordStrengthChecker;

abstract class GeneralInStringAbstract {
    public abstract function hasCharactersOnly();
    public abstract function hasExtra();
    public abstract function hasNumbersOnly();
    public abstract function hasAnyNumberInTheMiddle();

}