<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');




define('SYSTEM_DOMAIN_NAME', 'redcappi.com');
define('OTHER_ALLOWED_DOMAIN_ARRAY', serialize(array('www.red7.me', 'www.rcmailsv.com', 'www.mailsvrc.com', 'www.rcmailcorp.com')));
//define('OTHER_DOMAIN_ALLOWED_PAGE_ARRAY', serialize(array('/c/','/s/', '/false_link_message','newsletter/signup/subscribe', 'newsletter/signup/verify_subscription/', 'newsletter/signup/signup_confirmation/', '/webappassets/', '/newsletter/unsubscribe_mail/unsubscribe/', '/newsletter/forward_to_friend/', '/newsletter/powered_by_redcappi/',  '/newsletter/unsubscribe_mail/read/', '/newsletter/clickrate/create/', '/a/', '/newsletter/clickrate/create_autoresponder/', '/newsletter/autoresponder_email/unsubscrib...(line truncated)...

define('OTHER_DOMAIN_ALLOWED_PAGE_ARRAY', serialize(array('/c/','/a/','/s/', '/false_link_message', 'newsletter/signup/subscribe', 'newsletter/signup/verify_subscription/', 'newsletter/signup/signupform_url/','newsletter/signup/signup_confirmation/', '/newsletter/signup/showpblogo/','/webappassets/', '/newsletter/unsubscribe_mail/unsubscribe/',  '/newsletter/powered_by_redcappi/',  '/newsletter/unsubscribe_mail/read/', '/newsletter/clickrate/create/', '/newsletter/clickrate/create_autoresponder/', '/newsletter/autoresponder_email/unsubscribe/', '/newsletter/autoresponder_email/read/')));


define('CAMPAIGN_DOMAIN', 'https://www.red7.me/');
define('SYSTEM_EMAIL_FROM', 'support@redcappi.com');
define('SYSTEM_NOTICE_EMAIL_TO', 'jig.samani@redcappi.com');
define('DEVELOPER_EMAIL', 'jig.samani@redcappi.com');
define('WEBMASTER_TIMEZONE', 'America/Chicago');
define('RIGHT_TO_LEFT_LANGUAGE_ARRAY', serialize(array('ar','ur','iw','fa','yi')));
// Based on the Development(DEV) and Production(PH) server
define('CAMPAIGN_HEADER_SUFFIX','PH');
define('WWW_AUTHENTICATE','NO');
define('WWW_AUTHENTICATION_UNM','KyalLyla');
define('WWW_AUTHENTICATION_PWD','L0v3T0Pl@yTog3th3r');
define('IMAGE_BANK_QUOTA', 1048576 * 400); //1MB(megabyte) =1048576 Bytes

define('QUEUEING_BATCH_SIZE', 10000); //Used to fetch records while queueing a campaign

// MAINTENACE SETTINGS
define('MAINTENANCE_MODE_FOR_LOGGED_USERS', 'no'); // yes / no
define('MAINTENANCE_MODE_FOR_ALL_USERS', 'no'); // yes / no, front end down for logged in members and visitors

//SFDC Settings
define('SFDC_USERNAME','jig.samani@redcappi.com');
define('SFDC_Password','R3dC@pp1LLCyQtEPaP7wEKej2zPikxojOxcv');
define("SOAP_CLIENT_BASEDIR", "/home/redcapp/public_html/webapp/libraries/soapclient");


/* End of file constants.php */