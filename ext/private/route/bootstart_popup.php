<?php
    session_start();

    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    set_time_limit(18000);    
    // error_reporting(E_ALL);
    
    header('Access-Control-Allow-Origin: *');

    require_once __DIR__."\libs\autoload.php";
    require_once __DIR__.'\..\..\..\model\database\database.php';

    use app\core\DbConfig;
    
    $database = new database;
    DbConfig::SetServer($database);
	$smarty = new Smarty;

    $smarty->caching = 0;
    $smarty->compile_check = false;
    $smarty->debugging = false;
    
    $smarty->setTemplateDir('view/');
    $smarty->setConfigDir('view/');
    $smarty->setCompileDir('log/template/');
    //$smarty->setCacheDir('log/cache/');

    $smarty->clearCompiledTemplate();

	$smarty->assign('autocss', array(
        'bootstrap' 					=> '/ext/public/assets/css/bootstrap.css',
        'bootstrap-theme'               => '/ext/public/assets/css/bootstrap-theme.css',
        'fontawesome' 					=> '/ext/public/assets/css/font-awesome.css',
        //'main_open17bet'                => '../css/main_open17bet.css?v=1508238388',
        'global'                      => '../css/global.css?v=1543843915',
        'global'                      => '../css/appbase_dnastar9.css?v=1543873257',
        //'datatables'                    => '../css/datatables.min.css?v=1500088226',
        //'rvfs'                          => '../css/rvfs.css?v=1500088226',
        //'jquery-ui'                   => '../css/jquery-ui.css?v=1500088226',
        'bootstrap-datepicker' 			=> '/ext/public/assets/css/bootstrap-datepicker.css',
        // Project Extends
    ));

    $smarty->assign('autojs', array(
        'jquery' 						=> '/ext/public/assets/js/jquery.js',
        'bootstrap' 					=> '/ext/public/assets/js/bootstrap.js',
        'knockout' 						=> '/ext/public/assets/js/knockout-3.4.1.min.js',
        'validation' 					=> '/ext/public/assets/js/knockout.validation.min.js',
        // 'typeahead' 					=> '/ext/public/assets/js/bootstrap-typeahead.min.js',
         'moment' 						=> '/ext/public/assets/js/moment.js',
         'local-th' 					=> '/ext/public/assets/js/local/th.js',
         'local-en'                     => '/ext/public/assets/js/local/en.js',
         'bootstrap-datetime'           => '/ext/public/assets/js/bootstrap-datetime.js',
        // 'lesscss'                    => '/ext/public/assets/js/less.min.js',

        // input mask
        'inputmask'						=> '/ext/public/assets/js/inputmask.js',
        'inputmask-extensions'			=> '/ext/public/assets/js/inputmask.extensions.js',
        'inputmask-dependencyLib'       => '/ext/public/assets/js/inputmask.dependencyLib.js',
        'inputmask-date'                => '/ext/public/assets/js/inputmask.date.extensions.js',
        'inputmask-phone'				=> '/ext/public/assets/js/inputmask.phone.extensions.js',
        'inputmask-numeric'				=> '/ext/public/assets/js/inputmask.numeric.extensions.js',
        'inputmask-regex'               => '/ext/public/assets/js/inputmask.regex.extensions.js',
        'inputmask-jquery'				=> '/ext/public/assets/js/jquery.inputmask.js',
        // owner function
        'number_format'				    => '/ext/public/assets/js/number_format.js',
        'enum'				            => '/ext/public/assets/js/enum.js',

    ));
    
    switch ($_SESSION["lang"]) {
        case 'eng':
            if($_SESSION['langfix']=='mm'){
                $lang = 'mm';
            }else{
                $lang = 'en';
            }
            break;
        case 'mm':
            $lang = 'mm';
            break;
        default:
            $lang = 'th';
            break;
    }
    $smarty->assign('lang', $lang );
