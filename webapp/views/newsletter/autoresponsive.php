<html lang="en">
  <head>
  <title>Redcappi - Responsive Email Editor</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('webappassets');?>css/font-awesome.css?v=6-20-13" media="screen" />
      <style type="text/css">
      * {
        margin:0px;
        padding:0px;
      }
      body {
        overflow:hidden;
        background-color: rgb(238,238,238);
        color:#000000;
      }
      #bee-plugin-container {
        position: absolute;
        top:80px;
        bottom:30px;
        left:450px;
        right:500px;
		margin: 0 auto;
      }
      #integrator-bottom-bar {
        position: absolute;
        height: 25px;
        bottom:0px;
        left:5px;
        right:0px;
      }
	    /*====================== aksha=============*/
            #diyy-header {
                text-align: center;
                min-width: 1000px;
                box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.05);
                border-bottom: 1px solid #ddd;
                background-image: linear-gradient(to bottom, #ffffff, #e8e8e8);
                background-repeat: repeat-x;
                background-color: #e8e8e8;
                border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.15);
                height: 40px;
                position: relative;
                z-index: 10;
            }

            #diyy-header #header-logo {
                float: left;
            }
            #diyy-header {
                text-align: center;
            }
            #diyy-header #header-logo img {
                padding: 4px 0 0 13px;
                height: 32px;
            }
            #diyy-header form {
                position: absolute;
                left: 120px;
                right: 165px;
                top: 5px;
            }
            #diyy-header label {
                font-size: 15px;
                text-shadow: 0 1px 1px #fff;
                color: #333;
                font-family: Arial, Helvetica, sans-serif !important;
            }
            #diyy-header input {
                background-color: #fff;
                border: 1px solid #ccc;
                transition: border linear 0.2s, box-shadow linear 0.2s;
                border-radius: 4px;
                height: 26px;
                margin: 0 0 0 5px;
                padding: 1px 8px;
                width: 230px;
                font-size: 14px;
            }
            #campaign_title {
                line-height: 24px;
            }
            #diyy-header .btn.add {
                padding: 3px 19px 4px;
                margin: 0;
            }
            #diy-header .btn {
                display: inline-block;
                margin: 5px 4px 0;
                padding: 3px 13px 4px;
                font-size: 14px;
            }
            .btn.add {
                color: #fff;
                text-shadow: 0 1px 0 rgba(0, 0, 0, 0.65);
                background-image: linear-gradient(to bottom, #ff3019, #cf0404);
                background-repeat: repeat-x;
                background-color: #cf0404;
                border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
            }

            #diyy-header .btn i {
                line-height: 20px;
				margin-right: 25px;
            }

            #diyy-header .btn.add {
                padding: 3px 19px 4px;
                margin: 0;
                border-radius: 5px !important;
                border: 1px solid #cf0404  !important;
            }

            #diyy-header .btn.cancel {
                float: right;
                margin: 10px 0 0;
                margin-right: 0px;
                border-radius: 0;
                border: 0;
                background-image: none;
                background-color: transparent !important;
                font-size: 20px;
                box-shadow: none;
                color: #666;
            }
			
			#diyy-header input.add.save_next {
				margin-top: -5px;
				width: 110px;
			}
          /*   .btn {
                font-family: Arial, Helvetica, sans-serif !important;
                text-decoration:none !important ;
                vertical-align: middle !important;
                line-height: 20px !important;
                text-align: center !important;
                cursor: pointer !important;

                box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05) !important;

            } */
            .icon-remove::before {
                content: "\f00d";
            }
            .icon-question::before {
                content: "\f128";
            }
            .icon-eye-open::before {
                content: "\f06e";
            }
            [class^="icon-"], [class*=" icon-"] {
                font-family: FontAwesome;
                font-weight: normal;
                font-style: normal;
                text-decoration: inherit;
            }
			#diyy-header input.add.save_campaign_changes {
				margin-top: -5px;
				width: 110px;
			}
			#bee-plugin-container {
				position: absolute;
				top: 80px;
				bottom: 30px;
				left: 20%;
				right: 25%;
				margin: 0 auto;
				width: 50%;
			}
			@media only screen and (max-width: 1700px) { 
				#bee-plugin-container {
					left: 4%;
				}
			}
			@media only screen and (max-width: 1366px) { 
				#bee-plugin-container {
					left: -12%;
					width: 40%;
				}
			}
			
			



            /*====================== aksha=============*/
			
	
	
	.custum-template {
				background: #fff none repeat scroll 0 0;
				margin-top: 43px;
				padding: 10px 21px;
				width: 9%;
				overflow-y: scroll;
				height: 833px;
			}
			.custum-template .new_temp {
				margin: 10px;
				cursor: pointer;
			}
    </style>
  
  </head>
  <body>

    <div id="diyy-header">
            <div id="header-logo">
                <a href="https://www.redcappi.us/newsletter/campaign">
                    <img src="https://www.redcappi.us/webappassets/images/redcappi-baby-editor.png?v=6-20-13" alt="" border="0">
                </a>
            </div>
            <form action="" method="post">
                <label class="label">Campaign Name</label>
                <input type="text" name="campaign_title" class="campaign_title" value="<?php echo $campaign_title; ?>" onchange="javascript:pagechange = true;">

                <!--<a class="btn add save_campaign_changes next" href="<?php echo base_url() ?>newsletter/campaign_email_setting/index/<?php echo $campaign_id;?>" id="next_step">Next Step</a>
				-->
				<input type="button" name="next_step" class="btn add save_next" value="Next Step" id='next_step' onclick="disablepopup();" />     
				<input type='hidden' data-info="" class="redirectlink" value="">
			</form>
			
			
             <a href="javascript:void(0);" data-href="<?php echo base_url() ?>newsletter/campaign" title="Close" class="btn cancel inline-block remove-icon" id="closetab"><i class="icon-remove"></i></a>
            <a href="<?php echo base_url() ?>support/index" target="_blank" title="Help" class="btn cancel inline-block"><i class="icon-question"></i></a>
			
           <!-- <a class="btn cancel inline-block preview" title="Preview" href="" id="preview_alert"><i class="icon-eye-open"></i> -->
				
				<button  name="preview_alert" class="btn cancel inline-block preview" value="Preview" id='preview_alert'> <i class="icon-eye-open"></i> </button>
				<button  name="Save" class="save_campaign btn cancel" value="Save" id='save_campaign'> <i class="icon-save"></i> </button>
				
			<!--</a>
			<a class="save_campaign_changes btn cancel save" title="Save"><i class="icon-save"></i></a>
-->
   </div>
   <?php $jsonglobal = json_encode($global); ?>
	<div class="custum-template">
	<?php
		$i =1;
		foreach($template as $templatename){
			$img_url = "https://redcappi.us/webappassets/images/".$templatename['bee_image'];
			echo '<img src="'.$img_url.'" name="new_temp" class="new_temp" data-tempalte="'.$templatename['id'].'"/>';
		//echo '<input type="button" data-tempalte="'.$templatename['config_name'].'" name="new_temp" class="new_temp" value="New Template'.$i++.'"/>';
	}?>
		
		
	</div>
	
	<div style="display:none;" id="preview_msg" class="">
		<h2 style="font-weight: 300;background-color: #f8f8f8;padding: 8px 12px !important;color: #333;border-bottom:1px solid #ddd;">Notice</h2>
		<div style="padding: 5px 15px">
			<p>Your campaign may have unsaved changes. Would you like to save it?</p>
			<button class="btn save_campaign_changes add">Save</button>
			<button class="btn discard_campaign_changes cancel">Cancel Changes</button>
			<a class="btn cancel cancel_campaign_changes" title="">Close</a>
		</div>
	</div>
        <div id="bee-plugin-container">
        </div>
  
     <!-- <div id="bee-plugin-container">
        <strong><span> Campaign Name <input type="text" name="campaign_title" class="campaign_title" value="<?php echo $campaign_title;?>"></span></strong>
        <span><a href="<?php echo base_url() ?>newsletter/autoresponder/responsiveview/<?php echo $campaign_id;?>" target="_blank">Preview</a></span>
        <span><a href="<?php echo base_url() ?>newsletter/campaign_email_setting/autoresponder/<?php echo $campaign_id;?>" >Next Step</a></span>
        
      </div> -->
      
      
    <div id="integrator-bottom-bar">
      <!-- You can change the download function to get the JSON and use this input to load it -->
     <input id="choose-template" type="hidden"  />
     
    </div>

  </body>
  <script type="text/javascript" src="<?php echo $this->config->item('webappassets');?>js/beefree/Blob.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('webappassets');?>js/beefree/fileSaver.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('webappassets');?>js/beefree/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('webappassets');?>js/beefree/jquery-ui-1.10.2.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('webappassets');?>js/beefree/BeePlugin.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('webappassets');?>css/inner_red.css"></script>
<script type="text/javascript" src="<?php echo $this->config->item('webappassets');?>js/jquery-1.4.4.min.js?v=6-20-13"></script>
<script type="text/javascript" src="<?php echo $this->config->item('webappassets');?>js/fancybox/jquery.fancybox-1.3.4.pack.js?v=6-20-13"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('webappassets');?>js/fancybox/jquery.fancybox-1.3.4.css?v=6-20-13" media="screen" />
<script type="text/javascript">
$( document ).ready(function() {
  disablepopup();  
});

window.onbeforeunload = function () {
            return "Do you want to leave?"
        }

        // A jQuery event (I think), which is triggered after "onbeforeunload"
        $(window).unload(function () {
            alert("Do Reset..");
            //I will call my method
        });
function disablepopup()
{
  window.onbeforeunload = null;
        //window.nativeAlert = window.alert;
       // window.alert = function(val){console.log(val+' (alert disabled)');};
       
}
var request = function(method, url, data, type, callback) {
      var req = new XMLHttpRequest();
	 
		//console.log(type);
      req.onreadystatechange = function() {
        if (req.readyState === 4 && req.status === 200) {
        var response = JSON.parse(req.responseText);
          //var response = req.responseText;
          callback(response);
        }
      };

      req.open(method, url, true);
      if (data && type) {
        if(type === 'multipart/form-data') {
          var formData = new FormData();
          for (var key in data) {
            formData.append(key, data[key]);
          }
          data = formData;          
        }
        else {
          req.setRequestHeader('Content-type', type);
        }
      }

      req.send(data);
    };

    var save = function(filename, content) {
      saveAs(
        new Blob([content], {type: 'text/plain;charset=utf-8'}), 
        filename
      ); 
    };

    var specialLinks = [{
        type: 'unsubscribe',
        label: 'Unsubscribe',
        link: 'http://[unsubscribe]/'
    }, {
        type: 'subscribe',
        label: 'Subscribe',
        link: 'http://[subscribe]/'
    }];

    var mergeTags = [{
      name: 'Name',
      value: '{name}'
    }, {
      name: 'Email',
      value: '{email}'
    },{
      name: 'First name',
      value: '{first_name}'
    },{
      name: 'Last name',
      value: '{last_name}'
    },{
      name: 'Address',
      value: '{address}'
    },{
      name: 'City',
      value: '{city}'
    },{
      name: 'State',
      value: '{state}'
    },{
      name: 'Zip Code',
      value: '{zip}'
    },{
      name: 'Country',
      value: '{country}'
    }
	
	];
	//console.log(mergeTags);
	 var glob = {};
	var jsonglobal = <?php echo $jsonglobal;?>;
	if(jsonglobal){
	 jQuery.each( jsonglobal, function( key, value ) {
			 var jsonkey = key;
			 var jsonvalue = value;
			 var jsonval = 'value';
			 glob={
				name :  jsonvalue,
				value : '{'+jsonvalue+'}'
			 }
			  mergeTags.push(glob);
	}); 
	}

    var mergeContents = [{
      name: 'content 1',
      value: '[content1]'
    }, {
      name: 'content 2',
      value: '[content2]'
    }];
	<?php if($member_id < 100){
		$uid = '00'.$member_id;
	}else{
		$uid = $member_id;
	}?>
    var beeConfig = {  
      uid: '<?php echo $uid;?>',
      container: 'bee-plugin-container',
      autosave: 15, 
      language: 'en-US',
      specialLinks: specialLinks,
      mergeTags: mergeTags,
      mergeContents: mergeContents,
	  preventClose: false,
      onSave: function(jsonFile, htmlFile) { 
	  var target = jQuery('.redirectlink').attr('data-info');
	  var redirectlink = jQuery('.redirectlink').val();
	  var title = jQuery('.campaign_title').val(); 
        
        //save('newsletter.html', htmlFile);
		var postdata = {};
			postdata['json'] = jsonFile;
			postdata['html'] = htmlFile;
                        postdata['campaign_id'] = <?php echo $campaign_id;?>;
                        postdata['campaign_title'] = title;
                       
		
			 jQuery.post('<?php echo base_url() ?>newsletter/autoresponder/beefreesave/', postdata, function (result) {
				var response = jQuery.parseJSON(result);
				if(response.status = 'success'){
					
									if(target){
									
										window.open(redirectlink, '_blank');
									}else{
										 window.onbeforeunload = null;
										 window.alert=undefined;    									
										 window.location.href = redirectlink;
									}
         //
                              
                 }                
			 });
		 
	
      },
      onSaveAsTemplate: function(jsonFile) { // + thumbnail? 
       // save('newsletter-template.json', jsonFile);
		/* 
			var postdata = {};
			postdata['json'] = jsonFile;
			console.log(postdata);
			 jQuery.post('ajaxhtml.php/', postdata, function (result) {
				
			 }); */
		
      },
      onAutoSave: function(jsonFile) { // + thumbnail? 
         
         
        window.onbeforeunload = null;
        //window.nativeAlert = window.alert;
        //window.alert = function(val){console.log(val+' (alert disabled)');};
        console.log(new Date().toISOString() + ' autosaving...');
        window.localStorage.setItem('newsletter.autosave', jsonFile);
        
       
        
      },
      onSend: function(htmlFile) {
        //write your send test function here
      },
      onError: function(errorMessage) { 
        console.log('onError ', errorMessage);
      }
    };

    var bee = null;

    var loadTemplate = function(e) {
      var templateFile = e.target.files[0];
	 
      var reader = new FileReader();

      reader.onload = function() {
        var templateString = reader.result;
        var template = JSON.parse(templateString);
        bee.load(template);
      };

      reader.readAsText(templateFile);
    };
 
    document.getElementById('choose-template').addEventListener('change', loadTemplate, true);
console.log(beeConfig);
    request(
      'POST', 
      'https://auth.getbee.io/apiauth',
      'grant_type=password&client_id=ca2ef0e3-cf4b-4e79-84e1-eda0a560051a&client_secret=8Gla59jBi5IYY2KKQzSOvlLyLbsJB3lsf9S6FlYWWhbRlthFTG7',
      'application/x-www-form-urlencoded',
	 
      function(token) {
        BeePlugin.create(token, beeConfig, function(beePluginInstance) {
          bee = beePluginInstance;
          request(
            'GET', 
                    //'https://rsrc.getbee.io/api/templates/m-bee',
                   '<?php echo base_url() ?>newsletter/autoresponder/fetchresponsive?id=<?php echo $campaign_id;?>',
                
            null,
				null,
				function(template) {
              bee.start(template);
             /* bee.toggleStructure();*/
            });
        });
      });
	  
	  
	   jQuery('.next').click(function () {
		   jQuery('.redirectlink').attr('data-info', '');
		   jQuery('.redirectlink').val('<?php echo base_url() ?>newsletter/campaign_email_setting/autoresponder/<?php echo $campaign_id;?>');
            bee.save();
						
				
        });
		
		jQuery('.save_campaign').click(function () {
			bee.save();
		});
		
		/* jQuery('.preview').click(function () {
			jQuery('.redirectlink').attr('data-info', '');
			jQuery('.redirectlink').attr('data-info', 'false');
			jQuery('.redirectlink').val('<?php echo base_url() ?>newsletter/autoresponder/responsiveview/<?php echo $campaign_id;?>');
            bee.save();
			
			/*  $("a.preview_alert").attr('target','_blank');
			$("a.preview_alert").attr('href','<?php echo base_url() ?>newsletter/campaign/responsiveview/<?php echo $campaign_id;?>');  */
					
        //});
		
		jQuery('#preview_alert').live('click',function(){
			$.fancybox($('#preview_msg').html(),{'autoDimensions':false,'height':'205','width':'400','centerOnScroll':true});
			return false;
		
		});
		
		$('#closetab').live('click',function(){
			 jQuery.fancybox({
				 'content' : '<h2 style="font-weight: 300;background-color: #f8f8f8;padding: 8px 12px !important;color: #333;border-bottom:1px solid #ddd;">Notice</h2>	<div style="padding: 5px 15px">	<p>Your campaign may have unsaved changes. Really want to close it?</p>	<button data-href="'+ $(this).attr('data-href')+'" class="btn cancel close_campaign">Ok</button><button class="btn cancel_campaign_changes cancel">Cancel</button>					</div>',
				 'autoDimensions':false,'height':'205','width':'400','centerOnScroll':true
			});
		});
		
		$(".close_campaign").live('click',function(){
			window.location.href= '<?php echo base_url() ?>newsletter/campaign';       
			$.fancybox.close();
		});
		
		
		$(".save_campaign_changes").live('click',function(event){
			jQuery('.redirectlink').attr('data-info', '');
			jQuery('.redirectlink').attr('data-info', 'false');
			//alert(jQuery('.redirectlink').attr('data-info'));
			jQuery('.redirectlink').val('<?php echo base_url() ?>newsletter/autoresponder/responsiveview/<?php echo $campaign_id;?>');
            bee.save();
			$.fancybox.close();

		});
		
		$(".discard_campaign_changes").live('click',function(event){
			window.open('<?php echo base_url() ?>newsletter/autoresponder/responsiveview/<?php echo $campaign_id;?>', '_blank');           
			$.fancybox.close();
		});
		
		
		
		$(".cancel_campaign_changes").live('click',function(event){
			$.fancybox.close();
		}); 
		
		  jQuery('#next_step').click(function () {
        
		   jQuery('.redirectlink').attr('data-info', '');
		   jQuery('.redirectlink').val('<?php echo base_url() ?>newsletter/campaign_email_setting/autoresponder/<?php echo $campaign_id;?>');
           
          
bee.save(); 
        });
		
		
		jQuery('.new_temp').click(function () {
			var postdata = {};
			postdata['template'] = jQuery(this).attr('data-tempalte');
			
			//alert(jQuery(this).attr('data-tempalte'));return false;
			jQuery.post('<?php echo base_url() ?>newsletter/autoresponder/fetchtemplate/<?php echo $campaign_id; ?>', postdata, function (result) {
				var response = jQuery.parseJSON(result);
				var campaign_id = response.campaign_id;
				console.log(response);
				//var campaign_id = response.campaign_id;
				window.location.href = '<?php echo base_url() ?>newsletter/autoresponder/responsivetemplate/<?php echo $campaign_id; ?>';
		   });
		});
</script>
</html>
