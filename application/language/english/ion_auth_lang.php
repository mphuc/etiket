<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth Lang - English
*
* Author: Ben Edmunds
*         ben.edmunds@gmail.com
*         @benedmunds 
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  03.14.2010
*
* Description:  English language file for Ion Auth messages and errors
*
*/

// Account Creation
$lang['account_creation_successful']            = 'Account Successfully Created';
$lang['account_creation_unsuccessful']          = 'Unable to Create Account';
$lang['account_creation_duplicate_email']       = 'Email Already Used or Invalid';
$lang['account_creation_duplicate_identity']    = 'Identity Already Used or Invalid';
$lang['account_creation_missing_default_group'] = 'Default group is not set';
$lang['account_creation_invalid_default_group'] = 'Invalid default group name set';


// Password
$lang['password_change_successful']          = 'Password Successfully Changed';
$lang['password_change_unsuccessful']        = 'Unable to Change Password';
$lang['forgot_password_successful']          = 'Password Reset Email Sent';
$lang['forgot_password_unsuccessful']        = 'Unable to Reset Password';

// Activation
$lang['activate_successful']                 = 'Account Activated';
$lang['activate_unsuccessful']               = 'Unable to Activate Account';
$lang['deactivate_successful']               = 'Account De-Activated';
$lang['deactivate_unsuccessful']             = 'Unable to De-Activate Account';
$lang['activation_email_successful']         = 'Activation Email Sent';
$lang['activation_email_unsuccessful']       = 'Unable to Send Activation Email';

// Login / Logout
$lang['login_successful']                    = 'Logged In Successfully';
$lang['login_unsuccessful']                  = 'Incorrect Login';
$lang['login_unsuccessful_not_active']       = 'Account is inactive';
$lang['login_timeout']                       = 'Temporarily Locked Out.  Try again later.';
$lang['logout_successful']                   = 'Logged Out Successfully';

// Account Changes
$lang['update_successful']                   = 'Account Information Successfully Updated';
$lang['update_unsuccessful']                 = 'Unable to Update Account Information';
$lang['delete_successful']                   = 'User Deleted';
$lang['delete_unsuccessful']                 = 'Unable to Delete User';

// Groups
$lang['group_creation_successful']           = 'Group created Successfully';
$lang['group_already_exists']                = 'Group name already taken';
$lang['group_update_successful']             = 'Group details updated';
$lang['group_delete_successful']             = 'Group deleted';
$lang['group_delete_unsuccessful']           = 'Unable to delete group';
$lang['group_delete_notallowed']             = 'Can\'t delete the administrators\' group';
$lang['group_name_required']                 = 'Group name is a required field';
$lang['group_name_admin_not_alter']          = 'Admin group name can not be changed';

// Activation Email
$lang['email_activation_subject']            = 'Account Activation';
$lang['email_activate_heading']              = 'Activate account for %s';
$lang['email_activate_subheading']           = 'Please click this link to %s.';
$lang['email_activate_link']                 = 'Activate Your Account';

// Forgot Password Email
$lang['email_forgotten_password_subject']    = 'Forgotten Password Verification';
$lang['email_forgot_password_heading']       = 'Reset Password for %s';
$lang['email_forgot_password_subheading']    = 'Please click this link to %s.';
$lang['email_forgot_password_link']          = 'Reset Your Password';

// New Password Email
$lang['email_new_password_subject']          = 'New Password';
$lang['email_new_password_heading']          = 'New Password for %s';
$lang['email_new_password_subheading']       = 'Your password has been reset to: %s';

//Modified
$lang['colum_publish'] = 'Publish';
$lang['colum_draf'] = 'Save Draf';
$lang['colum_trash'] = 'In Trash';

//Date
$lang['time_now'] = 'just now';
$lang['time_aminute'] = 'one minute ago';
$lang['time_minute'] = 'minutes ago';
$lang['time_ahrs'] = 'an hour ago';
$lang['time_hrs'] = 'hrs ago';
$lang['time_yes'] = 'yesterday';
$lang['time_day'] = 'days ago';
$lang['time_aweek'] = 'a week ago';
$lang['time_week'] = 'weeks ago';
$lang['time_amonth'] = 'a month ago';
$lang['time_month'] = 'months ago';
$lang['time_ayear'] = 'one year ago';
$lang['time_year'] = 'years ago';
$lang['updatein'] = 'Update in';

//categori
$lang['cat_name'] = 'Name';
$lang['cat_desc'] = 'Description';
$lang['cat_slug'] = 'Slug';
$lang['cat_parent'] = 'Parent';


//navbar
$lang['nav_menu_dashboard'] = 'Dashboard';
$lang['nav_menu_posts'] = 'Posts';
$lang['nav_menu_allposts'] = 'All Posts';
$lang['nav_menu_feature'] = 'Features';
$lang['nav_menu_allfeature'] = 'All Features';
$lang['nav_menu_new'] = 'Add New';
$lang['nav_menu_cat'] = 'Categories';
$lang['nav_menu_tags'] = 'Tags';
$lang['nav_menu_media'] = 'Media';
$lang['nav_menu_pages'] = 'Pages';
$lang['nav_menu_allpages'] = 'All Pages';

$lang['nav_menu_comment'] = 'Comments';
$lang['nav_menu_allcomment'] = 'All Comment';
$lang['nav_menu_contact'] = 'Feed Contact';

$lang['nav_menu_appear'] = 'Appearance';
$lang['nav_menu_appear_theme'] = 'Themes';
$lang['nav_menu_appear_custom'] = 'Customize';
$lang['nav_menu_appear_widget'] = 'Widgets';
$lang['nav_menu_appear_menu'] = 'Menus';
$lang['nav_menu_appear_cpanel'] = 'Cpanel';
$lang['nav_menu_appear_head'] = 'Header';
$lang['nav_menu_appear_back'] = 'Background';

$lang['nav_menu_plugins'] = 'Plugins';
$lang['nav_menu_plugins_in'] = 'Installed Plugins';
$lang['nav_menu_plugins_new'] = 'Plugins';

$lang['nav_menu_users'] = 'Users';
$lang['nav_menu_users_all'] = 'All Users';
$lang['nav_menu_users_new'] = 'Add New';
$lang['nav_menu_users_profile'] = 'Your Profile';
$lang['nav_menu_users_group'] = 'Users Groups';
$lang['nav_menu_users_groupsrole'] = 'Groups Role';
$lang['nav_menu_users_notif'] = 'Notification';

$lang['nav_menu_setting'] = 'Setting';
$lang['nav_menu_setting_general'] = 'General';
$lang['nav_menu_setting_writing'] = 'Writing';
$lang['nav_menu_setting_seo'] = 'SEO';
$lang['nav_menu_setting_company'] = 'Company';
$lang['nav_menu_setting_mitra'] = 'Mitra';


//Media Controller
$lang['media_img'] = 'Image';
$lang['media_title'] = 'Media Title';
$lang['media_author'] = 'Media Author';
$lang['media_date'] = 'Media Date';

//Comment Controller

$lang['com_parent'] = 'In Response To';
$lang['com_author'] = 'Author Name';
$lang['com_email'] = 'Email';
$lang['com_url'] = 'Url';
$lang['com_content'] = 'Comment';
$lang['com_status'] = 'Status';
$lang['com_date'] = 'Date';
$lang['com_user'] = 'User Register';

$lang['com_contact'] = 'Cotent';

//Themes
$lang['theme_name'] = 'Themes Name';
$lang['theme_status'] = 'Status';
$lang['theme_pic'] = 'Preview';

//Widgets
$lang['widgets_name'] = 'Widgets Name';
$lang['value'] = 'Value';

//Menu
$lang['menu_name'] = 'Menu Name';
$lang['menu_position'] = 'Menu Position';
$lang['menu_add'] = 'Add new menu';
$lang['menu_edit'] = 'Edit Position or Name';
$lang['or'] = 'or';
$lang['menu_submit'] = 'Submit';
$lang['menu_all'] = 'Select All';
$lang['menu_addcat'] = 'Choose from Category';
$lang['menu_addlink'] = 'Add a Link';
$lang['menu_addpage'] = 'Choose from Pages';
$lang['menu_chose'] = 'Select menus to edit :';
$lang['menu_value'] = 'Add menu to list';
$lang['menu_list'] = 'List menus';
$lang['menu_linkurl'] = 'URL';
$lang['menu_linktext'] = 'Link Text';
$lang['menu_title'] = 'Data Menus';
$lang['menu_choses'] = 'Changes';
$lang['menu_addto'] = 'Add';
$lang['menu_save'] = 'Save & Update Menus';
$lang['menu_empty'] = 'There has been no list or empty menu to display';


//User Profile
$lang['p_photo'] = 'Photos';
$lang['p_posts'] = 'Posts';
$lang['p_about'] = 'About';
$lang['p_email'] = 'Email';
$lang['p_phone'] = 'Phone';
$lang['p_gplus'] = 'Goole Plus';
$lang['p_twitter'] = 'Twitter';
$lang['p_fb'] = 'Facebook';
$lang['p_b_day'] = 'Birth Day';
$lang['p_gender'] = 'Gender';
$lang['p_current_location'] = 'Currnet Location';
$lang['p_last_login'] = 'Last Login';
$lang['p_ip'] = 'IP Address';
$lang['p_groups'] = 'Groups';
$lang['p_timline'] = 'Timeline';
$lang['p_s_all'] = 'Show All';
$lang['p_contact_info'] = 'Contact Info';
$lang['p_birth'] = 'Birth Date';
$lang['p_ip_address'] = 'IP Address';


//Notification
$lang['notif'] = 'Notification';
$lang['add_notif'] = 'Add new data ';
$lang['update_notif'] = 'Update data ';
$lang['delete_notif'] = 'Delete data ';

$lang['contact_notif'] = 'Contact';
$lang['timeline_notif'] = 'Timeline';
$lang['all_notif'] = 'Show All';
$lang['no_notif'] = 'No new notifications received';
$lang['in_notif'] = 'Notif in ';

//General Setting
$lang['setting_name'] = 'Setting Name';
//Mitra
$lang['mitra_img'] = 'Image Mitra';
$lang['mitra_title'] = 'Mitra Title';
$lang['mitra_link'] = 'Mitra Link';

//shortcut
$lang['shortcut_link'] = 'Shortcut Link';
$lang['shortcut_visit'] = 'Visit Web';
$lang['shortcut_index'] = 'Google Index';
$lang['shortcut_doc'] = 'Documentation';
$lang['shortcut_umbrella'] = 'Umbrella Official';
//Search
$lang['search_no'] 		= 'Your search ';
$lang['search_sugest'] = 'does not match any documents.<br><br><b>Suggestions:</b><br>Make sure all words are spelled correctly.<br>Try other keywords.<br>Try more general keywords.<br>Try to reduce the keyword.<br>';
$lang['search_post'] 		= 'Documents Results';
$lang['search_user'] 		= 'Users Results';
$lang['search_last'] 		= 'Last Login';

//log
$lang['logout'] 		= 'Logout';

//Dashboard
$lang['dash_welcome'] 		= 'Welcome to Umbrella v.2.0!';
$lang['dash_tagline'] 		= 'We’ve assembled some links to get you started:';
$lang['total_post'] 		= 'Total Post';
$lang['total_media'] 		= 'Total Media';
$lang['total_page'] 		= 'Total Page';
$lang['total_user'] 		= 'Total User';

$lang['comment'] 		= 'Comment';
$lang['views'] 		= 'Views';

//Tambahan Menu
$lang['nav_master'] = 'Data Master';
$lang['nav_jenis_wahana'] = 'Jenis Wahana';
$lang['nav_loker_tiket'] = 'Loker Tiket';
$lang['nav_tiket'] = 'Data Tiket';
$lang['nav_keuangan'] = 'Keuangan';
$lang['nav_report'] = 'Report';
$lang['nav_report_harian'] = 'Report Harian';
$lang['nav_report_bulanan'] = 'Report Bulanan';
$lang['nav_report_profit_sharing'] = 'Report Profit Sharing';
$lang['nav_kode_rekening'] = 'Kode Rekening';
$lang['nav_buku_kas'] = 'Buku Kas';
$lang['nav_report_buku_kas'] = 'Report Buku Kas';
$lang['nav_menu_setting_wahana'] = 'Setting Wahana';
$lang['nav_jenis_pendapatan'] = 'Type Pendapatan';
$lang['nav_report_pendapatan'] = 'Report Pendapatan';
$lang['nav_pendapatan_sewa'] = 'Pendapatan Sewa';
$lang['nav_transaksi'] = 'Transaksi';