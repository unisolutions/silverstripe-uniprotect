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

		$value = md5(mt_rand());
		Session::set($this->class.".".$this->form->FormName().".".$this->getName(), $value);

		return '
			<input type="hidden" value="" name="'.$this->getName().'" />
			<script type="text/javascript">
				$(function(){
					$(document).on("mousemove keydown", function(e){
						$("#'.$this->form->FormName().' input[name='.$this->getName().']").val("'.$value.'");
					});
				});
			</script>
		';
	}

	public function FieldHolder($properties = array()) {
		return $this->XML_val('Field');
	}

	/**
	 * Validate checking if the value in the field is correct
	 */
	public function validate($validator) {
		if (!isset($_REQUEST[$this->getName()])
			|| $_REQUEST[$this->getName()] != Session::get($this->class.".".$this->form->FormName().".".$this->getName())
		) {
			$validator->validationError(
				$this->getName(),
				_t($this->class . '.INVALID', "Sorry, but looks like that you're trying to post spam here."),
				'validation',
				false
			);
			return false;
		}
		return true;
	}

}
