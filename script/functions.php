<?php
// including css stylesheet
// 
// sarvesh for admin bar 

//sarvesh end 


function wpcss_styles_load_cdn()
{
  // Register the style for a theme:
  wp_register_style( 'msf-bootstrap-cdn', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), '', 'all' );
  wp_register_style( 'msf-font-cdn', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:200i,300i,400,400i,600,600i,700,700i,900,900i', array(), '', 'all' );
  wp_register_style( 'msf-fontawesome-cdn', 'https://use.fontawesome.com/releases/v5.6.3/css/all.css', array(), '', 'all' );
  wp_register_style( 'msf-stellarnav', get_template_directory_uri() . '/css/stellarnav.min.css', array(), '', 'all' );
  wp_register_style( 'msf-owlcarousel', get_template_directory_uri() . '/css/owlcarousel/owl.carousel.min.css', array(), '', 'all' );
  wp_register_style( 'msf-owlcarousel-default', get_template_directory_uri() . '/css/owlcarousel/owl.theme.default.min.css', array(), '', 'all' );
	
	wp_register_style( 'msf-style', get_stylesheet_uri(), array(), '', 'all' );

  // enqueue the style:
  wp_enqueue_style( 'msf-bootstrap-cdn' );
  wp_enqueue_style( 'msf-font-cdn' );
  wp_enqueue_style( 'msf-fontawesome-cdn' );
  wp_enqueue_style( 'msf-stellarnav');
  wp_enqueue_style( 'msf-owlcarousel');
  wp_enqueue_style( 'msf-owlcarousel-default');
  wp_enqueue_style( 'msf-style');
}
add_action( 'wp_enqueue_scripts', 'wpcss_styles_load_cdn' );



// including js scripts
function wpjs_scripts_load_cdn()
{
  // Deregister the included library:
  //wp_deregister_script( 'jquery' );
   
  // Register the library again from  CDN:
  //wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), null );
  wp_register_script( 'bootsrap_script', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), null, true );

  wp_register_script( 'msf-stellarnav-script', get_template_directory_uri() . '/js/stellarnav.min.js' , array(), null, true );
  wp_register_script( 'msf-custom-script', get_template_directory_uri() . '/js/script.min.js' , array(), null, true );
  wp_register_script( 'msf-custom-menu-script', get_template_directory_uri() . '/js/menu-effect.js' , array(), null, true );
	
	wp_register_script( 'msf-custom-Homemenu-script', get_template_directory_uri() . '/js/msf-custom-Homemenu-script.js' , array(), null, true );
	
  wp_register_script( 'msf-owlcarousel-script', get_template_directory_uri() . '/js/owlcarousel/owl.carousel.min.js' , array(), null, true );
	
  if(is_front_page()) {
    wp_deregister_script('msf-custom-menu-script');
  }
  if(!is_front_page()) {
    wp_deregister_script('msf-custom-Homemenu-script');
  }
  // enqueue the scripts:
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'bootsrap_script' );
  wp_enqueue_script( 'msf-stellarnav-script' );
  wp_enqueue_script( 'msf-owlcarousel-script' );
  if(!is_front_page()) { 
  	wp_enqueue_script( 'msf-custom-menu-script' );
  }
  if(is_front_page()) { 
  	wp_enqueue_script( 'msf-custom-Homemenu-script' );
  }
  wp_enqueue_script( 'msf-custom-script' );
}
add_action( 'wp_enqueue_scripts', 'wpjs_scripts_load_cdn' );


// registration of theme features
function msf_themesetup() 
{
	// navigation menu support enable
  register_nav_menus(
  array(
    'header-menu' => __( 'Header Menu' ),
    'footer-menu' => __( 'Footer Menu' )
  )
  );
  // thumbnail feature support enable
  add_theme_support( 'post-thumbnails' );  

  // cutomized title support enable
  add_theme_support( 'title-tag' );

  // cutomized post format support enable
  add_theme_support( 'post-formats', array(
      'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
  ) );

  // custom header spport enable
	$header_info = array(
  'flex-width'    => true,
    'width'       => 980,
    'flex-height' => true,
    'height'      => 200
	);
  add_theme_support( 'custom-header', $header_info );

  // customized logo
  function themename_custom_logo_setup() 
  {
    $defaults = array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    );
    add_theme_support( 'custom-logo', $defaults );
  }
  themename_custom_logo_setup();
}
add_action( 'init', 'msf_themesetup' );

// widgets registration
function theme_slug_widgets_init() 
{
  register_sidebar(array(
  'name' => 'footer 1',
  'id' => 'footer-1',
  'before_widget' => '<div id="%1$s" class="col-sm-2 msf-font-17 widget %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<h1 class="msf-font-17">',
  'after_title' => '</h1>'
  ));

  register_sidebar(array(
  'name' => 'footer 2',
  'id' => 'footer-2',
  'before_widget' => '<div id="%1$s" class="col-sm-2 msf-font-17 widget %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<h1 class="msf-font-17">',
  'after_title' => '</h1>'
  ));

  register_sidebar(array(
  'name' => 'footer 3',
  'id' => 'footer-3',
  'before_widget' => '<div id="%1$s" class="col-sm-2 msf-font-17 widget %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<h1 class="msf-font-17">',
  'after_title' => '</h1>'
  ));

  register_sidebar(array(
  'name' => 'footer 4',
  'id' => 'footer-4',
  'before_widget' => '<div id="%1$s" class="col-sm-2 msf-font-17 widget %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<h1 class="msf-font-17">',
  'after_title' => '</h1>'
  ));

  register_sidebar(array(
  'name' => 'footer 5',
  'id' => 'footer-5',
  'before_widget' => '<div id="%1$s" class="col-sm-2 msf-font-17 widget %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<h1 class="msf-font-17">',
  'after_title' => '</h1>'
  ));

  register_sidebar(array(
  'name' => 'footer 6',
  'id' => 'footer-6',
  'before_widget' => '<div id="%1$s" class="col-sm-2 msf-font-17 widget %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<h1 class="msf-font-17">',
  'after_title' => '</h1>'
  ));

  register_sidebar(array(
  'name' => 'footer 7',
  'id' => 'footer-7',
  'before_widget' => '<div id="%1$s" class="msf-copyright-part widget %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<h1 class="msf-font-17 msf-hidden">',
  'after_title' => '</h1>'
  ));

   register_sidebar(array(
  'name' => 'sidebar',
  'id' => 'sidebar-1',
  'before_widget' => '<aside id="%1$s" class="widget %2$s">',
  'after_widget' => '</aside>',
  'before_title' => '<h3 class="widget-title">',
  'after_title' => '</h3>',
  ));
}
add_action( 'widgets_init', 'theme_slug_widgets_init' );


// for seach form
function my_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform_msf" class="searchform_cls msf-home-search" action="' . home_url( '/' ) . '">
    <input type="text" value="' . get_search_query() . '" name="s" id="txtid" placeholder="Search..."/><i class="fa fa-search" style="font-size:17px;"></i>
<button id="searchsubmit">
</button>
    </form>';
    return $form;
}
add_filter( 'get_search_form', 'my_search_form', 100 );


// adding customised pagination
function wpbeginner_numeric_posts_nav() {
 
    if( is_singular() )
        return;
 
    global $wp_query;
 
    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;
 
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
 
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
 
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
 
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
 
    echo '<div class="navigation"><ul>' . "\n";
 
    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link("« Previous") );
 
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
 
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
 
        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }
 
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
 
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";
 
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
 
    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link("Next »") );
 
    echo '</ul></div>' . "\n";
 
}

// exerpt length
function tn_custom_excerpt_length( $length ) {
return 35;
}
add_filter( 'excerpt_length', 'tn_custom_excerpt_length', 999 );


// news and stories : changing category (taxanomy) label name 
add_action('init', 'renameCategory');
function renameCategory() {
    global $wp_taxonomies;

    $cat = $wp_taxonomies['category'];
    $cat->label = 'News & stories category';
    $cat->labels->singular_name = 'News & stories categorie';
    $cat->labels->name = $cat->label;
    $cat->labels->menu_name = $cat->label;
    //…
}


// vishwajeet shortcode for emailer
// Example 
// [emailerEmbed url="http://localhost/wordpress/4.9.9/wordpress/wp-content/uploads/2019/01/TMH.html" width="700" height="900"]

function emailerEmbed_func( $atts ) {
 $atts = shortcode_atts( array(
   'url' => '',
   'width' => '500',
   'height' => '700'
 ), $atts, 'emailerEmbed' );

 //return "foo = {$atts['url']}";
 return "<iframe src='{$atts['url']}' width='{$atts['width']}' height='{$atts['height']}'></iframe>";
}
add_shortcode( 'emailerEmbed', 'emailerEmbed_func' );

// vishwajeet shortcode for pdf
// Example
// [pdfEmbed url="http://localhost/wordpress/4.9.9/wordpress/wp-content/uploads/2019/01/duckett.pdf"]
function pdfEmbed_func( $atts ) {
 $atts = shortcode_atts( array(
   'url' => '',
   'width' => '500',
   'height' => '700'
 ), $atts, 'pdfEmbed' );

 //return "foo = {$atts['url']}";
 return "<object data='{$atts['url']}' type='application/pdf' width='{$atts['width']}' height='{$atts['height']}'>
   <embed src='{$atts['url']}' type='application/pdf'>
       <p>This browser does not support PDFs. Please download the PDF to view it: <a href='{$atts['url']}'>Download PDF</a>.</p>
   </embed>
</object>";
}
add_shortcode( 'pdfEmbed', 'pdfEmbed_func' );
?>
<?php
// shorcode for what we do curosel part
function kCurosel_func( $owlatts ) {
  $atts = shortcode_atts( array('type' => 'post', 'item-per-box' => 1, 'indicators' => 'indicatorDots'), $owlatts, 'kCurosel' ); //combining attributes(bydefaut+userpassed)
  $itemperbox=$atts['item-per-box'];
  $indicators=$atts['indicators']; //indicator

  $kCuroselstring = "";
  $args = array(
        'post_type' => $atts['type'],
        'posts_per_page' => -1
        );
  $query = new WP_Query( $args );
  if($query->have_posts())
  {
    $kCuroselstring .= '<div class="'.$indicators.' owl-carousel owl-theme">';
    while ($query->have_posts()) {
      $kCuroselstring .="<div class='item'>";
      for ($i=1; $i <= $itemperbox; $i++) { //this loop should run 0 1 the got o hi 0
        $query->the_post();

        $title=get_the_title(); //post title
        $postid=get_the_ID(); //post id
        $postcontent=wp_trim_words(get_the_content(),18); //post id
        $getpermalink=get_permalink();
        if(has_post_thumbnail())
        {
          $postthumbnail=get_the_post_thumbnail_url();
        } 
        else
        {
          $postthumbnail = get_bloginfo( 'stylesheet_directory' ) . '/images/thumbnail-default.jpg"';
        }

        $kCuroselstring .= "<div class='msf_about_curosel'>
        <div class='img' style='background-image: url($postthumbnail);'></div>
        <div class='heading'><h1>$title</h1></div>
        <div class='content'><p>$postcontent</p></div>
        <div class='' style='padding:0px 4px;'><a class='msf-btn-red' href='$getpermalink'>View more</a></div>
        </div>";
      }
      $kCuroselstring .='</div>';
    }
  $kCuroselstring .='</div>';
  }
  //return "type = {$atts['type']}";
  wp_reset_postdata();
  return $kCuroselstring;
}
add_shortcode( 'kCurosel', 'kCurosel_func' ); //creating shorcode name kCurosel and maping to kCurosel_func function
?>
<?php  
  // shortcode for home news and stories
  function homeNews_func( $newsatts ){
    $vhtml = "";
    $atts = shortcode_atts( array('postType' => 'post', 'terms' => 'home'), $newsatts, 'homeNews' );
	$indicators='home-news-owl'; //indicator
	$relatedNewsStories = "Related News & stories";  
	if($atts['terms'] == 'home' || $atts['terms'] == 'access-campaign')
	{
		$relatedNewsStories="News & stories";
	}
    $args = array('post_type' => $atts['postType'],'posts_per_page' => 8,'tax_query' => array(array('taxonomy' => 'visible-on','field' => 'slug','terms' => $atts['terms'])));
    $vquery = new WP_Query( $args );
    if($vquery->have_posts()) {
      $vhtml .= "<div class='msf-mid-related-news-stories-scroll'>
    <div class='container-fluid msf-container msfRealtedNewsStyle-owl'><h1 class='msf_realtednewsstories_h1'>$relatedNewsStories</h1><div class='$indicators owl-carousel owl-theme'>";
      while($vquery->have_posts()) {
        $vquery->the_post();
        if(has_post_thumbnail())
        {
          $post_img = get_the_post_thumbnail_url();
        } 
        else
        {
          $upload_dir = wp_upload_dir();
          $post_img = trailingslashit( $upload_dir['url'] ).''. 'default.png"';
        }
		$category=get_the_category(get_the_ID());
		$terms = get_the_terms( get_the_ID(), 'category');
		foreach ( $terms as $term ) 
		{
			// The $term is an object, so we don't need to specify the $taxonomy.
			$term_link = get_term_link( $term );
			// If there was an error, continue to the next term.
			if ( is_wp_error( $term_link ) ) {
				continue;
			}	
			// We successfully got a link. Print it out.
			$catname.='<a href="' . esc_url( $term_link ) . '" class="msf-term-link-owl">' . $term->name . '</a>';
		}
        $vhtml .= "<div class='msf-news-stories-main-div-owl'>
          <div class='msf-news-stories-div-owl'>
            <div class='msf-img-div-owl' style='background-image: url($post_img);'>   
                </div>
                <div class='msf-content-owl'>";

        $vhtml .= "<span class='msf-news-stories-cat-owl'>".$catname."</span>
                  <h1>".wp_trim_words(get_the_title(), 12, '...')."</h1>
                  <span class='entry-date-news-stories-owl'>".get_the_date()."  |  </span>
                  <span class='news-stories-countryspn-owl'>";
		$catname="";
        $NewsStoriesCountry = get_the_terms( $post->ID, 'country' ); 
        for ($i=0; $i < count($NewsStoriesCountry); $i++) { 
          $vhtml .= $NewsStoriesCountry[$i]->name."<br>";
        }

        $vhtml .= "</span>
                  <p>
                    <br>
                    <a href='".get_permalink()."' class='msf-btn-red msf-news-stories-btn-red-owl'>View full story</a> 
                  </p>
                </div>
          </div>
        </div>";
      }
      $vhtml .= "</div>
    </div>
  </div>
  <br><br>";
    }
    wp_reset_postdata();
    return $vhtml;
  }
  add_shortcode( 'homeNews', 'homeNews_func' );

 //kanika's job shortcode for job
 // shortcode for jobs curosel part
function kJobCurosel_func( $owlatts ) {
  $atts = shortcode_atts( array('type' => 'post', 'item-per-box' => 1, 'indicators' => 'indicatorDots', 'taxonomy' => 'job-type', 'field' => 'slug', 'terms' => 'project'), $owlatts, 'kCurosel' ); //combining attributes(bydefaut+userpassed)
  $itemperbox=$atts['item-per-box'];
  $indicators=$atts['indicators']; //indicator
  $taxonomy=$atts['taxonomy']; //taxonomy name
  $field=$atts['field']; //taxonomy feild
  $terms=$atts['terms']; //taxonomy terms
  $kCuroselstring = "";
  $args = array(
        'post_type' => $atts['type'],
        'posts_per_page' => -1,
        'tax_query' => array(
         array(
          'taxonomy' => $taxonomy,
          'field'    => $field,
          'terms'    => $terms,
        ),
        ),
  );
  $query = new WP_Query( $args );
  if($query->have_posts())
  {
    echo $modal='<div class="modal fade" id="jobmyModal" role="dialog" style="color:#000;">
    <div class="modal-dialog msf-modal-box">

    <div class="modal-content">    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="jobModalBox">
          
      </div>
    </div>
    
      </div>
    </div>';

    $kCuroselstring .= '<div class="'.$indicators.' owl-carousel owl-theme msfJobDivZ">';
    while ($query->have_posts()) {
      $kCuroselstring .="<div class='item' style='background-color:#fff;padding:15px 18px;'>";
      for ($i=1; $i <= $itemperbox; $i++) { //this loop should run 0 1 the got o hi 0
        $query->the_post();

        $title=get_the_title(); //post title
        $postid=get_the_ID(); //post id
        $postContent=get_the_content(); //post content
        $getpermalink=get_permalink(); //link of post
        $joblocation=get_post_meta( get_the_ID(), 'wpcf-job-location', true );
        $hrmail=get_post_meta( get_the_ID(), 'wpcf-hr-mail', false );  //list of all mails in array format
        $hrmail=implode(" <br> ",$hrmail);

        $jobdepartment=get_post_meta( get_the_ID(), 'wpcf-department', true ); //job department
        if(!empty($jobdepartment))
        {
          $jobdepartment="<tr>
                    <td>Department: </td>
                    <td>$jobdepartment</td>
                  </tr>";
        }
        else
        {
          $jobdepartment="";
        }
        $jobvacancy=get_post_meta( get_the_ID(), 'wpcf-vacancy', true ); //job vacancy
        if(!empty($jobvacancy))
        {
          $jobvacancy="<tr>
                    <td>No. of Vacancies: </td>
                    <td>$jobvacancy</td>
                  </tr>";
        }
        else
        {
          $jobvacancy="";
        }
        $jobannualSalary=get_post_meta( get_the_ID(), 'wpcf-annual-salary', true ); //job annual-salary
        if(!empty($jobannualSalary))
        {
          $jobannualSalary="<tr>
                    <td>Monthly gross salary: </td>
                    <td>$jobannualSalary</td>
                  </tr>";
        }
        else
        {
          $jobannualSalary="";
        }
        $jobLastDateApplication=get_post_meta( get_the_ID(), 'wpcf-last-date-of-application', true ); //job last date of application       
		$jobLastDateApplication=date('F j, Y', (float)$jobLastDateApplication);
        if(!empty($jobLastDateApplication) AND $jobLastDateApplication!='January 1, 1970')
        {
          $jobLastDateApplication="<tr>
                    <td>Last date of application: </td>
                    <td>$jobLastDateApplication</td>
                  </tr>";
        }
        else
        {
          $jobLastDateApplication="<tr>
                    <td>Last date of application: </td>
                    <td>N/A</td>
                  </tr>";
        }

        $jobExpectedDateApplication=get_post_meta( get_the_ID(), 'wpcf-expected-staring-date', true ); //job expected date of application	  
		$jobExpectedDateApplication=date('F j, Y', (float)$jobExpectedDateApplication);
		if(!empty($jobExpectedDateApplication) AND $jobExpectedDateApplication!='January 1, 1970')
        {
          $jobExpectedDateApplication="<tr>
                    <td>Expected starting date: </td>
                    <td>$jobExpectedDateApplication</td>
                  </tr>";
        }
        else
        {
          $jobExpectedDateApplication="<tr>
                    <td>Expected starting date: </td>
                    <td>N/A</td>
                  </tr>";
        }
		  
        $jobwpcfAvailability=get_post_meta( get_the_ID(), 'wpcf-availability', true ); //job avaliability
        if(!empty($jobwpcfAvailability))
        {
          if($jobwpcfAvailability == "office")
          {
            $jobwpcfAvailability="<tr>
                      <td>Functional reporting vacancies: </td>
                      <td>$jobwpcfAvailability</td>
                    </tr>";
          }
          else
          {
            $jobwpcfAvailability="<tr>
                      <td>Duration: </td>
                      <td>$jobwpcfAvailability</td>
                    </tr>";
          }
        }
        else
        {
          $jobwpcfAvailability="";
        }
		  
        $jobadminfunctionalReporting=get_post_meta( get_the_ID(),'wpcf-administer-functional-reporting', true );
        if(!empty($jobadminfunctionalReporting))
        {
          if($terms == "office")
          {
            $jobOfficeFeild="<tr>
                      <td>Functional reporting vacancies: </td>
                      <td>$jobadminfunctionalReporting</td>
                    </tr>";
          }
        }
        else
        {
          $jobOfficeFeild="";
        }

        if(has_post_thumbnail())
        {
          $postthumbnail=get_the_post_thumbnail_url();
        } 
        else
        {
          $postthumbnail = get_bloginfo( 'stylesheet_directory' ) . '/images/thumbnail-default.jpg"';
        }

        $kCuroselstring .="<div id='msfJobModalDiv-$postid' style='display:none;' class='msf-modal-design'>
        <div style='width: 100%; text-align: right; padding: 0px 40px;'><input type='text' value='share' style='display: none;'><button id='copy-job-link' data-link='$getpermalink' 
            class='msf-btn-red'>Share Job</button></div>  
        <h1 class='heading'>$title</h1>
          <div class='col-sm-5'>
            <div class='content'>";
            if(!empty($joblocation))
            {
              $kCuroselstring .="<div class='col-sm-1 msf-no-padding msf-red'><i class='fas fa-map-marker-alt'></i> </div>
              <div class='col-sm-11 msf-no-padding msf-red' style='margin-bottom: 10px;'> $joblocation </div>";
            }
            if(!empty($hrmail))
            {
              $kCuroselstring .="<div class='col-sm-1 msf-no-padding'><i class='far fa-envelope'></i></div><div class='col-sm-11 msf-no-padding' style='margin-bottom: 10px;'>$hrmail </div>";
            }
            $kCuroselstring .="</div> 
            </div>
            <div class='col-sm-7'>
            <div class='job_detailssection_2'>
                <table class='msf-modal table noBorder table'>
                  <tbody>
				  $jobdepartment
                  $jobvacancy
                  $jobOfficeFeild
                  $jobannualSalary
                  $jobwpcfAvailability
                  $jobLastDateApplication
                  $jobExpectedDateApplication
                  </tbody>
                </table>
            </div> 
          </div>

          <div class='col-sm-12 msf-modal-job-content-top'>
            <p>
              $postContent
            </p>
          </div>
        </div>";

        $kCuroselstring .= "<div class='msf_about_curosel'>
  		<div class='job_namesection_1'>
        <h1 class='heading'>$title</h1>
        <div class='content'>";
        if(!empty($joblocation))
        {
          $kCuroselstring .="<p class='msf-red'><i class='fas fa-map-marker-alt'></i> $joblocation</p>";
        }
//         if(!empty($hrmail)){
//           $kCuroselstring .="<p class='msf-mail'><div class='col-sm-1 msf-no-padding'><i class='far fa-envelope'></i></div> 
//           <div class='col-sm-11 msf-no-padding'>$hrmail </div></p>";
//         }
        $kCuroselstring .="</div>   
        </div> 
    <div class='job_detailssection_2'>
        <table class='msf-table noBorder table'>
          <tbody>
          $jobvacancy
          $jobLastDateApplication
          $jobExpectedDateApplication
          </tbody>
        </table>
    </div>   
    <div class='job_discriptionsection_3' style='display: none;'>
    $postContent
    </div>  
        <div class='btn'><a class='msf-btn-red msfJobModalonclick' data-id='msfJobModalDiv-$postid' data-target='#jobmyModal' data-toggle='modal'>View details</a></div>
        </div>";
      }
      $kCuroselstring .='</div>';
    }
  $kCuroselstring .='</div>';
  }else{
	  echo "<h1 style='text-align: center;
    color: #ea0001;'>No current vacancies</h1>";
  }
  wp_reset_query();
  return $kCuroselstring;
}
add_shortcode( 'kJobCurosel', 'kJobCurosel_func' ); //creating shorcode name kCurosel and maping to kCurosel_func function
?>
<?php  
  // shortcode for home news and stories
  function homeProject_func( $atts ){
    $vhtml = "";
    $atts = shortcode_atts( array(
       'postType' => 'project'
     ), $atts, 'homeProject' );

    $hpquery = array(
          'posts_per_page'   => 10,
            'post_type' => 'project',
            'tax_query' => array(
                array (
                    'taxonomy' => 'project-status',
                    'field' => 'slug',
                    'terms' => 'active',
                )
            ),    
        );
      $hploop = new WP_Query($hpquery);
      $colcounter = 1;
        if ( $hploop->have_posts() ) {
        $vhtml .= '<div class="row">';
          while ( $hploop->have_posts() ) { 
            $hploop->the_post();
            if($colcounter <4){
              $colcounter++; $grid = " col-md-4";
            }elseif($colcounter <6){
              $colcounter++; $grid = "col-md-6";
            }
             elseif($colcounter <9){
              $colcounter++; $grid = " col-md-4";
            }
            else{
              $colcounter++; $grid = "col-md-6";
            }

              $vhtml .= "<div class='home-active-project-container $grid'>";
              $vhtml .= "<div class='detailproject' style=' background-image: url(".get_the_post_thumbnail_url().");'>";
                if(get_post_meta(get_the_ID(), 'wpcf-project-location', true)!="" ){ 
                  $vhtml .= "<div class='eloc'><span><i class='fas fa-map-marker-alt'></i></span>".get_post_meta(get_the_ID(), 'wpcf-project-location', true)."</div>";
                 }
                $vhtml .= '<div class="home-project-hover">
                  <h1>'.get_the_title().'</h1>
                  <a href="'.get_the_permalink().'" class="msf-btn-red">View project</a>
                </div>
              </div>
              
            </div>';
          }
          $vhtml .= '</div>';
      }
      wp_reset_query();
    return $vhtml;
  }
  add_shortcode( 'homeProject', 'homeProject_func' );


// shortcode for related tags - news and stories
function tagsRelatedNS_func()
{
  $vhtml = "";
  $tags=get_the_tag_list('',', ',''); //get all the tags
  $tagsList = strip_tags($tags);
  $tags = get_the_tags(get_the_ID()); 
  $tags_Bucket=array();
  foreach ( $tags as $tag ) 
  { 
	 $tags_Bucket[]=$tag->term_id; 
  }
  $tagsList=trim($tagsList);
  $indicators='home-news-owl'; //indicator

  $array_values = array_values($tags_Bucket); //Array ( 9 , 13 , 12 , 11 )
  $tagIdString=implode(",", $tags_Bucket);	
  $NewsStoriesTags = new WP_Query( array( 'tag__in' => array( $tagIdString ) ) );   
  if($NewsStoriesTags->have_posts()) 
  {
    // <!-- related news scroll section -->
    $vhtml.="<div class='msf-mid-related-news-stories-scroll'>
    <div class='container-fluid msf-container msfRealtedNewsStyle-owl'><h1 class='msf_realtednewsstories_h1'>Related News & stories</h1><div class='$indicators owl-carousel owl-theme'>";
        
    while($NewsStoriesTags->have_posts()) 
    {
      $NewsStoriesTags->the_post();
      if(has_post_thumbnail())
      {
        $post_img = get_the_post_thumbnail_url();
      } 
      else
      {
        $upload_dir = wp_upload_dir();
        $post_img = trailingslashit( $upload_dir['url'] ).''. 'default.png"';
      }

      $terms = get_the_terms( get_the_ID(), 'category');
      foreach ( $terms as $term ) 
      {
        // The $term is an object, so we don't need to specify the $taxonomy.
        $term_link = get_term_link( $term );
        // If there was an error, continue to the next term.
        if ( is_wp_error( $term_link ) ) 
        {
          continue;
        } 
        $catname.='<a href="' . esc_url( $term_link ) . '" class="msf-term-link-owl">' . $term->name . '</a>';
      }

      $vhtml.='<div class="msf-news-stories-main-div-owl">
        <div class="msf-news-stories-div-owl">
          <div class="msf-img-div-owl" style="background-image: url('.$post_img.')">   
              </div>
              <div class="msf-content-owl">
                <span class="msf-news-stories-cat-owl">'. $catname .'</span>
                <h1>'.wp_trim_words(get_the_title(), 12, '...').'</h1>
                <span class="entry-date-news-stories-owl">'. get_the_date().'  |  </span>
                <span class="news-stories-countryspn-owl">';
                $NewsStoriesCountry = get_the_terms( $post->ID, 'country' );
                for ($i=0; $i < count($NewsStoriesCountry); $i++) { 
                  $vhtml.= $NewsStoriesCountry[$i]->name."<br>";
                }
                $vhtml.='</span>
                <p>
                  <br>
                  <a href="'.get_permalink().'" class="msf-btn-red msf-news-stories-btn-red-owl">View full story</a> 
                </p>
              </div>
        </div>
      </div>';  
    $catname="";
    }
    $vhtml.='</div>
    </div>
  </div>
  <br><br>';
  } 
  else
  {
    //$vhtml.= '<h1 class="msfRedResult">No results Found!</h1>';
  }
  wp_reset_query();
  return $vhtml;
}
add_shortcode( 'tagsRelatedNS', 'tagsRelatedNS_func' );

/**********Add code for Related Articles and Publications Section*****************/
function tagsRelatedANP_func()
{
  $vhtml = "";
  $tags=get_the_tag_list('',', ',''); //get all the tags
  //print_r($tags);die('test');
  $tagsList = strip_tags($tags);
  $tags = get_the_tags(get_the_ID()); 
  $tags_Bucket=array();
  foreach ( $tags as $tag ) 
  { 
	 $tags_Bucket[]=$tag->term_id; 
  }
  $tagsList=trim($tagsList);
  $indicators='home-news-owl'; //indicator

  $array_values = array_values($tags_Bucket); //Array ( 9 , 13 , 12 , 11 )
  $tagIdString=implode(",", $tags_Bucket);	
  $NewsStoriesTags = new WP_Query( array( 'tag__in' => array( $tagIdString ) ) );   
  if($NewsStoriesTags->have_posts()) 
  {
    // <!-- related news scroll section -->
    $vhtml.="<div class='msf-mid-related-news-stories-scroll'>
    <div class='container-fluid msf-container msfRealtedNewsStyle-owl'><h1 class='msf_realtednewsstories_h1'>Related Articles and Publications</h1><div class='$indicators owl-carousel owl-theme'>";
        
    while($NewsStoriesTags->have_posts()) 
    {
      $NewsStoriesTags->the_post();
      if(has_post_thumbnail())
      {
        $post_img = get_the_post_thumbnail_url();
      } 
      else
      {
        $upload_dir = wp_upload_dir();
        $post_img = trailingslashit( $upload_dir['url'] ).''. 'default.png"';
      }

      $terms = get_the_terms( get_the_ID(), 'category');
      foreach ( $terms as $term ) 
      {
        // The $term is an object, so we don't need to specify the $taxonomy.
        $term_link = get_term_link( $term );
        // If there was an error, continue to the next term.
        if ( is_wp_error( $term_link ) ) 
        {
          continue;
        } 
        $catname.='<a href="' . esc_url( $term_link ) . '" class="msf-term-link-owl">' . $term->name . '</a>';
      }

      $vhtml.='<div class="msf-news-stories-main-div-owl">
        <div class="msf-news-stories-div-owl">
          <div class="msf-img-div-owl" style="background-image: url('.$post_img.')">   
              </div>
              <div class="msf-content-owl">
                <span class="msf-news-stories-cat-owl">'. $catname .'</span>
                <h1>'.wp_trim_words(get_the_title(), 12, '...').'</h1>
                <span class="entry-date-news-stories-owl">'. get_the_date().'  |  </span>
                <span class="news-stories-countryspn-owl">';
                $NewsStoriesCountry = get_the_terms( $post->ID, 'country' );
                for ($i=0; $i < count($NewsStoriesCountry); $i++) { 
                  $vhtml.= $NewsStoriesCountry[$i]->name."<br>";
                }
                $vhtml.='</span>
                <p>
                  <br>
                  <a href="'.get_permalink().'" class="msf-btn-red msf-news-stories-btn-red-owl">View full story</a> 
                </p>
              </div>
        </div>
      </div>';  
    $catname="";
    }
    $vhtml.='</div>
    </div>
  </div>
  <br><br>';
  } 
  else
  {
    //$vhtml.= '<h1 class="msfRedResult">No results Found!</h1>';
  }
  wp_reset_query();
  return $vhtml;
}
add_shortcode( 'tagsRelatedANP', 'tagsRelatedANP_func' );
/*vishwajeet code for shedule post*/
add_filter('the_posts', 'show_future_posts');

function show_future_posts($posts)
{
   global $wp_query, $wpdb;

   if(is_single() && $wp_query->post_count == 0)
   {
      $posts = $wpdb->get_results($wp_query->request);
   }
   return $posts;
}

@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );


/**
 * Replace permalink segment with post ID
 *
 */
/*function gp_remove_cpt_slug( $post_link, $post ) {
  
     if ( 'job' === $post->post_type && 'publish' === $post->post_status && $post->ID == 8650) {
        
        $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
    }
    return $post_link;
}
add_filter( 'post_type_link', 'gp_remove_cpt_slug', 10, 2 );
*/


add_action( 'template_redirect', 'unlisted_jobs_redirect' );
function unlisted_jobs_redirect()
{
   if( is_404()){
     $path=$_SERVER['REQUEST_URI'];

     $medical_activity = array('/water-and-sanitation-specialists', '/mental-health-officerpsychiatrists','/obstetriciansgynaecologists','/tbhiv-physicians','/surgeons','/anesthesiologists','/general-physicians','/medical-doctor-14','/medical-doctor-16','/ot-nurse-0','/nurse-1','/project-coordinator-1','/human-resources-specialist','/financial-officer','/iec-officer-1','/nurse-gnm-4','/deputy-medical-coordinator-1','/iec-officer-1','/iec-officer-0','/hrco-assistant-asia','/female-health-promoter-iec-officer-hp-iec-officer');
        if(in_array($path,$medical_activity)){
          $post_type = 'job';
        } else{
        $post_type = get_id_by_post_name(str_replace("-"," ",trim($path ,'/')));
         }      
        //check that wp has figured out post_type from the request
        //and it's the type you're looking for
        if(isset($post_type) && $post_type == 'job' ){
        // then redirect to yourdomain.com/jobs/
         wp_redirect( home_url( '/job/'.$path));
        exit();
       }elseif(isset($post_type) && $post_type == 'project' )
       {
         wp_redirect( home_url( '/project/'.$path));
         exit();
       }

     if($path == '/work-us' || $path == '/work-us/'){
        wp_redirect( home_url( '/work-with-us/'));
        exit();
     }
      if($path == '/what-msf' || $path == '/what-msf/'){
        wp_redirect( home_url( '/what-is-msf/'));
        exit();
     }
     if($path == '/applying-msf' || $path == '/applying-msf/'){
        wp_redirect( home_url( '/how-apply/'));
        exit();
     }
      if($path == '/msf-scientific-days-abstracts' || $path == '/msf-scientific-days-abstracts/'){
        wp_redirect( home_url( '/msf-scientific-days-asia-2019/'));
        exit();
     }
     
   
}
}
function get_id_by_post_name($post_name)
{
     
   global $wpdb;;
   $id = $wpdb->get_var("SELECT `post_type` FROM `kkhpl_posts` WHERE  `post_title` like '%".$post_name."%'"); return $id;
}

// Add class in body by using page category

add_filter( 'body_class','my_body_classes' );
function my_body_classes( $classes ) {
  global $post;
 $cat_name = get_the_category($post->ID);
 $post_type = get_post_type($post->ID);

 $uri = $_SERVER['REQUEST_URI'];
 $urls = explode('-',$uri);

  if($post->ID !='' && $post_type === 'post'){
   $classes[] =  $cat_name[0]->slug.' post_type';
  }else if($post->ID !='' && $post_type === 'page' && $urls[0] =='/node')
  {
    $classes[] = 'custom_country';
  }
     
    return $classes;
     
}

//adding page type to tags
function my_cptui_add_post_types_to_archives( $query ) {
	// We do not want unintended consequences.
	if ( is_admin() || ! $query->is_main_query() ) {
		return;    
	}

	if ( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {		
		//print_r(get_registered_post_types());
		$cptui_post_types = get_registered_post_types();

		$query->set(
			'post_type',
			array_merge(
				array( 'post' ),
				$cptui_post_types
			)
		);
	}
}
function get_registered_post_types() {
	$postTypeList = array('post', 'page', 'donor-story', 'event', 'crises-response', 'medical-activity', 'project', 'job', 'publication');
    return $postTypeList;
}
add_filter( 'pre_get_posts', 'my_cptui_add_post_types_to_archives' );



// // echo noindex tag if post or page has a "my_noindex" custom field with a value of "y"|"Y"|"yes" ...
// function my_meta_tags() {
// 	//if post or page has a "my_canon" custom field
// 	$my_canon = get_post_meta( get_queried_object_id(), 'my_canon', true );
// 	if ( ! empty($my_canon)) :
// 	   echo '<link rel="canonical" href="' . $my_canon . '" />';
// 	   remove_action('wp_head', 'rel_canonical'); // prevnts Wordpress inserting a canon tag - we don't want two
// 	endif;
// }
// add_action( 'wp_head', 'my_meta_tags',2);

?>
