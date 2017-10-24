<?php
/**
* Plugin Main Class
*/
require_once __DIR__ . "/lib/class.flat.php";
require_once __DIR__ . "/lib/class.doc.php";

class DEV_MAIN
{
	const STYLE_KENDO_COMMON = 'kendo.common.min';
    const STYLE_KENDO_DEFAULT = 'kendo.default.min';
    const SCRIPT_KENDO_CULTURE = 'kendo.culture.ru-RU.min';
    const SCRIPT_KENDO_WEB = 'kendo.web.min';
    
    const PLUGIN_DIR = 'developers';

	function __construct(){

		self::initActions ();
		
		new DEV_FLATS();
      
    }

    public static function initActions () {
    	add_action( 'admin_init', array( 'DEV_MAIN', 'activate' ) );
		add_action('wp_ajax_get_flats', array(DEV_FLATS, 'ajax_get_flats'));
		add_action('wp_ajax_nopriv_get_flats', array(DEV_FLATS, 'ajax_get_flats'));
        add_action('wp_ajax_get_one_flat', array(DEV_FLATS, 'ajax_get_one_flat'));
        add_action('wp_ajax_nopriv_get_one_flat', array(DEV_FLATS, 'ajax_get_one_flat'));
        add_action('wp_ajax_get_one_flat_gallery', array(DEV_FLATS, 'ajax_get_one_flat_gallery'));
        add_action('wp_ajax_nopriv_get_one_flat_gallery', array(DEV_FLATS, 'ajax_get_one_flat_gallery'));
    }

    // activation administrative part
    public static function activate () {

        self::registerJSFramework();

        self::initAJAXhooks();    
    }


    private static function registerJSFramework () {

        wp_register_script( self::SCRIPT_KENDO_CULTURE,
            plugins_url(self::PLUGIN_DIR."/kendo/js/" . self::SCRIPT_KENDO_CULTURE . ".js", __DIR__ ) );
        wp_register_script( self::SCRIPT_KENDO_WEB,
            plugins_url(self::PLUGIN_DIR."/kendo/js/" . self::SCRIPT_KENDO_WEB . ".js", __DIR__ ) );
        wp_register_style( self::STYLE_KENDO_COMMON,
            plugins_url(self::PLUGIN_DIR."/kendo/css/" . self::STYLE_KENDO_COMMON . ".css", __DIR__ ) );
        wp_register_style( self::STYLE_KENDO_DEFAULT,
            plugins_url(self::PLUGIN_DIR."/kendo/css/" . self::STYLE_KENDO_DEFAULT . ".css", __DIR__ ) );


        wp_localize_script( 'jquery', 'VVP_OPTIONS', 
        array(
           'ajaxurl' => admin_url('admin-ajax.php'),
           'ajaxlight' => site_url('/ajax/light.php')
        ));
    }

    public static function initAJAXhooks () {

    	if (is_user_logged_in()) {
            add_action("wp_ajax_uploader", array(__CLASS__, 'uploader'));
        }
    }


	public static function uploader ($req) {
        $req = self::handleRequest();
        $result = self::prepareResponse();

        function getFileExt ($filename) {
            if (preg_match('~\.[^\.]+$~', $filename, $matches)) {
                return $matches[0];
            } else {
                return '';
            }
        }

        function processUploadedFile($up_dirs, $remote_dir, $name, $tmp_name) {
            $filename = uniqid() . getFileExt($name);
            $filepath = $up_dirs['basedir'] . $remote_dir . '/' . $filename;
            if (move_uploaded_file($tmp_name, $filepath)) {
                $current_user = wp_get_current_user();
                $file_result = array(
                    'user_file_name' => $name,
                    'file_name' => $filename,
                    'file_path' => $filepath,
                    'file_url' => join('/', array(
                        $up_dirs['baseurl'],
                        $remote_dir,
                        $filename
                    )),
                    'uploaded by' => $current_user->ID,
                    'uploader_name' => $current_user->display_name,
                    'timestamp' => date('c')
                );
                //var_dump($file_result);
                return $file_result;
            }
        }


        // Ручная загрузка docs
        $filename = 'doc_pdf';
        if (!empty($req->files[$filename])) {
            $loaded = $req->files[$filename];
            if ($loaded && $loaded['error'] == 0) {
                $result->docs = DEV_DOC::document_upload(
                    $loaded['tmp_name']);
            }
        }
        // Загрузка flats
           	$filename = 'flats_csv';
        if (!empty($req->files[$filename])) {
            $loaded = $req->files[$filename];
            if ($loaded && $loaded['error'] == 0) {
                $result->gifts = DEV_FLATS::parseFlatsCSV(
                    $loaded['tmp_name']);
            }
        }
        
        // update flats
        $filename = 'flats_update_csv';
        if (!empty($req->files[$filename])) {
            $loaded = $req->files[$filename];
            if ($loaded && $loaded['error'] == 0) {
                $result->gifts = DEV_FLATS::parseFlatsUpdateCSV(
                    $loaded['tmp_name']);
            }
        }

        $moved = array();
        if (property_exists($req, 'remote_dir')) {
            
            $up_dirs = wp_upload_dir();
            //var_dump($up_dirs);
            //var_dump($req);
            $remote_dir = $up_dirs['basedir'] . $req->remote_dir;
            if (!file_exists($remote_dir)) {
                mkdir($remote_dir, 0777, TRUE);
            }

            //var_dump($req);
            foreach ($req->files as $key => $value) {
                if (is_array($value['name'])) {
                    foreach ($value['name'] as $_key => $_value) {
                        # code...
                        $moved[] = processUploadedFile($up_dirs, $req->remote_dir,
                            $_value, $value['tmp_name'][$_key]);
                    }
                } else {
                    $moved[] = processUploadedFile($up_dirs, $req->remote_dir,
                        $value['name'], $value['tmp_name']);
                }
            }
            $result->moved = $moved;
        }

        self::sendResponse($result);
        wp_die();
    }

    public static function handleAJAX () {
        $req = self::handleRequest();

        if (property_exists($req, 'action')) {
            //var_dump("wp_ajax_$req->action");
            do_action("wp_ajax_$req->action", $req);
        }
    }

    public static function handleRequest () {
        $req = json_decode(file_get_contents("php://input"));
        if (is_null($req)) {
            $req = new stdClass();
            foreach ($_REQUEST as $key => $value) {
                $req->$key = $value;
            }
        }
        $req->files = $_FILES;
        return $req;
    }

    public static function prepareResponse () {
        header('Access-Control-Allow-Origin:');
        header('Content-Type: application/javascript; charset=UTF-8');
       
        $result = new stdClass();
        return $result;
    }

    public static function sendResponse ($res, $skip_die  = FALSE) {
        echo json_encode($res);
        if (!$skip_die) {
            exit();
        }
    }

    public static function httpStatus ($id) {
        header("HTTP/1.0 $id");
    }

    public static function dateToDB ($data) {
        if (is_string($data)) {
            $str = $data;
        } else if (is_a($data, 'DateTime')) {
            $str = $data->format('c');
        } else {
            return '';
        }
        $parsed = date_parse($str);
        return $parsed['year'] . sprintf('%02d', $parsed['month']) . sprintf('%02d', $parsed['day']);
    }

    public static function dateFromDB ($str) {
        if (strlen($str) == 8) {
            $str = substr_replace($str, '-', 6, 0);
            $str = substr_replace($str, '-', 4, 0);
        }
        $date = date_create($str, self::getTimeZone());
        if (!empty($date)) {
            $parsed = date_parse($date->format('c'));
            return join('.', array(
                sprintf('%02d', $parsed['day']),
                sprintf('%02d', $parsed['month']),
                $parsed['year']
            ));
        }
    }
}