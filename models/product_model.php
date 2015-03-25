<?php
// Generic Enum
// http://stackoverflow.com/questions/254514/php-and-enumerations
abstract class BasicEnum
{
    private static $constCacheArray = NULL;

    private static function getConstants()
    {
        if (self::$constCacheArray == NULL) {
            self::$constCacheArray = [];
        }
        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }
        return self::$constCacheArray[$calledClass];
    }

    public static function isValidName($name, $strict = false)
    {
        $constants = self::getConstants();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));
        return in_array(strtolower($name), $keys);
    }

    public static function isValidValue($value)
    {
        $values = array_values(self::getConstants());
        return in_array($value, $values, $strict = true);
    }
}

// OS Enum
abstract class OS extends BasicEnum
{
    const Windows = 0;
    const OSX = 1;
    const Unix = 2;
}

// Language Enum
abstract class Language extends BasicEnum
{
    const English = 0;
    const Mandarin = 1;
    const Spanish = 2;
    const Hindi = 3;
    const Arabic = 4;
    const Portuguese = 5;
    const Bengali = 6;
    const Russian = 7;
    const Japanese = 8;
    const German = 9;
    const Punjabi = 10;
}

abstract class Product
{
    private $appID; // int
    private $name; // string
    private $desc; // string
    private $website; // string
    private $os; // array(OS)
    private $langs; // array(Language)
    private $iconPath; // string

    function __construct($appID, $name, $desc, $website, $os, $langs, $iconPath)
    {
        $this->setAppID($appID);
        $this->setName($name);
        $this->setDescription($desc);
        $this->setWebsite($website);
        $this->setOS($os);
        $this->setLanguages($langs);
        $this->setIconPath($iconPath);

        // If it's not a valid setup, alert.
        if (!$this->isValid()) {
            // TODO: Whatever we want to do when someone doesn't enter proper params.
        }
    }

    function  __destruct()
    {

    }

    // Is the current object in a valid state?
    // For now, is every element assigned a value?
    public function isValid()
    {
        if (!isset($this->appID)) {
            return false;
        } else if (!isset($this->name)) {
            return false;
        } else if (!isset($this->desc)) {
            return false;
        } else if (!isset($this->website)) {
            return false;
        } else if (!isset($this->os)) {
            return false;
        } else if (!isset($this->langs)) {
            return false;
        } else if (!isset($this->iconPath)) {
            return false;
        }

        return true;
    }

    // Getters
    public function getAppID()
    {
        return $this->appID;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->desc;
    }

    public function getWebsite()
    {
        return $this->website;
    }

    public function getOS()
    {
        return $this->os;
    }

    public function getLanguages()
    {
        return $this->langs;
    }

    public function getIconPath()
    {
        return $this->iconPath;
    }

    // Setters
    public function setAppID($appID)
    {
        if (is_int($appID)) {
            $this->appID = $appID;
            return true;
        }
        return false;
    }

    public function setName($name)
    {
        if (is_string($name)) {
            $this->name = $name;
            return true;
        }
        return false;
    }

    public function setDescription($desc)
    {
        if (is_string($desc)) {
            $this->desc = $desc;
            return true;
        }
        return false;
    }

    public function setWebsite($website)
    {
        if (is_string($website)) {
            $this->website = $website;
            return true;
        }
        return false;
    }

    public function setOS($os)
    {
        if (is_array($os)) {
            foreach ($os as $o) {
                if (!OS::isValidName($o, true)) {
                    return false;
                }
            }
            $this->os = $os;
            return true;
        }
        return false;
    }

    public function setLanguages($langs)
    {
        if (is_array($langs)) {
            foreach ($langs as $l) {
                if (!Language::isValidName($l, true)) {
                    return false;
                }
            }
            $this->langs = $langs;
            return true;
        }
        return false;
    }

    public function setIconPath($icon)
    {
        if (is_string($icon)) {
            $this->iconPath = $icon;
            return true;
        }
        return false;
    }
}
?>