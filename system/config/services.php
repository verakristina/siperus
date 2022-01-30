<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => [
		'domain' => '',
		'secret' => '',
	],

	'mandrill' => [
		'secret' => '',
	],

	'ses' => [
		'key' => '',
		'secret' => '',
		'region' => 'us-east-1',
	],

	'stripe' => [
		'model'  => 'User',
		'secret' => '',
	],

	'facebook' => [
	    'client_id' => '1387398624654506',
	    'client_secret' => '8dcab7677bec74d339fea811664d7cd4',
	    'redirect' => 'http://www.partaihanura.net/pusdatin_v3/register/facebook/callback',
	],

	'google' => [
	    'client_id' => '855424771062-a29gd26e1a42sm9pm42hcqjkahq550jp.apps.googleusercontent.com',
	    'client_secret' => 'fHnF0FSARMVMn8M5-rSzGZbc',
	    'redirect' => 'http://www.partaihanura.net/pusdatin_v3/register/google/callback',
	],

];
