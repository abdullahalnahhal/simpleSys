<?php

function active($page, $active)
{
	if ($page == $active) {
		return 'active';
	}
	return '';
}

?>