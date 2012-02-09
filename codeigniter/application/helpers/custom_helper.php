<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/*
	Tutorial says add, but it crashes CI:
		if (!function_exists('fun_name')){
			function fun_name() ...
		}
	*/
    function anchor_img($controller_method,$img){
        return anchor($controller_method ,img(array('src'=> $img, 'border'=>'0', 'alt'=> 'welcome')));
    }   
	
	/* test stub:
		function test_method($var = ''){
			return $var;
		}
	*/