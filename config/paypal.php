<?php
	return array(
		'client_id'	=> 'AYSq3RDGsmBLJE-otTkBtM-jBRd1TCQwFf9RGfwddNXWz0uFU9ztymylOhRS',
		'secret'	=> 'EGnHDxD_qRPdaLdZz8iCr8N7_MzF-YHPTkjs6NKYQvQSBngp4PTTVWkPZRbL',

		/**
			SDK configuration
		*/
		'settings' => array(
			'mode'						=> 'sandbox',
			'http.ConnectionTimeOut'	=> 30,
			'log.LogEnabled'			=> true,
			'log.FileName'				=> storage_path().'/logs/paypal.log',
			'log.LogLevel'				=> 'FINE'
		),

	);