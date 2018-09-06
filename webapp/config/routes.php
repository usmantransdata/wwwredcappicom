<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = '';
$route['_404'] = 'error_404';

$route['signup'] = "user/register";
$route['anti-spam'] = "anti_spam";
$route['email-marketing-features'] = "email_marketing_features";
$route['gdpr/(:num)/(:any)'] = "gdpr/index/$1/$2";

$route['st/(:any)/signup'] = "st/register/";

$route['blog/archive/(:num)'] = "blog/archive/$1/$2/$3";
$route['blog/email-marketing-category/(:any)'] = "blog/email_marketing_category/$1/$2/$3/$4";
$route['blog/([a-zA-Z0-9-_]+)/(\d+)'] = "blog/article/$1/$2";
$route['blog/(:num)'] = "blog/post_listing/$1";

$route['a/(:any)'] = "newsletter/autoresponder_preview/index/$1/$2/$3/";

$route['c/(:num)'] = "newsletter/campaign_preview/index/$1/";
$route['c/(:any)'] = "newsletter/campaign_preview/display_mail/$1/$2";
$route['c/(:any)/(:num)'] = "newsletter/campaign_preview/display_mail/$1/$2";
$route['c/(:any)/(:num).html'] = "newsletter/campaign_preview/index/$1/$2";
$route['s/(:num)'] = "newsletter/signup/signupform_url/$1";
//visitor tracking
$route['st/(:any)'] = "home/st/$1/$2/";

$route['asset/user_files/(:num)/extracted_zip_files/(:any)'] = "/get_data/show_template_image/$1/$2/$3/$4/$5/$6/$7";
$route['webappassets/user_files/(:num)/extracted_zip_files/(:any)'] = "/get_data/show_template_image/$1/$2/$3/$4/$5/$6/$7";
$route['asset/user_files/(:num)/image_bank/(:any)'] = "/get_data/get_file/$1/image/$2";
$route['asset/user_files/(:num)/email_templates/(:any)'] = "/get_data/show_diy_mail_logo/$1/email_templates/$2";
$route['asset/user_files/(:num)/autoresponders/(:any)'] = "/get_data/show_diy_mail_logo/$1/autoresponders/$2";
$route['asset/user_files/(:num)/hbg/(:any)'] = "/get_data/show_signup_img/$1/$2/hbg/";
$route['asset/user_files/(:num)/bbg/(:any)'] = "/get_data/show_signup_img/$1/$2/bbg/";
$route['asset/user_files/(:num)/btn/(:any)'] = "/get_data/show_signup_img/$1/$2/btn/";
$route['asset/user_files/a/(:any)'] = "/get_data/show_campaign_header/a/$1";
$route['asset/user_files/c/(:any)'] = "/get_data/show_campaign_header/c/$1";
$route['asset/user_files/video_img/(:any)'] = "/get_data/show_campaign_video/$1";
$route['asset/user_files/(:any)'] = "/get_data/show_campaign_header/c/$1";
$route['asset/uploaded/(:any)'] = "/get_data/show_blog_img/$1";

$route['lshare/(:any)'] = "/lshare/index/$1/$2";

/* End of file routes.php */
/* Location: ./application/config/routes.php */