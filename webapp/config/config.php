<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 
define('DS',DIRECTORY_SEPARATOR);		
/*
|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
|
| URL to your CodeIgniter root. Typically this will be your base URL,
| WITH a trailing slash:
|
|	http://example.com/
|
| If this is not set then CodeIgniter will guess the protocol, domain and
| path to your installation.
|
*/
$config['php_path'] =  "/usr/bin/php"; // "/usr/local/bin/php";   // "c:/xampp/php/php";

//$config['base_url'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
//$config['base_url'] .= "://www.redcappi.com/";
$config['base_url'] = "https://www.redcappi.com/";
$config['ssl_base_url'] = "https://www.redcappi.com/";
$config['redirect_url'] = "redcappi.com";

/*
static files for the website
*/
$config['webappassets'] = $config['base_url']."webappassets/";
$config['webappassets_path'] = '/var/www/html/webappassets/';
/*
dynamic file paths for upload
*/
$config['rcdata'] = "/mnt/efs/rcdata/";
$config['user_public'] = $config['rcdata']."user/public/";
$config['user_private'] = $config['rcdata']."user/private/";
/*
dynamic file paths for pmta
*/
$config['pmta_logs'] = $config['rcdata']."pmta/logs/";
$config['pmta_archives'] = $config['rcdata']."pmta/archives/";
/*
Blog Images
*/
$config['blog_files'] = $config['rcdata']."blog/";
$config['campaign_files'] = $config['rcdata']."campaign/";


/* Start Paypal Details*/
$config['DV_API_KEY'] = 'f492eef48b18a8a7c0fcad0cb08a4309';
$config['DV_UPLOAD_PATH'] = $config['rcdata'].'dv_validation/';
$config['DV_CSV_COUNT'] = 5000;
/* END DV Details*/

/*START Paypal Details*/
$config['PAYPAL_TESTMODE'] = FALSE;

$config['PAYPAL_URL'] = ($config['PAYPAL_TESTMODE'])? 'https://api-3t.sandbox.paypal.com/nvp' : 'https://api-3t.paypal.com/nvp';
$config['PAYPAL_SUBMIT_URL'] = ($config['PAYPAL_TESTMODE'])? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';
$config['PAYPAL_EMAIL'] = ($config['PAYPAL_TESTMODE'])?  'pravinjha-shop@gmail.com' : 'jig.samani@redcappi.com';
$config['PAYPAL_PASSWORD'] = ($config['PAYPAL_TESTMODE'])? '888K2TJ94VMWENSH' : 'H9V4XN3BUTMRWC9L';
$config['PAYPAL_SIGNATURE'] = ($config['PAYPAL_TESTMODE'])? 'An5ns1Kso7MWUdW4ErQKJJJ4qi4-AYpCuZzCWCvcDLo06Jbit2iUOOym' : 'Afe7b2rDpdLqzCjlnhQjM3OXyfr9AdrhVRfJexLARFf8j.xhStdpNZkU';
$config['PAYPAL_USERNAME'] = ($config['PAYPAL_TESTMODE'])? 'pravinjha-shop_api1.gmail.com' : 'jig.samani_api1.redcappi.com';
$config['PAYPAL_SUCCESS_URL'] =  $config['base_url'].'upgrade_package_cim/successpaypal/';
$config['PAYPAL_CANCEL_URL'] = $config['base_url'].'upgrade_package_cim/cancelpaypal';
$config['PAYPAL_NOTIFY_URL'] =  $config['base_url'].'ipn/notify_paypal_url';

/*
$config['PAYPAL_URL'] = 'https://api-3t.paypal.com/nvp';
$config['PAYPAL_SUBMIT_URL'] = 'https://www.paypal.com/cgi-bin/webscr';
$config['PAYPAL_EMAIL'] = 'jig.samani@redcappi.com';
$config['PAYPAL_PASSWORD'] = 'H9V4XN3BUTMRWC9L';
$config['PAYPAL_SIGNATURE'] = 'Afe7b2rDpdLqzCjlnhQjM3OXyfr9AdrhVRfJexLARFf8j.xhStdpNZkU';
$config['PAYPAL_USERNAME'] = 'jig.samani_api1.redcappi.com';//'wikitudedeveloper-facilitator_api1.gmail.com';
$config['PAYPAL_SUCCESS_URL'] = $config['base_url'].'upgrade_package_cim/successpaypal/';
$config['PAYPAL_CANCEL_URL'] = $config['base_url'].'upgrade_package_cim/cancelpaypal';
$config['PAYPAL_NOTIFY_URL'] = $config['base_url'].'upgrade_package_cim/notify_paypal_url';
*/
/*END Paypal Details*/





$config['major_domains'] = array('gmail.com', 'yahoo.com', 'hotmail.com', 'aol.com', 'msn.com', 'outlook.com', 'windowslive.com', 'live.com', 'mail.ru', 'me.com', 'mac.com', 'comcast.net', 'cox.net');
/*
|--------------------------------------------------------------------------
| Index File
|--------------------------------------------------------------------------
|
| Typically this will be your index.php file, unless you've renamed it to
| something else. If you are using mod_rewrite to remove the page set this
| variable so that it is blank.
|
*/
$config['index_page'] = '';

/*
|--------------------------------------------------------------------------
| URI PROTOCOL
|--------------------------------------------------------------------------
|
| This item determines which server global should be used to retrieve the
| URI string.  The default setting of 'AUTO' works for most servers.
| If your links do not seem to work, try one of the other delicious flavors:
|
| 'AUTO'			Default - auto detects
| 'PATH_INFO'		Uses the PATH_INFO
| 'QUERY_STRING'	Uses the QUERY_STRING
| 'REQUEST_URI'		Uses the REQUEST_URI
| 'ORIG_PATH_INFO'	Uses the ORIG_PATH_INFO
|
*/
$config['uri_protocol']	= 'AUTO';

/*
|--------------------------------------------------------------------------
| URL suffix
|--------------------------------------------------------------------------
|
| This option allows you to add a suffix to all URLs generated by CodeIgniter.
| For more information please see the user guide:
|
| http://codeigniter.com/user_guide/general/urls.html
*/

$config['url_suffix'] = '.html';

/*
|--------------------------------------------------------------------------
| Default Language
|--------------------------------------------------------------------------
|
| This determines which set of language files should be used. Make sure
| there is an available translation if you intend to use something other
| than english.
|
*/
$config['language']	= 'english';

/*
|--------------------------------------------------------------------------
| Default Character Set
|--------------------------------------------------------------------------
|
| This determines which character set is used by default in various methods
| that require a character set to be provided.
|
*/
$config['charset'] = 'UTF-8';

/*
|--------------------------------------------------------------------------
| Enable/Disable System Hooks
|--------------------------------------------------------------------------
|
| If you would like to use the 'hooks' feature you must enable it by
| setting this variable to TRUE (boolean).  See the user guide for details.
|
*/
$config['enable_hooks'] = FALSE;


/*
|--------------------------------------------------------------------------
| Class Extension Prefix
|--------------------------------------------------------------------------
|
| This item allows you to set the filename/classname prefix when extending
| native libraries.  For more information please see the user guide:
|
| http://codeigniter.com/user_guide/general/core_classes.html
| http://codeigniter.com/user_guide/general/creating_libraries.html
|
*/
$config['subclass_prefix'] = 'MY_';


/*
|--------------------------------------------------------------------------
| Allowed URL Characters
|--------------------------------------------------------------------------
|
| This lets you specify with a regular expression which characters are permitted
| within your URLs.  When someone tries to submit a URL with disallowed
| characters they will get a warning message.
|
| As a security measure you are STRONGLY encouraged to restrict URLs to
| as few characters as possible.  By default only these are allowed: a-z 0-9~%.:_-
|
| Leave blank to allow all characters -- but only if you are insane.
|
| DO NOT CHANGE THIS UNLESS YOU FULLY UNDERSTAND THE REPERCUSSIONS!!
|
*/
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-@';


/*
|--------------------------------------------------------------------------
| Enable Query Strings
|--------------------------------------------------------------------------
|
| By default CodeIgniter uses search-engine friendly segment based URLs:
| example.com/who/what/where/
|
| By default CodeIgniter enables access to the $_GET array.  If for some
| reason you would like to disable it, set 'allow_get_array' to FALSE.
|
| You can optionally enable standard query string based URLs:
| example.com?who=me&what=something&where=here
|
| Options are: TRUE or FALSE (boolean)
|
| The other items let you set the query string 'words' that will
| invoke your controllers and its functions:
| example.com/index.php?c=controller&m=function
|
| Please note that some of the helpers won't work as expected when
| this feature is enabled, since CodeIgniter is designed primarily to
| use segment based URLs.
|
*/
$config['allow_get_array']		= TRUE;
$config['enable_query_strings'] = FALSE;
$config['controller_trigger']	= 'c';
$config['function_trigger']		= 'm';
$config['directory_trigger']	= 'd'; // experimental not currently in use

/*
|--------------------------------------------------------------------------
| Error Logging Threshold
|--------------------------------------------------------------------------
|
| If you have enabled error logging, you can set an error threshold to
| determine what gets logged. Threshold options are:
| You can enable error logging by setting a threshold over zero. The
| threshold determines what gets logged. Threshold options are:
|
|	0 = Disables logging, Error logging TURNED OFF
|	1 = Error Messages (including PHP errors)
|	2 = Debug Messages
|	3 = Informational Messages
|	4 = All Messages
|
| For a live site you'll usually only enable Errors (1) to be logged otherwise
| your log files will fill up very fast.
|
*/
$config['log_threshold'] = 1;

/*
|--------------------------------------------------------------------------
| Error Logging Directory Path
|--------------------------------------------------------------------------
|
| Leave this BLANK unless you would like to set something other than the default
| application/logs/ folder. Use a full server path with trailing slash.
|
*/
$config['log_path'] = '/mnt/efs/rcdata/rclogs/';

/*
|--------------------------------------------------------------------------
| Date Format for Logs
|--------------------------------------------------------------------------
|
| Each item that is logged has an associated date. You can use PHP date
| codes to set your own date formatting
|
*/
$config['log_date_format'] = 'Y-m-d H:i:s';

/*
|--------------------------------------------------------------------------
| Cache Directory Path
|--------------------------------------------------------------------------
|
| Leave this BLANK unless you would like to set something other than the default
| system/cache/ folder.  Use a full server path with trailing slash.
|
*/
$config['cache_path'] = '';

/*
|--------------------------------------------------------------------------
| Encryption Key
|--------------------------------------------------------------------------
|
| If you use the Encryption class or the Session class you
| MUST set an encryption key.  See the user guide for info.
|
*/
$config['encryption_key'] = 'pravinjha';

/*
|--------------------------------------------------------------------------
| Session Variables
|--------------------------------------------------------------------------
|
| 'sess_cookie_name'		= the name you want for the cookie
| 'sess_expiration'			= the number of SECONDS you want the session to last.
|   by default sessions last 7200 seconds (two hours).  Set to zero for no expiration.
| 'sess_expire_on_close'	= Whether to cause the session to expire automatically
|   when the browser window is closed
| 'sess_encrypt_cookie'		= Whether to encrypt the cookie
| 'sess_use_database'		= Whether to save the session data to a database
| 'sess_table_name'			= The name of the session database table
| 'sess_match_ip'			= Whether to match the user's IP address when reading the session data
| 'sess_match_useragent'	= Whether to match the User Agent when reading the session data
| 'sess_time_to_update'		= how many seconds between CI refreshing Session Information
|
*/
$config['sess_cookie_name']		= 'cisession';
$config['sess_expiration']		= 86400;
$config['sess_expire_on_close']	= FALSE;
$config['sess_encrypt_cookie']	= FALSE;
$config['sess_use_database']	= FALSE;
$config['sess_table_name']		= 'ci_sessions';
$config['sess_match_ip']		= FALSE;
$config['sess_match_useragent']	= TRUE;
$config['sess_time_to_update']	= 300;

/*
|--------------------------------------------------------------------------
| Cookie Related Variables
|--------------------------------------------------------------------------
|
| 'cookie_prefix' = Set a prefix if you need to avoid collisions
| 'cookie_domain' = Set to .your-domain.com for site-wide cookies
| 'cookie_path'   =  Typically will be a forward slash
| 'cookie_secure' =  Cookies will only be set if a secure HTTPS connection exists.
|
*/
$config['cookie_prefix']	= "";
$config['cookie_domain']	= "";
$config['cookie_path']		= "/";
$config['cookie_secure']	= FALSE;
$config['http_only']		= TRUE;

/*
|--------------------------------------------------------------------------
| Global XSS Filtering
|--------------------------------------------------------------------------
|
| Determines whether the XSS filter is always active when GET, POST or
| COOKIE data is encountered
|
*/
$config['global_xss_filtering'] = FALSE;

/*
|--------------------------------------------------------------------------
| Cross Site Request Forgery
|--------------------------------------------------------------------------
| Enables a CSRF cookie token to be set. When set to TRUE, token will be
| checked on a submitted form. If you are accepting user data, it is strongly
| recommended CSRF protection be enabled.
|
| 'csrf_token_name' = The token name
| 'csrf_cookie_name' = The cookie name
| 'csrf_expire' = The number in seconds the token should expire.
*/
$config['csrf_protection'] = FALSE;
$config['csrf_token_name'] = 'rcgenpi';
$config['csrf_cookie_name'] = 'rchidgulla';
$config['csrf_expire'] = 7200;

/*
|--------------------------------------------------------------------------
| Output Compression
|--------------------------------------------------------------------------
|
| Enables Gzip output compression for faster page loads.  When enabled,
| the output class will test whether your server supports Gzip.
| Even if it does, however, not all browsers support compression
| so enable only if you are reasonably sure your visitors can handle it.
|
| VERY IMPORTANT:  If you are getting a blank page when compression is enabled it
| means you are prematurely outputting something to your browser. It could
| even be a line of whitespace at the end of one of your scripts.  For
| compression to work, nothing can be sent before the output buffer is called
| by the output class.  Do not 'echo' any values with compression enabled.
|
*/
$config['compress_output'] = FALSE;

/*
|--------------------------------------------------------------------------
| Master Time Reference
|--------------------------------------------------------------------------
|
| Options are 'local' or 'gmt'.  This pref tells the system whether to use
| your server's local time as the master 'now' reference, or convert it to
| GMT.  See the 'date helper' page of the user guide for information
| regarding date handling.
|
*/
$config['time_reference'] = 'GMT';


/*
|--------------------------------------------------------------------------
| Rewrite PHP Short Tags
|--------------------------------------------------------------------------
|
| If your PHP installation does not have short tag support enabled CI
| can rewrite the tags on-the-fly, enabling you to utilize that syntax
| in your view files.  Options are TRUE or FALSE (boolean)
|
*/
$config['rewrite_short_tags'] = FALSE;


/*
|--------------------------------------------------------------------------
| Reverse Proxy IPs
|--------------------------------------------------------------------------
|
| If your server is behind a reverse proxy, you must whitelist the proxy IP
| addresses from which CodeIgniter should trust the HTTP_X_FORWARDED_FOR
| header in order to properly identify the visitor's IP address.
| Comma-delimited, e.g. '10.0.1.200,10.0.1.201'
|
*/
$config['proxy_ips'] = '';
/*
Google Map API Key
*/

$config['gmap_key']='ABQIAAAAbcPdaPLhbS66qEHW87GJRRQiLJwTp1-lBW4bOjX0QE5poNmmbRQOr11s1B6sfAUx9eh40Q93S3mvuw';
/*
PeakHost and Liquidweb vmtas and pools array
*/

$config['ph_vmta']=array('pool1','pool2','pool3','pool4','mta01','rc1','rc2','rc3','rc4','rc5','rc6','rc7','rc8','rc9','rc10','rc11','rc12','rc14','rc15','rc16','rc17');
$config['lw_vmta']=array('redrotate','redrotate2','redrotate3','redrotate_gmail', 'rcmailer1','rcmailer2','rcmailer3','rcmailer4','rcmailer5','rcmailer6','rcmailer7','rcmailer8','rcmailer9','rcmailer10','rcmailer11','rcmailer12');
$config['lw2_vmta']=array('rcmailsv.com','rc74','rc75','rc76','rc77');
$config['lw3_vmta']=array('mailsvrc.com','mailsvrc_agile','rc33','rc34','rc35','rc36');
$config['lw4_vmta']=array('mailsvrc2.com','rc13','rc88','rc89');
$config['lw5_vmta']=array('mailsvrc3.com','rc110','rc111');
$config['lw6_vmta']=array('mailsvrc4.com','rc112','rc113');
$config['lw7_vmta']=array('mailsvrc5.com','rc115','rc114');
$config['lw8_vmta']=array('mailsvrc6.com','rc116','rc117','rc118');
$config['mailgun']=array('mailgun');
$config['amazon_vmta']=array('amazon-mta1');
$config['spark_vmta']=array('sparkpost-mta1');
//$config['vmta_domain']=array('redrotate'=>'www.redcappi.com','redrotate2'=>'www.redcappi.com','redrotate3'=>'www.redcappi.com','redrotate_gmail'=>'www.redcappi.com', 'rcmailer1'=>'www.redcappi.com', 'rcmailer2'=>'www.redcappi.com', 'rcmailer3'=>'www.redcappi.com', 'rcmailer4'=>'www.redcappi.com', 'rcmailer5'=>'www.redcappi.com', 'rcmailer6'=>'www.redcappi.com', 'rcmailer7'=>'www.redcappi.com', 'rcmailer8'=>'www.redcappi.com', 'rcmailer9'=>'www.redcappi.com', 'rcmailer10'=>'www.redcappi.com', 'rcmailer11'=>'www.redcappi.com', 'rcmailer12'=>'www.redcappi.com', 'rcmailsv.com'=>'www.rcmailsv.com',  'mailsvrc_agile'=>'www.redcappi.com', 'mailsvrc.com'=>'www.redcappi.com', 'mailsvrc2.com'=>'www.redcappi.com', 'mailsvrc3.com'=>'www.redcappi.com', 'mailsvrc4.com'=>'www.redcappi.com', 'mailsvrc5.com'=>'www.redcappi.com', 'mailsvrc6.com'=>'www.redcappi.com',   'mailsvrc_gmail'=>'www.redcappi.com', 'rcmailcorp.com'=>'www.rcmailcorp.com',  'mailgun'=>'www.redcappi.com');

$config['vmta_domain']=array('redrotate'=>'www.redcappi.com','redrotate2'=>'www.redcappi.com','redrotate3'=>'www.redcappi.com','redrotate_gmail'=>'www.redcappi.com', 'rcmailer1'=>'www.redcappi.com', 'rcmailer2'=>'www.redcappi.com', 'rcmailer3'=>'www.redcappi.com', 'rcmailer4'=>'www.redcappi.com', 'rcmailer5'=>'www.redcappi.com', 'rcmailer6'=>'www.redcappi.com', 'rcmailer7'=>'www.redcappi.com', 'rcmailer8'=>'www.redcappi.com', 'rcmailer9'=>'www.redcappi.com', 'rcmailer10'=>'www.redcappi.com', 'rcmailer11'=>'www.redcappi.com', 'rcmailer12'=>'www.redcappi.com', 'rcmailsv.com'=>'www.redcappi.com',  'mailsvrc_agile'=>'www.redcappi.com', 'mailsvrc.com'=>'www.redcappi.com', 'mailsvrc2.com'=>'www.redcappi.com', 'mailsvrc3.com'=>'www.redcappi.com', 'mailsvrc4.com'=>'www.redcappi.com', 'mailsvrc5.com'=>'www.redcappi.com', 'mailsvrc6.com'=>'www.redcappi.com',   'mailsvrc_gmail'=>'www.redcappi.com', 'rcmailcorp.com'=>'www.redcappi.com',  'hmailsvrc'=>'www.redcappi.com', 'mailgun'=>'www.redcappi.com', 'amazon'=>'www.redcappi.com', 'sparkpost'=>'www.redcappi.com');

$config['pool_vmta'] = array(
							'redrotate'=>array('rcmailer2','rcmailer3','rcmailer4','rcmailer6','rcmailer7','rcmailer8','rcmailer9','rcmailer10','rcmailer11','rcmailer12'),
							//'redrotate2'=>array('rcmailer4','rcmailer6','rcmailer8','rcmailer9','rcmailer11','rcmailer12'), 
							//'redrotate3'=>array('rcmailer9','rcmailer10','rcmailer11'), 
							'rcmailsv.com'=>array('rc73','rc74','rc75','rc76','rc77'), 
							'redcappi.com'=>array('rcorp73'), 
							'rcmailcorp.com'=>array('rcorp74'), 
							'mailsvrc.com'=>array('rc33','rc34','rc35','rc36'),
							'mailsvrc2.com'=>array('rc13','rc88','rc89'),
							'mailsvrc3.com'=>array('rc110','rc111'),
							'mailsvrc4.com'=>array('rc112','rc113'),
							'mailsvrc5.com'=>array('rc114','rc115'),
							'mailsvrc6.com'=>array('rc116','rc117','rc118'),
							'mailgun'=>array('mailgun'),
							'amazon'=>array('amazon-mta1'),
							'sparkpost'=>array('sparkpost-mta1')
							);
$config['pool_and_vmta'] = array(
						array('redrotate','redrotate2','redrotate3','rcmailer2','rcmailer3','rcmailer4','rcmailer6','rcmailer7','rcmailer8','rcmailer9','rcmailer10','rcmailer11','rcmailer12'),
							//'redrotate2'=>array('rcmailer4','rcmailer6','rcmailer8','rcmailer9','rcmailer11','rcmailer12'), 
							//'redrotate3'=>array('rcmailer9','rcmailer10','rcmailer11'), 
						array('rcmailsv.com','rc73','rc74','rc75','rc76','rc77'), 
						//array('redcappi.com', 'rcorp73'), 
						//array('rcmailcorp.com', 'rcorp74'), 
						array('mailsvrc_agile', 'rc35','rc36'),
						array('mailsvrc.com', 'rc33','rc34','rc35','rc36'),
						array('mailsvrc2.com','rc13','rc88','rc89'),
						array('mailsvrc3.com','rc110','rc111'),
						array('mailsvrc4.com','rc112','rc113'),
						array('mailsvrc5.com','rc114','rc115'),
						array('mailsvrc6.com','rc116','rc117','rc118'),
						array('hmailsvrc'),
						array('mailgun'),
						array('amazon-mta1'),
						array('sparkpost-mta1')						
							);							

$config['unsubscribe_feedback']	= array('I no longer want to receive these emails', 
							'I never signed up for this mailing list', 
							'The emails don&rsquo;t apply to me or are offensive and inappropriate', 
							'The emails are spam and should be reported',
							'I received too many emails from you',
							'Other (Fill in the reason below)'
							)	;									
/*
|--------------------------------------------------------------------------
| Authorize.Net
|--------------------------------------------------------------------------
|
| All of the stuff we need to connect with Authorize.Net
|
|
*/
 
 
$config['loginname']            = "6ks7VWP53";
$config['transactionkey']       = "9S5u88U5K4hn8JRX";

$config['host']                 = "api.authorize.net";
$config['path']                 = "/xml/v1/request.api";
$config['post_url']             = 'https://secure.authorize.net/gateway/transact.dll';
$config['test_mode'] = false;



/*
|--------------------------------------------------------------------------
| Free trial period
|--------------------------------------------------------------------------
|
| How long (in months) should a new paid account have as a free trial?
|
|
*/
$config['trial_period'] = 1;

/* End of file config.php */
/* Location: ./application/config/config.php */
