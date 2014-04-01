<?php

class Simple_Verify {
	
	private $_passcode_key = 'sIMple_VErIFy_COde_Key';
	
	public function __construct($passcode_key) {
		
		if(!empty($passcode_key)) {
			
			$this->_passcode_key = $passcode_key;
			
		}
		
	}
	
	public function getPasscode($str, $expiration=0) {
	
		return md5($str .'-'. $this->_passcode_key .'-'. $expiration);
	
	}
	
	public function check($original_str, $check_passcode, $expiration=0) {

		if($original_str != '' && 
				$this->getPasscode($original_str, $expiration) == $check_passcode) {
	
			if($expiration > 0 && $expiration < time()) {
				
				return false;
				
			}
			
			return true;
	
		}
	
		return false;
	
	}
	
}
/*** Example

	$verify = new Simple_Verify('passcode');	// The arg is skippable.

	$str = 'Test string';
	$expiration = time() + 10000;
	
	$passcode = $verify->getPasscode($str, $expiration);	// $expiration is skippable.
	
	if($verify->check($str, $passcode, $expiration)) {		// $expiration is skippable.
		
		echo OK;
		
	}

***/
