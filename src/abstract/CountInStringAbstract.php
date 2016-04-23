<?php
namespace jycr753\PasswordStrengthChecker;

abstract class CountInStringAbstract {
    public abstract function countLength(array $password);
    public abstract function countLowerCase(array $password);
    public abstract function countNumbers(array $password);
    public abstract function countSymbols(array $password);
    public abstract function countUpperCase(array $password);
}