<?php
	global $Mo2fdbQueries,$mainDir;
	$user = wp_get_current_user();
	$is_NC = MoWpnsUtility::get_mo2f_db_option('mo2f_is_NC', 'get_option');
	$is_customer_registered = get_option('mo_2factor_user_registration_status') == 'MO_2_FACTOR_PLUGIN_SETTINGS';

	$mo2f_feature_set = array(
		"Roles Based and User Based 2fa",
		"Role based Authentication Methods",
		"Force Two Factor",
		"Verification during 2FA Registration",
		"Language Translation Support",
		"Password Less Login",
		"Backup Methods",
		"Role based redirection",
		"Custom SMS Gateway",
		"App Specific Password from mobile Apps",
		"Brute Force Protection",
		"IP Blocking",
		"Monitoring",
		"Strong Password",
		"File Protection"
	);

	$mo2f_addons_set		=	array(
		"RBA & Trusted Devices Management",
		"Personalization",		                 
		"Short Codes"  
	);
	$mo2f_addons           	= array(
		"RBA & Trusted Devices Management" 	=> array( true, true,  false, true ),
		"Personalization"					=> array( true, true,  false, true ),
		"Short Codes"						=> array( true, true,  false, true )
	);
	$mo2f_addons_description_set	=array(
		"Remember Device, Set Device Limit for the users to login, IP Restriction: Limit users to login from specific IPs.",
		"Custom UI of 2FA popups Custom Email and SMS Templates, Customize 'powered by' Logo, Customize Plugin Icon, Customize Plugin Name",
		"Option to turn on/off 2-factor by user, Option to configure the Google Authenticator and Security Questions by user, Option to 'Enable Remember Device' from a custom login form, On-Demand ShortCodes for specific fuctionalities ( like for enabling 2FA for specific pages)",
	);
if (sanitize_text_field($_GET['page']) == 'mo_2fa_upgrade') {
	?><br><br><?php
}
echo '
<a class="mo2f_back_button" style="font-size: 16px; color: #000;" href="'.esc_url($two_fa).'"><span class="dashicons dashicons-arrow-left-alt" style="vertical-align: bottom;"></span> Back To Plugin Configuration</a>';
?>
<br><br>

<?php
	wp_register_style('mo2f_upgrade_css',$mainDir.'/includes/css/upgrade.css',[],MO2F_VERSION );
	wp_register_style('mo2f_font_awesome','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css',[],MO2F_VERSION);
	wp_enqueue_style('mo2f_upgrade_css');
	wp_enqueue_style('mo2f_font_awesome');

 global $imagePath;
 
?>

	<?php 
	if( get_option("mo_wpns_2fa_with_network_security"))
		{
			?>
			<div class="mo_upgrade_toggle">
				<p class="mo_upgrade_toggle_2fa">
				<input type="radio" name="sitetype" value="Recharge" id="mo2f_2fa_plans" onclick="show_2fa_plans();" style="display: none;">
				<label for="mo2f_2fa_plans" class="mo2f_upgrade_toggle_lable" id="mo_2fa_lite_licensing_plans_title" style="display: none;">&nbsp;&nbsp;&nbsp;2-Factor Authentication</label>
				<label for="mo2f_2fa_plans" class="mo2f_upgrade_toggle_lable mo2f_active_plan" id="mo_2fa_lite_licensing_plans_title1" style="display: block;">&nbsp;&nbsp;&nbsp;2-Factor Authentication</label>
				<input type="radio" name="sitetype" value="Recharge" id="mo2f_ns_plans" onclick="mo_ns_show_plans();" style="display: none;">
				<label for="mo2f_ns_plans" class="mo2f_upgrade_toggle_lable" id="mo2f_ns_licensing_plans_title">Website Security</label>
				<label for="mo2f_ns_plans" class="mo2f_upgrade_toggle_lable mo2f_active_plan" id="mo_ns_licensing_plans_title1" style="display: none;">Website Security</label>
				</p>
			</div>
			<?php
		}
?>
<span class="cd-switch"></span>



<section class="mo2fa-popup-overlay">
  <!-- BASIC/PERSONAL 2FA  -->
  <div id="mo2fa-basic-personal-plan" class="mo2f-overlay">
    <div class="popup">
      <a href="#pricing"
        onclick="mo_hide_popup_feature('mo2fa-basic-personal-plan')"
        class="mo2fa-close-btn"
      ></a>
   
        <h2 class="mo2fa-popup-title">Features</h2>
        <ul class="mo2fa-ul-list">
        
          <li class="mo-api-license-li feature-item">
            TOTP Based Methods</br>

             Google Authenticator</br>
             Microsoft Authenticator<br>
             Authy Authenticator</br>
             LastPass Authenticator</br>
             Duo Authenticator
          </li>
        
          <li class="mo-api-license-li feature-item">
            2FA Code Over Email
          </li>
          <li class="mo-api-license-li feature-item">
            2FA Code Over SMS<sup>*</sup><a href="https://plugins.miniorange.com/sms-and-email-transaction-pricing-2fa" target="_blank">Charges Apply</a>

          </li>
        </ul>
      
    </div>
  </div>

  <!-- 2FA FOR LMS  -->
  <div id="mo2fa-lms-plan" class="mo2f-overlay">
    <div class="popup">
      <a
        href="#pricing"
        onclick="mo_hide_popup_feature('mo2fa-lms-plan')"
        class="mo2fa-close-btn"
      ></a>

    
        <h2 class="mo2fa-popup-title">Features</h2>
        <ul class="mo2fa-ul-list" style="padding:10px 0 10px 0px;">
     

        <li class="mo-api-license-li feature-item">
                QR Code Authentication/Push Notification
        </li>
       
        <li class="mo-api-license-li feature-item">
          TOTP Based Methods</br>

           Google Authenticator</br>
           Microsoft Authenticator<br>
           Authy Authenticator</br>
           LastPass Authenticator</br>
           Duo Authenticator
        </li>
          <li class="mo-api-license-li feature-item">
           Configurable code length and Expiration time
          </li>
          </ul>
      
    </div>
  </div>

  <!-- 2FA FOR MEMBERSHIP  -->
  <div id="mo2fa-membership-plan" class="mo2f-overlay">
    <div class="popup">
      <a
        href="#pricing"
        onclick="mo_hide_popup_feature('mo2fa-membership-plan')"
        class="mo2fa-close-btn"
      ></a>

   
        <h2 class="mo2fa-popup-title">Features</h2>
        <ul class="mo2fa-ul-list">
          
          <li class="mo-api-license-li feature-item">
            Single-site Compatible
          </li>
          <li class="mo-api-license-li feature-item">
            White labelling
          </li>
          <li class="mo-api-license-li feature-item">
            TOTP Based Method </br>
          Google Authenticator</br>
             Microsoft Authenticator<br>
             Authy Authenticator</br>
             LastPass Authenticator</br>
             Duo Authenticator
          </li>
          <li class="mo-api-license-li feature-item">
            2FA Code Over SMS<sup>*</sup><a href="https://plugins.miniorange.com/sms-and-email-transaction-pricing-2fa" target="_blank">Charges Apply</a>
          </li>
          <li class="mo-api-license-li feature-item">
           2FA Code Over Email
          </li>
          <li class="mo-api-license-li feature-item">
            Role-Based 2FA 
          </li>
         
          <li class="mo-api-license-li feature-item">Custom Redirection Url</li>
          <li class="mo-api-license-li feature-item">Blackup Login Methods</li>
          <li class="mo-api-license-li feature-item">2FA Code Over Telegram</li>
        
        </ul>
     
    </div>
  </div>

  <!-- 2FA FOR ECOMMERCE  -->
  <div id="mo2fa-ecommerce-plan" class="mo2f-overlay">
    <div class="popup">
      <a href="#pricing" onclick="mo_hide_popup_feature('mo2fa-ecommerce-plan')"
        class="mo2fa-close-btn"></a>

    
        <h2 class="mo2fa-popup-title">Features</h2>
        <ul class="mo2fa-ul-list">
          <li class="mo-api-license-li feature-item">
           Single-site Compatible 
          </li>
          <li class="mo-api-license-li feature-item">
            White labelling
          </li>
          <li class="mo-api-license-li feature-item">
            TOTP Based Methods</br>
            Google Authenticator</br>
             Microsoft Authenticator<br>
             Authy Authenticator</br>
             LastPass Authenticator</br>
             Duo Authenticator
          </li>
          <li class="mo-api-license-li feature-item">
            2FA Code Over Email
          </li>
          <li class="mo-api-license-li feature-item">
            2FA Code Over SMS<sup>*</sup><a href="https://plugins.miniorange.com/sms-and-email-transaction-pricing-2fa" target="_blank">Charges Apply</a>

          </li>
          <li class="mo-api-license-li feature-item">
            Role-Based 2FA
          </li>
          <li class="mo-api-license-li feature-item">
           OTP Over Telegram
          </li>
          <li class="mo-api-license-li feature-item">OTP Over Whatsapp</li>
          <li class="mo-api-license-li feature-item">Custom SMS Gateway</li>
        </ul>
    </div>
  </div>

  <!-- All INCLUSIVE/BUSINESSES  -->
  <div id="mo2fa-inclusive-plan" class="mo2f-overlay">
    <div class="popup">
      <a
        href="#pricing"
        onclick="mo_hide_popup_feature('mo2fa-inclusive-plan')"
        class="mo2fa-close-btn"
      ></a>

    
        <h2 class="mo2fa-popup-title">Features</h2>
        <ul class="mo2fa-ul-list">
          <li class="mo-api-license-li feature-item">
           Single-site Compatible
          </li>
          <li class="mo-api-license-li feature-item">
            White Labelling
           </li>
           <li class="mo-api-license-li feature-item">
            Remember Device
           </li>
           <li class="mo-api-license-li feature-item">
            Role-Based 2FA
          </li>
          <li class="mo-api-license-li feature-item">
           All TOTP Based Methods</br>
          </li>
          <li class="mo-api-license-li feature-item">
            2FA Code Over Email
          </li>
          <li class="mo-api-license-li feature-item">
            2FA Code Over SMS<sup>*</sup><a href="https://plugins.miniorange.com/sms-and-email-transaction-pricing-2fa" target="_blank">Charges Apply</a>

          </li>
          <li class="mo-api-license-li feature-item">Backup Login Method</li>
          <li class="mo-api-license-li feature-item">Custom Redirection Url</li>
          <li class="mo-api-license-li feature-item">Passwordless Login</li>
          <li class="mo-api-license-li feature-item">
            2FA via Telegram
          </li>
          <li class="mo-api-license-li feature-item">
            2FA via WhatsApp
          </li>
          <li class="mo-api-license-li feature-item">
            Custom SMS Gateway
          </li>
        </ul>
      
    </div>
  </div>

</section>



<div class="mo2fa-pricing-section">
    
<div class="mo2fa-pricing-div">
        <h4 class="mo2fa-pricing-heading">Personal 2FA</h4><sub class="mo2fa-sub-heading">For individual requirement</sub>

        <p class="mo2fa-pricing-para">
        2FA For 100 Users
        <br>
        Role-Based 2FA 
        <br>
         Backup Login Methods<span class="mo2fa_12_tooltip_methodlist"><i class="fa fa-info-circle fa-xs" aria-hidden="true"></i>
          <span class="mo2fa_methodlist">
            Security Questions(KBA)<br>
            OTP Over Email<br>
            Backup Codes
              </span>
        </span>
      </p>
        <div class="mo2fa-text-center">
      <button
        onclick="mo_show_popup_feature('mo2fa-basic-personal-plan')"
        class="mo2fa-circle-wrapper"
      >
        <i class="fas fa-plus fa-xx"></i>
      </button>
    </div>
    
    <div class="one-row-price">
      
      
    <div class="item-one">
    <p class="mt"><span class="mo2f-display-1"><span>$</span><span id="dollar_mo_basic_price" class="mo_premium_price">99</span>/year<sup>*</sup></span></span></p>
  
  </div>
   <div class="item-two">
       
             <div class="container-dropdown discount-price">
                 <div class="select-dropdown">
                     <select class="dropdown-width mo2f-inst-btn2" id="mo_basic_price"
                         onchange="update_site('mo_basic_price')">
                         <option value="99" data-price="99"> 1 SITE </option>
                         <option value="179" data-price="179"> 2 SITES</option>
                         <option value="299" data-price="299"> 5 SITES</option>
                         <option value="499" data-price="499"> 10 SITES</option>
                         <option value="599" data-price="599"> 25 SITES</option>
                     </select>

                  
                     </div>
                     </div>
     </div>
     
    </div>
  <div class="text-align">
        

     <center>
									<div id="mo2fa_custom_my_plan_2fa_mo">
												<?php	if( isset($is_customer_registered) && $is_customer_registered) { ?>
												<a onclick="mo2f_upgradeform('wp_security_two_factor_basic_plan','2fa_plan')" target="blank" class="license-btn-2fa-premise mo2f-license-btn-2fa">UPGRADE NOW</a>
												<?php }else{ ?>
												<a onclick="mo2f_register_and_upgradeform('wp_security_two_factor_basic_plan','2fa_plan')" target="blank"class=" license-btn-2fa-premise mo2f-license-btn-2fa">UPGRADE NOW</a>
												<?php }?>
									</div>
                        </div>
		 </center>	

    </div>
    
    <div class="mo2fa-pricing-div">
        <h4 class="mo2fa-pricing-heading">2FA For LMS
        </h4><sub class="mo2fa-sub-heading">For e-learning sites</sub>
        
        <p class="mo2fa-pricing-para"> 
            
            For Unlimited Sites
            <br>
            Session Restriction
            <br>
            Prevent Credential Sharing<span class="mo2fa_15_tooltip_methodlist"><i class="fa fa-info-circle fa-xs" aria-hidden="true"></i>
              <span class="mo2fa_methodlist">
                        Credential sharing is prevented through QR code authentication.
                  </span>
            </span>
          </p>
             <div class="mo2fa-text-center">
              <button
                onclick="mo_show_popup_feature('mo2fa-lms-plan')"
                class="mo2fa-circle-wrapper"
              >
                <i class="fas fa-plus fa-xx"></i>
              </button>
            </div>   
          
           <div class="one-row-price">
      
            <div class="item-one">
            <p class="mt"><span class="mo2f-display-1"><span>$</span><span  id="dollar_mo_lms_price" class="mo_premium_price">59</span>/year<sup>*</sup></span></span></p> 
          
          </div>
          <div class="item-two">
       
            <div class="container-dropdown discount-price">
                <div class="select-dropdown">
                                
                    <select class="dropdown-width mo2f-inst-btn2" id="mo_lms_price"
                                    onchange="update_site('mo_lms_price')">
                                    <option value="59" data-price="59"> 5 USERS </option>
                                    <option value="78" data-price="78"> 10 USERS</option>
                                    <option value="98" data-price="98"> 25 USERS</option>
                                    <option value="128" data-price="128"> 50 USERS</option>
                                    <option value="228" data-price="228"> 100 USERS</option>
                                    <option value="378" data-price="378"> 500 USERS</option>
                                    <option value="528" data-price="528"> 1000 USERS</option>
                                    <option value="878" data-price="878"> 5000 USERS</option>
                                    <option value="1028" data-price="1028"> 10000 USERS</option>
                                    <option value="1478" data-price="1478"> 20000 USERS</option>
                                </select>
                          </div>
                                </div>
            </div>
            
                 </div>     
                 <div class="text-align">
                  
                <center>
									<div id="mo2fa_custom_my_plan_2fa_mo">
												<?php	if( isset($is_customer_registered) && $is_customer_registered) { ?>
												<a onclick="mo2f_upgradeform('wp_2fa_lms_plan','2fa_plan','2fa_plan')" target="blank" class="license-btn-2fa-premise mo2f-license-btn-2fa">UPGRADE NOW</a>
												<?php }else{ ?>
												<a onclick="mo2f_register_and_upgradeform('wp_2fa_lms_plan','2fa_plan')" target="blank"class="license-btn-2fa-premise mo2f-license-btn-2fa">UPGRADE NOW</a>
												<?php }?>
									</div>
                        </div>
		        </center>	

          </div>

    <div class="mo2fa-pricing-div">
        <h4 class="mo2fa-pricing-heading">2FA For Membership</h4>
        <sub class="mo2fa-sub-heading">For membership sites</sub>
        
        <p class="mo2fa-pricing-para">

          For Unlimited Users
            <br>
            Role-Based 2FA And Custom Redirect Url
            <br>
            Session Restriction And Remember Device <span class="mo2fa_1_tooltip_methodlist"><i class="fa fa-info-circle fa-xs" aria-hidden="true"></i>
              <span class="mo2fa_methodlist">
                       2FA is skipped for the remembered device.
                  </span>
            </span></p>

            <div class="mo2fa-text-center">
              <button
                onclick="mo_show_popup_feature('mo2fa-membership-plan')"
                class="mo2fa-circle-wrapper"
              >
                <i class="fas fa-plus fa-xx"></i>
              </button>
            </div>
            
         <div class="one-row-price">

            <div class="item-one">
               <p class="mt"><span class="mo2f-display-1"><span>$</span><span id="dollar_mo_membership_price" class="mo_premium_price">199</span>/year<sup>*</sup></span></span><br></p>
            </div>
            
        <div class="item-two">
             <div class="container-dropdown discount-price">
                 <div class="select-dropdown">
                     <select class="dropdown-width mo2f-inst-btn2" id="mo_membership_price"
                         onchange="update_site('mo_membership_price')">
                         <option value="199" data-price="199"> 1 SITE </option>
                         <option value="299" data-price="299"> 2 SITES</option>
                         <option value="499" data-price="499"> 5 SITES</option>
                         <option value="799" data-price="799"> 10 SITES</option>
                         <option value="1599" data-price="1599"> 25 SITES</option>
                     </select>

                  </div>   
                    </div>
                     </div>
        </div>
    
     
     <div class="text-align">

        <center>
									<div id="mo2fa_custom_my_plan_2fa_mo">
												<?php	if( isset($is_customer_registered) && $is_customer_registered) { ?>
												<a onclick="mo2f_upgradeform('wp_security_two_factor_membership_plan','2fa_plan')" target="blank" class="license-btn-2fa-premise mo2f-license-btn-2fa">UPGRADE NOW</a>
												<?php }else{ ?>
												<a onclick="mo2f_register_and_upgradeform('wp_security_two_factor_membership_plan','2fa_plan')" target="blank"class="license-btn-2fa-premise mo2f-license-btn-2fa">UPGRADE NOW</a>
												<?php }?>
									</div>
                        </div>
		        </center>	


    </div>

    <div class="mo2fa-pricing-div">
    <h4 class="mo2fa-pricing-heading">2FA For Ecommerce</h4><sub class="mo2fa-sub-heading">For e-commerce website</sub>
    
    <p class="mo2fa-pricing-para">
       
      For Unlimited Users <br>
      2FA On Checkout Forms
      <br>
      Remember Device<br>
      Passwordless Login <span class="mo2fa_tooltip_methodlist"><i class="fa fa-info-circle fa-xs" aria-hidden="true"></i>
        <span class="mo2fa_methodlist">
                Passwordless Login with Phone
            </span>
      </span>
    </p>
    <div class="mo2fa-text-center">
      <button
        onclick="mo_show_popup_feature('mo2fa-ecommerce-plan')"
        class="mo2fa-circle-wrapper">
        <i class="fas fa-plus fa-xx"></i>
      </button>
    </div>
   
    <div class="one-row-price">    
       <div class="item-one"> 
                        
            <p class="mt"><span class="mo2f-display-1"><span>$</span><span id="dollar_mo_ecommerce_price" class="mo_premium_price">199</span>/year<sup>*</sup></span></span><br></p> 
       </div>

      <div class="item-two">
              
                    <div class="container-dropdown discount-price">
                        <div class="select-dropdown">
                            <select class="dropdown-width mo2f-inst-btn2" id="mo_ecommerce_price"
                                onchange="update_site('mo_ecommerce_price')">
                                <option value="199" data-price="199"> 1 SITE </option>
                                <option value="299" data-price="299"> 2 SITES</option>
                                <option value="499" data-price="499"> 5 SITES</option>
                                <option value="799" data-price="799"> 10 SITES</option>
                                <option value="1599" data-price="1599"> 25 SITES</option>
                            </select>
                          </div>
                            </div>
      </div>
   </div>

         <div class="text-align">     

          <center>
									<div id="mo2fa_custom_my_plan_2fa_mo">
												<?php	if( isset($is_customer_registered) && $is_customer_registered) { ?>
												<a onclick="mo2f_upgradeform('wp_security_two_factor_ecommerce_plan','2fa_plan')" target="blank" class="license-btn-2fa-premise mo2f-license-btn-2fa">UPGRADE NOW</a>
												<?php }else{ ?>
												<a onclick="mo2f_register_and_upgradeform('wp_security_two_factor_ecommerce_plan','2fa_plan')" target="blank"class="license-btn-2fa-premise mo2f-license-btn-2fa">UPGRADE NOW</a>
												<?php }?>
									</div>
                        </div>
		        </center>	

    </div>

    <div class="mo2fa-pricing-div">

        <h4 class="mo2fa-pricing-heading">All Inclusive/Business</h4><sub class="mo2fa-sub-heading">For big businesses</sub>
        
       <p class="mo2fa-pricing-para twofa-para-contactus">
        For Unlimited Users<br> All features in Basic 2FA, Ecommerce 2FA And<br> Membership 2FA plan
        <br> AJAX Login form support
        </p>

        <div class="mo2fa-text-center">
          <button
            onclick="mo_show_popup_feature('mo2fa-inclusive-plan')"
            class="mo2fa-circle-wrapper"
          >
            <i class="fas fa-plus fa-xx"></i>
          </button>
        </div>
 
        <div class="one-row-price">
         
           <div class="item-one">                  
              <p class="mt"><span class="mo2f-display-1"><span>$</span><span id="dollar_mo_all_inclusive_price" class="mo_premium_price">249</span>/year<sup>*</sup></span></span><br></p> 
           </div>
         
           <div class="item-two">
                        <div class="container-dropdown discount-price">
                            <div class="select-dropdown">
                                <select class="dropdown-width mo2f-inst-btn2" id="mo_all_inclusive_price"
                                    onchange="update_site('mo_all_inclusive_price')">
                                    <option value="249" data-price="249"> 1 SITE </option>
                                    <option value="349" data-price="349"> 2 SITES</option>
                                    <option value="549" data-price="549"> 5 SITES</option>
                                    <option value="849" data-price="849"> 10 SITES</option>
                                    <option value="1649" data-price="1649"> 25 SITES</option>
                                </select>
    
                                </div>
                                </div>
           </div>
        </div>

            <div class="text-align">
            <center>
									<div id="mo2fa_custom_my_plan_2fa_mo">
												<?php	if( isset($is_customer_registered) && $is_customer_registered) { ?>
												<a onclick="mo2f_upgradeform('wp_security_two_factor_business_plan','2fa_plan')" target="blank" class="license-btn-2fa-premise mo2f-license-btn-2fa">UPGRADE NOW</a>
												<?php }else{ ?>
												<a onclick="mo2f_register_and_upgradeform('wp_security_two_factor_business_plan','2fa_plan')" target="blank"class="license-btn-2fa-premise mo2f-license-btn-2fa">UPGRADE NOW</a>
												<?php }?>
									</div>
                        </div>
		        </center>	


     </div>
	 
    <div class="mo2fa-pricing-div">
            <h4 class="mo2fa-pricing-heading">Custom Plan</h4>
            <p class="mo2fa-pricing-para tfa-pricing-para-contact-us">
              Nothing out here matches your requirement?<br>
                 Don't worry, we've got you covered.<br>
                 Contact us for custom solutions<br>tailor-made for your requirements.
             
            </p>
                <div class="mo2fa-text-center">
                <center>
                    <img class="mo2f-pricing-image" src="<?php echo esc_url($imagePath).'includes'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'custom-pricing-plan.png' ?>" >
                </center>
                </div>
                <div class="text-align">
             <a href="https://mail.google.com/mail/u/0/?fs=1&amp;tf=cm&amp;source=mailto&amp;su=Two+Factor+Authentication+Plugin+-+WP+2FA+Customized+Plugin+Request.&amp;to=2fasupport@xecurify.com&amp;body=I+want+to+request+for+customized+2FA+plugin+plan.+" target="_blank" rel="nofollow" class="license-btn-2fa-premise-call-us">Contact Us</a>
             </div>
     </div>
     <div class="bottom-shapes">
    </div> 
</div> 



 <form style="display:none;" id="mo2fa_loginform" action="https://login.xecurify.com/moas/login" target="_blank" method="post">
        <input type="text" name="redirectUrl" value="https://login.xecurify.com/moas/initializepayment">
        <input type="text" name="requestOrigin" id="requestOrigin" value="">
    </form>

 <script>
  
    
 

jQuery("dollar_mo_basic_price").click();
jQuery("dollar_mo_lms_price").click();
jQuery("dollar_mo_membership_price").click();
jQuery("dollar_mo_ecommerce_price").click();
jQuery("dollar_mo_all_inclusive_price").click();

		function update_site(plan_name) {
              
                  
		var sites = document.getElementById(plan_name).value;
              
	        var users_addion = parseInt(sites);
               
                document.getElementById("dollar_"+plan_name).innerHTML = + users_addion;

          }
 function mo2f_upgradeform(planType,planname) 
                {
                    jQuery('#requestOrigin').val(planType);
                    jQuery('#mo2fa_loginform').submit();
                    
                }

    function mo_show_popup_feature(popup_id) {
      document.getElementById(popup_id).style.visibility = "visible";
      document.getElementById(popup_id).style.opacity = "1";
    }
    function mo_hide_popup_feature(popup_id) {
      document.getElementById(popup_id).style.opacity = "0";
      document.getElementById(popup_id).style.visibility = "hidden";
}
            
function showData(e){
            
                var parent = e.parentElement
                var x = GetElementInsideContainer(parent, "plugin-features");
               var H = document.createElement("i");
      
           let childarry=e.childNodes
                let childelement=childarry[1]; 
                    if(x.style.display == "none"){
                        x.style.display = "block";
                     H.setAttribute("class","fa fa-minus-circle");
                      
  
       e.replaceChild(H,childarry[1]);
    


                    }else{
                        x.style.display = "none";
                        H.setAttribute("class","fa fa-plus-circle");
                        e.replaceChild(H,childarry[1]);
                       
                      
                    }
}

function GetElementInsideContainer(parentElement, childID) {
    var elm = {};
    var elms = parentElement.getElementsByTagName("*");
    for (var i = 0; i < elms.length; i++) {
        if (elms[i].id === childID) {
            elm = elms[i];
            break;
        }
    }
    return elm;
}

</script>
<center>
        <div class="mo2fa-plan-comparision-outer-box">

          <h2 class="mo2fa-pricing-heading">Plan Comparison</h2>
          <br>                        
          <div class="plan-comparison">
            <table class="mo2fa-comparision-table-pricing">
              <thead>
                <tr class="table-heading-border">
                  <th class="mo2fa-table-heading">Features</th>
                  <th class="mo2fa-table-heading-one">Personal 2FA</th>
                  <th class="mo2fa-table-heading-one">2FA For Learning Management System</th>
                  <th class="mo2fa-table-heading-two">2FA For Membership</th>
                  <th class="mo2fa-table-heading-two">2FA For Ecommerce</th>
                  <th class="mo2fa-table-heading-two">All Inclusive/Business</th>
                </tr>
              </thead>
                <tbody>
                <tr class="table-row">
                  <td class="mo2fa-column-first">
                    <div>&nbsp;&nbsp;Unlimited Sites</div>
                  </td>
                  <td class="table-checks mo2fa-column-second">
                    <i class="fa fa-times"></i>
                  </td>
                  <td class="table-checks mo2fa-column-second">
                    <i class="fa fa-check"></i>
                  </td>
                  <td class="table-checks mo2fa-column-third">
                    <i class="fa fa-times"></i>
                  </td>
                  <td class="table-checks mo2fa-column-third">
                    <i class="fa fa-times"></i>
                  </td>
                  <td class="table-checks mo2fa-column-third">
                    <i class="fa fa-times"></i>
                  </td>
                </tr>
                <tr class="table-row">
                  <td class="mo2fa-column-first">
                    <div> &nbsp;&nbsp;Unlimited Users </div>
                  </td>
                  <td class="table-checks mo2fa-column-second">
                    For 100 Users
                  </td>
                  <td class="table-checks mo2fa-column-second">
                    <i class="fa fa-times"></i>
                  </td>
                  <td class="table-checks mo2fa-column-third">
                    <i class="fa fa-check"></i>
                  </td>
                  <td class="table-checks mo2fa-column-third">
                    <i class="fa fa-check"></i>
                  </td>
                  <td class="table-checks mo2fa-column-third">
                    <i class="fa fa-check"></i>
                  </td>
                </tr>
                <tr class="table-row">
                  <td colspan="6">
                    <div class="plugin-data" id="plugin-data" onclick="showData(this)">
                      <i class="fa fa-plus-circle table-plus-icon" aria-hidden="true" style="display:contents"></i>
                      &nbsp;&nbsp;Authentication Methods 
                    </div>
                    <div id="plugin-features" class="plugin-features-class" style="display: none;">
                      <table class="add-on-table">
                        <tr class="table-row">
                          <th class="table-row mo2fa-table-heading"></th>
                          <th class="table-row mo2fa-table-heading-one"></th>
                          <th class="table-row mo2fa-table-heading-one"></th>
                          <th class="table-row mo2fa-table-heading-two"></th>
                          <th class="table-row mo2fa-table-heading-two"></th>
                          <th class="table-row mo2fa-table-heading-two"></th>
                        </tr>

                        
                        <tr class="table-row">
                          <td class="mo2fa-column-first">
                            <div class="plugin-data TOTP Based Authenticators" id="plugin-data" onclick="showData(this)">
                              <i class="fa fa-plus-circle table-plus-icon-one" aria-hidden="true" style="display:contents"></i>
                              &nbsp;&nbsp;TOTP Based Authenticators
                            </div>
                            <div id="plugin-features" class="plugin-features-class" style="display: none;">
                              <ul>
                                <li>Google Authenticator</li>
                                <li> Microsoft Authenticator</li>
                                <li>Authy Authenticator</li>
                                <li>LastPass Authenticator</li>
                                <li>Duo Authenticator</li>
                              </ul>
                            </div>
                          </td>
                          <td class="table-checks mo2fa-column-second"><i class="fa fa-check"></i></td>
                          <td class="table-checks mo2fa-column-second"><i class="fa fa-check"></i></td>
                          <td class="table-checks mo2fa-column-third"><i class="fa fa-check"></i></td>
                          <td class="table-checks mo2fa-column-third"><i class="fa fa-check"></i></td>
                          <td class="table-checks mo2fa-column-third"><i class="fa fa-check"></i></td>
                        </tr> 

                        <tr class="table-row">
                          <td class="mo2fa-column-first">Security Questions</td>
                          <td class="table-checks mo2fa-column-second"><i class="fa fa-check"></i></td>
                          <td class="table-checks mo2fa-column-second"><i class="fa fa-check"></i></td>
                          <td class="table-checks mo2fa-column-third"><i class="fa fa-check"></i></td>
                          <td class="table-checks mo2fa-column-third"><i class="fa fa-check"></i></td>
                          <td class="table-checks mo2fa-column-third"><i class="fa fa-check"></i></td>
                        </tr>
                        <tr class="table-row">
                          <td class="mo2fa-column-first">Email Verification</td>
                          <td class="table-checks mo2fa-column-second"><i class="fa fa-check"></i></td>
                          <td class="table-checks mo2fa-column-second"> <i class="fa fa-check"></i></td>
                          <td class="table-checks mo2fa-column-third"> <i class="fa fa-check"></i></td>
                          <td class="table-checks mo2fa-column-third"> <i class="fa fa-check"></i></td>
                          <td class="table-checks mo2fa-column-third"> <i class="fa fa-check"></i></td>
                        </tr>
                        <tr class="table-row">
                          <td class="mo2fa-column-first">OTP Over Email</td>
                          <td class="table-checks mo2fa-column-second"> <i class="fa fa-check"></i></td>
                          <td class="table-checks mo2fa-column-second"> <i class="fa fa-check"></i></td>
                          <td class="table-checks mo2fa-column-third"> <i class="fa fa-check"></i></td>
                          <td class="table-checks mo2fa-column-third"> <i class="fa fa-check"></i></td>
                          <td class="table-checks mo2fa-column-third"> <i class="fa fa-check"></i></td>
                        </tr>
                        <tr class="table-row">
                          <td class="mo2fa-column-first">OTP Over SMS</td>
                          <td class="table-checks mo2fa-column-second"> <i class="fa fa-check"></i></td>
                          <td class="table-checks mo2fa-column-second"> <i class="fa fa-check"></i></td>
                          <td class="table-checks mo2fa-column-third"> <i class="fa fa-check"></i></td>
                          <td class="table-checks mo2fa-column-third"> <i class="fa fa-check"></i></td>
                          <td class="table-checks mo2fa-column-third"> <i class="fa fa-check"></i></td>
                        </tr>
                        <tr class="table-row">
                          <td>
                            <div class="plugin-data" id="plugin-data" onclick="showData(this)">
                              <i class="fa fa-plus-circle table-plus-icon" aria-hidden="true" style="display:contents"></i>&nbsp;&nbsp;miniOrange Authenticator
                            </div>
                            <div id="plugin-features" class="plugin-features-class" style="display: none;">
                              <ul>
                                <li>Soft Token Code</li>
                                <li>QR Code Authentication</li>
                                <li>Push Notifications</li>
                              </ul>
                            </div>
                          </td>
                          <td class="table-checks">  <i class="fa fa-times"></i></td>
                          <td class="table-checks">  <i class="fa fa-check"></i></td>
                          <td class="table-checks">  <i class="fa fa-times"></i></td>
                          <td class="table-checks">  <i class="fa fa-times"></i></td>
                          <td class="table-checks">  <i class="fa fa-times"></i></td>
                        </tr>
                        <tr class="table-row">
                          <td>Yubikey (Hardware Token)</td>
                          <td class="table-checks">  <i class="fa fa-times"></i></td>
                          <td class="table-checks">  <i class="fa fa-times"></i></td>
                          <td class="table-checks">  <i class="fa fa-times"></i></td>
                          <td class="table-checks">  <i class="fa fa-times"></i></td>
                          <td class="table-checks"> <i class="fa fa-check"></i></td>
                        </tr>
                        <tr class="table-row">
                          <td>OTP Over Whatsapp (Add-on)</td>
                          <td class="table-checks">  <i class="fa fa-times"></i></td>
                          <td class="table-checks">  <i class="fa fa-times"></i></td>
                          <td class="table-checks">  <i class="fa fa-times"></i></td>
                          <td class="table-checks"> <i class="fa fa-check"></i></td>
                          <td class="table-checks"> <i class="fa fa-check"></i></td>
                        </tr>
                        <tr class="table-row">
                          <td>OTP Over Telegram</td>
                          <td class="table-checks">  <i class="fa fa-times"></i></td>
                          <td class="table-checks">  <i class="fa fa-times"></i></td>
                          <td class="table-checks">  <i class="fa fa-check"></i></td>
                          <td class="table-checks"> <i class="fa fa-check"></i></td>
                          <td class="table-checks"> <i class="fa fa-check"></i></td>
                        </tr>
                      </table>
                    </div>
                  </td>
                </tr>
                <tr class="table-row">
                  <td>
                    <div> &nbsp;&nbsp;Passwordless Login </div>
                  </td>
                  <td class="table-checks">
                    <i class="fa fa-times"></i>
                  </td>
                  <td class="table-checks">
                    <i class="fa fa-times"></i>
                  </td>
                  <td class="table-checks">
                    <i class="fa fa-times"></i>
                  </td>
                  <td class="table-checks">
                    <i class="fa fa-check"></i>
                  </td>
                  <td class="table-checks">
                    <i class="fa fa-check"></i>
                  </td>
                </tr>
                <tr class="table-row">
                  <td>
                    <div> &nbsp;&nbsp;White Labelling </div>
                  </td>
                  <td class="table-checks">
                    <i class="fa fa-times"></i>
                  </td>
                  <td class="table-checks">
                    <i class="fa fa-check">
                  </td>
                  <td class="table-checks">
                    <i class="fa fa-check">
                  </td>
                  <td class="table-checks">
                    <i class="fa fa-check">
                  </td>
                  <td class="table-checks">
                    <i class="fa fa-check"></i>
                  </td>
                </tr>
                <tr class="table-row">
                  <td>
                    <div> &nbsp;&nbsp;Custom SMS Gateway </div>
                  </td>
                  <td class="table-checks">
                    <i class="fa fa-times"></i>
                  </td>
                  <td class="table-checks">
                    <i class="fa fa-check"></i>
                  </td>
                  <td class="table-checks">
                    <i class="fa fa-check"></i>
                  </td>
                  <td class="table-checks">
                    <i class="fa fa-check"></i>
                  </td>
                  <td class="table-checks">
                    <i class="fa fa-check"></i>
                  </td>
                </tr>
                <tr class="table-row">
                  <td>
                    <div class="plugin-data" id="plugin-data" onclick="showData(this)">
                      <i class="fa fa-plus-circle table-plus-icon" aria-hidden="true" style="display:contents"></i>&nbsp;&nbsp;Backup Login Method
                    </div>
                    <div id="plugin-features" class="plugin-features-class" style="display: none;">
                    <ul><li>Security Questions(KBA)</li>
                      <li>OTP Over Email</li>
                      <li>Backup Codes</li>
                      </ul>
                    </div>
                  </td>
          
                  <td class="table-checks">
                    <i class="fa fa-check"></i>
                  </td>
                  <td class="table-checks">
                    <i class="fa fa-check"></i>
                  </td>
                  <td class="table-checks">
                    <i class="fa fa-check"></i>
                  </td>
                  <td class="table-checks">
                    <i class="fa fa-check"></i>
                  </td>
                  <td class="table-checks">
                    <i class="fa fa-check"></i>
                  </td>
                </tr>     
                <tr class="table-row">
                  <td colspan="6">
                    <div class="plugin-data" id="plugin-data" onclick="showData(this)">
                      <i class="fa fa-plus-circle table-plus-icon" aria-hidden="true" style="display:contents"></i>&nbsp;&nbsp;Add ons
                    </div>
                    <div id="plugin-features" class="plugin-features-class" style="display: none;">
                      <table class="add-on-table">
                      <tbody>
                          <tr class="table-row mo2fa-table-width">
                              <td class="table-row mo2fa-table-heading"></td>
                              <td class="table-row mo2fa-table-heading-one"></td>
                              <td class="table-row mo2fa-table-heading-one"></td>
                              <td class="table-row mo2fa-table-heading-two"></td>
                              <td class="table-row mo2fa-table-heading-two"></td>
                              <td class="table-row mo2fa-table-heading-two"></td>
                            </tr>
                          <tr class="table-row mo2fa-table-width">
                          <td class="mo2fa-table-heading-add-ons">
                              <div class="plugin-data" id="plugin-data" onclick="showData(this)">
                                <i class="fa fa-plus-circle table-plus-icon" aria-hidden="true" style="display:contents"></i>&nbsp;&nbsp;Remember Device Add-on
                            </div>
                            <div id="plugin-features" class="plugin-features-class" style="display: none;">
                            <small> You can save your device using the Remember device addon and you will get a two-factor authentication prompt to check your identity if you try to login from different devices.</small>
                              </div>
                          </td>
                            <td class="table-checks">
                              <i class="fa fa-times"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-times"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                          </tr>
                          <tr class="table-row"  style="background-color:white;">
                          <td class="mo2fa-table-heading-add-ons">
                              <div class="plugin-data" id="plugin-data" onclick="showData(this)">
                                <i class="fa fa-plus-circle table-plus-icon" aria-hidden="true" style="display:contents"></i>&nbsp;&nbsp;Personalization Add-on
                              </div>
                              <div id="plugin-features" class="plugin-features-class" style="display: none;">
                              <small> You'll get many more customization options in Personalization, such as
                              custom Email and SMS Template, Custom Login Popup, Custom Security Questions, and many more.</small>
                            </div>
                          </td>
                            <td class="table-checks mo2fa-table-heading-one">
                              <i class="fa fa-times"></i>
                            </td>
                            <td class="table-checks mo2fa-table-heading-one">
                              <i class="fa fa-check"></i>
                            </td>
                            <td class="table-checks mo2fa-table-heading-two">
                              <i class="fa fa-check"></i>
                            </td>
                            <td class="table-checks mo2fa-table-heading-two">
                              <i class="fa fa-check"></i>
                            </td>
                            <td class="table-checks mo2fa-table-heading-two">
                              <i class="fa fa-check"></i>
                            </td>
                          </tr>
                          <tr class="table-row" style="background-color:white;">
                            <td class="mo2fa-table-heading-add-ons">
                              <div class="plugin-data" id="plugin-data" onclick="showData(this)">
                                <i class="fa fa-plus-circle table-plus-icon" aria-hidden="true" style="display:contents"></i>&nbsp;&nbsp;Short Codes Add-on
                              </div>
                              <div id="plugin-features" class="plugin-features-class" style="display: none;">
                              <small>Shortcode Add-ons mostly include Allow 2FA shortcode (you can use this this to add 2FA on any page),
                              Reconfigure 2FA add-on (you can use this add-on to reconfigure your 2FA if you have lost your 2FA verification ability), remember device shortcode.
                              </small>
                              </div>
                              <div>
                            </td>       
                            <td class="table-checks">
                              <i class="fa fa-times"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-times"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-times"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-times"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                          </tr>
                          <tr class="table-row" style="background-color:white;">
                            <td class="mo2fa-table-heading-add-ons">Session Management</td>
                            <td class="table-checks">
                              <i class="fa fa-times"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-times"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                          </tr>
                          <tr class="table-row"  style="background-color:white;">
                            <td class="mo2fa-table-heading-add-ons">Page Restriction Add-On</td>
                            <td class="table-checks">
                              <i class="fa fa-times"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-times"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-times"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                          </tr>
                      </tbody>
                      </table>
                    </div>
                  </td>
                </tr>
                <tr class="table-row">
                  <td colspan="6">
                    <div class="plugin-data" id="plugin-data" onclick="showData(this)">
                      <i class="fa fa-plus-circle table-plus-icon" aria-hidden="true" style="display:contents"></i>&nbsp;&nbsp;Advance WordPress Login Settings
                    </div>
                    <div id="plugin-features" class="plugin-features-class" style="display: none;">
                      <table class="add-on-table">
                        <tbody class="add-on-table">
                          <tr class="table-row">
                              <th class="table-row mo2fa-table-heading"></th>
                              <th class="table-row mo2fa-table-heading-one"></th>
                              <th class="table-row mo2fa-table-heading-one"></th>
                              <th class="table-row mo2fa-table-heading-two"></th>
                              <th class="table-row mo2fa-table-heading-two"></th>
                              <th class="table-row mo2fa-table-heading-two"></th>
                            </tr>
                          <tr class="table-row">
                            <td class="mo2fa-table-heading-add-ons">Force Two Factor for Users</td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                          </tr>
                          <tr class="table-row">
                            <td>Role Based and User Based Authentication settings</td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                          </tr>
                          <tr class="table-row">
                            <td>Email Verififcation During Two-Factor Setup</td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                          </tr>
                          <tr class="table-row">
                            <td>Inline Registration (2FA Setup After First Login)</td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                          </tr>
                          <tr class="table-row">
                            <td>Mobile Support</td>
                            <td class="table-checks">
                              <i class="fa fa-times"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-times"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-times"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-times"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                          </tr>
                          <tr class="table-row">
                            <td>Privacy Policy Settings</td>
                            <td class="table-checks">
                              <i class="fa fa-times"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-times"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-times"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-times"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                          </tr>
                          <tr class="table-row">
                            <td>XML-RPC</td>
                            <td class="table-checks">
                              <i class="fa fa-times"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-times"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-times"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-times"></i>
                            </td>
                            <td class="table-checks">
                              <i class="fa fa-check"></i>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </td>
                </tr>
                <tr class="table-row mo2fa-table-width">
                  <td> 
                    <div class="plugin-data" id="plugin-data" onclick="showData(this)">
                      <i class="fa fa-plus-circle table-plus-icon" aria-hidden="true" style="display:contents"></i>&nbsp;&nbsp;Advance Security Features
                    </div>
                    <div id="plugin-features" class="plugin-features-class" style="display: none;">
                      
                        <ul>
                          <li>Brute Force Protection</li>
                    
                          <li>IP Blocking</li>
                    
                          <li>Monitoring</li>
                    
                          <li>File Protection</li>
                  
                          <li>Country Blocking</li>
                      
                          <li>HTACCESS Level Blocking</li>
                  
                          <li>Browser Blocking</li>
                      
                          <li>Block Global Blacklisted Email Domains</li>
                          
                          <li>DB Backup</li>
                          </ul>
                          </div>
                          </td>
                        
                          <td class="table-checks">
                            <i class="fa fa-times"></i>
                          </td>
                          <td class="table-checks">
                            <i class="fa fa-times"></i>
                          </td>
                          <td class="table-checks">
                            <i class="fa fa-times"></i>
                          </td>
                          <td class="table-checks">
                            <i class="fa fa-times"></i>
                          </td>
                          <td class="table-checks">
                            <i class="fa fa-check"></i>
                          </td>
                </tr>
                <tr class="table-row">
                  <td>
                    <div> &nbsp;&nbsp;Multi-Site Support </div>
                  </td>
                  <td class="table-checks">
                  <i class="fa fa-times"></i>
                  </td>
                  <td class="table-checks">
                    <i class="fa fa-check"></i>
                  </td>
                  <td class="table-checks">
                  Upto 3 subsites
                  </td>
                  <td class="table-checks">
                    Upto 3 subsites
                  </td>
                  <td class="table-checks">
                  Upto 3 subsites
                  </td>
                </tr>
                <tr class="table-row">
                  <td>
                    <div> &nbsp;&nbsp;Language Translation Support </div>
                  </td>
                  <td class="table-checks">
                    <i class="fa fa-check"></i>
                  </td>
                  <td class="table-checks">
                    <i class="fa fa-check"></i>
                  </td>
                  <td class="table-checks">
                    <i class="fa fa-check"></i>
                  </td>
                  <td class="table-checks">
                    <i class="fa fa-check"></i>
                  </td>
                  <td class="table-checks">
                    <i class="fa fa-check"></i>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          </div>
</center>


<div class="mo2f_table_layout mo2fa-font-text-table" style="width: 90%;margin-left:3%">
	<div>
		<h2><?php echo mo2f_lt('Steps to upgrade to the Premium Plan :');?></h2>
		<ol class="mo2f_licensing_plans_ol">
			<li><?php echo mo2f_lt( 'Click on <b>Upgrade Now</b> button of your preferred plan above.' ); ?></li>
			<li><?php echo mo2f_lt( ' You will be redirected to the miniOrange Console. Enter your miniOrange username and password, after which you will be redirected to the payment page.' ); ?></li>

			<li><?php echo mo2f_lt( 'Select the number of users/sites you wish to upgrade for, and any add-ons if you wish to purchase, and make the payment.' ); ?></li>
			<li><?php echo mo2f_lt( 'After making the payment, you can find the respective <b>plugins</b> to download from the <b>License</b> tab in the left navigation bar of the miniOrange Console.' ); ?></li>
			<li><?php echo mo2f_lt( 'Download the paid plugin from the <b>Releases and Downloads</b> tab through miniOrange Console .' ); ?></li>
			<li><?php echo mo2f_lt( 'Deactivate and delete the free plugin from <b>WordPress dashboard</b> and install the paid plugin downloaded.' ); ?></li>
			<li><?php echo mo2f_lt( 'Login to the paid plugin with the miniOrange account you used to make the payment, after this your users will be able to set up 2FA.' ); ?></li>
		</ol>
	</div>
	<hr>
	<div>
		<h2><?php echo mo2f_lt('Note :');?></h2>
		<ol class="mo2f_licensing_plans_ol">
		<li><?php echo mo2f_lt( 'Purchasing licenses for <b>unlimited users will grant you upto 2000 users.</b> If you want to purchase more users, please contact us or drop an email at <a href="mailto:2fasupport@xecurify.com">2fasupport@xecurify.com.</a>' ); ?></li>
			<li><?php echo mo2f_lt( 'The plugin works with many of the default custom login forms (like Woocommerce/Theme My Login/Login With Ajax/User Pro/Elementor), however if you face any issues with your custom login form, contact us and we will help you with it.' ); ?></li>
			<li><?php echo mo2f_lt( 'The <b>license key </b>is required to activate the <b>premium Plugins</b>. You will have to login with the miniOrange Account you used to make the purchase then enter license key to activate plugin.' ); ?>

		</li>
	</ol>
</div>
<hr>
<br>
<div>
	<?php echo mo2f_lt( '<b class="mo2fa_note">Refund Policy : </b>At miniOrange, we want to ensure you are 100% happy with your purchase. If the premium plugin you purchased is not working as advertised and you\'ve attempted to resolve any issues with our support team, which couldn\'t get resolved then we will refund the whole amount within 10 days of the purchase. ' ); ?>
</div>
<br>
<hr>
<br>
<div><?php echo mo2f_lt( '<b class="mo2fa_note">SMS Charges : </b>If you wish to choose OTP Over SMS/OTP Over SMS and Email as your authentication method,
	SMS transaction prices & SMS delivery charges apply and they depend on country. SMS validity is for lifetime.' ); ?>
</div>
<br>
<hr>
<br>
<div>
		<?php echo mo2f_lt( '<b class="mo2fa_note">Multisite : </b>For your first license 3 subsites will be activated automatically on the same domain. And if you wish to use it for more please contact support ' ); ?>
</div>
<br>
<hr>
<br>
<div>
	<?php echo mo2f_lt( '<b class="mo2fa_note">Privacy Policy : </b><a		href="https://www.miniorange.com/2-factor-authentication-for-wordpress-gdpr" target="blank">Click Here</a>
		to read our Privacy Policy.' ); ?>
</div>
<br>
<hr>
<br>
<div>
	<?php echo mo2f_lt( '<b class="mo2fa_note">Contact Us : </b>If you have any doubts regarding the licensing plans, you can mail us at <a		href="mailto:info@xecurify.com"><i>info@xecurify.com</i></a>
		or submit a query using the support form.' ); ?>
</div>
</div>
</center>
<div id="mo2f_payment_option" class="mo2f_table_layout mo2fa-supported-payment-method" style="width: 90%;margin-left:3%">
	<div>
		<h3>Supported Payment Methods</h3><hr>
		<div class="mo_2fa_container">
			<div class="mo_2fa_card-deck">
				<div class="mo_2fa_card mo_2fa_animation">
					<div class="mo_2fa_Card-header">
						<?php 
						echo'<img src="'.esc_url(dirname(plugin_dir_url(__FILE__))).'/includes/images/card.png" class="mo2fa_card">';?>
					</div>
					<hr class="mo2fa_hr">
					<div class="mo_2fa_card-body">
						<p class="mo2fa_payment_p">If payment is done through Credit Card/Intenational debit card, the license would be created automatically once payment is completed. </p>
						<p class="mo2fa_payment_p"><i><b>For guide 
							<?php echo'<a href='.esc_url(MoWpnsConstants::FAQ_PAYMENT_URL).' target="blank">Click Here.</a>';?></b></i></p>

						</div>
					</div>
					<div class="mo_2fa_card mo_2fa_animation">
						<div class="mo_2fa_Card-header">
							<?php 
							echo'<img src="'.esc_url(dirname(plugin_dir_url(__FILE__))).'/includes/images/paypal.png" class="mo2fa_card">';?>
						</div>
						<hr class="mo2fa_hr">
						<div class="mo_2fa_card-body">
							<?php echo'<p class="mo2fa_payment_p">Use the following PayPal id for payment via PayPal.</p><p><i><b style="color:#1261d8"><a href="mailto:'.esc_html(MoWpnsConstants::SUPPORT_EMAIL).'">info@xecurify.com</a></b></i>';?>

						</div>
					</div>
					<div class="mo_2fa_card mo_2fa_animation">
						<div class="mo_2fa_Card-header">
							<?php 
							echo'<img src="'.esc_url(dirname(plugin_dir_url(__FILE__))).'/includes/images/bank-transfer.png" class="mo2fa_card mo2fa_bank_transfer">';?>

						</div>
						<hr class="mo2fa_hr">
						<div class="mo_2fa_card-body">
							<?php echo'<p class="mo2fa_payment_p">If you want to use Bank Transfer for payment then contact us at <i><b style="color:#1261d8"><a href="mailto:'.esc_html(MoWpnsConstants::SUPPORT_EMAIL).'">info@xecurify.com</a></b></i> so that we can provide you bank details. </i></p>';?>
						</div>
					</div>
				</div>
			</div>
			<div class="mo_2fa_mo-supportnote">
				<p class="mo2fa_payment_p"><b>Note :</b> Once you have paid through PayPal/Bank Transfer, please inform us at <i><b style="color:#1261d8"><a href="mailto:<?php echo esc_html(MoWpnsConstants::SUPPORT_EMAIL); ?>">info@xecurify.com</a></b></i>, so that we can confirm and update your License.</p>
			</div>
		</div>
	</div>


	<?php
function mo2f_waf_yearly_standard_pricing() {
	?>
    <p class="mo2f_pricing_text mo_wpns_upgrade_page_starting_price"
       id="mo2f_yearly_sub"><?php echo __( 'Yearly subscription fees', 'miniorange-2-factor-authentication' ); ?><br>

	<select id="mo2f_yearly" class="form-control mo2fa_form_control1">
		<option> <?php echo mo2f_lt( '1 site - $50 per year' ); ?> </option>
		<option> <?php echo mo2f_lt( 'Upto 5 sites - $100 per year' ); ?> </option>
		<option> <?php echo mo2f_lt( 'Upto 10 sites - $150 per year' ); ?> </option>

	</select>
</p>

	<?php
}
function mo2f_login_yearly_standard_pricing() {
	?>
    <p class="mo2f_pricing_text mo_wpns_upgrade_page_starting_price"
       id="mo2f_yearly_sub"><?php echo __( 'Yearly subscription fees', 'miniorange-2-factor-authentication' ); ?><br>

	<select id="mo2f_yearly" class="form-control mo2fa_form_control1">
		<option> <?php echo mo2f_lt( '1 site - $15 per year' ); ?> </option>
		<option> <?php echo mo2f_lt( 'Upto 5 sites - $35 per year' ); ?> </option>
		<option> <?php echo mo2f_lt( 'Upto 10 sites - $60 per year' ); ?> </option>

	</select>
</p>

	<?php
}
function mo2f_backup_yearly_standard_pricing() {
	?>
    <p class="mo2f_pricing_text mo_wpns_upgrade_page_starting_price"
       id="mo2f_yearly_sub"><?php echo __( 'Yearly subscription fees', 'miniorange-2-factor-authentication' ); ?><br>

	<select id="mo2f_yearly" class="form-control mo2fa_form_control1">
		<option> <?php echo mo2f_lt( '1 site - $30 per year' ); ?> </option>
		<option> <?php echo mo2f_lt( 'Upto 5 sites - $50 per year' ); ?> </option>
		<option> <?php echo mo2f_lt( 'Upto 10 sites - $70 per year' ); ?> </option>

	</select>
</p>

	<?php
}
function mo2f_scanner_yearly_standard_pricing() {
	?>
    <p class="mo2f_pricing_text mo_wpns_upgrade_page_starting_price" 
       id="mo2f_yearly_sub"><?php echo __( 'Yearly subscription fees', 'miniorange-2-factor-authentication' ); ?><br>

	<select id="mo2f_yearly" class="form-control mo2fa_form_control1">
		<option> <?php echo mo2f_lt( '1 site - $15 per year' ); ?> </option>
		<option> <?php echo mo2f_lt( 'Upto 5 sites - $35 per year' ); ?> </option>
		<option> <?php echo mo2f_lt( 'Upto 10 sites - $60 per year' ); ?> </option>

	</select>
</p>

	<?php
}

function mo2f_get_binary_equivalent_2fa_lite( $mo2f_var ) {
	switch ( $mo2f_var ) {
		case 1:
			return "<div style='color: #20b2aa;font-size: x-large;float:left;margin:0px 5px;'>ðŸ—¸</div>";
		case 0:
			return "<div style='color: red;font-size: x-large;float:left;margin:0px 5px;'>Ã—</div>";
		default:
			return $mo2f_var;
	}
}

function mo2f_feature_on_hover_2fa_upgrade( $mo2f_var ) {

	return '<div class="mo2f_tooltip" style="float: right;width: 6%;"><span class="dashicons dashicons-info mo2f_info_tab"></span><span class="mo2f_tooltiptext" style="margin-left:-232px;margin-top: 9px;">'. $mo2f_var .'</span></div>';
}

?>
<form class="mo2f_display_none_forms" id="mo2fa_loginform"
                  action="<?php echo MO_HOST_NAME . '/moas/login'; ?>"
                  target="_blank" method="post">
                <input type="email" name="username" value="<?php echo get_option( 'mo2f_email' ); ?>"/>
                <input type="text" name="redirectUrl"
                       value="<?php echo MO_HOST_NAME . '/moas/initializepayment'; ?>"/>
                <input type="text" name="requestOrigin" id="requestOrigin"/>
            </form>

            <form class="mo2f_display_none_forms" id="mo2fa_register_to_upgrade_form"
                   method="post">
                <input type="hidden" name="requestOrigin" />
                <input type="hidden" name="mo2fa_register_to_upgrade_nonce"
                       value="<?php echo wp_create_nonce( 'miniorange-2-factor-user-reg-to-upgrade-nonce' ); ?>"/>
            </form>


     <script  type="text/javascript">

		function mo2f_upgradeform(planType,planname) 
		{
            jQuery('#requestOrigin').val(planType);
            jQuery('#mo2fa_loginform').submit();
            var data =  {
								'action'				  : 'wpns_login_security',
								'wpns_loginsecurity_ajax' : 'update_plan', 
								'planname'				  : planname,
								'planType'				  : planType,
					}
					jQuery.post(ajaxurl, data, function(response) {
					});
        }
        function mo2f_register_and_upgradeform(planType, planname) 
        {
                    jQuery('#requestOrigin').val(planType);
                    jQuery('input[name="requestOrigin"]').val(planType);
                    jQuery('#mo2fa_register_to_upgrade_form').submit();

                    var data =  {
								'action'				  : 'wpns_login_security',
								'wpns_loginsecurity_ajax' : 'wpns_all_plans', 
								'planname'				  : planname,
						'planType'				  : planType,
					}
					jQuery.post(ajaxurl, data, function(response) {
					});
        }
    	function show_2fa_plans()
    	{
    		document.getElementById('mo2fa_ns_features_only').style.display = "none";
    		document.getElementById('mo2f_twofa_plans').style.display = "block";
    		document.getElementById('mo_2fa_lite_licensing_plans_title').style.display = "none";
    		document.getElementById('mo_2fa_lite_licensing_plans_title1').style.display = "block";
    		document.getElementById('mo2f_ns_licensing_plans_title').style.display = "block";
    		document.getElementById('mo_ns_licensing_plans_title1').style.display = "none";
    		document.getElementById('mo2fa_compare').style.display = "block";
    	}
    	function mo_ns_show_plans()
    	{
    		document.getElementById('mo2fa_ns_features_only').style.display = "block";
    		document.getElementById('mo2f_twofa_plans').style.display = "none";
    		document.getElementById('mo_2fa_lite_licensing_plans_title').style.display = "block";
    		document.getElementById('mo_2fa_lite_licensing_plans_title1').style.display = "none";
    		document.getElementById('mo2f_ns_licensing_plans_title').style.display = "none";
    		document.getElementById('mo_ns_licensing_plans_title1').style.display = "block";
    		document.getElementById('mo2fa_compare').style.display = "none";
			
			if(document.getElementById('mo2fa_more_deails').style.display!="none")
			{   
		        jQuery('#mo2fa_more_deails').toggle();
			    jQuery('.mo2fa_compare1').toggle();


			}
		
    	}

    	function wpns_pricing()
		{
			window.open("https://security.miniorange.com/pricing/");
		}

		function mo2fa_show_details()
		{
			jQuery('#mo2fa_more_deails').toggle();
			jQuery('.mo2fa_more_details_p1').toggle();
			jQuery('.mo2fa_more_details_p').toggle();
			jQuery('.mo2fa_compare1').toggle();
		}


		var multisite = !1;

       function mo2f_change_instance_value(e, r, o, s = !1) {
				let p = 0,
					u = 0,
					n = 0;
				if (s) p = jQuery(o).find(":selected").val(), jQuery("#number_of_subsites_premium,#number_of_subsites_all_inclusive").not(o).val(p);
				else if (u = jQuery(o).find(":selected").val(), jQuery("#" + r ).not(o).val(u), "" != e) {
					document.getElementById(e).value = u;
					var c = jQuery("#" + e).find(":selected").data("price");
					jQuery("." + e.replace("select", "price")).text(c)
				}
				multisite && (n = jQuery("#number_of_subsites_premium").find(":selected").data("price"));
				var l = jQuery("#" + r).find(":selected").data("price"),
					a = jQuery("#" + r).find(":selected").val();
				jQuery("." + r.replace("select", "price")).text(parseInt(l) + parseInt(n) * parseInt(a));
        }
        	

    </script>
