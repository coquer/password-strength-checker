<?php
namespace jycr753\PasswordStrengthChecker;

abstract class GeneralInStringAbstract {
    public abstract function hasCharactersOnly(array $password);
    public abstract function hasExtra(array $password);
    public abstract function hasNumbersOnly(array $password);
    public abstract function hasAnyNumberInTheMiddle(array $password);

}