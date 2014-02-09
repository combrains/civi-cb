<?php
// ensure this file is being included by a parent file
if ( ! ( defined( '_VALID_CB' ) || defined( '_JEXEC' ) ) ) { die( 'Direct Access to this location is not allowed.' ); }

class getCiviTab extends cbTabHandler {
	
	function getCiviTab() {
		$this->cbTabHandler();
	}

?>
