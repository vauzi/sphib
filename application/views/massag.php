<?php if ($this->session->flashdata()) {
	echo $this->session->flashdata('message');
}
