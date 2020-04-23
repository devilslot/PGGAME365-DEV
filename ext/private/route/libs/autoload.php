<?php
    define( 'base_dir' , __DIR__.'/../../../');
    // main extension
    require_once base_dir . 'private/vendor/autoload.php';
    require_once base_dir . 'public/vendor/autoload.php';

    spl_autoload_register(function ($class) {

        // what prefixes should be recognized?
        $prefixes = array(
            // Core
            "app\core\\" => array(
                base_dir . 'core/config',
                base_dir . 'core/classes',
            ),
            // Share
            "app\share\Classes\\"       => array( base_dir . 'app/share/classes', ),
            "app\share\Enum\\"          => array( base_dir . 'app/share/enum', ),
            "app\share\Data\\"          => array( base_dir . 'app/share/data', ),
            "app\share\Model\\"         => array( base_dir . 'app/share/model', ),
            "app\share\Controller\\"    => array( base_dir . 'app/share/controller', ),
            // Casino
            "app\casino\Classes\\"      => array( base_dir . 'app/casino/classes', ),
            "app\casino\Enum\\"         => array( base_dir . 'app/casino/enum', ),
            "app\casino\Data\\"         => array( base_dir . 'app/casino/data', ),
            "app\casino\Model\\"        => array( base_dir . 'app/casino/model', ),
            "app\casino\Controller\\"   => array( base_dir . 'app/casino/controller', ),
            // Live
            "app\casino_live\Classes\\"        => array( base_dir . 'app/casino_live/classes', ),
            "app\casino_live\Enum\\"           => array( base_dir . 'app/casino_live/enum', ),
            "app\casino_live\Data\\"           => array( base_dir . 'app/casino_live/data', ),
            "app\casino_live\Model\\"          => array( base_dir . 'app/casino_live/model', ),
            "app\casino_live\Controller\\"     => array( base_dir . 'app/casino_live/controller', ),
            // Rng
            "app\casino_pg\Classes\\"        => array( base_dir . 'app/casino_pg/classes', ),
            "app\casino_pg\Enum\\"           => array( base_dir . 'app/casino_pg/enum', ),
            "app\casino_pg\Data\\"           => array( base_dir . 'app/casino_pg/data', ),
            "app\casino_pg\Model\\"          => array( base_dir . 'app/casino_pg/model', ),
            "app\casino_pg\Controller\\"     => array( base_dir . 'app/casino_pg/controller', ),
            // Awc
            "app\casino_awc\Classes\\"        => array( base_dir . 'app/casino_awc/classes', ),
            "app\casino_awc\Enum\\"           => array( base_dir . 'app/casino_awc/enum', ),
            "app\casino_awc\Data\\"           => array( base_dir . 'app/casino_awc/data', ),
            "app\casino_awc\Model\\"          => array( base_dir . 'app/casino_awc/model', ),
            "app\casino_awc\Controller\\"     => array( base_dir . 'app/casino_awc/controller', ),
            // Sa
            "app\casino_sa\Classes\\"        => array( base_dir . 'app/casino_sa/classes', ),
            "app\casino_sa\Enum\\"           => array( base_dir . 'app/casino_sa/enum', ),
            "app\casino_sa\Data\\"           => array( base_dir . 'app/casino_sa/data', ),
            "app\casino_sa\Model\\"          => array( base_dir . 'app/casino_sa/model', ),
            "app\casino_sa\Controller\\"     => array( base_dir . 'app/casino_sa/controller', ),
        );

        // go through the prefixes
        foreach ($prefixes as $prefix => $dirs) {

            // does the requested class match the namespace prefix?
            $prefix_len = strlen($prefix);
            if (substr($class, 0, $prefix_len) !== $prefix) {
                continue;
            }

            // strip the prefix off the class
            $class = substr($class, $prefix_len);

            // a partial filename
            $part = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

            // go through the directories to find classes
            foreach ($dirs as $dir) {
                $dir = str_replace('/', DIRECTORY_SEPARATOR, $dir);
                $file = $dir . DIRECTORY_SEPARATOR . $part;
                if (is_readable($file)) {
                    require $file;
                    return;
                }
            }
        }

    });
