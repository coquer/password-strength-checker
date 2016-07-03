<?php

namespace jycr753\PasswordStrengthChecker;

abstract class PasswordStrengthAbstract
{
    abstract public function setPasswordScore($score);

    abstract public function generatePasswordStrength($password);

    abstract public function getPasswordData($password);

    abstract public function getPasswordStrength();

    abstract public function getPasswordScore();
}
