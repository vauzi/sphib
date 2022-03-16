<?php

function user_logedIn()
{
	$ci = get_instance();
	if (!$ci->session->userdata('email')) {
		return redirect('/');
	}
}
