<?php

namespace jycr753\PasswordStrengthChecker;

use jycr753\PasswordStrengthChecker\Models\Password;
use jycr753\PasswordStrengthChecker\PasswordCheckImplementation as PCI;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Score for given password.
     * @var int
     */
    private $score;

    /**
     * Functions to evaluate.
     * @var array
     */
    private $order;

    /**
     * Message response.
     * @var string
     */
    private $messages;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $path = realpath(__DIR__ . '/../config/password_strength.php');

        $this->publishes([$path => config_path('password_strength.php')], 'config');
        $this->mergeConfigFrom($path, 'password_strength');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }

    public static function check($password)
    {
        $pci = new self(app());
        $pci->setSettings();
        $score = $pci->generatePasswordStrength($password);
        if ($score) {
            return new Password([
                'score' => $score,
                'strength' => $pci->getPasswordStrength($score),
                'text' => $pci->getScoreText($score),
            ]);
        }
    }

    private function setSettings()
    {
        $config = $this->config();
        $this->order = $config['order'];
        $this->messages = $config['response_text'];
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

    /**
     * @param integer $score
     */
    private function getPasswordStrength($score)
    {
        if ($score <= 60) {
            return Password::STRENGTH_VERY_WEAK;
        } elseif ($score > 60 && $score <= 70) {
            return Password::STRENGTH_WEAK;
        } elseif ($score > 70 && $score <= 80) {
            return Password::STRENGTH_FAIR;
        } elseif ($score > 80 && $score <= 90) {
            return Password::STRENGTH_STRONG;
        } else {
            return Password::STRENGTH_VERY_STRONG;
        }
    }

    /**
     * @param integer $score
     */
    public function getScoreText($score)
    {
        $messages = config('password_strength.response_text');
        if ($score <= 60) {
            return $messages[Password::STRENGTH_VERY_WEAK];
        } elseif ($score > 60 && $score <= 70) {
            return $messages[Password::STRENGTH_WEAK];
        } elseif ($score > 70 && $score <= 80) {
            return $messages[Password::STRENGTH_FAIR];
        } elseif ($score > 80 && $score <= 90) {
            return $messages[Password::STRENGTH_STRONG];
        } else {
            return $messages[Password::STRENGTH_VERY_STRONG];
        }
    }

    private function getPasswordScore()
    {
        return $this->score;
    }

    /**
     * @param integer $score
     */
    private function setPasswordScore($score)
    {
        $this->score = $score;
    }

    public function config()
    {
        return config('password_strength');
    }
}
