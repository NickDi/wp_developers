<?php

class DEV_FLATS 
{
	const taxonomy = 'flat';
    const post_type = 'flats';

    const textdomain = 'dev-flat';

	
	function __construct(){
		add_action('init', array(__CLASS__, 'registerType'));
		add_action('admin_head', array(__CLASS__, 'restrict_manage_posts'));
        //self::add_flat_fields ();
    }

    const INVEST_SYMBOL = 'invest_symbol'; //Symbol inwestycji*
    const OBJECT_TYPE = 'object_type'; //Typ lokalu* - 1 mieszkanie, 2 dom, 3 lokal usługowy
    const ETAP_ID = 'etap_id'; //Etap ID
    const BUILDING = 'building'; //Budynek - symbol budynku, wartość obowiązkowa dla mieszkań i lokali usługowych
    const CAGE = 'cage'; //Klatka - wartość obowiązkowa dla mieszkań i lokali usługowych  - Подьезд
    const FLOOR = 'floor'; // Piętro - wartość obowiązkowa dla mieszkań i lokali usługowych
    const OBJECT_NUMBER = 'object_number'; //Numer lokalu*
    const SYMBOL = 'symbol'; //Symbol*
    const STATUS  = 'status'; // Status* - 1 dostępne, 2 sprzedane, 3 rezerwacja
    const ROOMS_NUMBER = 'rooms_number'; //Ilość pokoi
    const SQUARE = 'square'; //Powierzchnia
    const PRICE = 'price'; //Cena
    const PRICE_PROMO = 'price_promo'; //cena promo
    const VAT = 'vat'; //VAT
    const COMPASS = 'compass'; // Kompas  (4 or 10 what is mean?)
    const ILLUMINATION = 'illumination'; //Nasłonecznienie
    const TERRACE = 'terrace'; //taras
    const GARDEN = 'garden'; //ogrod
    const MEZZANINE = 'mezzanine';//antresola
    const PLAN_IMG = 'plan_img'; //image with plan url
    const PDF_URL = 'pdf_url'; //url to doc


    public static function add_flat_fields(){
        if(function_exists("register_field_group"))
        {
            register_field_group(array (
                'id' => 'acf_hossanova-flat-fields',
                'title' => 'Hossanova flat fields',
                'fields' => array (
                    array (
                        'key' => 'field_59c42461e7b94',
                        'label' => 'Symbol inwestycji',
                        'name' => 'invest_symbol',
                        'type' => 'text',
                        'instructions' => 'Symbol inwestycji',
                        'required' => 1,
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                    array (
                        'key' => 'field_59c424a6e7b95',
                        'label' => 'Typ lokalu',
                        'name' => 'object_type',
                        'type' => 'select',
                        'instructions' => 'Typ lokalu* - 1 mieszkanie, 2 dom, 3 lokal usługowy',
                        'required' => 1,
                        'choices' => array (
                            1 => 'mieszkanie',
                            2 => 'dom',
                            3 => 'lokal usługowy',
                        ),
                        'default_value' => 1,
                        'allow_null' => 0,
                        'multiple' => 0,
                    ),
                    array (
                        'key' => 'field_59c424fde7b96',
                        'label' => 'Etap ID',
                        'name' => 'etap_id',
                        'type' => 'text',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                    array (
                        'key' => 'field_59c42525e7b97',
                        'label' => 'Budynek ',
                        'name' => 'building',
                        'type' => 'text',
                        'instructions' => 'Budynek - symbol budynku, wartość obowiązkowa dla mieszkań i lokali usługowych',
                        'required' => 1,
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                    array (
                        'key' => 'field_59c425dbe7b98',
                        'label' => 'Klatka ',
                        'name' => 'cage',
                        'type' => 'number',
                        'instructions' => 'Klatka - wartość obowiązkowa dla mieszkań i lokali usługowych',
                        'required' => 1,
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                    ),
                    array (
                        'key' => 'field_59c42664e7b99',
                        'label' => 'Piętro',
                        'name' => 'floor',
                        'type' => 'number',
                        'instructions' => 'Piętro - wartość obowiązkowa dla mieszkań i lokali usługowych',
                        'required' => 1,
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                    ),
                    array (
                        'key' => 'field_59c4268ce7b9a',
                        'label' => 'Numer lokalu',
                        'name' => 'object_number',
                        'type' => 'text',
                        'required' => 1,
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                    array (
                        'key' => 'field_59c426afe7b9b',
                        'label' => 'Symbol',
                        'name' => 'symbol',
                        'type' => 'text',
                        'required' => 1,
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                    array (
                        'key' => 'field_59c426c1e7b9c',
                        'label' => 'Status',
                        'name' => 'status',
                        'type' => 'select',
                        'instructions' => '1 dostępne, 2 sprzedane, 3 rezerwacja',
                        'required' => 1,
                        'choices' => array (
                            1 => 'dostępne',
                            2 => 'sprzedane',
                            3 => 'rezerwacja',
                        ),
                        'default_value' => 1,
                        'allow_null' => 0,
                        'multiple' => 0,
                    ),
                    array (
                        'key' => 'field_59c42705e7b9d',
                        'label' => 'Ilość pokoi',
                        'name' => 'rooms_number',
                        'type' => 'number',
                        'default_value' => 1,
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => 1,
                        'max' => 15,
                        'step' => 1,
                    ),
                    array (
                        'key' => 'field_59c42738e7b9e',
                        'label' => 'Powierzchnia',
                        'name' => 'square',
                        'type' => 'text',
                        'required' => 1,
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                    array (
                        'key' => 'field_59c4275fe7b9f',
                        'label' => 'Cena',
                        'name' => 'price',
                        'type' => 'text',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                    array (
                        'key' => 'field_59c4277de7ba0',
                        'label' => 'Cena promo',
                        'name' => 'price_promo',
                        'type' => 'text',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                    array (
                        'key' => 'field_59c42792e7ba1',
                        'label' => 'VAT',
                        'name' => 'vat',
                        'type' => 'number',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                    ),
                    array (
                        'key' => 'field_59c427b8e7ba2',
                        'label' => 'Kompas',
                        'name' => 'compass',
                        'type' => 'number',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                    ),
                    array (
                        'key' => 'field_59c427cae7ba3',
                        'label' => 'Nasłonecznienie',
                        'name' => 'illumination',
                        'type' => 'text',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                    array (
                        'key' => 'field_59c427e7e7ba4',
                        'label' => 'Taras',
                        'name' => 'terrace',
                        'type' => 'text',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                    array (
                        'key' => 'field_59c42804e7ba5',
                        'label' => 'Ogrod',
                        'name' => 'garden',
                        'type' => 'text',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                    array (
                        'key' => 'field_59c4281de7ba6',
                        'label' => 'Antresola',
                        'name' => 'mezzanine',
                        'type' => 'text',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                    array (
                        'key' => 'field_59c4282be7ba7',
                        'label' => 'plan_img',
                        'name' => 'plan_img',
                        'type' => 'image',
                        'save_format' => 'object',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                    ),
                    array (
                        'key' => 'field_59c42854e7ba8',
                        'label' => 'pdf_url',
                        'name' => 'pdf_url',
                        'type' => 'file',
                        'save_format' => 'object',
                        'library' => 'all',
                    ),
                ),
                'location' => array (
                    array (
                        array (
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'flats',
                            'order_no' => 0,
                            'group_no' => 0,
                        ),
                    ),
                ),
                'options' => array (
                    'position' => 'normal',
                    'layout' => 'no_box',
                    'hide_on_screen' => array (
                    ),
                ),
                'menu_order' => 0,
            ));
        }

    }

    public static function restrict_manage_posts () {
        $req = DEV_MAIN::handleRequest();

        if (empty($req->post_type) || $req->post_type !== self::post_type) {
            return;
        }

        wp_enqueue_script( DEV_MAIN::SCRIPT_KENDO_CULTURE );
        wp_enqueue_script( DEV_MAIN::SCRIPT_KENDO_WEB );
        wp_enqueue_style( DEV_MAIN::STYLE_KENDO_COMMON );
        wp_enqueue_style( DEV_MAIN::STYLE_KENDO_DEFAULT );
        //echo 'A';
        //admin_enqueue_scripts
        wp_enqueue_script( __CLASS__ . 'manage_flats', 
            plugins_url("/js/manage_flats.js", __DIR__ ), array('jquery') );

        include dirname(__DIR__) . '/view/manage_flats.php';
    }

    public static function ajax_get_flats () {
        $req = DEV_MAIN::handleRequest();
        $result = DEV_MAIN::prepareResponse();

        if (!empty($req->floor_id)){
        	$result->flats = self::getFlatsSql($req->house_id,$req->floor_id);
        }else{
        	$result->flats = self::getFlatsSql($req->house_id);
        }

        DEV_MAIN::sendResponse($result);
        wp_die();
    }

    public static function ajax_get_one_flat () {
        $req = DEV_MAIN::handleRequest();
        $result = DEV_MAIN::prepareResponse();

        $result->info = self::getoneFlatSql($req->flat_id);
        $result->gallery = self::one_flat_gallery($req->flat_id);
        $result->preview = self::one_flat_preview($req->flat_id);
        DEV_MAIN::sendResponse($result);
        wp_die();
    }

    public static function ajax_get_one_flat_gallery () {
        $req = DEV_MAIN::handleRequest();
        $result = DEV_MAIN::prepareResponse();

        $result = self::one_flat_gallery($req->flat_id);
        
        DEV_MAIN::sendResponse($result);
        wp_die();
    }

    
    

    public static function one_flat_gallery ($post_id) {
        $attachment_ids = get_post_meta( $post_id, '_easy_image_gallery', true );
        $attachment_ids = explode( ',', $attachment_ids );
        $attachment_ids =  array_filter( $attachment_ids );
        $urls = array();
        foreach ( $attachment_ids as $attachment_id ) {
            $image_link = wp_get_attachment_image_src( $attachment_id, apply_filters( 'easy_image_gallery_linked_image_size', 'large' ) );
           // $image_link_pre = wp_get_attachment_image_src( $attachment_id, apply_filters( 'easy_image_gallery_thumbnail_image_size', 'thumbnail' ) );
            //$image = wp_get_attachment_image( $attachment_id, apply_filters( 'easy_image_gallery_thumbnail_image_size', 'thumbnail' ), '', array( 'alt' => trim( strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) ) ) );
            array_push($urls,$image_link[0]);
        }
        return $urls;
    }

    public static function one_flat_preview ($post_id) {
        $attachment_ids = get_post_meta( $post_id, '_easy_image_gallery', true );
        $attachment_ids = explode( ',', $attachment_ids );
        $attachment_ids =  array_filter( $attachment_ids );
        $urls = array();
        foreach ( $attachment_ids as $attachment_id ) {
           // $image_link = wp_get_attachment_image_src( $attachment_id, apply_filters( 'easy_image_gallery_linked_image_size', 'large' ) );
            $image_link_pre = wp_get_attachment_image_src( $attachment_id, apply_filters( 'easy_image_gallery_thumbnail_image_size', 'thumbnail' ) );
            //$image = wp_get_attachment_image( $attachment_id, apply_filters( 'easy_image_gallery_thumbnail_image_size', 'thumbnail' ), '', array( 'alt' => trim( strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) ) ) );
            array_push($urls,$image_link_pre[0]);
        }
        return $urls;
    }

    public static function getoneFlatPlan ($attachment_id) {
        //
         // left join wp_postmeta m11 on m11.meta_key='".self::PLAN."' and m11.post_id = p.id
    
        
        $url = wp_get_attachment_image_url( $attachment_id, 'large', 'false' );
        return $url;

    }

    public static function getoneFlatSql ($flat_id) {
        global $wpdb;

        $sql = "
            select p.id, p.post_title as title,p.guid as url,
                m1.meta_value as ".self::FLAT_NUMBER.",
                m2.meta_value as ".self::ROOM_COUNT.",
                m3.meta_value as ".self::COST.",
                m12.meta_value as ".self::SAIL_COST.",
                m4.meta_value as ".self::ORDER_NUMBER.",
                m5.meta_value as ".self::FLOOR_ID.",
                m6.meta_value as ".self::HOUSE_ID.",
                m7.meta_value as ".self::STATUS.",
                m8.meta_value as ".self::COMMON_SQUARE.",
                m9.meta_value as ".self::LIVE_SQUARE.",
                m11.meta_value as ".self::PLAN."
            from wp_posts p
            left join wp_postmeta m1 on m1.meta_key='".self::FLAT_NUMBER."' and m1.post_id = p.id
            left join wp_postmeta m2 on m2.meta_key='".self::ROOM_COUNT."' and m2.post_id = p.id
            left join wp_postmeta m3 on m3.meta_key='".self::COST."' and m3.post_id = p.id
            left join wp_postmeta m12 on m12.meta_key='".self::SAIL_COST."' and m3.post_id = p.id
            left join wp_postmeta m4 on m4.meta_key='".self::ORDER_NUMBER."' and m4.post_id = p.id
            left join wp_postmeta m5 on m5.meta_key='".self::FLOOR_ID."' and m5.post_id = p.id
            left join wp_postmeta m6 on m6.meta_key='".self::HOUSE_ID."' and m6.post_id = p.id
            left join wp_postmeta m7 on m7.meta_key='".self::STATUS."' and m7.post_id = p.id
            left join wp_postmeta m8 on m8.meta_key='".self::COMMON_SQUARE."' and m8.post_id = p.id
            left join wp_postmeta m9 on m9.meta_key='".self::LIVE_SQUARE."' and m9.post_id = p.id
            left join wp_postmeta m11 on m11.meta_key='".self::PLAN."' and m11.post_id = p.id
            where p.post_type = 'flats' and p.id = %d ";

        $flats = $wpdb->get_row($wpdb->prepare($sql,$flat_id),OBJECT);  
        $flats->plan = self::getoneFlatPlan ($flats->plan);
       return $flats;
           // return $wpdb->get_row($wpdb->prepare($sql,$flat_id),OBJECT);  
    }

    public static function getFlats($house_id) {

		$args = array(
			'numberposts' => 55,
			'category'    => 0,
			'orderby'     => 'date',
			'order'       => 'DESC',
			'include'     => array(),
			'exclude'     => array(),
			'meta_key'    => 'invest_symbol',
			'meta_value'  => $house_id,
			'post_type'   => self::post_type,
			'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
		);
    	return get_posts( $args );
    }

   
 	public static function parseFlatsCSV ($filename) {
 		//  добавить все поля сюдя для загрузки 
        $fh = fopen($filename, 'r');

        $count = 0;
        $table = array();

        if ($fh) {
            fgets($fh); // Пропускаем первую строку
            while ($str = iconv("utf-8", "utf-8", fgets($fh))) {
                $row = array_map(function($item) { 
                    return trim(str_replace('"', '', $item));
                }, explode(';', $str));

                $flat = array(
                    'post_title' => $row[7],
                    'post_status' => 'publish',
                    'post_author' => get_current_user_id(),
                    'post_type'=> self::post_type,
                );
                $post_id = wp_insert_post( $flat );
                if ($post_id) {

                    $bufer = trim($row[0]);
                    if (!empty( $bufer)) {
                        update_field(self::INVEST_SYMBOL,  $bufer, $post_id);
                    }
                    $bufer = trim($row[1]);
                    if (!empty( $bufer)) {
                        update_field(self::OBJECT_TYPE,  $bufer, $post_id);
                    }
                    $bufer = trim($row[2]);
                    if (!empty( $bufer)) {
                        update_field(self::ETAP_ID,  $bufer, $post_id);
                    }
                    $bufer = trim($row[3]);
                    if (!empty( $bufer)) {
                        update_field(self::BUILDING,  $bufer, $post_id);
                    }
                    $bufer4 = trim($row[4]);
                    if (!empty( $bufer)) {
                        update_field(self::CAGE,  $bufer4, $post_id);
                    }
                    $bufer = trim($row[5]);
                    
                    update_field(self::FLOOR,  $bufer, $post_id);
                    
                    $bufer = trim($row[6]);
                    if (!empty( $bufer)) {
                        update_field(self::OBJECT_NUMBER,  $bufer, $post_id);
                    }
                    $bufer = trim($row[7]);
                    if (!empty( $bufer)) {
                        update_field(self::SYMBOL,  $bufer, $post_id);
                    }
                    $bufer = trim($row[8]);
                    if (!empty( $bufer)) {
                        update_field(self::STATUS,  $bufer, $post_id);
                    }
                    $bufer9 = trim($row[9]);
                    if (!empty( $bufer)) {
                        update_field(self::ROOMS_NUMBER,  $bufer9, $post_id);
                    }
                    $bufer = trim($row[10]);
                    if (!empty( $bufer)) {
                        update_field(self::SQUARE,  $bufer, $post_id);
                    }
                    $bufer = trim($row[11]);
                    if (!empty( $bufer)) {
                        update_field(self::PRICE,  $bufer, $post_id);
                    }
                    $bufer = trim($row[12]);
                    if (!empty( $bufer)) {
                        update_field(self::VAT,  $bufer, $post_id);
                    }
                    $bufer = trim($row[13]);
                    if (!empty( $bufer)) {
                        update_field(self::COMPASS,  $bufer, $post_id);
                    }
                    $bufer = trim($row[14]);
                    if (!empty( $bufer)) {
                        update_field(self::ILLUMINATION,  $bufer, $post_id);
                    }
                    $bufer = trim($row[15]);
                    if (!empty( $bufer)) {
                        update_field(self::TERRACE,  $bufer, $post_id);
                    }
                    $bufer = trim($row[16]);
                    if (!empty( $bufer)) {
                        update_field(self::GARDEN,  $bufer, $post_id);
                    }
                    $bufer = trim($row[17]);
                    if (!empty( $bufer)) {
                        update_field(self::MEZZANINE,  $bufer, $post_id);
                    }
                    $table[] = $row;
                    $count++;
                }
            }
            fclose($fh);
        }
        
        return array(
            //'free' => self::calculate_free_flats(),
            'total' => $count,
            'items' => $table);

    }

    public static function parseXLSX ($inputFileName) {
        $file = FALSE;
        if (file_exists($inputFileName)) {
            $file = file_get_contents(
                'zip://'.$inputFileName.'#xl/sharedStrings.xml');
            //file_put_contents(__DIR__ . '/shared.xml', $file);
        }
        if (!$file) throw new Exception("Error Processing Request", 1);
        ;

        $xml = (array)simplexml_load_string($file);
        $sst = array();
        foreach ($xml['si'] as $item => $val) {
            //$sst[] = mb_convert_encoding((string)$val->t, 'windows-1251') ;
            $sst[] = (string)$val->t;
        }

        $file = file_get_contents(
            'zip://'.$inputFileName.'#xl/worksheets/sheet1.xml');
        //file_put_contents(__DIR__ . '/data.xml', $file);

        $xml = simplexml_load_string($file);

        $data = array();

        foreach ($xml->sheetData->row as $row){
            $currow = array();
            foreach ($row->c as $c){
                $value = (string)$c->v;
                $attrs = $c->attributes();
               // print_r($c);
                if ($attrs['t'] == 's'){
                    $cell = $sst[$value];
                } else {
                    $cell = $value;
                }
                $currow[substr($attrs['r'],0, 1)] = $cell;
            }
            $data[]=$currow;
        }
        return $data;
    }

    public static function parseFlatsUpdateCSV ($filename) {
    	global $wpdb;
        //  добавить все поля сюдя для загрузки 
        $fh = fopen($filename, 'r');

        $count = 0;
        $table = array();

        if ($fh) {
            fgets($fh); // Пропускаем первую строку
            while ($str = iconv("windows-1251", "utf-8", fgets($fh))) {
                $row = array_map(function($item) { 
                    return trim(str_replace('"', '', $item));
                }, explode(';', $str));
                /*
                $flat = array(
                    'post_title' => $row[0],
                    'post_status' => 'publish',
                    'post_author' => get_current_user_id(),
                    'post_type'=> self::post_type,
                );*/

                //$post_id = wp_insert_post( $flat );
                $flat_number = trim($row[1]);
                //$sql = 'SELECT post_id FROM wp_postmeta WHERE meta_key = "'. self::FLAT_NUMBER .'" and meta_value = %d ';
                $sql = "SELECT id FROM wp_posts WHERE post_title = %d and post_status = 'published' and post_type = '".self::post_type."'";
                $post_id = $wpdb->get_var($wpdb->prepare($sql,$flat_number));

                if ($post_id) {
                    /**
                        const FLAT_NUMBER  = 'flat_number'; 
                        const ROOM_COUNT  = 'room_count'; 
                        const COST  = 'cost'; 
                        const ORDER_NUMBER  = 'order_number';
                        const FLOOR_ID  = 'floor_id '; 
                        const HOUSE_ID  = 'house_id'; 
                        const STATUS  = 'status'; 

                        const COMMON_SQUARE  = 'common_square'; 
                        const LIVE_SQUARE  = 'live_square';
                    */
                    /*
                    $flat_number = trim($row[1]);
                    if (!empty($flat_number)) {
                        update_field(self::FLAT_NUMBER, $flat_number, $post_id);
                    }
                    */
                    $room_count = trim($row[2]);
                    if (!empty($room_count)) {
                        update_field(self::ROOM_COUNT, $room_count, $post_id);
                    }
                    $cost = trim($row[3]);
                    if (!empty($cost)) {
                        update_field(self::COST, $cost, $post_id);
                    }
                    $order_number = trim($row[4]);
                    if (!empty($order_number)) {
                        update_field(self::ORDER_NUMBER, $order_number, $post_id);
                    }

                    $floor_id = trim($row[5]);
                    if (!empty($floor_id)) {
                        update_field(self::FLOOR_ID, $floor_id, $post_id);
                    }
                    $house_id = trim($row[6]);
                    if (!empty($house_id)) {
                        update_field(self::HOUSE_ID, $house_id, $post_id);
                    }
                    $status = trim($row[7]);
                    if (!empty($status)) {
                        update_field(self::STATUS, $status, $post_id);
                    }

                    $common_square = trim($row[8]);
                    if (!empty($common_square)) {
                        update_field(self::COMMON_SQUARE, $common_square, $post_id);
                    }
                    $live_square = trim($row[9]);
                    if (!empty($live_square)) {
                        update_field(self::LIVE_SQUARE, $live_square, $post_id);
                    }

                    $table[] = $row;
                    $count++;
                }
            }
            fclose($fh);
        }
        
        return array(
            //'free' => self::calculate_free_flats(),
            'total' => $count,
            'items' => $table);

    }


	public static function registerType () {
        $labels = array(
                'name' => ' Flats',
                'singular_name' => 'Flat',
                'search_items' =>  'Search',
                'popular_items' => 'Popular',
                'all_items' => 'All Flats',
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => 'Edit flat',
                'update_item' => 'Update',
                'add_new_item' => 'Add new flat',
                'new_item_name' => __('new item name', self::textdomain),
                'add_or_remove_items' => __('add or remove items', self::textdomain),
                'choose_from_most_used' => __('choose_from_most_used', self::textdomain),
                'menu_name' => 'Flats',
            );

        register_taxonomy(self::taxonomy, self::post_type, array(
                'hierarchical' => FALSE,
                'labels' => $labels,
                'public' => true,
            ));

        $post_labels = array(
                'name' => 'Flats',
                'singular_name' => 'Flat',
                'add_new' => 'add new',
                'add_new_item' => 'add new item',
                'edit_item' => 'edit flat'
            );

        $post_args = array(
                'labels' => $post_labels,
                'public' => true,
                'show_ui' => true,
                'publicly_queryable' => true,
                'show_in_nav_menus' => true,
                'query_var' => true,
                'rewrite' => false,
                'taxonomies' => array(self::taxonomy),
                'has_archive' => false,
                'hierarchical' => true,
                'parent' => 'floors',
                'show_in_menu' => true,
                'menu_position' => 10,
                'menu_icon' => 'dashicons-nametag',
                //'capability_type'     => array('bavaria_flat','bavaria_flats'),
                //'map_meta_cap'        => true,
                 "rewrite" => [
                    "with_front" => true
                ],
                'supports' => array(
                    'title',  
                )
            );

        register_post_type(self::post_type, $post_args);

        register_post_status(self::STATUS_FREE, array(
                "label" => "Продается",
                "public" => true,
                "label_count" => _n_noop( 
                    'Свободна <span class="count">(%s)</span>', 
                    'Свободны <span class="count">(%s)</span>' 
                )
        ));

        register_post_status(self::STATUS_SELL, array(
                "label" => "Проданы",
                "public" => true,
                "label_count" => _n_noop( 
                    'Продана <span class="count">(%s)</span>', 
                    'Проданные <span class="count">(%s)</span>' 
                )
        ));

        register_post_status(self::STATUS_RESERV, array(
                "label" => "Зарезервированны",
                "public" => true,
                "label_count" => _n_noop( 
                    'Зарезервирована <span class="count">(%s)</span>', 
                    'Зарезервированные <span class="count">(%s)</span>' 
                )
        ));

    }
}