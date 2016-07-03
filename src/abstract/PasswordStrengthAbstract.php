<?php
namespace jycr753\PasswordStrengthChecker;

abstract class PasswordStrengthControllerAbstract {
    public abstract function setPasswordScore($score);
    public abstract function generatePasswordStrength($password);
    public abstract function getPasswordData($password);
    public abstract function getPasswordStrength();
    public abstract function getPasswordScore();
}