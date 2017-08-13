<?php
	return array(
		'client_id'	=> 'Aci2LpZ0BSQOQmx0mlX_6RubqE32VgH512TYRvLNbYmkW0_qHVxLruFTYre4yoSOcu6kmdl0TLwFrMJ1',
		'secret'	=> 'EESR9_DajDUaDnlujNd2TBWrhhq_1_uJy_9jN44XMr0YFvXlfrPGE0QzVQtvC4oUOxwxN3ClXK7WiWl0',

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