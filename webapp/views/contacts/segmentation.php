<script type="text/javascript" src="<?php echo $this->config->item('webappassets'); ?>js/fancybox/jquery.mousewheel-3.0.4.pack.js?v=6-20-13"></script>
<script type="text/javascript" src="<?php echo $this->config->item('webappassets'); ?>js/jquery.blockUI.js?v=6-20-13"></script>
<script type="text/javascript" src="<?php echo $this->config->item('webappassets'); ?>js/jquery.fastconfirm.js?v=6-20-13"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('webappassets'); ?>css/jquery.fastconfirm.css?v=6-20-13" media="screen" />
<script type="text/javascript"  src="<?php echo $this->config->item('webappassets'); ?>js/segment.js?v=6-20-13"></script>


<div id="body-dashborad">
    <div class="container">
		<h1>Create New Segment</h1>
		<div class="container_segment">
		<div class="loading">
          <div class="loader">
            <img src="<?php  echo $this->config->item('webappassets');?>images/loader.gif?v=6-20-13" alt="Loading" />
          </div>
        </div>
		<div class="error-msg">
			<p class="error">Please select one field</p>
		</div>	
		<div class="error-msg2">
			<p class="error">Please enter value</p>
		</div>	
		<div class="error-msg3">
			<p class="error">Please enter List Name</p>
		</div>
		
		<div class="error-msg4">
			<p class="error">Please add atleast one segment</p>
		</div>
		<input type='hidden' value='<?php echo $subscription_type?>' class="segmenttype">
		<p class="msg" style="color:red;font-weight:bold;display:inline-block;"></p>
		<input type="hidden" value="<?php echo base_url(); ?>" class="baseurl">
		<input type="hidden" value="<?php echo $subscription_id; ?>" class="segmentid">
		<input type="hidden" value="<?php echo $this->config->item('webappassets');?>images/ajax_loading.gif" class="loaderimagepath">
		</br></br>
		<p>
			Choose the type of segment you want to create:
		</p>	</br>
		<div class="select_segment">
			<input type="radio" name="select_segment" value="1" class="segment_radio" id="segment_radio5"> Normal Segment
			<input type="radio" name="select_segment" value="2" class="segment_radio" id="segment_radio6"> Dynamic Segment
		</div></br>
		<h3> List Name: </h3>
		<input type="text" name="seg_title" class="seg_title" value="<?php echo $subscription_title; ?>"></br></br>
		
		
		<section id="segment_simple">
			<form method="post" name="segmentation" id="segmentation" class="segmentation" >
			
				
				<div id="elements">
				<?php 
				if(count($segmentdata)>0):
				
				foreach($segmentdata as $seg_key => $seg_val):
				
				?>
					
					<div class="segment_family" id="segment_family" data_val="<?php echo $seg_val['sg_ref_id']?>">
						<h3> Fields</h3>
						<select class="fields">
						<option value="" > --Select-- </option>
							<?php 
								foreach($allfields as $key => $val): //print_r($key);
							?>
							<option value="<?php echo $key?>" <?php if($seg_val['sg_segment_key'] == $key) echo "selected" ;?>><?php echo $val;?> </option>
							
							<?php endforeach;?>
						</select>
						<select class="criteria_is">
								<option value='is' <?php if($seg_val['sg_segment_condition'] == 'is') echo "selected" ;?>> is like </option>
								<option value='is_not' <?php if($seg_val['sg_segment_condition'] == 'is_not') echo "selected" ;?>> is not like </option>
						</select>
						
						<input type="text" name="fields_value" value="<?php echo $seg_val['sg_segment_val']; ?>" class="fields_value"/> 
						<input type='hidden' name="ref_id" value="<?php echo $seg_val['sg_ref_id']?>" class="ref_id">
						<input type='button' value="Delete Segment" class="delete_segment" data_val='<?php echo $seg_val['sg_ref_id']?>'/>
						
					</div>
				
				<?php endforeach;
				else:?>
				
				<div class="segment_family" id="segment_family">
					<h3> Fields</h3>
					<select class="fields">
						<option value="" > --Select-- </option>
						<?php 
							foreach($allfields as $key => $val):
						?>
						<option value="<?php echo $key?>"><?php echo $val;?> </option>
						
						<?php endforeach;?>
					</select>
					<select class="criteria_is">
							<option value='is'> is like </option>
							<option value='is_not' > is not like</option>
					</select>
					
					<input type="text" name="fields_value" value="" class="fields_value"/> 
					<input type='button' value="Delete Segment" class="delete_segment"/>
					
				</div>
			
				
				
				<?php endif;?>
				</div>
				<input type='button' value="Add Segment" class="add_segment"/>
				
				
					</br></br>
				<input type='submit' value="Save" class="btn add add_more segment_form"/>	
				<?php   // echo form_submit(array('name' => 'segment_submit', 'id' => 'btnEdit', 'class' => 'btn add add_more segment_form', 'content' => 'Submit'), 'Save');
                    ?>	
				
				</form>
		</section>
		<section id="segment_recent">
			<form method="post" name="recent" id="recent" class="recent">
			
			<div id="elements">
				<?php 
				
				if(count($recentArray)>0):
				foreach($recentArray as $res_key => $res_val):?>
				<div class="recent_segment_family" id="recent_segment_family">
					<h3> Fields</h3>
					<select class="rfields">
						<option value="" > --Select-- </option>
						<?php 
							foreach($recent_fields as $key => $val):
						?>
						<option value="<?php echo $key?>" <?php if($res_val['sg_segment_key'] == $key) echo "selected" ;?>><?php echo $val;?> </option>
						
						<?php endforeach;?>
					</select>
					   <span class="in"> In </span>
					
					<input type="text" name="r_fields_value" value="<?php echo $res_val['sg_segment_val'];?>" class="r_fields_value"/>  <span class="days"> Days </span>
					
					</br></br>
				<input type='submit' value="Save" class="btn add add_more recent_form"/>	
				</div>
				<?php endforeach;
				else:?>
				<div class="recent_segment_family" id="recent_segment_family">
					<h3> Fields</h3>
					<select class="rfields">
						<option value="" > --Select-- </option>
						<?php 
							foreach($recent_fields as $key => $val):
						?>
						<option value="<?php echo $key?>"><?php echo $val;?> </option>
						
						<?php endforeach;?>
					</select>
					  <span class="in"> In </span>
					
					<input type="text" name="r_fields_value" value="" class="r_fields_value"/> <span class="days"> Days </span>
					
					</br></br>
				<input type='submit' value="Save" class="btn add add_more recent_form"/>	
				</div>
				<?php endif;?>
				
			</div>
			</form>
		</section>
		
		</div>
		
    </div>
</div>





<div id="elementsnew">
	<div class="segment_family" id="segment_family">
		<h3> Fields</h3>
		<select class="fields">
			<option value="" > --Select-- </option>
			<?php 	foreach($allfields as $key => $val): ?>
			<option value="<?php echo $key?>"><?php echo $val;?> </option>
			<?php endforeach;?>
		</select>
		<select class="criteria_is">
			<option value='is'> is like </option>
			<option value='is_not'> is not like</option>
		</select>
		<input type="text" name="fields_value" value="" class="fields_value"/>
		<input type='button' value="Delete Segment" class="delete_segment"/>
	</div>
</div>


