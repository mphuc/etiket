
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
	$this->set_js($this->default_theme_path.'/twitter-bootstrap/js/jquery.functions.js');

	$this->set_js($this->default_theme_path.'/twitter-bootstrap/js/app/twitter-bootstrap.js');
    if($list_upload != null && !empty($list_upload))
	$this->set_css($this->default_theme_path.'/twitter-bootstrap/js/libs/dropzone/dist/dropzone.css');
	$this->set_js($this->default_theme_path.'/twitter-bootstrap/js/libs/dropzone/dist/dropzone.js');
	?>

<?php

	$table= str_replace("tb_","",$subject);
	$ci = &get_instance();
?>

<script type="text/javascript">
	var base_url = "<?php echo base_url();?>",
		subject = "<?php echo $subject?>",
		ajax_list_info_url = "<?php echo $ajax_list_info_url?>",
		unique_hash = "<?php echo $unique_hash; ?>",
		message_alert_delete = "<?php echo $this->l('alert_delete'); ?>";
</script>
<!-- UTILIZADO PARA IMPRESSÃO DA LISTAGEM -->
<div id="hidden-operations"></div>


<div id="page_content">
    <div id="page_content_inner">
    	<h3 class="heading_b"><?php echo $this->l('list_title').' '.$table ?></h3>
        <div class="uk-grid" data-uk-grid-margin>
          
            <?php if($actionfalse != true) { ?>
            <div class="uk-width-medium-1">
                <div class="md-card">
                    <div class="md-card-toolbar">
                        <h3 class="md-card-toolbar-heading-text">
                            <?php echo $this->l('list_actions');?>
                        </h3>
                    </div>
                    <div class="md-card-content">
                       <div class="uk-grid" data-uk-grid-margin=""> 
	                        <div id="options-content" class="uk-width-medium-1-2">
	                        	<?php
	                        	
								if(!$unset_add || !$unset_export || !$unset_print){?>
									<?php if(!$unset_add){?>
										<a href="<?php echo $add_url?>" title="<?php echo $this->l('list_add'); ?> <?php echo str_replace("tb_","",$subject)?>" class="md-btn">
											<i class="icon-plus"></i>
											<?php echo $this->l('list_add'); ?> <?php echo str_replace("tb_","",$subject)?>
										</a>
										<div class="md-fab-wrapper">
									        <a class="md-fab md-fab-primary"  href="<?php echo $add_url?>" title="<?php echo $this->l('list_add'); ?> <?php echo str_replace("tb_","",$subject)?>">
												<i class="material-icons">&#xE150;</i>
									        </a>
									    </div>
						 			<?php
						 			}
						 			if(!$unset_export) { ?>
							 			<a class="export-anchor md-btn" data-url="<?php echo $export_url; ?>" rel="external">
							 				<i class="icon-download"></i>
							 				<?php echo $this->l('list_export');?>
							 			</a>
						 			<?php
						 			}
						 			if(!$unset_print) { ?>
							 			<a class="print-anchor md-btn" data-url="<?php echo $print_url; ?>">
							 				<i class="icon-print"></i>
							 				<?php echo $this->l('list_print');?>
							 			</a>
						 			<?php
						 			}
						 		} ?>
	                             <a class="md-btn" data-toggle="modal" href="#filtering-form-search"><i class="icon-search"></i> <?php echo $this->l('list_search');?></a>
	                        </div>
                		</div>                         
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php if($list_upload != null && !empty($list_upload)) { ?>
            <div class="uk-width-medium-1">
                <div class="md-card">
                     <div class="md-card-content">
                        <div class="uk-grid" data-uk-grid-margin=""> 
                            <div id="options-content" class="uk-width-1">
                                <form action="<?php echo site_url('/img/upload'); ?>" id="uploadmedia" class="dropzone"  ></form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php  } ?>
        </div>

        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1">
                <div class="md-card">
                    <div class="md-card-toolbar">
                        <h3 class="md-card-toolbar-heading-text">
                           <?php echo $this->l('list_table').' '.$table ?>
                        </h3>
                    </div>
                    <div class="md-card-content">
                        <!-- CONTENT FOR ALERT MESSAGES -->
                        <div>
						<div  id="message-box" class="uk-width-medium-1">
							<div class="uk-alert uk-alert-success <?php echo ($success_message !== null) ? '' : 'hide'; ?>">
								<a class="close" data-dismiss="alert" href="#"> x </a>
								<?php echo ($success_message !== null) ? $success_message : ''; ?>
							</div>
						</div>
						<div class="uk-grid">
							<div class="uk-width-medium-5-10">
								<?php if($lisfilter == true) { ?>
								<a class="listtypea <?php echo $ci->base_config->activelinkCRUD(''); ?>" href="<?php echo $state_list_url;?>"> <?php echo $this->l('bulk_all'); ?> </a>
								<a class="listtypea <?php echo $ci->base_config->activelinkCRUD('publish'); ?>" href="<?php echo $state_list_url;?>/publish"><?php echo $this->l('bulk_inpub'); ?></a>
								<a class="listtypea <?php echo $ci->base_config->activelinkCRUD('draf'); ?>" href="<?php echo $state_list_url;?>/draf"><?php echo $this->l('bulk_indraf'); ?></a>
								<a class="nobdright <?php echo $ci->base_config->activelinkCRUD('trash'); ?>" href="<?php echo  $state_list_url;?>/trash"><?php echo $this->l('bulk_intrash'); ?></a>
								<?php } ?>
                                <?php if($listfilterfeed == true) { ?>
                                <a class="listtypea <?php echo $ci->base_config->activelinkCRUD(''); ?>" href="<?php echo $state_list_url;?>"> <?php echo $this->l('bulk_all'); ?> </a>
                                <a class="listtypea <?php echo $ci->base_config->activelinkCRUD('approved'); ?>" href="<?php echo $state_list_url;?>/approved"><?php echo $this->l('feed_approve'); ?></a>
                                <a class="listtypea <?php echo $ci->base_config->activelinkCRUD('pending'); ?>" href="<?php echo $state_list_url;?>/pending"><?php echo $this->l('feed_pendding'); ?></a>
                                <a class="listtypea <?php echo $ci->base_config->activelinkCRUD('spam'); ?>" href="<?php echo  $state_list_url;?>/spam"><?php echo $this->l('feed_spam'); ?></a>
                                <a class="nobdright <?php echo $ci->base_config->activelinkCRUD('trash'); ?>" href="<?php echo  $state_list_url;?>/trash"><?php echo $this->l('feed_trash'); ?></a>
                                <?php } ?>
							</div>
							<div class="uk-width-medium-1-10">
								
							</div>
							<div class="uk-width-medium-4-10">
                                <?php if($bulkaction != true) { ?>
					            <div class="uk-button-dropdown pull-right" data-uk-dropdown="{mode:'click'}">
					                <button class="md-btn "><?php echo $this->l('bulk_action'); ?> <i class="material-icons">&#xE313;</i></button>
					                <div class="uk-dropdown uk-dropdown-small">
					                    <ul class="uk-nav uk-nav-dropdown">
					                    	<li class="uk-nav-header"><?php echo $this->l('bulk_action'); ?></li>
					                    	<?php if($lisfilter == true) { ?>
					                    	<li><a class="changedraf" id="Publish" href="#"><?php echo $this->l('bulk_pub'); ?></a></li>
					                    	<li><a class="changedraf" id="Draf" href="#"><?php echo $this->l('bulk_draf'); ?></a></li>
					                        <li><a class="changedraf" id="Trash" href="#"><?php echo $this->l('bulk_trash'); ?></a></li>
					                        <?php } ?>
                                            <?php if($listfilterfeed == true) { ?>
                                            <li><a class="changedraf" id="Approved" href="#"><?php echo $this->l('feed_approve'); ?></a></li>
                                            <li><a class="changedraf" id="Pending" href="#"><?php echo $this->l('feed_unapprove'); ?></a></li>
                                            <li><a class="changedraf" id="Spam" href="#"><?php echo $this->l('feed_markspam'); ?></a></li>
                                            <li><a class="changedraf" id="Trash" href="#"><?php echo $this->l('feed_movetrash'); ?></a></li>
                                            <?php } ?>
					                        <li><a id="deleteall" href="#"><?php echo $this->l('bulk_del'); ?></a></li>
					                    </ul>
					                </div>
					            </div>
                                 <?php } ?>
					        </div>
					     </div>	
						
                        <div id="ajax_list">
							<?php echo $list_view; ?>
						</div>
						<div class="uk-grid" data-uk-grid-margin>
	                        <div class="uk-width-large-1-4 uk-width-medium-1-2">
	                            <div class="uk-input-group">
	                                <select style="width:80px;" name="tb_per_page" id="tb_per_page">
										<?php foreach($paging_options as $option){?>
											<option value="<?php echo $option; ?>" <?php echo ($option == $default_per_page) ? 'selected="selected"' : ''; ?> > <?php echo $option; ?> </option>
										<?php }?>
									</select>
	                            </div>
	                        </div>
	                        <div class="uk-width-large-1-4 uk-width-medium-1-2">
	                            <div style="margin-top:15px;" class="uk-input-group">
	                                <?php
									$paging_starts_from = '<span  id="page-starts-from">1</span>';
									$paging_ends_to = '<span id="page-ends-to">'. ($total_results < $default_per_page ? $total_results : $default_per_page) .'</span>';
									$paging_total_results = '<span id="total_items" >'.$total_results.'</span>';
									echo str_replace( array('{start}','{end}','{results}'), array($paging_starts_from, $paging_ends_to, $paging_total_results), $this->l('list_displaying')); ?>
									<?php echo $this->l('list_page'); ?>
	                            </div>
	                        </div>
	                        <div class="uk-width-large-1-4 uk-width-medium-1-2">
	                            <div class="uk-input-group">
	                               <input class="md-input" name="tb_crud_page" type="text" value="1" size="4" id="tb_crud_page">
	                            </div>
	                        </div>
	                        <div class="uk-width-large-1-4 uk-width-medium-1-2">
	                            <div class="uk-input-group">
	                            	
									<input disabled class="md-input" value="of <?php echo ceil($total_results / $default_per_page); ?>" />
	                               <div class="hide loading" id="ajax-loading"><?php echo $this->l('form_update_loading'); ?></div>
	                            </div>
	                        </div>
	                    </div>
       					<ul class="pager">
							<li class="previous first-button"><a href="javascript:void(0);">&laquo; <?php echo $this->l('list_paging_first'); ?></a></li>
							<li class="prev-button"><a href="javascript:void(0);">&laquo; <?php echo $this->l('list_paging_previous'); ?></a></li>
							<li class="next-button"><a href="javascript:void(0);"><?php echo $this->l('list_paging_next'); ?> &raquo;</a></li>
							<li class="next last-button"><a href="javascript:void(0);"><?php echo $this->l('list_paging_last'); ?> &raquo;</a></li>
						</ul>
						</div>
                        <div class="md-card-fullscreen-content">
                            <h4 class="heading_a uk-margin-bottom">Fullscreen</h4>
                            Full Disini
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal hide" id="filtering-form-search">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">✕</button>
        <h3><?php echo $this->l('list_search') . ' <i>' .$table; ?></i></h3>
    </div>
        <div class="modal-body">
        <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin="">
                        <div class="uk-width-medium-1">
                            <?php echo form_open( $ajax_list_url, 'method="post" id="filtering_form" autocomplete = "off"'); ?>
                            <input type="hidden" name="page" value="1" size="4" id="crud_page">
							<input type="hidden" name="per_page" id="per_page" value="<?php echo $default_per_page; ?>" />
							<input type="hidden" name="order_by[0]" id="hidden-sorting" value="<?php if(!empty($order_by[0])){?><?php echo $order_by[0]?><?php }?>" />
							<input type="hidden" name="order_by[1]" id="hidden-ordering"  value="<?php if(!empty($order_by[1])){?><?php echo $order_by[1]?><?php }?>"/>
							<div class="uk-form-row">
                                <div class="md-input-wrapper"><label><?php echo $this->l('list_search');?></label>
                                	<input type="text" class="md-input qsbsearch_fieldox" name="search_text" size="30" id="search_text"><span class="md-input-bar"></span>
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <div class="md-input-wrapper"><label>Label</label>
                                	<select  name="search_field" id="search_field" data-md-selectize>
		                                <?php foreach($columns as $column){
		                                	$display = strip_tags(preg_replace('/<[^>]*>/', '',html_entity_decode($column->display_as,ENT_QUOTES,'UTF-8')));
		                                ?>
										<option value="<?php echo $column->field_name?>"><?php if(!empty($display)) echo $display; ?></option>
										<?php }?>
		                            </select>
                                </div>
                            </div>
                            <div class="uk-form-row">
                            	<div class="uk-grid" data-uk-grid-margin="">
		                        	<div class="uk-width-medium-1">
	                           			 <input class="md-btn md-btn-primary" type="button" data-dismiss="modal" value="<?php echo $this->l('list_search');?>" id="crud_search" />
	                           			 <input class="md-btn md-btn-success" type="button" data-dismiss="modal" value="<?php echo $this->l('list_clear_filtering');?>" id="search_clear" />
                        			</div>
                        		</div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

<script>
<?php if($list_upload != null) {?>
Dropzone.options.uploadmedia = {
  paramName: "file", 
  addRemoveLinks:true,
  maxFilesize: 2, 
  acceptedFiles: "audio/*,image/*,video/*",
  queuecomplete: function(file,response){
    $('#filtering_form').trigger('submit');
  }
};
<?php } ?>
$("#deleteall").on("click",function(){
	UIkit.modal.confirm(message_alert_delete, function(){
        $(".removelist:checkbox").each(function() {
	        if ($(this).is(":checked")) {
	        	var $this = $(this).closest('tr');
				  $this.hide("slow", "linear").delay(200).animate({"left": "-320px"}, 300,function(){
				  	deteleGroceryCrudInformation($this.find('.delete-row').attr('data-target-url'));
				   	$this.remove();
				  });
	        }
		    });
    });
     return false;
});
<?php if($lisfilter == true) { ?>
$(".changedraf").on("click",function(){
	var status = $(this).attr('id');
    $(".removelist:checkbox").each(function() {
        if ($(this).is(":checked")) {
        	var $this = $(this).closest('tr');
        	var id    = $(this).attr('id');
	         var url  = "<?php echo base_url(); ?>cms/posts/set_post_status/";
	         if(id !== "") {
	            $.post(url,{ id:id, status:status}, function (html) {
	            	if(status == 'Draf') { 
	            		$this.find('.uk-badge').text(status).removeClass('uk-badge-danger').removeClass('uk-badge-success').toggleClass('uk-badge-warning');
	            	}else if(status == 'Trash') {
	            		$this.find('.uk-badge').text(status).removeClass('uk-badge-success').removeClass('uk-badge-warning').toggleClass('uk-badge-danger');
	            	}else {
	            		$this.find('.uk-badge').text(status).removeClass('uk-badge-danger').removeClass('uk-badge-warning').toggleClass('uk-badge-success');
	            	}
	            });
	         }
        }
    });
    return false;
});
<?php } ?>
<?php if($listfilterfeed == true) { ?>
$(".changedraf").on("click",function(){
    var status = $(this).attr('id');
    $(".removelist:checkbox").each(function() {
        if ($(this).is(":checked")) {
            var $this = $(this).closest('tr');
            var id    = $(this).attr('id');
             var url  = "<?php echo base_url(); ?>cms/comments/set_feed_status/";
             if(id !== "") {
                $.post(url,{ id:id, status:status}, function (html) {
                    if(status == 'Panding') { 
                        $this.find('.uk-badge').text(status).removeClass('uk-badge-danger').removeClass('uk-badge-success').toggleClass('uk-badge-warning');
                    }else if(status == 'Trash' || status == 'Spam') {
                        $this.find('.uk-badge').text(status).removeClass('uk-badge-success').removeClass('uk-badge-warning').toggleClass('uk-badge-danger');
                    }else {
                        $this.find('.uk-badge').text(status).removeClass('uk-badge-danger').removeClass('uk-badge-warning').toggleClass('uk-badge-success');
                    }
                });
             }
        }
    });
    return false;
});
<?php } ?>
</script>