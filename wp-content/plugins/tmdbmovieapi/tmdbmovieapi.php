<?php 
/**
 * @package TMDBMoviePlugin 
 */
 /** 
 * Plugin Name: TMDB Movie API
 * Description: This is my first plugin 
 * Version: 1.0.0
 * Author : Dani
 * License: GPLv2 or later 
 */


// if ( !defined( 'ABSPATH' ) ) {
//     die;
// }
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

class TMDBPlugin {

    function __construct() {
        add_action('init', array( $this, 'custom_post_type'));
    }

    function activate() {
        echo 'Plugin activated';
        flush_rewrite_rules();
    }
    function deactivate() {
        echo 'Plugin deactivated';
    }
    function uninstall() {
        
    }
    //create custom post type
    function custom_post_type() {
        register_post_type( 'movie', ['public' => true,'label'=>'movies'] );
    }
    function the_movie_db( $atts ) {
        global $post;
        global $wpdb;
        $atts = shortcode_atts( array(
           
        ), $atts, 'the_movie_plugin');
        
        //make api request from themoviedb
        $today = date('Y-m-d');
        $url ='https://api.themoviedb.org/3/discover/movie?api_key=d62f11ea5037948898652e8deb073c44&primary_release_date.gte='.$today.'&primary_release_date.lte='.$today;
        $get_data = $this->callAPI('GET',$url , false);
        $response = json_decode($get_data, true);
        $original_movie = array();
        foreach ($response as $value) {
            if(is_array($value)){
                foreach ($value as  $val) {
                    if( !empty($val)){
                        array_push($original_movie, array($val['original_title'],$val['genre_ids'],$val['id'],$val['overview'],$val['release_date']));
                    }
                }
            }
        
        }
        foreach ($original_movie as $om) {
            $existing_post = $wpdb->get_results(
                $wpdb->prepare( "select * from $wpdb->postmeta where meta_key = 'api_movie_id' AND meta_value =%s",$om[2]));
                if(!empty($existing_post ) ) {
                wp_update_post( array(
                    'ID' => $existing_post[0]->post_id,
                    'post_title' => $om[0],
                    'post_status' => 'published',
                    'post_genre' => $om[1],
                    'post_type' => 'movie',
                    'post_content' => $om[3],
                    'meta_input'=> array(
                            'api_movie_id' => $om[2],
                            'details' => $om[3],
                            'release_data' => $om[4],
                            'title' => $om[0]
                    )
                ));    
            } else {
                wp_insert_post( array(
                    'post_title' => $om[0],
                    'post_status' => 'published',
                    'post_genre' => $om[1],
                    'post_type' => 'movie',
                    'post_content' => $om[3],
                    'meta_input'=> array(
                            'api_movie_id' => $om[2],
                            'details' => $om[3],
                            'release_data' => $om[4],
                            'title' => $om[0]
                        )
                ));
            }
        }

    }

    function callAPI($method, $url, $data){
        $curl = curl_init();
     
        switch ($method){
           case "POST":
              curl_setopt($curl, CURLOPT_POST, 1);
              if ($data)
                 curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
              break;
           case "PUT":
              curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
              if ($data)
                 curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
              break;
           default:
              if ($data)
                 $url = sprintf("%s?%s", $url, http_build_query($data));
        }
     
        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
           'APIKEY: 111111111111111111111',
           'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
     
        // EXECUTE:
        $result = curl_exec($curl);
        if(!$result){die("Connection Failure dear user");}
        curl_close($curl);
        return $result;
     }    
}
if ( class_exists('TMDBPlugin') ) {
    $tmdbPlugin = new TMDBPlugin();
    add_action('get_movie_data', array($tmdbPlugin, 'the_movie_db') );
}
register_activation_hook( __FILE__, array($tmdbPlugin, 'activate') );
register_deactivation_hook( __FILE__, array($tmdbPlugin, 'deactivate') );