<?php
namespace jycr753\PasswordStrengthChecker;

abstract class CountInStringAbstract {
    public abstract function countLength();
    public abstract function countLowerCase();
    public abstract function countNumbers();
    public abstract function countSymbols();
    public abstract function countUpperCase();
}