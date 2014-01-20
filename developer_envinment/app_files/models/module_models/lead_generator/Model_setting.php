<?php

class Model_setting extends G_model{
    function save($settings_data){
        if(!empty($settings_data)){
            $allSettings = array();
            
            foreach($settings_data as $setting_name => $setting_value){
                $allSettings[] = array(
                    "setting_name" => $setting_name,
                    "setting_value" => $setting_value
                );
            }
            
            $this->db->update_batch("settings", $allSettings, 'setting_name');
        }
    }
    
    function getAllSettings(){
        $settings = $this->db->from("settings")->get()->result_array();
        
        $allSettings = array();
        
        foreach($settings as $setting){
            $allSettings[$setting["setting_name"]] = $setting["setting_value"];
        }
        
        return $allSettings;
    }
    
    function runCron(){        
        $cronLastRunOn = $this->db->get("cron_run_on")->row_array();
        $settings = $this->db->get_where("settings", array("setting_name" => "runCronFor"))->row_array();
        
        $currentTime = time();
        $cronNextTimeToRun =  strtotime('+'.$settings["setting_value"].' hours', $cronLastRunOn["run_on"]);
        
        if((int)$cronNextTimeToRun <= (int)$currentTime){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    
    function updateCronTime(){
        $this->db->update("cron_run_on", array("run_on" => time()));
    }
}

?>
