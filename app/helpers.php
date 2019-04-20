<?php

	function active($page, $active)
	{
		if ($page == $active) {
			return 'active';
		}
		return '';
	}
	function currentUser()
	{
		return auth('web')->user();
	}
?>