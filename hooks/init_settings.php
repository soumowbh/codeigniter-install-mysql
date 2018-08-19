<?php
function check_database()
{

    ini_set('display_errors', 'Off');

    //  Load the database config file.
    if (file_exists($file_path = APPPATH . 'config/database.php')) {
        include $file_path;
    }

    $config = $db[$active_group];

    //  Check database connection if using mysqli driver
    if ($config['dbdriver'] === 'mysqli') {
        try{
        $mysqli = new mysqli($config['hostname'], $config['username'], $config['password'], $config['database']);
        if (!$mysqli->connect_error) {
            $empty_db = "SELECT COUNT(DISTINCT `table_name`) as tables FROM `information_schema`.`columns` WHERE `table_schema` = '" . $config['database'] . "'";
            $query_empty_db = $mysqli->query($empty_db)->fetch_array()[0];
            if ($query_empty_db != 0) {
                 $mysqli->close();
                  return true;
            }
        }
    } catch (Exception $e ) {
        $mysqli->close();
    }
    }
    return false;
}
function init_settings()
{
    $ci = &get_instance();
    if (check_database()) {
        $settings = $ci->Settings_model->get_all()->result();
        foreach ($settings as $setting) {
            $ci->config->set_item($setting->setting_name, $setting->setting_value);
        }
        $language = get_setting("language");
        $ci->lang->load('default', $language);
        $ci->lang->load('custom', $language); //load custom after loading the default. because custom will overwrite the default file.
    } elseif((!check_database())&&(current_url()!=base_url()."install")&&(current_url()!=base_url()."exec")){ 
            //print_r((current_url()!=base_url()."install")or(current_url()!=base_url()."exec"));
            redirect('install');
    }
     }
