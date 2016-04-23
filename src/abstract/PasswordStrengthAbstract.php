<?php
namespace jycr753\PasswordStrengthChecker;

abstract class PasswordStrengthControllerAbstract {
    public abstract function generatePasswordStrength();
    public abstract function getPasswordData();
    public abstract function getPasswordScore();
    public abstract function setPasswordScore();
    public abstract function getPasswordStrength();
}