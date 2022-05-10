<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth Lang - Indonesian
*
* Author: Toni Haryanto
* 		  toha.samba@gmail.com
*         @yllumi
*
* Author: Daeng Muhammad Feisal
*         daengdoang@gmail.com
*         @daengdoang
*
* Author: Suhindra
*         suhindra@hotmail.co.id
*         @suhindra
*
* Location: https://github.com/benedmunds/CodeIgniter-Ion-Auth
*
* Created:  11.15.2011
* Last-Edit:   June 27th 2015
*
* Description:  Indonesian language file for Ion Auth messages and errors
*
*/

// Account Creation
$lang['account_creation_successful']				= 'Akun Berhasil Dibuat';
$lang['account_creation_unsuccessful']				= 'Tidak Dapat Membuat Akun';
$lang['account_creation_duplicate_email']			= 'Email Sudah Digunakan atau Tidak Valid';
$lang['account_creation_duplicate_identity']	    = 'Username Sudah Digunakan atau Tidak Valid';

// TODO Please Translate
$lang['account_creation_missing_default_group']		= 'Standar grup tidak diatur';
$lang['account_creation_invalid_default_group']		= 'Pengaturan Nama Grup Standar Tidak Valid';


// Password
$lang['password_change_successful']					= 'Kata Sandi Berhasil Diubah';
$lang['password_change_unsuccessful']				= 'Tidak Dapat Mengganti Kata Sandi';
$lang['forgot_password_successful']					= 'Email untuk Set Ulang Kata Sandi Telah Dikirim';
$lang['forgot_password_unsuccessful']				= 'Tidak Dapat Set Ulang Kata Sandi';

// Activation
$lang['activate_successful']						= 'Akun Telah Diaktifkan';
$lang['activate_unsuccessful']						= 'Tidak Dapat Mengaktifkan Akun';
$lang['deactivate_successful']						= 'Akun Telah Dinonaktifkan';
$lang['deactivate_unsuccessful']					= 'Tidak Dapat Menonaktifkan Akun';
$lang['activation_email_successful']			    = 'Email untuk Aktivasi Telah Dikirim';
$lang['activation_email_unsuccessful']		        = 'Tidak Dapat Mengirimkan Email Aktivasi';

// Login / Logout
$lang['login_successful']							= 'Log In Berhasil';
$lang['login_unsuccessful']							= 'Log In Gagal';
$lang['login_unsuccessful_not_active']	            = 'Akun Tidak Aktif';
$lang['login_timeout']								= 'Sementara Terkunci. Coba Beberapa Saat Lagi.';
$lang['logout_successful']							= 'Log Out Berhasil';

// Account Changes
$lang['update_successful']							= 'Informasi Akun Berhasil Diperbaharui';
$lang['update_unsuccessful']						= 'Gagal Memperbaharui Informasi Akun';
$lang['delete_successful']							= 'Pengguna Telah Dihapus';
$lang['delete_unsuccessful']						= 'Gagal Menghapus Pengguna';

// Groups
$lang['group_creation_successful']				    = 'Grup Berhasil Dibuat';
$lang['group_already_exists']						= 'Nama Grup Sudah Digunakan';
$lang['group_update_successful']					= 'Detil Grup Berhasil Diubah';
$lang['group_delete_successful']					= 'Grup Berhasil Dihapus';
$lang['group_delete_unsuccessful']				    = 'Gagal Menghapus Grup';
$lang['group_delete_notallowed']					= 'Tidak Dapat menghapus Grup Administrator';
$lang['group_name_required']						= 'Nama Grup Tidak Boleh Kosong';
$lang['group_name_admin_not_alter']			    	= 'Nama Grup Admin Tidak Bisa Diubah';

// Activation Email
$lang['email_activation_subject']					= 'Aktivasi Akun';
$lang['email_activate_heading']						= 'Aktifkan Akun dari %s';
$lang['email_activate_subheading']				    = 'Silahkan klik tautan berikut untuk %s.';
$lang['email_activate_link']						= 'Aktifkan Akun';

// Forgot Password Email
$lang['email_forgotten_password_subject']			= 'Verifikasi Lupa Password';
$lang['email_forgot_password_heading']				= 'Setel Ulang Kata Sandi untuk %s';
$lang['email_forgot_password_subheading']			= 'Silahkan klik tautan berikut untuk %s.';
$lang['email_forgot_password_link']					= 'Setel Ulang Kata Sandi';

// New Password Email
$lang['email_new_password_subject']					= 'Kata Sandi Baru';
$lang['email_new_password_heading']					= 'Kata Sandi Baru Untuk %s';
$lang['email_new_password_subheading']			    = 'Kata Sandi Telah Diubah Ke: %s';


//Modified
$lang['colum_publish'] = 'Publikasikan';
$lang['colum_draf'] = 'Simpan Draft';
$lang['colum_trash'] = 'Tempat sampah';

//Date
$lang['time_now'] = 'baru saja';
$lang['time_aminute'] = 'satu menit yg lalu';
$lang['time_minute'] = 'menit yg lalu';
$lang['time_ahrs'] = 'jam yg lalu';
$lang['time_hrs'] = 'jam yg lalu';
$lang['time_yes'] = 'kemarin';
$lang['time_day'] = 'hari yg lalu';
$lang['time_aweek'] = 'seminggu yg lalu';
$lang['time_week'] = 'minggu yg lalu';
$lang['time_amonth'] = 'sebulan yg lalu';
$lang['time_month'] = 'bulan yg lalu';
$lang['time_ayear'] = 'setahun yg lalu';
$lang['time_year'] = 'tahun yg lalu';
$lang['updatein'] = 'update pada';

//categori
$lang['cat_name'] = 'nama';
$lang['cat_desc'] = 'deskripsi';
$lang['cat_slug'] = 'slug';
$lang['cat_parent'] = 'Parent';


//navbar
$lang['nav_menu_dashboard'] = 'Beranda';
$lang['nav_menu_posts'] = 'Posts';
$lang['nav_menu_allposts'] = 'Semua Posts';
$lang['nav_menu_feature'] = 'Fitur';
$lang['nav_menu_allfeature'] = 'Semua Fitur';
$lang['nav_menu_new'] = 'Tambah Baru';
$lang['nav_menu_cat'] = 'Kategori';
$lang['nav_menu_tags'] = 'Tags';
$lang['nav_menu_media'] = 'Media';
$lang['nav_menu_pages'] = 'Pages';
$lang['nav_menu_allpages'] = 'All Pages';

$lang['nav_menu_comment'] = 'Komentar';
$lang['nav_menu_allcomment'] = 'Semua Komentar';
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
$lang['p_birth'] = 'Tanggal Lahir';
$lang['p_ip_address'] = 'Alamat IP';


//Notification
$lang['notif'] = 'Notifikasi';
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
$lang['nav_report'] = 'Laporan';
$lang['nav_report_harian'] = 'Laporan Harian';
$lang['nav_report_bulanan'] = 'Laporan Bulanan';
$lang['nav_report_profit_sharing'] = 'Laporan Profit Sharing';
$lang['nav_kode_rekening'] = 'Kode Rekening';
$lang['nav_buku_kas'] = 'Buku Kas';
$lang['nav_report_buku_kas'] = 'Laporan Buku Kas';
$lang['nav_menu_setting_wahana'] = 'Pengaturan Wahana';
$lang['nav_jenis_pendapatan'] = 'Jenis Pendapatan';
$lang['nav_report_pendapatan'] = 'Laporan Pendapatan';
$lang['nav_pendapatan_sewa'] = 'Pendapatan Sewa';
$lang['nav_transaksi'] = 'Transaksi';