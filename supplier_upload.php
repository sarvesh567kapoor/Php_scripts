<?php
if (!is_user_logged_in()) {
    wp_redirect(home_url());
}

$currentUserID = get_current_user_id();
$lpAllMessges = get_user_meta($currentUserID, 'lead_messages', true);
$supplier_id = get_user_meta($currentUserID, 'old_supplierPage');

$supplierquery = new WP_Query(array(
    'post_type' => 'listing',
    'meta_key' => 'old_id',
    'meta_value' => $supplier_id['0']
        ));
$post_id = '';
$posts = $supplierquery->posts;
$post_id = $posts[0]->ID;
$post_data = get_post($post_id);
$heading = $post_data->post_title;
$description = $post_data->post_content;
$address = get_post_meta($post_id, 'old_companyAddress');

$phone = get_post_meta($post_id, 'lp_listingpro_options');
$pdata = $phone[0]['phone'];
$oldspid = get_post_meta($post_id, 'old_id');
$user = get_users(array(
    'meta_key' => 'old_supplierPage',
    'meta_value' => $oldspid
        ));
$logo = get_post_meta($post_id, "company_logo");
$operational = "";
$exhibitionname = get_post_meta($post_id, 'old_exhibitionName1');
$exhibitionstartdate = get_post_meta($post_id, 'old_startDate');
$exhibitionenddate = get_post_meta($post_id, 'old_endDate');
?>



<div class="tab-pane fade in active" id="updateprofile">
    <div class="user-recent-listings-inner tab-pane fade in active lp-update-profile-container" id="inbox">
        <div class="panel with-nav-tabs panel-default lp-dashboard-tabs col-md-12 lp-left-panel-height lp-update-profile">
            <div class="tab-header lp-update-password-outer ">
                <h3>Edit General Information</h3>
            </div>
			<div class="tab-box-dasborad-2">
                <div class="single-tabber2 margin-bottom-30" id="reply-title2">
                    <ul class="row list-style-none clearfix" data-tabs="tabs">
                        <li class="">
                            <a href="#companyinfo" >Company Info</a>
                        </li>
                        <li class="">
                            <a href="#companycontacts" >Contacts</a>
                        </li> 
                        <li class="">
                            <a href="#cfiles" >Files & Media</a>
                        </li> 
                        <li class="">
                            <a href="#cexhibition" >Exhibitions</a>
                        </li> 
                        <li class="">
                            <a href="#cgallery">Gallery</a>
                        </li> 
                        <li class="">
                            <a href="#ctour" >Virtual Tour</a>
                        </li>   
                        <li class="">
                            <a href="#youtubegallery">YouTube</a>
                        </li>
						<li class="">
                            <a href="#rcmdtions">Recommendations</a>
                        </li>
						<li class="">
                            <a href="#linkedcompanies">Companies</a>
                        </li>						
                    </ul>
                </div>
            </div>
            <div class="updateprofile-tab">
                <div class="updateprofile-tab aligncenter">
                    <?php
                    $maximumPoints = 100;
                    $register = 1;
                    $documents = 1;
                    if (is_user_logged_in()) {
                        if ($register != "") {
                            $register = 30;
                            if ($documents != "") {
                                $documents = 10;
                            }
                            $percentage = ($register + $documents) * $maximumPoints / 100;
                            echo "Your Profile is " . $percentage . "% Completed";
                            echo "<div style='width:100%; background-color:white; height:28px; border:1px solid #000; margin-bottom: 20px;'>
                        <div style='width:" . $percentage . "%; background-color:#30c0d1; height:26px;'></div></div>";
                        }
                        ?>


    <?php if (isset($message) && !empty($message)) { ?>
                            <div class="notification <?php echo esc_attr($mType); ?> clearfix">
                                <div class="noti-icon">	</div>
                                <p><?php echo esc_html($message); ?></p>
                            </div>
    <?php }
}
?>

                    <form class="form-horizontal" id="supplierupdateform" action="" method="POST" enctype="multipart/form-data" data-lp-recaptcha="<?php echo wp_kses_post($enableCaptcha); ?>" data-lp-recaptcha-sitekey="<?php echo wp_kses_post($gSiteKey); ?>">
                        <div class="page-innner-container padding-40 lp-border lp-border-radius-8" id="companyinfo">
                            <div class="tab-header top-header-equal lp-update-password-outer margin-top-30">
                                <h3>Company Information</h3>
                                <p>Now let planners know how great you and add some detail about you.</p>
                            </div>
                            <div class="form-group">  
                                <div class="col-md-8">                           

                                    <div class="col-md-12">

                                        <label for="Fname">Page Heading</label>
                                        <input value="<?php echo esc_attr($heading); ?>" type="text" class="form-control" name="page_heading" id="Fname" />
                                    </div>

                                    <div class="col-md-12">
                                        <label for="Lname">Description</label>
                                        <textarea  class="form-control" name="desc" id="about" rows="8" placeholder="<?php esc_html_e('Write about youself', 'listingpro'); ?>"><?php echo esc_html($description); ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="uemail">Company Address</label>
                                        <textarea  class="form-control" name="address" id="about" rows="8" placeholder="<?php esc_html_e('Write about youself', 'listingpro'); ?>"><?php echo esc_html($address[0]); ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="phone">Company Phone</label>
                                        <input value="<?php echo esc_attr($pdata); ?>" type="text" class="form-control" name="phone" id="phone" placeholder="<?php echo esc_html__('+00-12345-7890', 'listingpro'); ?>" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="user-space user-avatar-upload lp-border-bottom padding-bottom-45">
                                        <div class="user-avatar-preview avatar-circle">
                                            <img class="author-avatar" src="<?php $imagelogo = wp_get_attachment_image_src($logo['0']);
echo $imagelogo['0']; ?>" alt="Company Logo" />
                                        </div>
                                        <div class="user-avatar-description avatar-coustome">
                                            <p class="paragraph-form">
                                                Company Logo<br>
                                            </p>
                                            <div class="upload-photo margin-top-25">
                                                <span class="file-input file-upload-btn btn-first-hover btn-file">
                                                    <?php echo esc_html__('Upload Photo', 'listingpro'); ?>&hellip; <input style="width:170px;" class="upload-logo-image" id="upload_logo_image" type="file" accept="image/*" />
                                                </span>
                                                <input class="criteria-image-url" id="logo_image_url" type="hidden" name="logo_image_url" style="display: none;" value="<?php if (isset($your_image_url)) {
                                                        echo esc_attr($your_image_url);
                                                    } ?>" />
                                                <input class="criteria-image-id" id="logo_image_id" type="hidden" name="logo_image_id" value="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="update-profile-button">
                                <div class="update_button">
                                    <input type="hidden" name="action" value="save_supplier_page_data">
                                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                                    <button class="lp-secondary-big-btn btn-first-hover" type ="button" id="savesupplierdata">Save</button>
                                    <button class="lp-secondary-big-btn cancel-btn" type ="button">Cancel</button>
                                    
                                </div>   
                            </div>

                        </div>
                    </form>
                    <div class="clearfix"></div>

                    <div class="clearfix margin-top-30"></div>
                    <form action="" method="POST" id="suppliercontactform">
                        <div class="page-innner-container padding-40 lp-border lp-border-radius-8" id="companycontacts">                        
                            <div class="tab-header top-header-equal lp-update-password-outer margin-top-30">
                                <h3>Company Contacts</h3>
                            </div>
                            <div class="form-group">
                                <div class="contactdivs">
                                    <?php
                                    $i = 0;
                                    foreach ($user as $users) {
                                        ?>
                                        <div class="col-md-3">

                                            <label for="cname"><?php echo 'Name'; ?></label>
                                            <input type="text" class="form-control" name="cname1" id="npassword" value='<?php echo $users->display_name ?>' />

                                            <label for="npassword"><?php echo 'Job'; ?></label>
                                            <input type="text" class="form-control" name="cjob1" id="cjob" value='<?php echo $users->old_jobTitle ?>'  />
                                            <label for="cmail">Email</label>
                                            <input type="text" class="form-control" name="cemail1" id="npassword" value='<?php echo $users->user_email ?>'  />
                                            <label for="cphone">Phone</label>
                                            <input type="text" class="form-control" name="cphone1" id="npassword" value='<?php echo $users->phone ?>' />

                                        </div>										
                                        <?php
                                        $i++;
                                    }
                                    if ($i < 4) {
                                        ?>
                                    </div>
                                    <input type="hidden" name="total_contact" id="total_contacts" value="<?php echo $i; ?>" />
                                    <div class="update_button" id="contactadddiv">
                              <button type="button" name="profileupdate" class="lp-secondary-big-btn btn-first-hover addContact">Add Contact</button>
                                    </div>
                                    <?php }
                                ?>
                            </div>							
                            <div class="clearfix"></div>
                            <div class="update_padding">
                                <div class="update_button">
                                    <input type="hidden" name="action" value="save_supplier_contacts_data">
                                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                                    <input type="hidden" name="oldspid" value="<?php echo $oldspid[0]; ?>">
                                    <button class="lp-secondary-big-btn btn-first-hover" type ="button" id="savesuppliercontacts">Save</button>
                                    <button class="lp-secondary-big-btn cancel-btn" type ="button">Cancel</button>
                                    
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix margin-top-30"></div>

                    <form action="" method="POST" id="companyfiles">
                        <div class="page-innner-container padding-40 lp-border lp-border-radius-8" id="cfiles">
                            <div class="tab-header top-header-equal lp-update-password-outer margin-top-30">
                                <h3>Company Files & Media</h3>
                                <p>
                                    Show planners what you can do for them and upload sales information e.g. sample programmes and floor plans. TIP: For Operational materials include risk assessments and insurance certificates.
                                </p>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="npassword">OPERATIONAL</label>
                                    
                                    <input type="file[]" class="form-control" name="upload_operational_docs" id="upload_operational_docs" placeholder="Documents" />
									<input class="criteria-image-url" id="exhibition_image_url" type="hidden" name="exhibition_image_url" style="display: none;" value="" />
                                    <input class="criteria-image-id" id="operational_docs_id" type="hidden" name="operational_docs_id" value="" />
								</div>
                                <div class="col-md-4">
                                    <label for="rnpassword">PROPOSAL & SALES</label>
                                    <input type="file" class="form-control" name="upload_sales_docs" id="upload_sales_docs" placeholder="Documents" />
									<input class="criteria-image-id" id="sales_docs_id" type="hidden" name="sales_docs_id" value="" />
                                </div>
                                <div class="col-md-4">
                                    <label for="rnpassword">HEALTH & SAFETY/COVID-19</label>
                                    <input type="file" class="form-control" name="upload_health_docs" id="upload_health_docs" placeholder="Documents" />
									<input class="criteria-image-id" id="health_docs_id" type="hidden" name="health_docs_id" value="" />
                                </div>
                            </div>							
                            <div class="clearfix"></div>
                            <div class="update-profile-button">
                                <div class="update_button">
                                    <input type="hidden" name="action" value="save_supplier_page_data">
                                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                                    <button class="lp-secondary-big-btn btn-first-hover" type ="button" id="savesupplierdata">Save</button>
                                    <button class="lp-secondary-big-btn cancel-btn" type ="button">Cancel</button>
                                    
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix margin-top-30"></div>

                    <form action="" method="POST" id="companyexhibitionform">
                        <div class="page-innner-container padding-40 lp-border lp-border-radius-8 cexhibition">
                            <div class="tab-header top-header-equal lp-update-password-outer margin-top-30">
                                <h3>Company Exhibitions</h3>
                                <p>Tell planners where they can meet you. TIP: Add details of your exhibition presence at IMEX Frankfurt/America The Meetings Show and ibtmWORLD..</p>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3" style="padding:0;">
                                    <label for="npassword">Exhibition Logo</label>
                                    <input type="file" class="form-control" name="exihibition_logo" id="upload_exihibition_image" placeholder="Logo" />
									<input class="criteria-image-url" id="exhibition_image_url" type="hidden" name="exhibition_image_url" style="display: none;" value="" />
                                    <input class="criteria-image-id" id="exhibition_image_id" type="hidden" name="exhibition_image_id" value="" />
									<img class="author-avatar" src="" id="exhibition_image_url" alt="Company Logo" />
                                </div>
                                <div class="col-md-9">
                                    <div class="col-md-6">
                                        <label for="rnpassword">Exhibition Title</label>
                                        <input type="text" class="form-control" name="exhb_title" id="rnpassword" placeholder="Exihibition Title" />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="rnpassword">Exhibition Link</label>
                                        <input type="text" class="form-control" name="exhb_link" id="rnpassword" placeholder="Exihibition Link" />
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-6">
                                        <label for="rnpassword">Exhibition Start Date</label>
                                        <input type="date" class="form-control" name="exhbstrtdate" id="rnpassword" placeholder="" />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="rnpassword">Exhibition End Date</label>
                                        <input type="date" class="form-control" name="exhbenddate" id="rnpassword" placeholder="" />
                                    </div>
                                </div>
                                <br /><br />
                                <div class="">
                                    <div class="update_button">
                                            <!--<input type="submit" name="profileupdate" value="Add Exhibition" class="lp-secondary-big-btn btn-first-hover">-->
                                        <button class="lp-secondary-big-btn btn-first-hover" type ="button" id="savesupplierexhibitions">Add Exhibition</button>
                                    </div>
                                </div>
								 <div id="show-exhibtions-div">
                        <?php
                            $get_all_exhib_query = "SELECT meta_value,meta_key FROM wp_2_postmeta WHERE `post_id` = " . $post_id . " AND `meta_key` LIKE 'old_exhibitionName%'";
                            $get_all_exhib_data = $wpdb->get_results($get_all_exhib_query);
                            $count = count((array) $get_all_exhib_data);

                            for ($p = 1; $p <= $count; $p++) {
                                $exhibition_data = get_post_meta($post_id);
                                $c = '';
                                $exhibitionname = get_post_meta($post_id, 'old_exhibitionName'.$p);
                                if($p == 1) {
                                    $c = '';
                                    $exhibitionstartdate = get_post_meta($post_id, 'old_startDate');
                                    $exhibitionenddate = get_post_meta($post_id, 'old_endDate');
                                } else {
                                    $c = $p;
                                    $exhibitionstartdate = get_post_meta($post_id, 'old_startDate'.$p);
                                    $exhibitionenddate = get_post_meta($post_id, 'old_endDate'.$p);
                                }

                                $get_meta_detail = $wpdb->get_results("SELECT `wp_2_postmeta`.`meta_id` FROM `wp_2_postmeta` WHERE `post_id` = '".$post_id."' AND `meta_key` = '" . 'old_exhibitionName'.$p . "' AND meta_value = '".$exhibitionname[0]."'");
                                $exhibition_metaID = $get_meta_detail[0]->meta_id;

                                $get_meta_detail1 = $wpdb->get_results("SELECT `wp_2_postmeta`.`meta_id` FROM `wp_2_postmeta` WHERE `post_id` = '".$post_id."' AND `meta_key` = '" . 'old_startDate'.$c . "' AND meta_value = '".$exhibitionstartdate[0]."'");
                                $exhibitionstartdate_metaID = $get_meta_detail1[0]->meta_id;

                                $get_meta_detail2 = $wpdb->get_results("SELECT `wp_2_postmeta`.`meta_id` FROM `wp_2_postmeta` WHERE `post_id` = '".$post_id."' AND `meta_key` = '" . 'old_endDate'.$c . "' AND meta_value = '".$exhibitionenddate[0]."'");
                                $exhibitionenddate_metaID = $get_meta_detail2[0]->meta_id;

                                print_r($exhibition_metaID . "<br>");
                                print_r($exhibitionstartdate_metaID . "<br>");
                                print_r($exhibitionenddate_metaID . "<br>");
                            ?>
                            <div class="col-md-12 exhibittion">
                                <table class="exhibittion-table">
                                    <tr>
                                        <td>
                                            <div class="exhibittion-2">
                                                <label for="rnpassword"><b>Exhibition Title</b></label> : <?php echo $exhibitionname[0]; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="exhibittion-2">
                                                <label for="rnpassword"><b>Exhibition Start Date</b></label> : <?php echo $exhibitionstartdate[0]; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="exhibittion-2">
                                                <label for="rnpassword"><b>Exhibition End Date</b></label> : <?php echo $exhibitionenddate[0]; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <button onclick="deleteSupplierExhibitiondata(<?php echo $post_id; ?>, <?php echo $exhibitionname[0]; ?>, <?php echo $exhibitionstartdate[0]; ?>, <?php echo $exhibitionenddate[0]; ?>)"><i class="fa fa-times" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <?php } ?>
                        </div>
                            </div>						
                            <div class="clearfix"></div>
                            <div class="update-profile-button">
                                <div class="update_button">
                                    <input type="hidden" name="action" value="sve">
                                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                                </div>
                            </div>							
                        </div>
                       
                    </form>
                    <div class="clearfix margin-top-30"></div>

                    <form action ="" method="POST" id="companygallery">
                        <div class="page-innner-container padding-40 lp-border lp-border-radius-8" id="cgallery">
                            <div class="tab-header top-header-equal lp-update-password-outer margin-top-30">
                                <h3>Photo Gallery</h3>
                                <p>Planners love detail and visual imagery. So don’t delay… Bring your destination or service to life with stunning photos. TIP ideal size up to 300KB to help faster page loading.</p>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="npassword">Add Photo</label>
                                    <input type="file" class="form-control" name="upload_gallery_image" id="upload_gallery_image" placeholder="Gallery" />
									<input class="criteria-image-url" id="gallery_image_url" type="hidden" name="gallery_image_url" style="display: none;" value="<?php if (isset($your_image_url)) {
                                                        echo esc_attr($your_image_url);
                                                    } ?>" />
                                                <input class="criteria-image-id" id="gallery_image_id" type="hidden" name="gallery_image_id" value="" />
                                </div>
                                <br /><br />
                                <div class="col-md-12">
                                    <div class="update_button">
                                        <input type="submit" name="profileupdate" value="Add Gallery" class="lp-secondary-big-btn btn-first-hover">
                                    </div>
                                </div>
                            </div>							
                            <div class="clearfix"></div>
                            <div class="update-profile-button">
                                <div class="update_button">
                                    <input type="hidden" name="action" value="save_supplier_page_data">
                                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix margin-top-30"></div>

                    <form action ="" method="POST" id="Virtual Tour">
                        <div class="page-innner-container padding-40 lp-border lp-border-radius-8" id="ctour">
                            <div class="tab-header top-header-equal lp-update-password-outer margin-top-30">
                                <h3>Virtual Tour</h3>
                                <p>Add your 3D (Matterport/Others) video to give planners a virtual tour.If you do not have a 3D virtual tour and world like one created, Please contact info@micebook.com</p>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="npassword">Virtual Tour</label>

                                    <input type="text" class="form-control" name="virtual_tour" id="npassword" placeholder="Virtual Tour" />
                                </div><br /><br />
                                <div class="col-md-12">
                                    <div class="update_button">
                                        <input type="submit" name="profileupdate" value="Add Virtual Tour" class="lp-secondary-big-btn btn-first-hover">
                                    </div>
                                </div>
                            </div>							
                            <div class="clearfix"></div>
                            <div class="update-profile-button">
                                <div class="update_button">
                                    <input type="hidden" name="action" value="save_supplier_page_data">
                                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix margin-top-30"></div>
                    <form action ="" method="POST" id="youtube-gallery">
                        <div class="page-innner-container padding-40 lp-border lp-border-radius-8" id="youtubegallery">
                            <div class="tab-header top-header-equal lp-update-password-outer margin-top-30">
                                <h3>Youtube Gallery</h3>
                                <p>If a picture paints a 1000 words, imagine what video could do...</p>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="npassword">Youtube Link</label>
                                    <input type="text" class="form-control" name="youtube_gallery" id="npassword" placeholder="Youtube Video Link" />
                                </div>
                                <br /><br />
                                <div class="">
                                    <div class="col-md-12">
                                        <div class="update_button">

        <!--<input type="submit" name="profileupdate" value="Add Youtube Link" class="lp-secondary-big-btn btn-first-hover">-->
                                            <input type="hidden" name="action" value="ytlink">
                                            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                                            <button class="lp-secondary-big-btn btn-first-hover" type ="button" id="saveyoutubelink">Add Youtube Link</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php
                        $get_youtubelink_query = "SELECT meta_value,meta_key FROM wp_2_postmeta WHERE `post_id` = " . $post_id . " AND `meta_key`  = 'old_youTubeGallery'";
                        $get_youtubelink_data = $wpdb->get_results($get_youtubelink_query);
                        
//                        echo '<pre>';                        print_r($get_youtubelink_data);die;
                        
                        $exp_youtubelink = explode(',',$get_youtubelink_data[0]->meta_value);
                        $y = 1;
                        
                        ?>
                                
                                <div class="col-md-12 exhibittion youtube_link" >
                                
                               <table class="exhibittion-table" id="show-ytl-div">
                                   
                               <?php 
                               
                               foreach ($exp_youtubelink as $yt) {
                               ?>    
                                   
                                   
                               <tr>
                               <td>
                                 <div class="exhibittion-2">
                                       
                          
                                    <label for="rnpassword"><b>Youtube Link <?php echo $y; ?></b></label> : <?php echo $yt; ?>
                                    </div>
                               
                               </td>
                               <td><a href="#" class="remove"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                               </tr>
                               <?php $y++; } ?> 
                               </table>
                               
                                </div>
                                
                               
                                
                            </div>							
                            <div class="clearfix"></div>
                            <div class="update-profile-button">
                                <div class="update_button">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix margin-top-30"></div>

                    <form action="" method="POST" id="recommendation">
                        <div class="page-innner-container padding-40 lp-border lp-border-radius-8  clearfix" id="rcmdtions">
                            <div class="tab-header top-header-equal lp-update-password-outer margin-top-30">
                                <h3>Recommendations</h3>
                                <p>Shout about your success here! Add up to 5 glowing recommendations from event planners. PLEASE NOTE you will need approval from the event planner to publish their words.</p>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="npassword">RECOMMENDATION HEADING</label>
                                    <input type="text" class="form-control" name="rheading" id="npassword" placeholder="Recommendation Heading" />
                                </div>
                                <div class="col-md-4">
                                    <label for="npassword">REVIEWER NAME</label>
                                    <input type="text" class="form-control" name="rname" id="npassword" placeholder="Reviewer name, Company" />
                                </div>
                                <div class="col-md-4">
                                    <label for="npassword">RATING</label>
                                    <input type="number" class="form-control" value=5 name="rating" min="0" max="5" />
                                </div>
                                <div class="col-md-12">
                                    <label for="npassword">Recommendations</label>									
                                    <textarea class="form-control" name="desc1" id="about" rows="8" name="rdata"></textarea>
                                </div> 

                                <div class="col-md-12">
                                    <div class="update_button">
                                        <input type="submit" name="profileupdate" value="Add Recommendation" class="lp-secondary-big-btn btn-first-hover">
                                    </div>                                           
                                </div>
                                <div class="clearfix"></div>
                                <div class="update-profile-button">
                                    <div class="update_button">
                                        <input type="hidden" name="action" value="save_supplier_page_data">
                                        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                                    </div>
                                </div>

                            </div>
                        </div>						
                        <div class="clearfix"></div>


                    </form>
                    <div class="clearfix margin-top-30"></div>

                    <form action="" method="POST" id="linked-companies">
                        <div class="page-innner-container padding-40 lp-border lp-border-radius-8" id="linkedcompanies">
                            <div class="tab-header top-header-equal lp-update-password-outer margin-top-30">
                                <h3>Linked Companies</h3>
                                <p>Work together! Link to registered micebook companies e.g. Representation Company to DMC or Hotel clients; GSO to Hotels. TIP: Ask them to link back to you.</p>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="npassword">Company Name</label>
                                    <input type="text" class="form-control" name="linked_company" id="npassword" placeholder="Enter company Name" />
                                </div>
                                <br /><br />
                                <div class="">
                                    <div class="col-md-12">
                                        <div class="update_button">
                                            <input type="hidden" name="action" value="linkedcompanies">
                                            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                                            <button class="lp-secondary-big-btn btn-first-hover" type ="button" id="savelinkedcompanies">Add Company</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="update-profile-button">
                                <div class="update_button">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- listingpro GDPR -->

                <!-- end listingpro GDPR -->
            </div>
        </div>
        <!-- end html for pdf -->

    </div>


</div>

</div>
<script>
    jQuery(document).on('click', '#savesupplierdata', function (event) { // use jQuery no conflict methods replace $ with "jQuery"

        event.preventDefault(); // stop post action
        var dataString = jQuery("#supplierupdateform").serialize();
        jQuery.ajax({
            type: "POST",
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: dataString,
            success: function (result) {
                alert(result)
            },
            error: function () {
                alert('error')
            },
        });
    });

    jQuery(document).on('click', '#savesuppliercontacts', function (event) { // use jQuery no conflict methods replace $ with "jQuery"

        event.preventDefault(); // stop post action
        var dataString = jQuery("#suppliercontactform").serialize();
        jQuery.ajax({
            type: "POST",
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: dataString,
            success: function (result) {
                console.log(result);
            },
            error: function () {
                alert('error')
            },
        });
    });
    jQuery(document).on('click', '#savesupplierexhibitions', function (event) { // use jQuery no conflict methods replace $ with "jQuery"

        event.preventDefault(); // stop post action
        var dataString = jQuery("#companyexhibitionform").serialize();
        jQuery.ajax({
            type: "POST",
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: dataString,
            success: function (result) {
//                console.log(result);
            jQuery('#show-exhibtions-div').append(result);
            },
            error: function () {
                alert('error');
            },
        });
    });
    jQuery(document).on('click', '#saveyoutubelink', function (event) { // use jQuery no conflict methods replace $ with "jQuery"

        event.preventDefault(); // stop post action
        var dataString = jQuery("#youtube-gallery").serialize();
        jQuery.ajax({
            type: "POST",
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: dataString,
            success: function (result) {
//                console.log(result);
                jQuery('#show-ytl-div').append(result);
            },
            error: function () {
                alert('error');
            },
        });
    });
    jQuery(document).on('click', '#savelinkedcompanies', function (event) { // use jQuery no conflict methods replace $ with "jQuery"

        event.preventDefault(); // stop post action
        var dataString = jQuery("#linked-companies").serialize();
        jQuery.ajax({
            type: "POST",
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: dataString,
            success: function (result) {
                console.log(result);
            },
            error: function () {
                alert('error');
            },
        });
    });

    jQuery('.addContact').on('click', addcontact);
    jQuery('.removeContact').on('click', removecontact);
    function addcontact()
    {
        var new_contacts_no = parseInt(jQuery('#total_contacts').val()) + 1;

        if (new_contacts_no <= 4)
        {
            var contactinput = "<div class='col-sm-3'><label for='cname'>Name</label><input type='text' class='form-control' name='cname" + new_contacts_no + "' id='npassword' /><label for=npassword>Job</label><input type='text' class='form-control' name='cjob" + new_contacts_no + "' id='cjob' /><label for='cmail'>Email</label><input type='text' class='form-control' name='cemail" + new_contacts_no + "'id='npassword' /><label for='cphone'>Phone</label><input type='text' class='form-control' name='cphone" + new_contacts_no + "' id='cphone' /></div>";
            jQuery('.contactdivs').append(contactinput);
            jQuery('#total_contacts').val(new_contacts_no);
            if (new_contacts_no == 4)
            {
                document.getElementById('contactadddiv').outerHTML = "";
            }
        } else
        {
            jQuery('#contactadddiv').html();
        }
    }
    function removecontact()
    {
        var last_chq_no = jQuery('#totalcontacts').val();

        if (last_chq_no > 1) {
            jQuery('#new_' + last_chq_no).remove();
            jQuery('#total_contacts').val(last_chq_no - 1);
        }
    }

    function deleteSupplierExhibitiondata($post_id, $meta_detail, $meta_key, $meta_value) {
        alert("Dummy");
    }
</script>
<!--updateprofile-->