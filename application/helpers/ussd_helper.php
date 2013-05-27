<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function ussd_number($number=false, $port=-1){
	if($number && ($port != -1)){
		preg_match('/[0-9*#]+/',$number,$numbermatch);
		if(isset($number[0])){
			return ussd_ssh2($number,$port);
		}
	}
	return false;
}

function ussd_ssh2($number=false, $port=-1){
	if($number && ($port != -1)){
		$CI =& get_instance(); 
		$CI->config->load('ussdconfig');
		$connection = ssh2_connect($CI->config->item('ussdhost'), $CI->config->item('ussdport'), array('hostkey'=>'ssh-rsa'));
		if (ssh2_auth_pubkey_file($connection, $CI->config->item('ussdusername'),$CI->config->item('ussdpubkey'),$CI->config->item('ussdprivkey'))) {
			if (!($stream = ssh2_exec($connection, "/usr/local/sbin/gammu-ussd ".$number.' '.$port))){
				return  "fail: unable to execute command\n";
			} else {
				stream_set_blocking($stream, true);
				$stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
				return  stream_get_contents($stream_out);
			}
		} else {
			return 'Public Key Authentication Failed';
		}
	}
}


