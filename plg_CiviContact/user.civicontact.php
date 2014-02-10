<?php
// ensure this file is being included by a parent file
if ( ! ( defined( '_VALID_CB' ) || defined( '_JEXEC' ) ) ) { die( 'Direct Access to this location is not allowed.' ); }

class getCiviTab extends cbTabHandler {
	
	function getCiviTab() {
		$this->cbTabHandler();
	}

	function getDisplayTab($tab,$user,$ui) {
		
		// Perform Civi bootstrap
		define('CIVICRM_SETTINGS_PATH', JPATH_ADMINISTRATOR . '/components/com_civicrm/civicrm.settings.php');
		define('CIVICRM_CORE_PATH', JPATH_ADMINISTRATOR . '/components/com_civicrm/civicrm/');
		require_once CIVICRM_SETTINGS_PATH;
		require_once CIVICRM_CORE_PATH .'CRM/Core/Config.php';
		$config = CRM_Core_Config::singleton();
		
		
		try{
			$contacts = civicrm_api3('UF_MATCH', 'get', array(
			'sequential' => 1,
			));
			
			}
		
		catch (CiviCRM_API3_Exception $e) {
			$error = $e->getMessage();
			
			}
		
		$return = "this is a new tab and the user viewing this tab is " . $user->name . var_dump($user) . 
		"<br />" . var_dump($contacts) . 
		"br />" . printf($error);
		
	
	return $return;
	
	} //end getDisplayTab function
}//end getCiviTab class	
	
?>
