﻿<?php

/*
|--------------------------------------------------------------------------
| Instagram
|--------------------------------------------------------------------------
|
| Instagram client details
|
*/

$config['instagram_client_name']	= 'sample2';
$config['instagram_client_id']		= 'ac27022e543240eab212d902bf1bb7c4';
$config['instagram_client_secret']	= '683e3c5e8a2e427b84e1c9362774b2c4';
$config['instagram_callback_url']	= 'http://rhytha.info/path/index.php/auth/session/instagram';
$config['instagram_website']		= 'http://rhytha.info';
$config['instagram_description']	= 'sample2';

/**
 * Instagram provides the following scope permissions which can be combined as likes+comments
 * 
 * basic - to read any and all data related to a user (e.g. following/followed-by lists, photos, etc.) (granted by default)
 * comments - to create or delete comments on a user’s behalf
 * relationships - to follow and unfollow users on a user’s behalf
 * likes - to like and unlike items on a user’s behalf
 * 
 */
$config['instagram_scope'] = 'basic';

// There was issues with some servers not being able to retrieve the data through https
// If you have this problem set the following to FALSE 
// See https://github.com/ianckc/CodeIgniter-Instagram-Library/issues/5 for a discussion on this
$config['instagram_ssl_verify']		= TRUE;