<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Application Debug Mode
	|--------------------------------------------------------------------------
	|
	| When your application is in debug mode, detailed error messages with
	| stack traces will be shown on every error that occurs within your
	| application. If disabled, a simple generic error page is shown.
	|
	*/

	'debug' => true,

	/*
	|--------------------------------------------------------------------------
	| Application URL
	|--------------------------------------------------------------------------
	|
	| This URL is used by the console to properly generate URLs when using
	| the Artisan command line tool. You should set this to the root of
	| your application so that it is used when running Artisan tasks.
	|
	*/

	'url' => 'http://localhost',

	/*
	|--------------------------------------------------------------------------
	| Application Timezone
	|--------------------------------------------------------------------------
	|
	| Here you may specify the default timezone for your application, which
	| will be used by the PHP date and date-time functions. We have gone
	| ahead and set this to a sensible default for you out of the box.
	|
	*/

	'timezone' => 'UTC',

	/*
	|--------------------------------------------------------------------------
	| Application Locale Configuration
	|--------------------------------------------------------------------------
	|
	| The application locale determines the default locale that will be used
	| by the translation service provider. You are free to set this value
	| to any of the locales which will be supported by the application.
	|
	*/

	'locale' => 'en',

	/*
	|--------------------------------------------------------------------------
	| Application Fallback Locale
	|--------------------------------------------------------------------------
	|
	| The fallback locale determines the locale to use when the current one
	| is not available. You may change the value to correspond to any of
	| the language folders that are provided through your application.
	|
	*/

	'fallback_locale' => 'en',

	/*
	|--------------------------------------------------------------------------
	| Encryption Key
	|--------------------------------------------------------------------------
	|
	| This key is used by the Illuminate encrypter service and should be set
	| to a random, 32 character string, otherwise these encrypted strings
	| will not be safe. Please do this before deploying an application!
	|
	*/

	'key' => 'eezzlNVQuH3VeWsUc1XcvhFW61d7kDeo',

	'cipher' => MCRYPT_RIJNDAEL_128,

	/*
	|--------------------------------------------------------------------------
	| Autoloaded Service Providers
	|--------------------------------------------------------------------------
	|
	| The service providers listed here will be automatically loaded on the
	| request to your application. Feel free to add your own services to
	| this array to grant expanded functionality to your applications.
	|
	*/

	'providers' => array(

		'Illuminate\Foundation\Providers\ArtisanServiceProvider',
		'Illuminate\Auth\AuthServiceProvider',
		'Illuminate\Cache\CacheServiceProvider',
		'Illuminate\Session\CommandsServiceProvider',
		'Illuminate\Foundation\Providers\ConsoleSupportServiceProvider',
		'Illuminate\Routing\ControllerServiceProvider',
		'Illuminate\Cookie\CookieServiceProvider',
		'Illuminate\Database\DatabaseServiceProvider',
		'Illuminate\Encryption\EncryptionServiceProvider',
		'Illuminate\Filesystem\FilesystemServiceProvider',
		'Illuminate\Hashing\HashServiceProvider',
		'Illuminate\Html\HtmlServiceProvider',
		'Illuminate\Log\LogServiceProvider',
		'Illuminate\Mail\MailServiceProvider',
		'Illuminate\Database\MigrationServiceProvider',
		'Illuminate\Pagination\PaginationServiceProvider',
		'Illuminate\Queue\QueueServiceProvider',
		'Illuminate\Redis\RedisServiceProvider',
		'Illuminate\Remote\RemoteServiceProvider',
		'Illuminate\Auth\Reminders\ReminderServiceProvider',
		'Illuminate\Database\SeedServiceProvider',
		'Illuminate\Session\SessionServiceProvider',
		'Illuminate\Translation\TranslationServiceProvider',
		'Illuminate\Validation\ValidationServiceProvider',
		'Illuminate\View\ViewServiceProvider',
		'Illuminate\Workbench\WorkbenchServiceProvider',
		'Way\Generators\GeneratorsServiceProvider',
		'Maatwebsite\Excel\ExcelServiceProvider'

	),

	/*
	|--------------------------------------------------------------------------
	| Service Provider Manifest
	|--------------------------------------------------------------------------
	|
	| The service provider manifest is used by Laravel to lazy load service
	| providers which are not needed for each request, as well to keep a
	| list of all of the services. Here, you may set its storage spot.
	|
	*/

	'manifest' => storage_path().'/meta',

	/*
	|--------------------------------------------------------------------------
	| Class Aliases
	|--------------------------------------------------------------------------
	|
	| This array of class aliases will be registered when this application
	| is started. However, feel free to register as many as you wish as
	| the aliases are "lazy" loaded so they don't hinder performance.
	|
	*/

	'aliases' => array(

		'App'             => 'Illuminate\Support\Facades\App',
		'Artisan'         => 'Illuminate\Support\Facades\Artisan',
		'Auth'            => 'Illuminate\Support\Facades\Auth',
		'Blade'           => 'Illuminate\Support\Facades\Blade',
		'Cache'           => 'Illuminate\Support\Facades\Cache',
		'ClassLoader'     => 'Illuminate\Support\ClassLoader',
		'Config'          => 'Illuminate\Support\Facades\Config',
		'Controller'      => 'Illuminate\Routing\Controller',
		'Cookie'          => 'Illuminate\Support\Facades\Cookie',
		'Crypt'           => 'Illuminate\Support\Facades\Crypt',
		'DB'              => 'Illuminate\Support\Facades\DB',
		'Eloquent'        => 'Illuminate\Database\Eloquent\Model',
		'Event'           => 'Illuminate\Support\Facades\Event',
		'File'            => 'Illuminate\Support\Facades\File',
		'Form'            => 'Illuminate\Support\Facades\Form',
		'Hash'            => 'Illuminate\Support\Facades\Hash',
		'HTML'            => 'Illuminate\Support\Facades\HTML',
		'Input'           => 'Illuminate\Support\Facades\Input',
		'Lang'            => 'Illuminate\Support\Facades\Lang',
		'Log'             => 'Illuminate\Support\Facades\Log',
		'Mail'            => 'Illuminate\Support\Facades\Mail',
		'Paginator'       => 'Illuminate\Support\Facades\Paginator',
		'Password'        => 'Illuminate\Support\Facades\Password',
		'Queue'           => 'Illuminate\Support\Facades\Queue',
		'Redirect'        => 'Illuminate\Support\Facades\Redirect',
		'Redis'           => 'Illuminate\Support\Facades\Redis',
		'Request'         => 'Illuminate\Support\Facades\Request',
		'Response'        => 'Illuminate\Support\Facades\Response',
		'Route'           => 'Illuminate\Support\Facades\Route',
		'Schema'          => 'Illuminate\Support\Facades\Schema',
		'Seeder'          => 'Illuminate\Database\Seeder',
		'Session'         => 'Illuminate\Support\Facades\Session',
		'SoftDeletingTrait' => 'Illuminate\Database\Eloquent\SoftDeletingTrait',
		'SSH'             => 'Illuminate\Support\Facades\SSH',
		'Str'             => 'Illuminate\Support\Str',
		'URL'             => 'Illuminate\Support\Facades\URL',
		'Validator'       => 'Illuminate\Support\Facades\Validator',
		'View'            => 'Illuminate\Support\Facades\View',
		'Excel' => 'Maatwebsite\Excel\Facades\Excel'

	),


    'exosite_domain_name' => 'skylab',
    'exosite_username' => 'bharath.ln@provenlogic.net',
    'exosite_password' => 'Pl@12345678',
    'exosite_portal_id' => '1358978225',
    'exosite_data_sources' => array(
        array('format'=>'integer', 'name'=>'Speed', 'unit'=>'kmph', 'alias'=>'speed'),
        array('format'=>'string', 'name'=>'Critical', 'unit'=>'critical', 'alias'=>'critical'),
        array('format'=>'integer', 'name'=>'RPM', 'unit'=>'rpm', 'alias'=>'rpm'),
        array('format'=>'string', 'name'=>'Location', 'unit'=>'', 'alias'=>'location'),
        array('format'=>'float', 'name'=>'Distance', 'unit'=>'km', 'alias'=>'dis'),
        array('format'=>'float', 'name'=>'Coolant', 'unit'=>'c', 'alias'=>'coolant'),
        array('format'=>'float', 'name'=>'Air intake', 'unit'=>'c', 'alias'=>'airintake'),
        array('format'=>'string', 'name'=>'Engine Running Time', 'unit'=>'', 'alias'=>'engrunningtime')
    ),
    'exosite_dashboard_data' => '{"config":{"layout":{"cols":4,"gravity":"LeftTop"},"widgets":{"3":{"title":"Speed Widget Meter","type":"0000000012","defaultactivedatasource":"*SPEED*","refreshrate":"1","caller":"","max":"200","min":"0","normal_max":"150","normal_min":"40","low":"#41C4DC","mid":"#FFFFFF","high":"#A91E27","order":"0","left":0,"top":0},"5":{"title":"RPM Widget","type":"0000000012","defaultactivedatasource":"*RPM*","refreshrate":"1","caller":"","max":"9000","min":"0","normal_max":"8000","normal_min":"4000","low":"#41C4DC","mid":"#FFFFFF","high":"#A91E27","order":"0","left":2,"top":0},"6":{"title":"Location Info","type":"0000000002","rid":"*LOCATION*","datacount":"12","maptype":"ROADMAP","mapzoom":"","refreshrate":"5","version":"2010-11-04","jsfile":"<script type=\"text/javascript\" src=\"https://maps.google.com/maps/api/js?v=3&amp;sensor=false\"></script>","order":"0","width":1,"height":1,"left":2,"top":2},"7":{"title":"Distance Meter","type":"0000000006","datacount":"24","min":0,"max":110,"limit":false,"defaultactivedatasource":"*DIS*","caller":"","refreshrate":"15","refresh_current":"1","display_current":"1","version":"2010-11-04","order":"0","left":0,"top":4},"8":{"title":"Critical Alerts","ihr":"false","order":"0","rt":"ds","dsid":"*CRITICAL*","dssv":1,"dssu":"h","width":1,"height":1,"dsf":"ls","dsc1":"t","dsc2":"v","dsc3":"n","eid":"","ef":"ls","ec1":"t","ec2":"d","ec3":"ds","refreshrate":"3","sdv":"c","dv":1,"du":"d","c":30,"type":"0000000017","f":1443616200,"t":1444224600,"left":0,"top":6},"9":{"title":"Coolant and Air Intake","type":"0000000006","datacount":"24","min":0,"max":110,"limit":false,"defaultactivedatasource":"_*COOLANT*_*AIRINTAKE*","caller":"","refreshrate":"10","refresh_current":"1","display_current":"1","version":"2010-11-04","order":"0","left":0,"top":2},"10":{"title":"Device Data Summary","type":"0000000005","defaultdatasource":"_*SPEED*_*COOLANT*_*AIRINTAKE*_*CRITICAL*_*ENGRUNNINGTIME*_*RPM*_*LOCATION*_*DIS*","defaultdatasourceselect":"","selectable":"1","caller":"","refreshrate":"3","version":"2010-11-04","order":"0","left":2,"top":4}},"type":"clientmodel"},"description":"*NAME* *RID* *CIK*","location":"","name":"*NAME*","portalId":"*PORTAL*","public":true}',

);
