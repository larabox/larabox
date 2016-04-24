<?php

Route::get('', [
	'as' => 'admin.dashboard',
	function ()
	{
		$content = 'Define your dashboard here.';
		return Admin::view($content, 'Dashboard');
	}
]);

