<?php

class ExositeController extends \BaseController {


    public function start()
    {
        $result = false;
        $fc = 'flash_cust_error';
        $fm='Error in creating new CIK';

        try {
            Log::info('*********start()*********');
            $create_device_original_result = $this->create_device();
            $create_device_result = json_decode( $create_device_original_result );
            if(json_last_error() != JSON_ERROR_NONE){
                return Redirect::back()->with($fc, 'Error in Create Device:: ' . $create_device_original_result );
            }
            $device_rid = $create_device_result->rid;
            $device_cik = $create_device_result->info->key;

            $data_sources = Config::get('app.exosite_data_sources');
            $aliases_data = array();
            $datasource_rids = array('speed' => '', 'dis' => '', 'location' => '', 'rpm' => '', 'coolant' => '', 'airintake' => '', 'engrunningtime' => '', 'critical' => '');
            foreach ($data_sources as $data_source) {
                $format = $data_source['format'];
                $name = $data_source['name'];
                $unit = $data_source['unit'];
                $alias = $data_source['alias'];
                Log::info('*********create_device_data_source('.$device_rid.$format. $name. $unit.')*********');
                $datasource_rid = $this->create_device_data_source($device_rid, $format, $name, $unit);
                if(json_last_error() != JSON_ERROR_NONE){
                    return Redirect::back()->with($fc, 'Error in Create Device Data Source:: ' . $datasource_rid );
                }
                $datasource_rids[$alias] = $datasource_rid;
                $aliases_data[] = array('alias', $datasource_rid, $alias);
            }

            Log::info('*********set_data_source_aliases()*********');
            $set_data_source_aliases_result = $this->set_data_source_aliases($device_cik, $aliases_data);
            json_decode($set_data_source_aliases_result);
            if(json_last_error() != JSON_ERROR_NONE){
                return Redirect::back()->with($fc, 'Error in Set Data Source Aliases:: ' . $set_data_source_aliases_result );
            }


            $uniqueId = uniqid('NewDevice'.date('Y-m-d_H:i:s_'));
            $exosite_dashboard_data = Config::get('app.exosite_dashboard_data');
            $exosite_dashboard_data = str_replace('*NAME*', $uniqueId, $exosite_dashboard_data);
            $exosite_dashboard_data = str_replace('*RID*', $device_rid, $exosite_dashboard_data);
            $exosite_dashboard_data = str_replace('*CIK*', $device_cik, $exosite_dashboard_data);
            $exosite_dashboard_data = str_replace('*PORTAL*', Config::get('app.exosite_portal_id'), $exosite_dashboard_data);
            $exosite_dashboard_data = str_replace('*SPEED*', $datasource_rids['speed'], $exosite_dashboard_data);
            $exosite_dashboard_data = str_replace('*RPM*', $datasource_rids['rpm'], $exosite_dashboard_data);
            $exosite_dashboard_data = str_replace('*LOCATION*', $datasource_rids['location'], $exosite_dashboard_data);
            $exosite_dashboard_data = str_replace('*DIS*', $datasource_rids['dis'], $exosite_dashboard_data);
            $exosite_dashboard_data = str_replace('*CRITICAL*', $datasource_rids['critical'], $exosite_dashboard_data);
            $exosite_dashboard_data = str_replace('*COOLANT*', $datasource_rids['coolant'], $exosite_dashboard_data);
            $exosite_dashboard_data = str_replace('*AIRINTAKE*', $datasource_rids['airintake'], $exosite_dashboard_data);
            $exosite_dashboard_data = str_replace('*ENGRUNNINGTIME*', $datasource_rids['engrunningtime'], $exosite_dashboard_data);
            Log::info('*********create_portal_dashboard('.$exosite_dashboard_data.')*********');
            $dashboard_id = $this->create_portal_dashboard($exosite_dashboard_data);
            if(json_last_error() != JSON_ERROR_NONE){
                return Redirect::back()->with($fc, 'Error in Set Data Source Aliases:: ' . $dashboard_id );
            }

            $new_cik = new Cik();
            $new_cik->name = $device_cik;
            $new_cik->dashboard_id = $dashboard_id;
            $new_cik->device_rid = $device_rid;
            $new_cik->speed_rid = $datasource_rids['speed'];
            $new_cik->dis_rid = $datasource_rids['dis'];
            $new_cik->location_rid = $datasource_rids['location'];
            $new_cik->rpm_rid = $datasource_rids['rpm'];
            $new_cik->coolant_rid = $datasource_rids['coolant'];
            $new_cik->airintake_rid = $datasource_rids['airintake'];
            $new_cik->engrunningtime_rid = $datasource_rids['engrunningtime'];
            $new_cik->critical_rid = $datasource_rids['critical'];
            $new_cik->save();
            $result = true;
        }
        catch(Exception $exception){
            Log::error( $exception->getMessage() );
            return Redirect::back()->with($fc, $exception->getMessage());
        }

        if($result){ $fc = 'flash_cust_success'; $fm='New CIK created successfully'; }

        return Redirect::back()->with($fc, $fm);
    }


	public function create_device()
	{
        try{
            $url = "https://". Config::get('app.exosite_domain_name') .".exosite.com/api/portals/v1/portals/". Config::get('app.exosite_portal_id') ."/devices";
            $data = array('type' => 'generic');

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true); /*POST*/
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_USERPWD, Config::get('app.exosite_username').':'.Config::get('app.exosite_password') );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $curl_result = curl_exec($ch);
            curl_close($ch);
            Log::info( $curl_result );
        }
        catch(Exception $exception){
            Log::error( $exception->getMessage() );
        }
        return $curl_result;
	}


    public function create_device_data_source($device_rid, $format, $name, $unit)
    {
        try {
            $url = "https://" . Config::get('app.exosite_domain_name') . ".exosite.com/api/portals/v1/devices/" . $device_rid . "/data-sources";

            $data = new stdClass();
            $data->info = new stdClass();
            $data->info->description = new stdClass();
            $data->info->description->format = $format;
            $data->info->description->name = $name;
            $data->unit = $unit;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true); /*POST*/
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_USERPWD, Config::get('app.exosite_username') . ':' . Config::get('app.exosite_password'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $curl_result = curl_exec($ch);
            curl_close($ch);
            Log::info($curl_result);
            $result = json_decode($curl_result);
            if(json_last_error() != JSON_ERROR_NONE){
                return $curl_result;
            }
        }
        catch(Exception $exception){
            Log::error( $exception->getMessage() );
        }

        return $result->rid;
    }


    public function set_data_source_aliases( $cik, $aliases_data )
    {
        try {
            $url = "http://m2.exosite.com/onep:v1/rpc/process";
            $calls = "";
            foreach ($aliases_data as $aliasKey => $singleAliasData) {
                $calls[$aliasKey] = new stdClass();
                $calls[$aliasKey]->procedure = 'map';
                $calls[$aliasKey]->arguments = $singleAliasData;
                $calls[$aliasKey]->id = $aliasKey;
            }

            $data = new stdClass();
            $data->auth = new stdClass();
            $data->auth->cik = $cik;
            $data->calls = $calls;
            $headers = array(
                'Content-Type: application/json; charset=utf-8'
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POST, true); /*POST*/
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $curl_result = curl_exec($ch);
            curl_close($ch);
            Log::info($curl_result);

        }
        catch(Exception $exception){
            Log::error( $exception->getMessage() );
        }

        return $curl_result;
    }


    public function create_portal_dashboard($data)
    {
        try {
            $url = "https://" . Config::get('app.exosite_domain_name') . ".exosite.com/api/portals/v1/portals/" . Config::get('app.exosite_portal_id') . "/dashboards";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true); /*POST*/
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_USERPWD, Config::get('app.exosite_username') . ':' . Config::get('app.exosite_password'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $curl_result = curl_exec($ch);
            curl_close($ch);
            Log::info($curl_result);
            $result = json_decode($curl_result);
            if(json_last_error() != JSON_ERROR_NONE){
                return $curl_result;
            }

        }
        catch(Exception $exception){
            Log::error( $exception->getMessage() );
        }

        return $result->id;
    }


    public function update_device_name($device_rid, $name)
    {
        try {
            $url = "https://" . Config::get('app.exosite_domain_name') . ".exosite.com/api/portals/v1/devices/" . $device_rid;
            $data = new stdClass();
            $data->info = new stdClass();
            $data->info->description = new stdClass();
            $data->info->description->name = $name;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); /*PUT*/
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_USERPWD, Config::get('app.exosite_username') . ':' . Config::get('app.exosite_password'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $curl_result = curl_exec($ch);
            curl_close($ch);
            Log::info($curl_result);
            $result = json_decode($curl_result);
        }
        catch(Exception $exception){
            Log::error( $exception->getMessage() );
        }

        return $result->rid;
    }

    public function update_dashboard_name($dashboard_id, $name, $description)
    {
        try {
            $url = "https://" . Config::get('app.exosite_domain_name') . ".exosite.com/api/portals/v1/dashboards/" . $dashboard_id;
            $data = new stdClass();
            $data->name = $name;
            $data->description = $description;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); /*PUT*/
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_USERPWD, Config::get('app.exosite_username') . ':' . Config::get('app.exosite_password'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $curl_result = curl_exec($ch);
            curl_close($ch);
            Log::info($curl_result);
            $result = json_decode($curl_result);
        }
        catch(Exception $exception){
            Log::error( $exception->getMessage() );
        }

        return $result->portalId;
    }


    public function link_device_to_user($email, $cik){
        try {
            $user = User::where('email', $email)->first();
            $cik = Cik::where('name', $cik)->first();
            $full_name = $user->first_name . " " . $user->last_name;
            $description = $user->first_name . " " . $user->last_name . " " . $cik->device_rid . " " . $cik->name;

            // Update device name
            Log::info('*********update_device_name('.$cik->device_rid. ', ' . $full_name .')*********');
            $this->update_device_name($cik->device_rid, $full_name);

            // Update dashboard name
            Log::info('*********update_dashboard_name('.$cik->dashboard_id. ', ' . $full_name . ', ' . $description .')*********');
            $this->update_dashboard_name($cik->dashboard_id, $full_name, $description);
        }
        catch(Exception $exception){
            Log::error( $exception->getMessage() . $exception->getTraceAsString());
        }
        return "https://skylab.exosite.com/views/" . Config::get('app.exosite_portal_id') . "/" . $cik->dashboard_id;
    }

    public function test()
    {
        //Test Code
        $dashboard_id="1253160361";
        $description="Aravind  provenn  054a8eb74c5422c598d7a3110b4dff9cd03f556f 6ca1d33e84ea82d63738b35f2fc4dc33f12dc846";
        $name="Aravind  provenn";
        try {
            $url = "https://" . Config::get('app.exosite_domain_name') . ".exosite.com/api/portals/v1/dashboards/" . $dashboard_id;
            $data = new stdClass();
            $data->name = $name;
            $data->description = $description;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); /*PUT*/
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_USERPWD, Config::get('app.exosite_username') . ':' . Config::get('app.exosite_password'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $curl_result = curl_exec($ch);
            curl_close($ch);
            Log::info($curl_result);
            $result = json_decode($curl_result);
        }
        catch(Exception $exception){
            Log::error( $exception->getMessage() );
        }

        return $result->portalId;
    }
}
