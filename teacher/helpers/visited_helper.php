<?php 

function visit_total() {
	
}

function visit_online() {
	$CI = & get_instance();
		
	/**
	 * Load database
	 * 
	 */
	$CI->load->model('online_model');
	
	$total = $CI->online_model->online_visit();
	
	return $total;
}

function total_visit( $pt = 'publics/count.dat' ) {

	$CI =& get_instance();
	
	$CI->load->helper('file');
	
	$path = $pt;
	
	$string = read_file( $path );
	
	if ( !$string ) {
		$data = '1';	
		write_file( $path , $data);
	}
	
	$count 	= (int)get_cookie('dem');
	
	$add 	= $string;
	
	if ( !$count ) {
		set_time_out();
		$add = $string + 1;
		write_file( $path , $add);
	}

	return $add;
		
}


function set_time_out() {
	
	$cookie = array(
        'name'   => 'dem',
        'value'  => '1',
        'expire' => '300'
    );

	return set_cookie($cookie); 
}

?>