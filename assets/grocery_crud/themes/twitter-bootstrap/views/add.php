<?php
$this->set_css($this->default_theme_path.'/twitter-bootstrap/css/bootstrap.min.css');
$this->set_css($this->default_theme_path.'/twitter-bootstrap/css/bootstrap-responsive.min.css');
$this->set_css($this->default_theme_path.'/twitter-bootstrap/css/style.css');
$this->set_css($this->default_theme_path.'/twitter-bootstrap/css/jquery-ui/flick/jquery-ui-1.9.2.custom.css');
$this->set_js($this->default_theme_path.'/twitter-bootstrap/js/jquery-ui/jquery-ui-1.9.2.custom.js');
$this->set_js_lib($this->default_javascript_path.'/common/lazyload-min.js');

if (!$this->is_IE7()) {
	$this->set_js_lib($this->default_javascript_path.'/common/list.js');
}

$this->set_js($this->default_theme_path.'/twitter-bootstrap/js/libs/bootstrap/bootstrap.min.js');
$this->set_js($this->default_theme_path.'/twitter-bootstrap/js/libs/bootstrap/application.js');


$this->set_js($this->default_theme_path.'/twitter-bootstrap/js/libs/modernizr/modernizr-2.6.1.custom.js');

$this->set_js($this->default_theme_path.'/twitter-bootstrap/js/libs/tablesorter/jquery.tablesorter.min.js');

$this->set_js($this->default_theme_path.'/twitter-bootstrap/js/cookies.js');

$this->set_js($this->default_theme_path.'/twitter-bootstrap/js/jquery.form.js');

$this->set_js($this->default_javascript_path.'/jquery_plugins/jquery.numeric.min.js');

$this->set_js($this->default_theme_path.'/twitter-bootstrap/js/libs/print-element/jquery.printElement.min.js');

$this->set_js($this->default_javascript_path.'/jquery_plugins/jquery.fancybox-1.3.4.js');

$this->set_js($this->default_javascript_path.'/jquery_plugins/jquery.easing-1.3.pack.js');

$this->set_js_config($this->default_theme_path.'/twitter-bootstrap/js/app/twitter-bootstrap-add.js');

$this->set_css($this->default_theme_path.'/twitter-bootstrap/js/libs/dropzone/dist/dropzone.css');
$this->set_js($this->default_theme_path.'/twitter-bootstrap/js/libs/dropzone/dist/dropzone.js');


$table= str_replace("tb_","",$subject);
?>

<div id="page_content">
        <div id="page_heading">
            <h1><?php echo $this->l('form_add'); ?> <?php echo $table?> 
            <?php if(!$this->unset_back_to_list) { ?>
             <button type="button" class="md-btn mdn-btn-small pull-right return-to-list"><?php echo $this->l('list_back'); ?></button>
            <?php } ?> </h1>
            <span class="uk-text-muted uk-text-upper uk-text-small" id="product_edit_sn"><?php echo $this->l('list_add_dec'); ?></span>
        </div>
        <div id="page_content_inner">
        	<?php
			echo form_open( $insert_url, 'method="post" id="crudForm" class="form-div uk-form-stacked " autocomplete="off" enctype="multipart/form-data"');
			?>
                <div class="uk-grid uk-grid-medium ">
                	<div class="uk-width-xLarge-8-10  uk-width-large-7-10" >
                        <div class="md-card">
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text">
                                    <?php echo $this->l('form_detail'); ?>
                                </h3>
                            </div>
                            <div class="md-card-content large-padding">

                                <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                                    <div class="uk-width-large-1">
                                        <span id="message-box" class="uk-width-medium-1"></span>
                                    	<?php
                                    	foreach($fields as $field)
										{ 
											if($input_fields[$field->field_name]->crud_type != "upload_file" && $input_fields[$field->field_name]->crud_type != "datetime" && $input_fields[$field->field_name]->crud_type != "date" && $input_fields[$field->field_name]->crud_type != "enum") {
                                    	?>
	                                        <div class="uk-form-row" id="<?php echo $field->field_name; ?>_field_box">
		                                            <label id="<?php echo $field->field_name; ?>_display_as_box" for="<?php echo $field->field_name; ?>"><?php echo $input_fields[$field->field_name]->display_as; ?><?php echo ($input_fields[$field->field_name]->required)? '<span class="required">*</span>' : ""; ?></label>
													<?php echo $input_fields[$field->field_name]->input?>
	                                        </div>
                                        <?php
                                        	}
                                    	}
                                        foreach($hidden_fields as $hidden_field){
                                            echo $hidden_field->input;
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"><br></h3>
                            </div>
                        </div>
                    </div>
 
                    <div class="uk-width-xLarge-2-10 uk-width-large-3-10 uk-sortable sortable-handler" data-uk-grid-margin data-uk-sortable>
                                 <?php
                                $z      = 0;
                                $tmp    = false;
                                foreach($fields as $field)
                                {
                                    if($input_fields[$field->field_name]->crud_type == "datetime" || $input_fields[$field->field_name]->crud_type == "date") {
                                        $tmp = true;
                                        if($z < 1){
                                ?>
                                <div class="md-card">
                                    <div class="md-card-toolbar">
                                        <h3 class="md-card-toolbar-heading-text">
                                            <?php echo $this->l('form_date'); ?> 
                                        </h3>
                                    </div>
                                    <div class="md-card-content">
                                <?php
                                        }
                                ?>
                                <div  id="<?php echo $field->field_name; ?>_field_box">
                                    <div  id="<?php echo $field->field_name; ?>_display_as_box">
                                        <br><?php echo $input_fields[$field->field_name]->display_as; ?><?php echo ($input_fields[$field->field_name]->required)? '<span class="required">*</span>' : ""; ?> :
                                    </div>
                                    <div  id="<?php echo $field->field_name; ?>_input_box">
                                        <?php echo $input_fields[$field->field_name]->input?>
                                    </div>
                                </div>
                                <?php
                                        $z++;
                                    }
                                    
                                }
                                if($tmp == true) {
                                    echo "</div></div>";
                                }
                                ?>
                                <?php
                               $no      = 0;
                               $akhir    = false;
                                foreach($fields as $field)
                                {
                                    
                                    if($input_fields[$field->field_name]->crud_type == "enum") {
                                        if($no ==  0){
                                            $akhir = true;
                                ?>
                                    <div class="md-card">
                                    <div class="md-card-toolbar">
                                        <h3 class="md-card-toolbar-heading-text">
                                            <?php echo $this->l('form_select'); ?> 
                                        </h3>
                                    </div>
                                    <div class="md-card-content">
                                <?php
                                        }
                                ?>
                                <div  id="<?php echo $field->field_name; ?>_field_box">
                                    <div  id="<?php echo $field->field_name; ?>_display_as_box">
                                        <?php echo $input_fields[$field->field_name]->display_as; ?><?php echo ($input_fields[$field->field_name]->required)? '<span class="required">*</span>' : ""; ?> :
                                    </div>
                                    <div  id="<?php echo $field->field_name; ?>_input_box">
                                        <?php echo $input_fields[$field->field_name]->input?>
                                    </div>
                                </div>
                                <?php
                                    $no++;
                                    }
                                }
                                if($akhir == true) {
                                    echo "</div></div>";
                                }
                                ?>
                               <?php
                               $x       = 0;
                               $tmp1    = false;
                                foreach($fields as $field)
                                {
                                    if($input_fields[$field->field_name]->crud_type == "upload_file") {
                                        if($x<1){
                                        $tmp1 = true;    
                                ?>
                                    <div class="md-card">
                                    <div class="md-card-toolbar">
                                        <h3 class="md-card-toolbar-heading-text">
                                            <?php echo $this->l('form_file'); ?> 
                                        </h3>
                                    </div>
                                    <div class="md-card-content">
                                <?php
                                        }
                                ?>
                                <div  id="<?php echo $field->field_name; ?>_field_box">
                                    <div  id="<?php echo $field->field_name; ?>_display_as_box">
                                        <?php echo $input_fields[$field->field_name]->display_as; ?><?php echo ($input_fields[$field->field_name]->required)? '<span class="required">*</span>' : ""; ?> :
                                    </div>
                                    <div  id="<?php echo $field->field_name; ?>_input_box">
                                        <?php echo $input_fields[$field->field_name]->input?>
                                    </div>
                                </div>
                                <?php
                                    $x++;
                                    }
                                    
                                }
                                if($tmp1 == true) {
                                        echo "</div></div>";
                                }
                                ?>
                            
                        <?php if($composer == true) {?>        
                        <div class="md-card">
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text">
                                    <?php echo $this->l('widget_title_fitur'); ?> 
                                </h3>
                            </div>
                            <div class="md-card-content">
                                <div id="tampilfitur" class="uk-margin-bottom uk-text-center uk-position-relative">
                                </div>
                                <p class="center"><br><span data-uk-modal="{target:'#multipleupload'}" class='md-btn md-btn-primary'> <?php echo $this->l('add_media'); ?></span></p>  
                            </div>
                        </div>
                         <?php } ?>
                        <div class="md-card">
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text">
                                    <?php echo $this->l('list_actions'); ?> 
                                </h3>
                            </div>
                            <div class="md-card-content">
                                <div class="uk-grid" data-uk-grid-margin=""> 
                                    <div id="options-content" class="uk-width-medium-1">
                                        <div class="md-fab-wrapper">
                                            <button type="button" class="md-fab md-fab-primary save-and-go-back-button">
                                                <i class="material-icons">&#xE161;</i>
                                            </button>
                                        </div>
                                        <button type="button" class="md-btn md-btn-primary mdn-btn-small submit-form"><?php echo $this->l('form_save'); ?></button>
                                        <?php if(!$this->unset_back_to_list) { ?>
                                         <button type="button" class="md-btn mdn-btn-small md-btn-success save-and-go-back-button"><?php echo $this->l('form_save_and_go_back'); ?></button>
                                         <button type="button" class="md-btn mdn-btn-small return-to-list"><?php echo $this->l('form_cancel'); ?></button>
                                        <?php } ?>
                                    </div>
                                </div> 
                            </div>
                        </div>
                       
                    </div> 


                </div>
            <?php echo form_close(); ?>

        </div>
</div>

 <?php if($composer == true) {?> 
<div class="uk-modal" id="multipleupload">
    <div class="uk-modal-dialog uk-modal-dialog-large">
        <button type="button" class="uk-modal-close uk-close"></button>
        <div class="uk-modal-header">
            <h3 class="uk-modal-title"><?php echo $this->l('insert_media'); ?></h3>
        </div>
        <div class="uk-width-large-1">
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-medium-1-10">
                    <ul class="uk-tab uk-tab-right" data-uk-tab="{connect:'#tabs_6', animation:'slide-vertical'}">
                        <li class="uk-active"><a href="#"><?php echo $this->l('insert_media'); ?></a></li>
                        <li ><a href="#"><?php echo $this->l('insert_fitur'); ?></a></li>
                        <li><a href="#"><?php echo $this->l('insert_gallery'); ?></a></li>
                    </ul>
                </div>
                <div class="uk-width-medium-9-10 mintop">
                    <div class="uk-input-group">
                        <div class="md-input-wrapper"><label><?php echo $this->l('media_search'); ?></label><input type="text" id="searchmedia" class="md-input"><span class="md-input-bar"></span></div>
                        <span class="uk-input-group-addon">
                            <i class="material-icons">&#xE8B6;</i>
                        </span>
                    </div>
                    <ul id="tabs_6" class="uk-switcher uk-margin-small-top">
                        <li>
                            <div class="uk-width-1-1">
                                <ul class="uk-tab" data-uk-tab="{connect:'#tabs_1', animation:'slide-horizontal'}">
                                    <li class="uploadmedia"><a href="#"><?php echo $this->l('upload'); ?></a></li>
                                    <li class="librarymedia"><a  href="#"><?php echo $this->l('media_library'); ?></a></li>
                                </ul>
                                <ul id="tabs_1" class="uk-switcher uk-margin">
                                    <li class="uploadli"><form action="<?php echo site_url('/img/upload'); ?>" id="mediaumbrella2" class="dropzone"  ></form></li>
                                    <li class="mediali">
                                        <div id="insert" class="uk-grid uk-grid-width-small-1-3 medialist librarymediacontent" data-uk-grid-margin></div>
                                    </li>
                                </ul>
                                <div class="pagging"></div>
                            </div>                          
                        </li>
                        <li>
                            <div class="uk-width-1-1">
                                <ul class="uk-tab" data-uk-tab="{connect:'#tabs_2', animation:'slide-horizontal'}">
                                    <li class="uploadmedia"><a href="#"><?php echo $this->l('upload'); ?></a></li>
                                    <li class="librarymedia"><a href="#"><?php echo $this->l('media_library'); ?></a></li>
                                </ul>
                                <ul id="tabs_2" class="uk-switcher uk-margin">
                                    <li class="uploadli"><form action="<?php echo site_url('/img/upload'); ?>" id="mediaumbrella1" class="dropzone"  ></form></li>
                                    <li class="mediali">
                                        <div id="fitur" class="uk-grid uk-grid-width-small-1-3 medialist librarymediacontent" data-uk-grid-margin></div>
                                    </li>
                                </ul>
                                <div class="pagging"></div>
                            </div>                          
                        </li>
                        <li>
                            <div class="uk-width-1-1">
                                <ul class="uk-tab" data-uk-tab="{connect:'#tabs_3', animation:'slide-horizontal'}">
                                    <li class="uploadmedia"><a href="#"><?php echo $this->l('upload'); ?></a></li>
                                    <li class="librarymedia"><a href="#"><?php echo $this->l('media_library'); ?></a></li>
                                </ul>
                                <ul id="tabs_3" class="uk-switcher uk-margin">
                                    <li class="uploadli"><form action="<?php echo site_url('/img/upload'); ?>" id="mediaumbrella3" class="dropzone"  ></form></li>
                                    <li class="mediali">
                                        <div id="gallery" class="uk-grid uk-grid-width-small-1-3 medialist librarymediacontent" data-uk-grid-margin></div>
                                    </li>
                                </ul>
                                <div class="pagging"></div>
                            </div>                          
                        </li>
                    </ul>
                </div>
                
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"> 
    $('document').ready(function() {
        var disabled_auto_save=false;
        getmedia(0);
        $( ".librarymedia" ).click(function() {
            $(".librarymediacontent").html();
            getmedia(0);
        });
        
        $( "#searchmedia" ).keyup(function() {
             var limit = 0 ;
             var keyword = $(this).val();
             setTimeout(function(){
                  if(keyword == "" || keyword == " "){
                    getmedia(0);
                  }else {
                    console.log(keyword);
                    getSearch(limit,keyword);
                  }
              },500);
        });
        $('#field-post_title').on('keyup',function () {
            var text = $(this).val();
            setTimeout(function(){
                if(text == $('#field-post_title').val() && text != null && text != "") {
                    $( "#field-post_seo_title" ).val(text).attr("maxlength", 70);
                }
                else if(text == ''){
                    $( "#field-post_seo_title" ).val("").attr("maxlength", 70);
                }
            },50);
            setTimeout(function(){
            if(text.length > 20 && disabled_auto_save == false &&  text == $('#field-post_title').val() && text != null && text != "") {
               var status = $("#field-post_status").val();
      
               if(status == null){
                var $select = $("#field-post_status").selectize();
                var selectize = $select[0].selectize;
                selectize.setValue(selectize.search("Draf").items[0].id);
               }
               var save_and_close = true;
               disabled_auto_save = true;
               autoSubmitCrudForm($('#crudForm'), save_and_close);
             }
             },5500);
        });
    });

    function getSearch(limit,keyword) {
        if(limit == 0) {
            url ="<?php echo base_url(); ?>img/getmedia/0/search/";
        }else {
            url = "<?php echo base_url(); ?>img/getmedia"+limit+"/search/";
        }
        var output="";
        $.post(url,{ keyword :keyword}, function (html) {
           var res = $.parseJSON(html);
            if(typeof res !== 'undefined' || res.length) {
            $.each(res.data, function(i, item) {
                output+='<div class="btm5"><div class="md-card md-card-hover md-card-overlay noheight"><div class="noheight truncate-text "><img src="<?php echo site_url('/img/load/200/200/png/'); ?>/'+item.post_name+'"alt=""class="img_large"></div><div class="md-card-overlay-content "><div class="uk-clearfix md-card-overlay-header"><i class="md-icon md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i><h3>'+item.post_title+'</h3></div><p class="truncate-text"><div class="uk-form-row"><label>Title</label><input type="text" id="'+item.post_id+'" value="'+item.post_title+'"class="md-input mediatitle"/></div><div class="uk-form-row"><label>Caption</label><input id="'+item.post_id+'" type="text"value="'+item.post_content+'" class="md-input mediacaption"/></div><div class="uk-form-row"><button type="button"id="'+item.post_id+'"class="md-btn mdn-btn-small md-btn-primary addmedia">Insert to post</button></div></p></div></div></div>';
            });
          if(output == "") {
             $(".librarymediacontent").html("<?php echo $this->l('search_nothing'); ?><b>"+ keyword+"</b>");
          }else {
             $(".librarymediacontent").html(output).hide().show('slide', '', 1200);
          }
          $(".pagging").html(res.paging);  
           $(".searchPagingclick").click(function() {
                var limit = $(this).attr("href");
                var keyword = $( "#searchmedia" ).val();
                    getSearch(limit,keyword);
                    $(".mediali").toggleClass('uk-active').attr('aria-hidden', 'false');
            });
          var i = "undefined" == typeof e ? $(".md-input") : $(e).find(".md-input");
            i.each(function() {
                if (!$(this).closest(".md-input-wrapper").length) {
                    var e = $(this);
                    e.prev("label").length ? e.prev("label").andSelf().wrapAll('<div class="md-input-wrapper"/>') : e.siblings("[data-uk-form-password]").length ? e.siblings("[data-uk-form-password]").andSelf().wrapAll('<div class="md-input-wrapper"/>') : e.wrap('<div class="md-input-wrapper"/>'), e.closest(".md-input-wrapper").append('<span class="md-input-bar"/>'), altair_md.update_input(e)
                }
                $body.on("focus", ".md-input", function() {
                    $(this).closest(".md-input-wrapper").addClass("md-input-focus")
                }).on("blur", ".md-input", function() {
                    $(this).closest(".md-input-wrapper").removeClass("md-input-focus"), $(this).hasClass("label-fixed") || ("" != $(this).val() ? $(this).closest(".md-input-wrapper").addClass("md-input-filled") : $(this).closest(".md-input-wrapper").removeClass("md-input-filled"))
                }).on("change", ".md-input", function() {
                    altair_md.update_input($(this))
                });
            });
             var e = $(".md-card");
                e.each(function() {
                    var e = $(this);
                    e.hasClass("md-card-overlay-active") && e.find(".md-card-overlay-toggler").html("&#xE5CD;")
                }), e.on("click", ".md-card-overlay-toggler", function(e) {
                    e.preventDefault(), $(this).closest(".md-card").hasClass("md-card-overlay-active") ? $(this).html("&#xE5D4;").closest(".md-card").removeClass("md-card-overlay-active") : $(this).html("&#xE5CD;").closest(".md-card").addClass("md-card-overlay-active")
                });
                $(".mediatitle" ).keyup(function() {
                     var id    = $(this).attr('id');
                     var title = $(this).val();
                     var url   = "<?php echo base_url(); ?>img/mediaupdate/";
                     setTimeout(function(){
                         if(id !== "") {
                            $.post(url,{ id :id, title:title}, function (html) {
                            
                            });
                         }
                     },300);
                });
                $(".mediacaption" ).focusout(function() {
                     var id    = $(this).attr('id');
                     var caption = $(this).val();
                     var url   = "<?php echo base_url(); ?>img/mediaupdate/";
                     if(id !== "") {
                        $.post(url,{ id :id, caption:caption}, function (html) {
                         
                        });
                     }
                });
                $(".addmedia").click(function() { 
                    var type= $(this).parents('.librarymediacontent').attr('id');
                    var url = $(this).closest('.noheight').find('.img_large').attr('src');
                    var id  = $(this).attr('id');
                    insertmedia(id,url,type);
                });
          $(".uploadmedia").removeClass('uk-active').attr('aria-expanded', 'false');
          $(".librarymedia").toggleClass('uk-active').attr('aria-expanded', 'true');
          $(".uploadli").removeClass('uk-active').attr('aria-hidden', 'true');
          $(".mediali").addClass('uk-active').attr('aria-hidden', 'false');
          altair_helpers.content_preloader_hide(); 
            }
        });
    }
    function getmedia(limit) {
        altair_helpers.content_preloader_show();
        if(limit == 0) {
            url ="<?php echo base_url(); ?>img/getmedia/";
        }else {
            url = "<?php echo base_url(); ?>img/getmedia"+limit;
        }
        var output="";
        $.getJSON(url, function(res){
            $.each(res.data, function(i, item) {
                output+='<div class="btm5"><div class="md-card md-card-hover md-card-overlay noheight"><div class="noheight truncate-text "><img src="<?php echo site_url('/img/load/200/200/png/'); ?>/'+item.post_name+'"alt=""class="img_large"></div><div class="md-card-overlay-content "><div class="uk-clearfix md-card-overlay-header"><i class="md-icon md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i><h3>'+item.post_title+'</h3></div><p class="truncate-text"><div class="uk-form-row"><label>Title</label><input type="text" id="'+item.post_id+'" value="'+item.post_title+'"class="md-input mediatitle"/></div><div class="uk-form-row"><label>Caption</label><input id="'+item.post_id+'" type="text"value="'+item.post_content+'" class="md-input mediacaption" /></div><div class="uk-form-row"><button type="button" id="'+item.post_id+'" class="md-btn mdn-btn-small md-btn-primary addmedia">Insert to post</button></div></p></div></div></div>';
            });
          $(".librarymediacontent").html(output).hide().show('slide', '', 1200);
          $(".pagging").html(res.paging);  
           $(".pagingclick").click(function() {
                var limit = $(this).attr("href");
                if(limit !== "") {
                    getmedia(limit);
                    $(".mediali").toggleClass('uk-active').attr('aria-hidden', 'false');
                }else {
                    getmedia(0);
                }
            });
          var i = "undefined" == typeof e ? $(".md-input") : $(e).find(".md-input");
            i.each(function() {
                if (!$(this).closest(".md-input-wrapper").length) {
                    var e = $(this);
                    e.prev("label").length ? e.prev("label").andSelf().wrapAll('<div class="md-input-wrapper"/>') : e.siblings("[data-uk-form-password]").length ? e.siblings("[data-uk-form-password]").andSelf().wrapAll('<div class="md-input-wrapper"/>') : e.wrap('<div class="md-input-wrapper"/>'), e.closest(".md-input-wrapper").append('<span class="md-input-bar"/>'), altair_md.update_input(e)
                }
                $body.on("focus", ".md-input", function() {
                    $(this).closest(".md-input-wrapper").addClass("md-input-focus")
                }).on("blur", ".md-input", function() {
                    $(this).closest(".md-input-wrapper").removeClass("md-input-focus"), $(this).hasClass("label-fixed") || ("" != $(this).val() ? $(this).closest(".md-input-wrapper").addClass("md-input-filled") : $(this).closest(".md-input-wrapper").removeClass("md-input-filled"))
                }).on("change", ".md-input", function() {
                    altair_md.update_input($(this))
                });
            });
             var e = $(".md-card");
                e.each(function() {
                    var e = $(this);
                    e.hasClass("md-card-overlay-active") && e.find(".md-card-overlay-toggler").html("&#xE5CD;")
                }), e.on("click", ".md-card-overlay-toggler", function(e) {
                    e.preventDefault(), $(this).closest(".md-card").hasClass("md-card-overlay-active") ? $(this).html("&#xE5D4;").closest(".md-card").removeClass("md-card-overlay-active") : $(this).html("&#xE5CD;").closest(".md-card").addClass("md-card-overlay-active")
                });
                $(".mediatitle" ).focusout(function() {
                     var id    = $(this).attr('id');
                     var title = $(this).val();
                     var url   = "<?php echo base_url(); ?>img/mediaupdate/";
                     if(id !== "") {
                        $.post(url,{ id :id, title:title}, function (html) {
        
                        });
                     }
                });
                $(".mediacaption" ).focusout(function() {
                     var id    = $(this).attr('id');
                     var caption = $(this).val();
                     var url   = "<?php echo base_url(); ?>img/mediaupdate/";
                     if(id !== "") {
                        $.post(url,{ id :id, caption:caption}, function (html) {
                        });
                     }
                }); 
                $(".addmedia").click(function() { 
                    var type= $(this).parents('.librarymediacontent').attr('id');
                    var url = $(this).closest('.noheight').find('.img_large').attr('src');
                    var id  = $(this).attr('id');
                    insertmedia(id,url,type);
                });
                
          $(".uploadmedia").removeClass('uk-active').attr('aria-expanded', 'false');
          $(".librarymedia").toggleClass('uk-active').attr('aria-expanded', 'true');
          $(".uploadli").removeClass('uk-active').attr('aria-hidden', 'true');
          $(".mediali").addClass('uk-active').attr('aria-hidden', 'false');
          altair_helpers.content_preloader_hide();      
        });
    }
    function insertmedia(id,url,type) {
        if(type == 'gallery') {
            var mediainput = '<input type="hidden" value="'+id+'" id="field-media_gallery" name="media_gallery[]">';
            var classimg = 'img_small' ;
        }else {
            var mediainput = '<input type="hidden" value="'+id+'" id="field-post_parent" name="post_parent" />';
            var classimg = 'img_medium' ;
        }
        var html = '<li class="uk-position-relative"><button type="button" class="uk-modal-close uk-close uk-close-alt uk-position-absolute mediaempety"></button><img src="'+url+'" alt="" class="'+classimg+'"/>'+mediainput+'</li>';
        if(type == 'fitur' || type == 'insert') {
              $("#tampilfitur").html(html);
        }else {
             $("#tampil"+type).prepend(html);
        }
        UIkit.notify("<?php echo $this->l('add_succses_media'); ?> ", {status:'success'});
        $(".mediaempety").click(function() { 
             $(this).closest('li').fadeOut(500,function(){
               $(this).closest('li').remove();
               $('#field-post_parent').val('');
            });
        });
    }
      Dropzone.options.mediaumbrella1 = {
          paramName: "file", 
          addRemoveLinks:true,
          maxFilesize: 2, 
          acceptedFiles: "audio/*,image/*,video/*",
          queuecomplete: function(file,response){
             getmedia(0);
          }

        };
        Dropzone.options.mediaumbrella2 = {
          paramName: "file", 
          addRemoveLinks:true,
          maxFilesize: 2,
          acceptedFiles: "audio/*,image/*,video/*",
          success: function(file,response){
             getmedia(0);
          }

        };
        Dropzone.options.mediaumbrella3 = {
          paramName: "file",
          addRemoveLinks:true,
          maxFilesize: 2,
          acceptedFiles: "audio/*,image/*,video/*",
          success: function(file,response){
            getmedia(0);
          }

        };
 </script>
 <?php } ?>
<script>
	var validation_url = "<?php echo $validation_url?>",
		list_url = "<?php echo $list_url?>",
		message_alert_add_form = "<?php echo $this->l('alert_add_form')?>",
		message_insert_error = "<?php echo $this->l('insert_error')?>";
</script>