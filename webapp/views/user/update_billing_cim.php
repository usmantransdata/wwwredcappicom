
<script type="text/javascript">
 // On load, style typical form elements
$(function () {
 // $("select").uniform();
});

$(document).ready(function() {
      $("#security_code").hover(function(e){
          $("#large")
                  .html("<img src="+ $(this).attr("alt") +" alt='Large Image' /><br/>")
                  .fadeIn("slow");
      }, function(){
          $("#large").fadeOut("fast");
      });
			if($('.payment_type').is(':checked')) { 
       	var payment_type = $('.payment_type:checked').val();
       	if(payment_type == 'credit_card'){
       		$(".credit_card_info").show();
					 	$(".paypal_info").hide();
        	$("#billing_form").attr('action','');
        }else{
          $(".credit_card_info").hide();            
					$(".paypal_info").show();
          $("#billing_form").attr('action',"<?php echo $this->config->item('PAYPAL_SUBMIT_URL'); ?>");			
			  }
   		}
			$(".payment_type").click(function(){
        var payment_type = $(this).val();
        if(payment_type == 'credit_card'){
					$(".credit_card_info").show();
					$(".paypal_info").hide();
        	$("#billing_form").attr('action','');
        }else{
          $(".credit_card_info").hide();            
					$(".paypal_info").show();
					$("#billing_form").attr('action',"<?php echo $this->config->item('PAYPAL_SUBMIT_URL'); ?>");	
			  }
  		});
  });
function submit_frm(){
	
    for (var i=0; i < document.getElementsByName('package_id').length; i++) {
      if (document.getElementsByName ('package_id')[i].checked) {
        rad_val = document.getElementsByName ('package_id')[i].value;
        document.billing_form.packageId.value=rad_val;
      }
    }
  //jQuery('.subscriber_msg').hide();
	var checked_package_id = jQuery("input[name='package_id']:checked").val();
	var payment_type = jQuery('.payment_type:checked').val();
	var current_package = <?php echo ($user_package['package_id']); ?>;
	if(current_package > 0){
		//alert('yes');return false;
		var next_payment_date ="<?php if ($user_package['next_payement_date'] != '') { echo strtotime($user_package['next_payement_date']);	} else { echo '0'; }  ?>"
	}
	
	
	var current_date = <?php echo strtotime(date('Y-m-d')); ?>;
	
	var current_paymnet_type = '<?php echo $arrUserForPaypal['payment_type']; ?>';
	
	var selectpackage = '<?php echo $selected_package; ?>';
	var creditpackage = '<?php echo $credit_id; ?>';
	      /**Ended by cb**/
				
		if(payment_type == 'paypal'){
			if(current_package  == '-1' || current_package == creditpackage){
				jQuery("#billing_form").attr('action','');
				document.billing_form.submit();
			}else{
      	var postdata =  jQuery("#billing_form").serialize();
      	jQuery.post('<?php echo base_url() ?>upgrade_package_cim/payment_by_paypal_cim', postdata, function (result) {
      		var resp = jQuery.parseJSON(result);
				
					//console.log(resp);return false;
        	if(resp.status == 'success'){
						var custom = jQuery("#custom").val();
						jQuery("#custom").val(custom+"|"+resp.transaction_id); 
						jQuery(".submit_button").html('Loading....');
						jQuery(".submit_button").css('background-color','Gray');
						jQuery(".submit_button").attr('disabled','disabled');
						jQuery(".submit_button").css('font-size','15px');
						jQuery(".submit_button").css('background-image','None');
					
						jQuery("#first_name").val(resp.first_name);
						jQuery("#last_name").val(resp.last_name);
						jQuery("#address1").val(resp.address1);
						jQuery("#city").val(resp.city);
						jQuery("#state").val(resp.state);
						jQuery("#zip").val(resp.zipcode);
						jQuery("#item_name").val(resp.package_title);
						jQuery("#a1").val(resp.package_price);
						if(resp.payment_year_month == 'months'){
							jQuery("#t1").val('M');
							jQuery("#t3").val('M');
						}else if(resp.payment_year_month == 'years'){
							jQuery("#t1").val('Y');
							jQuery("#t3").val('Y');
						}
						if(resp.no_of_uses == 'all'){
							jQuery("#a3").val(resp.package_regular_price);
						}else{
							if(resp.payment_year_month == 'months'){
								jQuery("#p1").val(resp.no_of_uses);
							}else if(resp.payment_year_month == 'years'){
								jQuery("#p1").val(1);
							}
							jQuery("#a3").val(resp.package_regular_price);
						}
						jQuery("#return_url").val('<?php echo $this->PAYPAL_SUCCESS_URL; ?>?userpackageid='+resp.member_package_id);
						if(resp.package_price == '0' && resp.package_regular_price == '0'){
							location.reload();
						}
						if(resp.package_title == 'Free'){
							location.reload();
						}else{
							jQuery("#billing_form").submit();
						}
					}else{
						jQuery(".paypal_validation_div").show();
						jQuery(".paypal_validation_div").html(resp.messgae);
					}
				});
			}
		}else{
			document.billing_form.submit();
		}
    
}


function fetchPayableAmount(){
    if($('#coupon_code').val() ==''){
      $('#coupon_code_msg').html('Enter coupon code');
      return;
    }
    var block_data ="ccode="+$('#coupon_code').val();
    jQuery.ajax({
      url: "<?php echo base_url() ?>ajax/fetchPayableAmount/",
      type:"POST",
      data:block_data,
      success: function(data) {
        if('err'==data){
        $('#coupon_code_msg').html('Invalid coupon code');
		$('#coupon_code').val('');
        }else{
          $('#coupon_code_msg').html(data);
        }
      }
    });
  }
</script>
<style>
#security_code {
  cursor: pointer;
}
#large {
  display: none;
  position: absolute;
  color: #FFFFFF;
  background: #ebebeb;
  padding: 1px;
}
</style>
<!--[body]-->

<div id="body-dashborad">
  <div class="container update-profile account">
  	<h1>Update Billing</h1>
  	<?php
		/// display all messages
		if (is_array($messages)):
			foreach ($messages as $type => $msgs):
				foreach ($msgs as $message):
					echo ('<div class="msg ' .  $type .' info">' . $message . '</div>');
				endforeach;
			endforeach;
		endif;
		?>

	  <?php
		if(validation_errors()){
			echo '<div class="msg info">'.validation_errors().'</div>';
		}
		?>
  	<form action="" method="post" name="billing_form" id="billing_form">
  		<div class="update-profile-container">
  			<h2>Billing Information</h2>
	    	<div class="update-profile-container">
					<strong>First Name</strong>
					<?php echo form_input(array('name'=>'first_name','id'=>'first_name','maxlength'=>120,'size'=>32,'value'=> $user_packages['first_name'] != "" ? $user_packages['first_name'] : set_value('first_name') ));   ?>

					<strong>Last Name</strong>
					<?php echo form_input(array('name'=>'last_name','id'=>'last_name','maxlength'=>120,'size'=>32,'value'=>$user_packages['last_name'] != "" ? $user_packages['last_name'] : set_value('last_name'))); ?>

					<strong>Street Address</strong>
					<?php echo form_input(array('name'=>'address1','id'=>'address1','maxlength'=>60,'size'=>32,'value'=>$user_packages['address'] != "" ? $user_packages['address'] : set_value('address') )); ?>

					<strong>City</strong>
					<?php echo form_input(array('name'=>'city','id'=>'city','maxlength'=>50,'size'=>32,'value'=>$user_packages['city'] != "" ? $user_packages['city'] : set_value('city') )); ?>

					<strong>State/Province</strong>
					<?php echo form_input(array('name'=>'state','id'=>'state','maxlength'=>50,'size'=>32,'value'=>$user_packages['state'] != "" ? $user_packages['state'] : set_value('state') )); ?>

					<strong>Zip/Post code</strong>
					<?php echo form_input(array('name'=>'zipcode','id'=>'zipcode','maxlength'=>50,'size'=>32,'value'=>$user_packages['zip'] != "" ? $user_packages['zip'] : set_value('zip') )); ?>

					<strong>Country</strong>
					<?php $country_name= $user_packages['country'] != "" ? $user_packages['country'] : "United States";?>
					<select name="country" id="country">
						<?php foreach($country_info as $country){
							if($country_name==$country['country_name']){
								echo "<option value='".$country['country_name']."' selected='selected'>".$country['country_name']."</option>";
							}else{
								echo "<option value='".$country['country_name']."'>".$country['country_name']."</option>";
							}
						}?>
					</select>
				</div>
				<h4 class="heading-txt">
					<input type="radio" name="payment_type_name" <?php if ($arrUserForPaypal['payment_type'] == 'paypal') : echo 'checked'; endif; ?> class="payment_type" id="payment_type" value="paypal"/> PayPal
          <input type="radio" name="payment_type_name"  <?php if ($arrUserForPaypal['payment_type'] == 'credit_card') : echo 'checked';	endif; ?> class="payment_type" id="payment_type" value="credit_card"/> Credit Card
        </h4>
				<div class="update-profile-container credit_card_info">
					<h2>Card Information</h2>
						<strong>Name on card</strong>
						<?php echo form_input(array('name'=>'credit_card_holder_name','id'=>'credit_card_holder_name','maxlength'=>120,'size'=>32,'value'=>set_value('credit_card_holder_name'),'autocomplete'=>'off')); ?>

						<strong>Credit card number</strong>
						<?php echo form_input(array('name'=>'cc_number','id'=>'cc_number','maxlength'=>120,'size'=>32,'value'=>set_value('cc_number'),'autocomplete'=>'off')); ?>

						<strong>Expiration date</strong>
						<?php
							$months_array=array(1=>'January',2=>'Febuary',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
							$expMo = 'id="expiration-date-month"';
          		echo form_dropdown('ccexp_month',$months_array,$_REQUEST['ccexp_month'], $expMo);

							for($i=date('Y');$i< date('Y') + 25;$i++){
								$year_array[$i] = $i;
							}

							$expYr = 'id="expiration-date-year"';
          		echo form_dropdown('ccexp_year',$year_array,$_REQUEST['ccexp_year'], $expYr);
						?>

						<strong>Security Code <img id="security_code" src="<?php echo $this->config->item('webappassets');?>images-front/info1.png?v=6-20-13" alt="<?php echo $this->config->item('webappassets');?>images-front/security_code.jpg?v=6-20-13" align="absmiddle" /><br/><span id="large"></span></strong>
						<?php echo form_input(array('name'=>'cvv','id'=>'cvv','maxlength'=>12,'size'=>15,'value'=>set_value('cvv'),'autocomplete'=>'off' )); ;?>
						<img align="absmiddle" src="<?php echo base_url();?>webappassets/images-front/credit_card_logos.jpg?v=6-20-13" alt="">
						<div class="AuthorizeNetSeal" style="display:inline-block;vertical-align:middle;">
							<script type="text/javascript" language="javascript">var ANS_customer_id="73403142-6ece-4003-8197-ab3a3dfd95ce";</script>
							<script type="text/javascript" language="javascript" src="//verify.authorize.net/anetseal/seal.js?v=6-20-13" ></script>
							<a href="http://www.authorize.net/" id="AuthorizeNetText" target="_blank">Payment Gateway</a>
						</div>
						<table width="98%" border="0">
				    	 <tr <?php if($user_packages['coupon_used'] !== true && $user_packages['is_payment'] == 0):?> style="display:block" <?php else:?> style="display:none" <?php endif;?>>
                      <td colspan="2">
                        <div class="discount_coupon_container">
                          <span class="label"><strong>Discount Code</strong></span>
						  <input name="coupon_code" type="text" size="32" value="" id="coupon_code" class="clean" />
                          <a href="javascript:void(0);" onclick="javascript:fetchPayableAmount();" class="btn cancel inline-block" style="margin-left:20px;">
                            Redeem
                          </a>
                          <span id="coupon_code_msg" class="error"></span>
                        </div>
                      </td>
                    </tr>
										
					</table>

					

					<?php
						/* foreach($user_packages as $key=>$user){
							echo form_hidden($key,$user);
						} */
						echo form_hidden('action','save');
						

					?>
				</div>
				<?php 
				$payment_year_month = ($mode == 'annual') ? 'annual' : ( ($mode == 'credit') ? 'credit' : ( ($mode == 'daily') ? 'daily' : 'months'));
				?>
				<input type="hidden" name="payment_year_month" value="<?php echo $payment_year_month; ?>" />
				<input type='hidden' name='business' value="<?php echo $this->config->item('PAYPAL_EMAIL'); ?>" />
				<input type='hidden' name='cpp-logo-image' value="<?php echo $this->config->item('webappassets'); ?>images/redesign/logo.png" />                   
				<input type="hidden" name="custom" id="custom" value="<?php echo $arrUserForPaypal['session_member_id'] . "|" . $payment_year_month; ?>" />
				
				<input type="hidden" name="page_style" value="paypal" />
				<input type="hidden" name="packageId" value="<?php echo $user_package['package_id']?>" />
				<input type="hidden" name="lc" value="" />
				<input type="hidden" name="no_note" value="1" />
				<input type="hidden" name="charset" value="utf-8" />
				<input type='hidden' name='cmd' value='_xclick-subscriptions' />
				<input type="hidden" name="src" value="1" />
				<input type="hidden" name="a1" id="a1" value="10" /> 
				<input type="hidden" name="p1" id="p1" value="1" />
				<input type="hidden" name="t1" id="t1" value="D"/>

				<input type="hidden" name="a3" id="a3" value="10" /> 
				<input type="hidden" name="p3" id="p3" value="1" />
				<input type="hidden" name="t3" id="t3" value="D"/>
				<input type="hidden" name="zip" id="zip" value="" />
				<input type='hidden' id='item_name' name='item_name' value='Test Product' />
				<input name="notify_url" value="<?php echo $this->config->item('PAYPAL_NOTIFY_URL'); ?>" type="hidden" />
				<!--<input type='hidden' id='amount' name='amount' value='100'>-->
				<input type="hidden" value="2" name="rm" />      
				<input type='hidden' name='no_shipping' value='1' />
				<input type='hidden' name='currency_code' value='USD' />
				<input type='hidden' name='handling' value='0' />
				<input type='hidden' name='cancel_return' value="<?php echo $this->config->item('PAYPAL_CANCEL_URL'); ?>" />
				<input type='hidden' id="return_url" name='return' value="<?php echo $this->config->item('PAYPAL_SUCCESS_URL'); ?>" />
				<div class="update-profile-container paypal_info">
						<strong>Paypal Email</strong>
							<?php echo form_input(array('name' => 'paypalEmail', 'id' => 'paypalEmail', 'maxlength' => 120, 'size' => 32, 'value' => '')); ?>
				</div>
				<div class="update-profile-container">
						<div style="padding-bottom: 10px;">
							<input name="terms_conditions" style="float: left;" type="checkbox" value="1" class="clean" />
							<strong style="float: left;">I agree to RedCappi <a href="<?php echo base_url() . 'terms'; ?>"  target="_blank" class="terms-link">terms &amp; conditions </a>.</strong>
						</div>
				</div>
				<div class="update-profile-container">
					<div>
						<a href="javascript:void(0);" title="" class="btn confirm submit_button"  onclick="submit_frm();">Update</a>
						<a href="<?php echo $previous_page_url; ?>" title="" class="btn cancel">Cancel</a>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
