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
