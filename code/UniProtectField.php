<?php
/**
 * @package uniprotect
 */

/**
 * Provides an {@link FormField} which allows form to validate for non-bot submissions
 * by checking if value in that field is correct. The value of this field is set using javascript events.
 */
class UniProtectField extends SpamProtectorField {

	public function Field($properties = array()) {
		Requirements::javascript(FRAMEWORK_DIR . '/thirdparty/jquery/jquery.js');

		Session::clear("FormField.".$this->form->FormName().".".$this->getName().".error");

		$name = $this->class . '_' . $this->getName();
		$value = md5(mt_rand());
		Session::set($this->class.".".$this->form->FormName().".Captcha", $value);

		return '
			<input type="hidden" value="" name="'.$name.'" />
			<script type="text/javascript"> $(function(){ $(document).on("mousemove keydown", function(e){ $("input[name='.$name.']").val("'.$value.'"); }); }) </script>
		';
	}

	public function FieldHolder($properties = array()) {
		return $this->XML_val('Field');
	}

	/**
	 * Validate cheking if the value in the field is correct
	 */
	public function validate($validator) {
		$name = $this->class . '_' . $this->getName();
		if (!isset($_REQUEST[$name]) || $_REQUEST[$name] != Session::get($this->class.".".$this->form->FormName().".Captcha")) {
			$validator->validationError(
				$this->name,
				_t($this->class . '.INVALID', "Sorry, but looks like that you're trying to post spam here."),
				'validation',
				false
			);
			return false;
		}
		return true;
	}

}
