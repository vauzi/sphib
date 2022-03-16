<?php
function admin_logedIn()
{
	$ci = get_instance();
	if (!$ci->session->userdata('email')) {
		return redirect('/');
	} else if (!$ci->session->userdata('user_level') == 1) {
		return redirect('Error');
	}
}
