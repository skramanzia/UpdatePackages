<?php
/* +***********************************************************************************************************************************
 * The contents of this file are subject to the YetiForce Public License Version 1.1 (the "License"); you may not use this file except
 * in compliance with the License.
 * Software distributed under the License is distributed on an "AS IS" basis, WITHOUT WARRANTY OF ANY KIND, either express or implied.
 * See the License for the specific language governing rights and limitations under the License.
 * The Original Code is YetiForce.
 * The Initial Developer of the Original Code is YetiForce. Portions created by YetiForce are Copyright (C) www.yetiforce.com. 
 * All Rights Reserved.
 * *********************************************************************************************************************************** */

class Settings_SupportProcesses_SaveGeneral_Action extends Settings_Vtiger_Index_Action
{

	public function __construct()
	{
		$this->exposeMethod('save');
	}

	/**
	 * Save date
	 * @param <array> $ticketStatus
	 * @return true if saved, false otherwise
	 */
	public function save(Vtiger_Request $request)
	{
		$response = new Vtiger_Response();
		$ticketStatus = $request->get('status');

		$moduleName = 'Settings:SupportProcesses';
		try {
			if (Settings_SupportProcesses_Module_Model::updateTicketStatusNotModify($ticketStatus)) {
				$response->setResult(array('success' => true, 'message' => vtranslate('LBL_SAVE_CONFIG_OK', $moduleName)));
			} else {
				$response->setResult(array('success' => false, 'message' => vtranslate('LBL_SAVE_CONFIG_ERROR', $moduleName)));
			}
		} catch (Exception $e) {
			$response->setError($e->getCode(), $e->getMessage());
		}
		$response->emit();
	}
}
