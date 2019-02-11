<?php

namespace Framework\Storage;

class Settings
{
    private $settings = [];

    public function __construct($file)
    {
        $this->settings = $this->parseFile($file);
    }

    public function setting($key, $default = null) {
        return $this->settings[strtolower($key)] ?? $default;
    }

    private function parseFile($file) {

        $settingsStr = '';

        if (file_exists($file)) {
            $settingsStr = file_get_contents($file);
        };

        $settingsStrArr = explode(PHP_EOL, $settingsStr);

        $settings = [];

        foreach ($settingsStrArr as $str) {
            $setting = explode('=', $str);
            $settings[strtolower(trim($setting[0]))] = trim($setting[1]);
        }

        return $settings;
    }
}