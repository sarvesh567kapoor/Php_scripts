<?php
	add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
	function my_theme_enqueue_styles() {
		wp_enqueue_style( 'listingpr-parent-style', get_template_directory_uri() . '/style.css' );
	}

add_filter( 'mime_types', 'wpse_mime_types' );
function wpse_mime_types( $existing_mimes ) {
    // Add csv to the list of allowed mime types
    $existing_mimes['csv'] = 'text/csv';

    return $existing_mimes;
}

function themeslug_enqueue_script() {
    wp_enqueue_script( 'my-js', 'font_awesom.js', false );
}
//add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_script' );
//sarvesh for the homepage feature 

add_shortcode( 'featured_supplier', 'event_filter_shortcode_function' );
function event_filter_shortcode_function() {
	$paged = get_query_var('paged') ? get_query_var('paged'):1;

	$loop = new WP_Query( array(
        'post_type' => 'listing',
        'post_status' => 'publish',
        'posts_per_page' => -1,
	'paged' => $paged,  
              
) 
);
$html=''; 
while ( $loop->have_posts() ) : $loop->the_post();

$post_id            = get_the_ID();
$link               = get_post_permalink($post_id);
$title              = get_the_title();
$address1           = get_post_meta(get_the_ID(), 'old_companyAddress', true );
$address2 = 'London';
$post_thumbnail_url = get_the_post_thumbnail_url( $post_id, 'medium_large' );
$post_author        = get_post_meta($post_id, 'author_name' , true );
$post_date	    = get_the_date( 'dS M Y', $post_id );
$p                  = get_the_excerpt();
$px                 = substr($p,0,20);
if($post_id == 485 or $post_id == 4227 or $post_id == 471 or $post_id == 2553 or $post_id == 722) {
$html.='<div class="featured-card"> <div class="blog-image">
    <a target="_blank" href="'.$link.'">
      <img src="'.esc_url($post_thumbnail_url).'" />
    </a>
  </div><div class="text_info">
    <div class="title-blog">
      <h5 class="tmnf">
        <a target="_blank" href="'.$link.'">'.$title.'</a>
      </h5>
    </div>
    <div class="title-author"><div class="tmnf_excerpt"><span><i class="fa fa-building" aria-hidden="true"></i></span>'.$px.'</div></div>
    <div class="bottom-box">
    <div class="title-date"><div class="tmnf_address"><span><i class="fa fa-map-marker" aria-hidden="true"></i></span>'.$address2.'</div></div>
     <div class="post-blog">
      <div class="post_view1"><a target="_blank" href="'.$link.'">More Enquery</a></div>
     </div>
    </div>
</div></div>';	
}

endwhile;
//echo '</div>';
wp_reset_query();
return $html;
}


add_shortcode( 'featured_news', 'event_filter_shortcode_function1' );
function event_filter_shortcode_function1() {

global $wpdb;
$sql_query="SELECT *  FROM `wp_posts` WHERE `post_type` LIKE 'post'  and  post_status = 'publish'  ORDER BY post_date DESC LIMIT 0, 5";
$sql_results = $wpdb->get_results( $sql_query, OBJECT);
//var_dump($sql_results);
    $html='';
    foreach ($sql_results as $post) {
     $array1 = (array) $post;
     $title= $array1["post_title"];
     $date=$array1["post_date"];
      $content=strip_tags($array1['post_content']);
     $array1['guid']= str_replace("http://mustbeonit.mickyrobinson.com","http://micebook.ebizontech.biz",$array1['guid']);
     $link=$array1['guid'];
     $id=$array1['ID'];
     $sql_sub= 'SELECT meta_value  FROM `wp_postmeta` WHERE `post_id` = '.$id.' and meta_key LIKE "_thumbnail_id"';
     $sql_results1 = $wpdb->get_results( $sql_sub, OBJECT);
      $array2 = (array) $sql_results1;
      $array4=(array)$array2[0];
      $pant=$array4['meta_value'];
      $sql_thub="SELECT guid  FROM `wp_posts` WHERE `ID` = '".$pant."'";
      $sql_results3 = $wpdb->get_results($sql_thub);
       $array3 = (array) $sql_results3[0];
       $array3['guid']= str_replace("http://mustbeonit.mickyrobinson.com","http://micebook.ebizontech.biz",$array3['guid']);
       $px="";
       $address2='';
       $px = substr($content,0,60);
       $ax= $px.'...';
       $img_link=$array3['guid'];
       $datetime = explode(" ",$date);
       $date = $datetime[0];
      $date = date_create($date);
      $date =  date_format($date,"F d, Y");
      $html.='<div class="featured-news"> <div class="blog-image">
    <a target="_blank" href="'.$link.'">
      <img src="'.esc_url($img_link).'" />
    </a>
  </div><div class="text_info">
    <div class="title-blog">
      <h5 class="tmnf">
        <a target="_blank" href="'.$link.'">'.$title.'</a>
      </h5>
    </div>
    <div class="title-author"><div class="tmnf_excerpt"><span><i class="content" aria-hidden="true"></i></span>'.$ax.'</div></div>
    <div class="bottom-box">
    <div class="title-date"><div class="tmnf_address"><span><i class="fa fa-calendar" aria-hidden="true"></i></span>'.$date.'</div></div>
     <div class="post-blog">
      <div class="post_view1"><a target="_blank" href="'.$link.'">Read More</a></div>
     </div>
    </div>
</div></div>';
   

    }
  wp_reset_postdata();
return $html;

}

/*
add_action('wp_ajax_register_user_front_end', 'register_user_front_end', 0);
add_action('wp_ajax_nopriv_register_user_front_end', 'register_user_front_end');
function register_user_front_end() {
          
	  $new_user_name = stripcslashes($_POST['new_user_name']);
	  $new_user_email = stripcslashes($_POST['new_user_email']);
	  $new_user_password = $_POST['new_user_password'];
	  $user_nice_name = strtolower($_POST['new_user_email']);
         // echo $new_user_name;
        //  echo $user_nice_name;
        //  echo $new_user_password;
        //  echo $new_user_email;
         // echo $new_user_first_name;
	  $user_data = array(
	      'user_login' => $new_user_name,
	      'user_email' => $new_user_email,
	      'user_pass' => $new_user_password,
	      'user_nicename' => $user_nice_name,
              'role' => 'buyer'
	      
	  	);
           echo $user_data;
	  $user_id = wp_insert_user($user_data);
        //  update_user_meta( $user_id,'', mixed $meta_value );
        //  update_user_meta( $user_id,'', mixed $meta_value );
        //  update_user_meta( $user_id,'', mixed $meta_value );

         // echo $user_id;
	  	if (!is_wp_error($user_id)) {
	      echo 'we have Created an account for you.';
	  	} else {
	    	if (isset($user_id->errors['empty_user_login'])) {
	          $notice_key = 'User Name and Email are mandatory';
	          echo $notice_key;
	      	} elseif (isset($user_id->errors['existing_user_login'])) {
	          echo'User name already exixts.';
	      	} else {
	          echo'Error Occured please fill up the sign up form carefully.';
	      	}
	  	}
	die;
}

*/


//shortcode for the experience listing on homepage
 
add_shortcode( 'featured_experience', 'event_filter_shortcode_function2' );
function event_filter_shortcode_function2() {
        $paged = get_query_var('paged') ? get_query_var('paged'):1;

        $loop = new WP_Query( array(
        'post_type' => 'experience',
        'post_status' => 'publish',
        'posts_per_page' => 5,
        'paged' => $paged,

)
);
$html='<div class="elementor-widget-container">
<div class="lp-section-content-container row">';
$x=0;
while ( $loop->have_posts() ) : $loop->the_post();

$post_id            = get_the_ID();
$link               = get_post_permalink($post_id);
$title              = get_the_title();
$address1           = get_post_meta(get_the_ID(), 'old_companyAddress', true );
$address2 = 'London';
$post_thumbnail_url = get_the_post_thumbnail_url( $post_id, 'medium_large' );
$post_author        = get_post_meta($post_id, 'author_name' , true );
$post_date          = get_the_date( 'dS M Y', $post_id );
$p                  = get_the_excerpt();
$px                 = substr($p,0,20);
if($x==0){
$html.='<div class="col-md-6 col-sm-6 col-xs-12 cities-app-view">
<div class="city-girds lp-border-radius-8">
<div class="city-thumb">
<img src="'.esc_url($post_thumbnail_url).'" alt="">
</div>
<div class="city-title text-center">
<h3 class="lp-h3">
<a href="'.$link.'">'.$title.'</a>
</h3>
<label class="lp-listing-quantity">0 Listings</label>
</div>
<a href="'.$link.'" class="overlay-link"></a>
</div>
</div>
';
}
else {
$html.='
<div class="col-md-3 col-sm-3 col-xs-12 cities-app-view">
<div class="city-girds lp-border-radius-8">
<div class="city-thumb">
<img src="'.esc_url($post_thumbnail_url).'" alt="">
</div>
<div class="city-title text-center">
<h3 class="lp-h3">
<a href="'.$link.'">'.$title.'</a>
</h3>
<label class="lp-listing-quantity">0 Listings</label>
</div>
<a href="'.$link.'" class="overlay-link"></a>
</div>
</div>
';

}
if($x==4){
$html.='</div></div>';
}
$x+=1;
endwhile;
//echo '</div>';
wp_reset_query();
return $html;
}


