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

/* Website Images and Icons */
define('logo', 									'http://zigu.freeiz.com/images/logo.gif');
define('magspinner',							'http://zigu.freeiz.com/scripts/popUpMagnifier/spinner40.gif');
define('magplus',								'http://zigu.freeiz.com/scripts/popUpMagnifier/magplus.gif');
define('magminus',								'http://zigu.freeiz.com/scripts/popUpMagnifier/magminus.gif');
/* End of Images and Icons */

/* Javascript */
define('magnifyjs',								'http://zigu.freeiz.com/scripts/popUpMagnifier/PopBoxDocumentation_files/PopBox.js');
/* End of Javascript */

/* CSS */
define('display_elements',						'http://zigu.freeiz.com/css/display_elements.css');
define('template',								'http://zigu.freeiz.com/css/style.css');
/* End of CSS */

/* End of file constants.php */
/* Location: ./application/config/constants.php */