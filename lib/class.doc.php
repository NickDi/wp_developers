<?php

class DEV_DOC
{
	const taxonomy = 'docs';
    const post_type = 'document';

    const textdomain = 'docs';
	
	function __construct(){
		 //add_action('init', array(__CLASS__, 'registerType'));
		add_action('init', array(__CLASS__, 'registerType'));
       // add_filter('manage_document_posts_columns', 'documents_table_head');

       // add_action('admin_head', array(__CLASS__, 'restrict_manage_posts'));

        add_shortcode('bavaria_get_docs', array(__CLASS__, 'shortcode_get_docs'));

      //  add_action( 'admin_menu', array($this, 'admin_search_menu_page') );
      //  add_action( 'admin_enqueue_scripts', array($this, 'loading_angular_admin'));
      //  add_action('wp_ajax_wcp_delete_post', array($this, 'delete_this_post'));
    }

    public static function shortcode_get_docs ($atts, $content = null) {
        ob_start();
        $atts = shortcode_atts(array( // вытащим параметр
            "house_number" => '1', // значение по умолчанию
        ), $atts);
         //$category[] = ('Проектные декларации','Разрешение на ввод');
                $choices = array (
                            1 => 'Проектные декларации',
                            2 => 'Разрешение на ввод',
                            3 => 'Аудиторские заключения',
                            4 => 'Проекты договоров участия в долевом строительстве',
                        );
        
        $docs = self::get_docs($house_number);
            //var_dump($docs);
        
        echo '<div class = "bavaria_docs"><ul>';
  
            foreach ($choices as $key => $value) {
                echo "<li class = 'razdel'>".$value."</li>";
                echo '<ul>';
                foreach ($docs as $doc) {
                    if ($key == $doc->category){
                        ?>
                         <li><a href="<?= $doc->file?>" ><?= $doc->post_title ?></a><br>
                         <span>(от <?= $doc->post_date ?> )</span></li>
                        <?
                    }

                 }   
                 echo '</ul>';
            }
            
        echo " </ul> </div>";
             
            
        return ob_get_clean();
    }

    public static function bavaria_get_docs ($house_id = null) {
        ob_start();
        $house_id = 1;
         //$category[] = ('Проектные декларации','Разрешение на ввод');
                $choices = array (
                            1 => 'Проектные декларации',
                            2 => 'Разрешение на ввод',
                            3 => 'Аудиторские заключения',
                            4 => 'Проекты договоров участия в долевом строительстве',
                        );
        
        $docs = self::get_docs($house_number);
            //var_dump($docs);
        
        echo '<div class = "bavaria_docs"><ul>';
  
            foreach ($choices as $key => $value) {
                echo "<li class = 'razdel'>".$value."</li>";
                echo '<ul>';
                foreach ($docs as $doc) {
                    if ($key == $doc->category){
                        ?>
                         <li><a href="<?= $doc->file?>" ><?= $doc->post_title ?></a><br>
                         <span>(от <?= $doc->post_date ?> )</span></li>
                        <?
                    }

                 }   
                 echo '</ul>';
            }
            
        echo " </ul> </div>";
             
            
        return ob_get_clean();
    }

   
    public static function get_docs ($house_number){
        $args = array(
            'numberposts' => 55,
            'category'    => 0,
            'orderby'     => 'date',
            'order'       => 'DESC',
            'include'     => array(),
            'exclude'     => array(),
            'meta_key'    => 'house_number',
            'meta_value'  => $house_number,
            'post_type'   => self::post_type,
            'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
        );
        
        $posts = get_posts( $args );
        foreach ($posts as $post) {
            $post->file_id = get_post_meta ($post->ID,'_file',true);
             $post->file = get_field('file', $post->ID);
            $post->category = get_post_meta ($post->ID,'category',true);

        }
        return $posts;
    }

    public static function get_docs_sql ($house_number){
        $args = array(
            'numberposts' => 55,
            'category'    => 0,
            'orderby'     => 'date',
            'order'       => 'DESC',
            'include'     => array(),
            'exclude'     => array(),
            'meta_key'    => 'house_number',
            'meta_value'  => $house_number,
            'post_type'   => self::post_type,
            'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
        );
        return get_posts( $args );
    }

    ////
    public static function bs_event_table_content( $column_name, $post_id ) {
        if ($column_name == 'event_date') {
        $event_date = get_post_meta( $post_id, '_bs_meta_event_date', true );
          echo  date( _x( 'F d, Y', 'Event date format', 'textdomain' ), strtotime( $event_date ) );
        }
        if ($column_name == 'ticket_status') {
        $status = get_post_meta( $post_id, '_bs_meta_event_ticket_status', true );
        echo $status;
        }

        if ($column_name == 'venue') {
        echo get_post_meta( $post_id, '_bs_meta_event_venue', true );
        }

    }
    
    public static function documents_table_head( $defaults ) {
       // $defaults['event_date']  = 'Event Date';
       // $defaults['ticket_status']    = 'Ticket Status';
        $defaults['category']   = 'Раздел';
        // $defaults['author'] = 'Added By';
        return $defaults;
    }


    //

    public static function document_upload ($filename){

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
        wp_enqueue_script( __CLASS__ . 'manage_dosc', 
            plugins_url("/js/manage_dosc.js", __DIR__ ), array('jquery') );

        include dirname(__DIR__) . '/view/manage_dosc.php';
    }

	public static function registerType () {
        $labels = array(
                'name' => ' Документы',
                'singular_name' => 'Документ',
                'search_items' =>  'Поиск',
                'popular_items' => 'Популярные',
                'all_items' => 'Все документы',
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => 'Измененить  этот документ',
                'update_item' => 'Обновить',
                'add_new_item' => 'Добавить документ',
                'new_item_name' => __('new item name', self::textdomain),
                'add_or_remove_items' => __('add or remove items', self::textdomain),
                'choose_from_most_used' => __(self::textdomain),
                'menu_name' => 'Категории',
            );

        register_taxonomy(self::taxonomy, self::post_type, array(
                'hierarchical' => true,
                'labels' => $labels,
                'public' => true,
            ));

        $post_labels = array(
                'name' => 'Документы',
                'singular_name' => 'Документ',
                'add_new' => 'Добавить док',
                'add_new_item' => 'Добавить новый документ',
                'edit_item' => 'Редактировать документ'
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
                'hierarchical' => false,
                'show_in_menu' => true,
                'menu_position' => 10,
                'menu_icon' => 'dashicons-nametag',
                'capability_type'     => array('bavaria_doc','bavaria_docs'),
                //'map_meta_cap'        => true,
                'supports' => array(
                    'title',
                      'revisions' 
                    //'author',
                    //'custom-fields',
                )
            );

        register_post_type(self::post_type, $post_args);

    }
}