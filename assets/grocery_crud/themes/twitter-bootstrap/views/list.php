<?php
$ci = &get_instance();
if(!empty($list)){ ?>
		<div style="max-width:100%;" class="scrollbar-inner scroll-content scroll-scrolly_visible">
        <table class="uk-table uk-table-hover uk-text-nowrap tablesorter uk-table-striped ">
            <thead>
	            <tr>
	            	<?php if(!$unset_delete || !$unset_edit || !empty($actions)){?>
					<th align="center" class="no-sorter">
							<?php echo $this->l('list_actions'); ?>
					</th>
					<?php }?>
					<?php 
					$x=1;
					foreach($columns as $column){?>
					<th <?php if($x == count($columns) ) {?>>
						<?php echo $column->display_as; ?>
						<?php }else { ?> 
						<div class="text-left field-sorting <?php if(isset($order_by[0]) &&  $column->field_name == $order_by[0]){?><?php echo $order_by[1]?><?php }?>"
							rel="<?php echo $column->field_name?>">
							<?php echo $column->display_as; ?>
						</div>
						<?php } ?>
					</th>
					<?php
					$x++;
					 }?>
				</tr>
            </thead>
            <tbody>
			<?php foreach($list as $num_row => $row){?>
			<tr class="<?php echo ($num_row % 2 == 1) ? 'erow' : ''; ?>">
				<?php if(!$unset_delete || !$unset_edit || !empty($actions)){?>
					<td align="left">
					<div class="">
                            <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}">
                                <button class="md-btn mdn-btn-small"> <?php echo $this->l('list_actions'); ?> <i class="material-icons">&#xE313;</i></button>
                                <div class="uk-dropdown uk-dropdown-small">
                                    <ul class="uk-nav uk-nav-dropdown">
                                        <?php
											if(!$unset_edit){?>
												<li>
													<a href="<?php echo $row->edit_url?>" title="<?php echo $this->l('list_edit')?> <?php echo str_replace("tb_","",$subject)?>">
														<i class="icon-pencil"></i>
														<?php echo $this->l('list_edit') . ' ' . str_replace("tb_","",$subject); ?>
													</a>
												</li>
											<?php
											}
											if(!$unset_delete){?>
												<li>
													<a href="javascript:void(0);" data-target-url="<?php echo $row->delete_url?>" title="<?php echo $this->l('list_delete')?> <?php echo str_replace("tb_","",$subject)?>" class="delete-row" >
														<i class="icon-trash"></i>
														<?php echo $this->l('list_delete') . ' ' . str_replace("tb_","",$subject); ?>
													</a>
												</li>
											<?php
											}
											if(!empty($row->action_urls)){
												foreach($row->action_urls as $action_unique_id => $action_url){
													$action = $actions[$action_unique_id];
													?>
													<li>
														<a href="<?php echo $action_url; ?>" class="<?php echo $action->css_class; ?> crud-action" title="<?php echo $action->label?>"><?php
														if(!empty($action->image_url)){ ?>
															<img src="<?php echo $action->image_url; ?>" alt="" />
														<?php
														}
														echo ' '.$action->label;
														?>
														</a>
													</li>
												<?php
												}
											}
											?>
                                    </ul>
                                </div>
                            </div>
                        </div>
					</td>
				<?php }?>
				<?php foreach($columns as $column){?>
					<td class="<?php if(isset($order_by[0]) &&  $column->field_name == $order_by[0]){?>sorted<?php }?>">
						<div class="text-left"><?php echo  ($row->{$column->field_name} != '') ? $row->{$column->field_name} : '&nbsp;' ; ?></div>
					</td>
				<?php }?>
				</tr>
				<?php } ?>
		</tbody>
        </table>
    </br></br>
    	</div>
<?php }else{ ?>
	<br/><?php echo $this->l('list_no_items'); ?><br/><br/>
<?php }?>
<script>
  $('document').ready(function() { 
	$('#removeall').click(function() {
	    var c = this.checked;
	    $('.removelist:checkbox').prop('checked',c);
	});
});

</script>