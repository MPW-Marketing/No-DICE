<?php

abstract class BTP_Form_Unit {
	
	protected	$_id,
				$_args;
	
	public function __construct( $id, $args = array() ) {
		$this->_id = $id;
		$this->_args = array_merge(
			array(
				'name' 		=> $id,
				'label'		=> $id,
				'value'		=> null,
				'hint'		=> null,
				'help'		=> null, 		
			),
			$args
		);		
	}			
					
				
	abstract public function getCSSClass();			
					
	public function setId( $v ) { $this->_id = $v; }	
	public function getId() { return $this->_id; }
	
	public function setLabel( $v ) { $this->_args['label'] = $v; }	
	public function getLabel() { return $this->_args['label']; }
	
	public function setHelp( $v ) { $this->_args['help'] = $v; }	
	public function getHelp() { return $this->_args['help']; }
	
	public function setHint( $v ) { $this->_args['hint'] = $v; }	
	public function getHint() { return $this->_args['hint']; }
	
	public function setName( $v ) { $this->_args['name'] = $v; }	
	public function getName() {
		return $this->_args['name'];	
	}
	
	public function setValue( $v ) { $this->_args['value'] = $v; }
	public function getValue() { return $this->_args['value']; }

	
	public function render() {
		$out = '';
		$out .= '<div id="' . esc_attr( $this->getId() ) . '" class="btp-form-unit ' . $this->getCSSClass() . '">';
			$out .= $this->renderLabel();
			$out .= $this->renderHelp();
			$out .= $this->renderField();
			$out .= $this->renderHint();			
		$out .= '</div>';
		
		return $out;
	}
	
	public function renderLabel() {
		$out = '';
		
		$out .= '<div class="btp-label">';
			$out .= '<label>' . esc_html( $this->getLabel() ) . '</label>';
		$out .= '</div>';
		
		return $out;
	}

	public function renderHelp() {
		$out = '';
		
		if ( strlen( $this->getHelp() ) ) {		
			$out .= '<div class="btp-help">';
				$out .= '<div class="btp-help-toggle"></div>';
				$out .= '<div class="btp-help-content">';
					$out .= $this->getHelp();
				$out .= '</div>';	
			$out .= '</div>';
		}	
		
		return $out;
	}
	
	public function renderField() {
		$out = '';
		
		$out .= '<div class="btp-field">';
			$out .= '<input type="text" name="' . esc_attr( $this->getName() ) . '" value="' . $this->getValue() . '" />';
		$out .= '</div>';
				
		return $out;
	}
	
	public function renderHint() {
		$out = '';
		
		if ( strlen( $this->getHint() ) ) {
			$out .= '<div class="btp-hint">';
				$out .= $this->getHint();
			$out .= '</div>';
		}
		
		return $out;
	}
}

class BTP_Form_Unit_Input_Text extends BTP_Form_Unit {
	public function getCSSClass() { return 'btp-form-unit-input-text'; }
	
	public function renderField() {
		$out = '';		
		$out .= '<div class="btp-field btp-field-input-text">';
			$out .= '<input type="text" name="' . esc_attr( $this->getName() ) . '" value="' . esc_attr( $this->getValue() ) . '" />';
		$out .= '</div>';
		
		return $out;
	}
}


class BTP_Form_Unit_Checkbox extends BTP_Form_Unit {
	public function getCSSClass() { return 'btp-form-unit-checkbox'; }	
	
	public function renderField() {
		$out = '';		
		$out .= '<div class="btp-field btp-field-checkbox">';
			
			if( $this->getValue() === true )
				$out .= '<input type="checkbox" name="' . esc_attr( $this->getName() ) . '" value="true" checked="checked" />';
			else	
				$out .= '<input type="checkbox" name="' . esc_attr( $this->getName() ) . '" value="true" />';
				
		$out .= '</div>';
		
		return $out;
	}
}




class BTP_Form_Unit_Select extends BTP_Form_Unit {
	public function getCSSClass() { return 'btp-form-unit-select'; }
	
	public function renderField() {
		$out = '';
		$out .= '<div class="btp-field btp-field-select">';
			$out .= '<select name="' . esc_attr($this->getName()) . '">';
				foreach( $this->getChoices() as $opt_value => $opt_label ) {
					$out .= '<option value="' . esc_attr( $opt_value ) . '">' . esc_html( $opt_label ) . '</option>';
				}
			$out .= '</select>';
		$out .= '</div>';	
		
		return $out;
	}
	
	public function getChoices() {
		if ( isset( $this->_args[ 'choices' ] ) ) {
			if( is_array( $this->_args['choices'] ) )
				return $this->_args['choices'];
			else
				return call_user_func( $this->_args['choices'] );
		}		
		return array();		
	}
}

class BTP_Form_Unit_Textarea extends BTP_Form_Unit {
	public function getCSSClass() { return 'btp-form-unit-textarea'; }
	
	public function renderField() {
		$out = '';
		$out .= '<div class="btp-field btp-field-textarea">';
			$out .= '<textarea name="' . esc_attr( $this->getName() ) . '" cols="10" rows="10">';
				$out .= $this->getValue();
			$out .= '</textarea>';
		$out .= '</div>';
		
		return $out;
	}
}

class BTP_Form_Unit_Color extends BTP_Form_Unit {
	public function getCSSClass() { return 'btp-form-unit-color'; }
	
	public function renderField() {
		$out = '';		
		$out .= '<div class="btp-field btp-field-color">';			
			$style = strlen( $this->getValue() ) ? ' style="background: #' . intval( $this->getValue() ) .';"' : '';
			$out .= '<span class="btp-color-sample"' . $style . '></span>';			
			$out .= '<input type="text" name="' . esc_attr( $this->getName() ) . '" value="' . esc_attr( $this->getValue() ) . '" />';
		$out .= '</div>';
		
		return $out;
	}
}

?>