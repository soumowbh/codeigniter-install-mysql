<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Exec extends CI_Controller
{
    /**
     *
     * Codeigniter Install Mysql
     * Developed by: www.joelferreira.eu
     * Licence MIT
     * Check project: https://github.com/joelviseu/codeigniter-start-mysql
     *
     */
    public function __construct()
    {
        parent::__construct();

    }
    public function index()
    {
        if (isset($_POST['load'])) {
            $this->_remap();
        } else {
            redirect('install');
        }

    }

    public function _remap()
    {
        $this->_logardb();
    }

    private function _logardb()
    {
        if (file_exists($file_path = APPPATH . 'config/database.php')) {
            include $file_path;
        }
        $config = $db[$active_group];
        $dsn = 'mysqli://' . $config['username'] . ':' . $config['password'] . '@' . $config['hostname'];
        $this->load->database($dsn);
        $this->load->dbutil();
        try {
            $dbs = $this->dbutil->list_databases();
            if (count($dbs) > 0) {
                foreach ($dbs as $dbx) {
                    if ($dbx == $config['database']) {
                        $mysqli = new mysqli($config['hostname'], $config['username'], $config['password'], $config['database']);
                        $mysqli->query("DROP DATABASE " . $config['database']);
                        //echo 'Database DROP!<br/>';
                        $this->dbforge->create_database($config['database']);
                        //echo 'Database created!<br/>';
                        $this->_execute();
                    } else {
                        $this->load->dbforge();
                        if ($this->dbforge->create_database($config['database'])) {
                            //echo 'Database created!<br/>';
                            $this->_execute();
                        }
                    }
                }
            }
        } catch (Exception $e) {
            echo json_encode(array("success" => false, "message" => lang("error_occurred")));
        }
    }
    private function _execute($test = '')
    {
        if (file_exists($file_path = APPPATH . 'config/database.php')) {
            include $file_path;
        }
        $config = $db[$active_group];
        $dsn = 'mysqli://' . $config['username'] . ':' . $config['password'] . '@' . $config['hostname'] . '/' . $config['database'];
        $this->load->database($dsn);
        $this->db->reconnect();
        $mysqli = new mysqli($config['hostname'], $config['username'], $config['password'], $config['database']);
		$filename = FCPATH .$config['database'].'.sql';
        if (!file_exists($filename)) {
            echo json_encode(array("success" => false, "message" => lang("file_not_exist") . " <br>Path : " . $filename));
            exit();
        }
        $lines = file($filename);
        $templine = '';
        foreach ($lines as $line) {
            if (substr($line, 0, 2) == '--' || $line == '') {
                continue;
            }

            $templine .= $line;
            if (substr(trim($line), -1, 1) == ';') {
                $mysqli->query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
                $templine = '';
            }
        }
        echo json_encode(array("success" => true, "message" => lang("record_saved")));
        //echo "Tables imported successfully<br/>";
        exit();
    }

}
