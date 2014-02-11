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
		
		//Get Civi contcat ID of current user
		//$civi_contact_id = null;
			try{
				$contacts = civicrm_api3('UFMatch', 'get', array(
				'uf_id' => $user->id,
				));
			
				}
		
			catch (CiviCRM_API3_Exception $e) {
				$error = $e->getMessage();
			
				printf($error);
				}
				
		$civi_contact = array('id'=> $contacts['values'][1]['contact_id']);	//store the civi contact id for later
		
		//$return = var_dump($civi_contact_id);
		//Get info from Civi contact record
			try{
				$contacts = civicrm_api3('Contact', 'get', array(
				'contact_id' => $civi_contact['id'],
				));
			
				
				//$return = var_dump($contacts);
			
				}
		
			catch (CiviCRM_API3_Exception $e) {
				$error = $e->getMessage();
			
				$return = printf($error);
				}
		//$return = var_dump($contacts);
		
		//Get the usefull values out of the multi-demnsional $contacts array and put into a 1-D array which is slightly easier to handle
		$civi_contact['firstname'] = $contacts['values'][2]['first_name'];
		$civi_contact['lastname'] = $contacts['values'][2]['last_name'];
		$civi_contact['email'] = $contacts['values'][2]['email'];
		$civi_contact['street'] = $contacts['values'][2]['street_address'];
		$civi_contact['suburb'] = $contacts['values'][2]['supplemental_address_1'];
		$civi_contact['city'] = $contacts['values'][2]['city'];
		$civi_contact['hmphone'] = $contacts['values'][2]['phone'];
		//$civi_contact_mobphone = $contacts['values'][1]['first_name'];
		//$civi_contact_wkphone = $contacts['values'][1]['first_name'];
		//$civi_contact_membershiptype = $contacts['values'][1]['first_name'];
		//$civi_contact_membershipexpiry = $contacts['values'][1]['first_name'];
		
		$return .= "\t\t<div>\n \t\t\t<form>\n \t\t\t\t<fieldset>\n";
		 foreach ($civi_contact as $key => $item) {
			if($key != 'id')
			{
				$var = str_replace(" ", "&nbsp;", $item);
				//var_dump($var);
				$return .= "\t\t\t\t\t <label>". $key ."</label>";
				$return .= "<input type='text' value= ". $var .">\n";
			}
		}	
		$return .= "\t\t\t\t\t <br/> <input type='button' value='Update Profile' action='post'/>";
		$return .= "\t\t\t\t </fieldset>\n \t\t\t</form>\n \t\t</div>";
	return $return;
	
	} //end getDisplayTab function
	
}//end getCiviTab class	
	
?>
