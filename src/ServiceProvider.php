<?php

namespace jycr753\PasswordStrengthChecker;

use jycr753\Models\Password;
use jycr753\PasswordStrengthChecker\PasswordCheckImplementation as PCI;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    private $score;
    private $as_text = false;
    private $order;
    private $messages;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadConfiguration();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }

    protected function loadConfiguration()
    {
        $config_path = __DIR__ . '/../config/password_strength.php';

        $this->publishes([
            $config_path => config_path('password_strength.php'),
        ], 'config');

        $this->mergeConfigFrom($config_path, 'password_strength');
    }

    public static function check($password)
    {
        self::setSettings();
        $score = self::generatePasswordStrength($password);
        if ($score) {
            return new Password([
                'score' => self::getPasswordStrength(),
                'strength' => self::getPasswordScore(),
                'text' => self::getPasswordStrength(),
            ]);
        }
    }

    private function setSettings()
    {
        $config = $this->config();
        $this->as_text = $config['print_text'];
        $this->order = $config['password_strength.order'];
        $this->messages = $config['password_strength.response_text'];
    }

    private function generatePasswordStrength($password)
    {
        $pci = new PCI();
        $passwordData = $this->getPasswordData($password);
        $score = $this->getPasswordScore();
        foreach ($this->order as $test_name) {
            $result = $pci->$test_name($passwordData);
            $score += $result;
        }
        $this->setPasswordScore($score);

        return $score;
    }

    private function getPasswordData($password)
    {
        $password_data = [
            'number' => [
                'count' => 0,
            ],
            'upper'  => [
                'count' => 0,
            ],
            'lower'  => [
                'count' => 0,
            ],
            'symbol' => [
                'count' => 0,
                'list'  => [],
            ],
            'list'   => [],
            'length' => 0,
            'raw'    => trim($password),
        ];
        $password_data['length'] = strlen($password);
        for ($i = 0; $i < strlen($password); $i++) {
            $character = $password[$i];
            $code = ord($character);
            if ($code >= 48 && $code <= 57) {
                $password_data['number']['count']++;
            } elseif ($code >= 65 && $code <= 90) {
                $password_data['upper']['count']++;
            } elseif ($code >= 97 && $code <= 122) {
                $password_data['lower']['count']++;
            } else {
                $password_data['symbol']['count']++;
                $passwordData['symbol']['list'][] = $character;
            }
            (isset($passwordData['list'][$character]))
                ? $passwordData['list'][$character]++ : $passwordData['list'][$character] = 1;
        }

        return $password_data;
    }

    private function getPasswordStrength()
    {
        $score = $this->getPasswordScore();
        if ($score <= 60) {
            return ($this->as_text) ? $this->messages[Password::STRENGTH_VERY_WEAK] : Password::STRENGTH_VERY_WEAK;
        } elseif ($score > 60 && $score <= 70) {
            return ($this->as_text) ? $this->messages[Password::STRENGTH_WEAK] : Password::STRENGTH_WEAK;
        } elseif ($score > 70 && $score <= 80) {
            return ($this->as_text) ? $this->messages[Password::STRENGTH_FAIR] : Password::STRENGTH_FAIR;
        } elseif ($score > 80 && $score <= 90) {
            return ($this->as_text) ? $this->messages[Password::STRENGTH_STRONG] : Password::STRENGTH_STRONG;
        } else {
            return ($this->as_text) ? $this->messages[Password::STRENGTH_VERY_STRONG] : Password::STRENGTH_VERY_STRONG;
        }
    }

    private function getPasswordScore()
    {
        return $this->score;
    }

    private function setPasswordScore($score)
    {
        $this->score = $score;
    }

    public function config()
    {
        return $this->laravel->config['password_strength'];
    }
}
