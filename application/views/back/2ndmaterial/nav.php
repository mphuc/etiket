    <!-- main header -->
    <header id="header_main">
        <div class="header_main_content">
            <nav class="uk-navbar">
                                
                <!-- main sidebar switch -->
                <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
                    <span class="sSwitchIcon"></span>
                </a>
                
                <div id="menu_top_dropdown" class="uk-float-left uk-hidden-small">
                    <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}">
                        <a href="#" class="top_menu_toggle"><i class="material-icons md-24">&#xE8F0;</i></a>
                        <div class="uk-dropdown uk-dropdown-width-3">
                            <div class="uk-grid uk-dropdown-grid" data-uk-grid-margin>
                                <div class="uk-width-2-3">
                                    <div class="uk-grid uk-grid-width-medium-1-3 uk-margin-top uk-margin-bottom uk-text-center" data-uk-grid-margin>
                                        <?php $product = $this->base_config->groups_access_sigle('menu','product'); if($product == false) { ?>
                                            <a href="cms/product">
                                                <i class="material-icons md-36 ">extension</i>
                                                <span class="uk-text-muted uk-display-block">Product</span>
                                            </a>
                                        <?php } ?>
                                        <?php $transaction = $this->base_config->groups_access_sigle('menu','transaction'); if($transaction == false) { ?>
                                            <a href="cms/transaction">
                                                <i class="material-icons md-36 ">add_shopping_cart</i>
                                                <span class="uk-text-muted uk-display-block">Transaction</span>
                                            </a>
                                        <?php } ?>
                                        <?php if($this->ion_auth->is_admin()){ ?>
                                        <a href="cms/setting">
                                            <i class="material-icons md-36">&#xE8B8;</i>
                                            <span class="uk-text-muted uk-display-block">Setting</span>
                                        </a>
                                        <a href="cms/users">
                                            <i class="material-icons md-36">&#xE7EF;</i>
                                            <span class="uk-text-muted uk-display-block">{_nav_menu_users}</span>
                                        </a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="uk-width-1-3">
                                    <ul class="uk-nav uk-nav-dropdown uk-panel">
                                        <li class="uk-nav-header">{_shortcut_link}</li>
                                        <li><a target="_blank" href="<?php echo base_url();?>">{_shortcut_visit}</a></li>
                                        <li><a target="_blank" href="<?php echo base_url('assets/uploads/manual-book.pdf')?>">{_shortcut_doc}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="uk-navbar-flip">
                    <ul class="uk-navbar-nav user_actions">
                        <li><a href="#" id="full_screen_toggle" class="user_action_icon uk-visible-large"><i class="material-icons md-24 md-light">&#xE5D0;</i></a></li>
                        <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                            <a href="#" class="user_action_image"><img class="md-user-image" onerror="this.src='<?php echo base_url('assets/uploads/avatar.png');?>'" src="<?php echo base_url('assets/uploads/'.$this->ion_auth->user()->row()->user_avatar) ;?>" alt=""/></a>
                            <div class="uk-dropdown uk-dropdown-small">
                                <ul class="uk-nav js-uk-prevent">
                                    <li><a href="cms/profile">{_nav_menu_users_profile}</a></li>
                                    <li><a href="cms/auth/logout">{_logout}</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="header_main_search_form">
            <i class="md-icon header_main_search_close material-icons">&#xE5CD;</i>
            <form action="cms/search" method="get" class="uk-form">
                <input type="text" name="q" class="header_main_search_input" />
                <button type="submit" class="header_main_search_btn uk-button-link"><i class="md-icon material-icons">&#xE8B6;</i></button>
            </form>
        </div>
    </header><!-- main header end -->
    <!-- main sidebar -->
    <aside id="sidebar_main">
        
        <div class="sidebar_main_header">
            <div class="sidebar_logo">
                <a href="cms" class="sSidebar_hide"><img src="<?php echo base_url("themes/umbrella-back/2ndmaterial/img/kemendikbud.png")?>" alt="" /></a>
            </div>
        </div>
        
        <div class="menu_section">
            <ul>
                <li class="<?php echo $this->base_config->activelinknav(''); ?>" title="<?php echo lang('nav_menu_dashboard'); ?>">
                    <a href="cms">
                        <span class="menu_icon"><i class="material-icons">&#xE88A;</i></span>
                        <span class="menu_title"><?php echo lang('nav_menu_dashboard'); ?></span>
                    </a>
                </li>
                <?php
                if(
                        !$this->base_config->groups_access_sigle('menu','product') ||
                        !$this->base_config->groups_access_sigle('menu','ticket_package') ||
                        !$this->base_config->groups_access_sigle('menu','category_product') ||
                        !$this->base_config->groups_access_sigle('menu','ticket') ||
                        !$this->base_config->groups_access_sigle('menu','bank') ||
                        !$this->base_config->groups_access_sigle('menu','vendor') ||
                        !$this->base_config->groups_access_sigle('menu','gate') ||
                        !$this->base_config->groups_access_sigle('menu','barcode')
                ):?>
                    <li class="<?php
                    echo $this->base_config->activelinknav('product');
                    echo $this->base_config->activelinknav('ticket_package');
                    echo $this->base_config->activelinknav('category_product');
                    echo $this->base_config->activelinknav('ticket');
                    echo $this->base_config->activelinknav('bank');
                    echo $this->base_config->activelinknav('vendor');
                    echo $this->base_config->activelinknav('gate');
                    echo $this->base_config->activelinknav('barcode');
                    echo $this->base_config->activelinknav('assessment_list');
                    ?>" title="master">
                        <a href="#">
                            <span class="menu_icon"><i class="material-icons">extension</i></span>
                            <span class="menu_title">Master</span>
                        </a>
                        <ul>
                            
                            <?php $nav_product = $this->base_config->groups_access_sigle('menu','product'); if($nav_product == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('product',true); ?>"><a href="cms/product">Product</a></li>
                            <?php } ?>
                            <?php $nav_category_product = $this->base_config->groups_access_sigle('menu','category_product'); if($nav_category_product == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('category_product',true); ?>"><a href="cms/category_product">Category</a></li>
                            <?php } ?>
                            <?php $nav_ticket = $this->base_config->groups_access_sigle('menu', 'ticket'); if($nav_ticket == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('ticket',true); ?>"><a href="cms/ticket">Ticket</a></li>
                            <?php } ?>
                            <?php $nav_bank = $this->base_config->groups_access_sigle('menu', 'bank'); if($nav_bank == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('bank',true); ?>"><a href="cms/bank">Bank</a></li>
                            <?php } ?>
                            <?php $nav_vendor = $this->base_config->groups_access_sigle('menu', 'vendor'); if($nav_vendor == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('vendor',true); ?>"><a href="cms/vendor">Vendor</a></li>
                            <?php } ?>
                            <?php $nav_gate = $this->base_config->groups_access_sigle('menu', 'gate'); if($nav_gate == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('gate',true); ?>"><a href="cms/gate">Access Gate</a></li>
                            <?php } ?>
                            <?php $nav_barcode = $this->base_config->groups_access_sigle('menu', 'barcode'); if($nav_barcode == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('barcode',true); ?>"><a href="cms/barcode">Barcode</a></li>
                            <?php } ?>
                            <?php $nav_gate = $this->base_config->groups_access_sigle('menu', 'assessment_list'); if($nav_gate == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('assessment_list',true); ?>"><a href="cms/assessment_list">Penilaian</a></li>
                            <?php } ?>
                            <?php $nav_gate = $this->base_config->groups_access_sigle('menu', 'lokasi_penilaian'); if($nav_gate == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('lokasi_penilaian',true); ?>"><a href="cms/lokasi_penilaian">Lokasi Penilaian</a></li>
                            <?php } ?>                            
                            <?php $posts_video = $this->base_config->groups_access_sigle('menu','tipe_kartu'); if($posts_video == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('tipe_kartu',true); ?>"><a href="cms/tipe_kartu/">Tipe Kartu</a></li>
                            <?php } ?>
                            <?php $posts_video = $this->base_config->groups_access_sigle('menu','penerima_pembayaran'); if($posts_video == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('penerima_pembayaran',true); ?>"><a href="cms/penerima_pembayaran/">Penerima Pembayaran</a></li>
                            <?php } ?>
                            <?php $posts_video = $this->base_config->groups_access_sigle('menu','mdr'); if($posts_video == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('mdr',true); ?>"><a href="cms/mdr/">MDR</a></li>
                            <?php } ?>
                            <?php $nav_gate = $this->base_config->groups_access_sigle('menu', 'customers'); if($nav_gate == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('customers',true); ?>"><a href="cms/customers">Customer</a></li>
                            <?php } ?>
                            <?php $nav_gate = $this->base_config->groups_access_sigle('menu', 'kontak'); if($nav_gate == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('kontak',true); ?>"><a href="cms/kontak">Kontak Kami</a></li>
                            <?php } ?>
                            <?php $nav_gate = $this->base_config->groups_access_sigle('menu', 'tentang_kami'); if($nav_gate == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('tentang_kami',true); ?>"><a href="cms/tentang_kami">Tentang Kami</a></li>
                            <?php } ?>
                            <?php $nav_gate = $this->base_config->groups_access_sigle('menu', 'syarat_dan_ketentuan'); if($nav_gate == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('syarat_dan_ketentuan',true); ?>"><a href="cms/syarat_dan_ketentuan">Syarat Dan Ketentuan</a></li>
                            <?php } ?>
                            <?php $nav_gate = $this->base_config->groups_access_sigle('menu', 'available_date'); if($nav_gate == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('available_date',true); ?>"><a href="cms/available_date">Tanggal Buka Dan Tutup</a></li>
                            <?php } ?>
                            
                        </ul>
                    </li>
                <?php endif; ?>
<!-- 
                <?php
                if(
                        !$this->base_config->groups_access_sigle('menu','promo') ||
                        !$this->base_config->groups_access_sigle('menu','discount_product') ||
                        !$this->base_config->groups_access_sigle('menu','discount_package')
                ): ?>
                <li class="<?php
                    echo $this->base_config->activelinknav('promo');
                    echo $this->base_config->activelinknav('discount_product');
                    echo $this->base_config->activelinknav('discount_package');
                    ?>" title="discount">
                        <a href="#">
                            <span class="menu_icon"><i class="material-icons">loyalty</i></span>
                            <span class="menu_title">Discount</span>
                        </a>
                        <ul>
                            <?php $nav_promo = $this->base_config->groups_access_sigle('menu','promo'); if($nav_promo == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('promo',true); ?>"><a href="cms/promo">Promo</a></li>
                            <?php } ?>
                            <?php $nav_discount_product = $this->base_config->groups_access_sigle('menu','discount_product'); if($nav_discount_product == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('discount_product',true); ?>"><a href="cms/discount_product">Discount Product</a></li>
                            <?php } ?>
                            <?php $nav_discount_package = $this->base_config->groups_access_sigle('menu','discount_package'); if($nav_discount_package == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('discount_package',true); ?>"><a href="cms/discount_package">Discount Package</a></li>
                            <?php } ?>
                        </ul>
                    </li> 
                <?php endif; ?>
                <?php
                if(
                    !$this->base_config->groups_access_sigle('menu','bus') ||
                    !$this->base_config->groups_access_sigle('menu','tempat') ||
                    !$this->base_config->groups_access_sigle('menu','reservation') ||
                    !$this->base_config->groups_access_sigle('menu','bus') ||
                    !$this->base_config->groups_access_sigle('menu','tempat') ||
                    !$this->base_config->groups_access_sigle('menu','customer')
                ): ?>
                    <li class="<?php
                    echo $this->base_config->activelinknav('bus');
                    echo $this->base_config->activelinknav('tempat');
                    echo $this->base_config->activelinknav('reservation');
                    echo $this->base_config->activelinknav('bus');
                    echo $this->base_config->activelinknav('tempat');
                    echo $this->base_config->activelinknav('customer');
                    ?>" title="discount">
                        <a href="#">
                            <span class="menu_icon"><i class="material-icons">send</i></span>
                            <span class="menu_title">Reservation</span>
                        </a>
                        <ul>
                            <?php $nav_customer = $this->base_config->groups_access_sigle('menu','customer'); if($nav_customer == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('customer',true); ?>"><a href="cms/customer">Customer</a></li>
                            <?php } ?>
                            <?php $nav_bus = $this->base_config->groups_access_sigle('menu','bus'); if($nav_bus == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('bus',true); ?>"><a href="cms/bus">Bus</a></li>
                            <?php } ?>
                            <?php $nav_tempat = $this->base_config->groups_access_sigle('menu','tempat'); if($nav_tempat == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('tempat',true); ?>"><a href="cms/tempat">Tempat</a></li>
                            <?php } ?>
                            <?php $nav_reservation = $this->base_config->groups_access_sigle('menu','reservation'); if($nav_reservation == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('reservation',true); ?>"><a href="cms/reservation">Reservation</a></li>
                            <?php } ?>
                        </ul>
                    </li> 
                <?php endif; ?> -->
                <?php $transaction = $this->base_config->groups_access_sigle('menu','transaction'); if($transaction == false) { ?>
                    <li class="<?php echo $this->base_config->activelinknav('transaction'); ?>" title="transaction">
                        <a href="cms/transaction">
                            <span class="menu_icon"><i class="material-icons">add_shopping_cart</i></span>
                            <span class="menu_title">Transaction</span>
                        </a>
                    </li>
                <?php } ?>
                <?php $loket = $this->base_config->groups_access_sigle('menu','loket'); if($loket == false) { ?>
                    <li class="<?php echo $this->base_config->activelinknav('loket'); ?>" title="loket">
                        <a href="cms/loket">
                            <span class="menu_icon"><i class="material-icons">location_searching</i></span>
                            <span class="menu_title">Loket Masuk</span>
                        </a>
                    </li>
                <?php } ?>
                <?php $loket = $this->base_config->groups_access_sigle('menu','lokettiket'); if($loket == false) { ?>
                    <li class="<?php echo $this->base_config->activelinknav('lokettiket'); ?>" title="lokettiket">
                        <a href="cms/tiket_lokal">
                            <span class="menu_icon"><i class="material-icons">location_searching</i></span>
                            <span class="menu_title">Loket Tiket</span>
                        </a>
                    </li>
                <?php } ?>
                <?php
                if(
                    !$this->base_config->groups_access_sigle('menu','report_today') ||
                    !$this->base_config->groups_access_sigle('menu','report_harian') ||
                    !$this->base_config->groups_access_sigle('menu','report_bulanan') ||
                    !$this->base_config->groups_access_sigle('menu','report_ticket') ||
                    !$this->base_config->groups_access_sigle('menu','report_transaction') ||
                    !$this->base_config->groups_access_sigle('menu','report_barcode') ||
                    !$this->base_config->groups_access_sigle('menu','report_reservation') ||
                    !$this->base_config->groups_access_sigle('menu','report_price')||
                    !$this->base_config->groups_access_sigle('menu','assessment_result')
                ) { ?>
                    <li class="<?php
                    echo $this->base_config->activelinknav('report_today');
                    echo $this->base_config->activelinknav('report_harian');
                    echo $this->base_config->activelinknav('report_bulanan');
                    echo $this->base_config->activelinknav('report_transaction');
                    echo $this->base_config->activelinknav('report_ticket');
                    echo $this->base_config->activelinknav('report_barcode');
                    echo $this->base_config->activelinknav('report_reservation');
                    echo $this->base_config->activelinknav('report_price');
                    echo $this->base_config->activelinknav('assessment_result');
                    ?>" title="report">
                        <a href="#">
                            <span class="menu_icon"><i class="material-icons">receipt</i></span>
                            <span class="menu_title">Report</span>
                        </a>
                        <ul>
                            <?php $media = $this->base_config->groups_access_sigle('menu','report_transaction'); if($media == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('report_transaction', true); ?>" title="Report Transaction">
                                    <a href="cms/report_transaction">Transaction</a>
                                </li>
                            <?php } ?>

                            <?php $media = $this->base_config->groups_access_sigle('menu','report_ticket'); if($media == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('report_ticket', true); ?>" title="Report Ticket">
                                    <a href="cms/report_ticket">Ticket</a>
                                </li>
                            <?php } ?>

                            <?php $media = $this->base_config->groups_access_sigle('menu','report_today'); if($media == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('report_today', true); ?>" title="Report Today">
                                    <a href="cms/report_today">Hari ini</a>
                                </li>
                            <?php } ?>
                            <?php $media = $this->base_config->groups_access_sigle('menu','report_harian'); if($media == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('report_harian', true); ?>" title="Report harian">
                                    <a href="cms/report_harian">Harian</a>
                                </li>
                            <?php } ?>
                            <?php $media = $this->base_config->groups_access_sigle('menu','report_bulanan'); if($media == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('report_bulanan', true); ?>" title="Report Bulanan">
                                    <a href="cms/report_bulanan">Bulanan</a>
                                </li>
                            <?php } ?>
                            <?php $media = $this->base_config->groups_access_sigle('menu','assessment_result'); if($media == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('assessment_result', true); ?>" title="Report assessment_result">
                                    <a href="cms/assessment_result">Penilaian Wahana</a>
                                </li>
                            <?php } ?>
                            <?php $media = $this->base_config->groups_access_sigle('menu','assessment_plus'); if($media == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('assessment_plus', true); ?>" title="Report assessment_plus">
                                    <a href="cms/assessment_plus">Penilaian Tambahan</a>
                                </li>
                            <?php } ?>
                            <!-- <?php $media = $this->base_config->groups_access_sigle('menu','report_barcode'); if($media == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('report_barcode', true); ?>" title="Report Barcode">
                                    <a href="cms/report_barcode">Barcode</a>
                                </li>
                            <?php } ?>
                            <?php $media = $this->base_config->groups_access_sigle('menu','report_reservation'); if($media == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('report_reservation', true); ?>" title="Report Reservation">
                                    <a href="cms/report_reservation">Reservation</a>
                                </li>
                            <?php } ?> -->
                            <!-- <?php $media = $this->base_config->groups_access_sigle('menu','report_price'); if($media == false) { ?>
                                <li class="<?php echo $this->base_config->activelinknav('report_price', true); ?>" title="Report price">
                                    <a href="cms/report_price">Price</a>
                                </li>
                            <?php } ?> -->
                        </ul>
                    </li>
                <?php } ?>
                <li class="<?php echo $this->base_config->activelinknav('users'); ?>" title="<?php echo lang('nav_menu_users'); ?>">
                    <a href="#">
                        <span class="menu_icon"><i class="material-icons">&#xE7EF;</i></span>
                        <span class="menu_title"><?php echo lang('nav_menu_users'); ?></span>
                    </a> 
                    <ul>
                        <?php if($this->ion_auth->is_admin()): ?>
                        <li class="<?php echo $this->base_config->activelinknav('users',true); ?>"><a href="cms/users">All Users</a></li>
                        <?php endif;?>
                        <?php $user_loket = $this->base_config->groups_access_sigle('menu','user_loket'); if($user_loket == false): ?>
                        <li class="<?php echo $this->base_config->activelinknav('user_loket',true); ?>"><a href="cms/user_loket">Loket</a></li>
                        <?php endif;?>
                        <?php if($this->ion_auth->is_admin()): ?>
                        <li class="<?php echo $this->base_config->activelinknav('groups',true); ?>"><a  href="cms/groups"><?php echo lang('nav_menu_users_group'); ?></a></li>
                        <?php endif;?>
                        <li class="<?php echo $this->base_config->activelinknav('profile',true); ?>"><a  href="cms/profile"><?php echo lang('nav_menu_users_profile'); ?></a></li>
                    </ul>
                </li>
                <?php if($this->ion_auth->is_admin()){ ?>
                <li class="<?php echo $this->base_config->activelinknav('setting'); ?>" title="<?php echo lang('nav_menu_setting'); ?>">
                    <a href="cms/setting">
                        <span class="menu_icon"><i class="material-icons">&#xE8B8;</i></span>
                        <span class="menu_title"><?php echo lang('nav_menu_setting'); ?></span>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </aside><!-- main sidebar end -->