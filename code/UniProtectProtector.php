<?php
/**
 * @package uniprotect
 */

/**
 * Protecter class to handle spam protection interface
 */
class UniProtectProtector implements SpamProtector {

	/**
	 * Return the Field that we will use in this protector
	 *
	 * @return string
	 */
	function getFormField($name = "UniProtectField", $title = "UniProtect",
		$value = null, $form = null, $rightTitle = null
	) {
		return new UniProtectField($name, $title, $value, $form, $rightTitle);
	}

	/**
	 * Needed for the interface. Recaptcha does not have a feedback loop
	 *
	 * @return boolean
	 */
	function sendFeedback($object = null, $feedback = "") {
		return false;
	}
}
