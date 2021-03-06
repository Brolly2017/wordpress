<?php
/**
 * Field Template: Date Picker
 *
 * @since 1.4.0
 *
 * @var array $args Field arguments.
 * @var string $name Field name.
 * @var mixed $value Field value.
 */

defined( 'ABSPATH' ) || die();
?>

<input type="text"
       class="fieldhelpers-field-datepicker-preview"
       value="<?php echo esc_attr( $args['preview'] ); ?>"
	   <?php RBM_FH_Field::input_atts( $args ); ?>
       data-fieldhelpers-field-datepicker
/>

<input type="hidden"
       name="<?php echo esc_attr( $name ); ?>"
       value="<?php echo esc_attr( $value ); ?>"
       class="<?php echo esc_attr( $args['input_class'] ); ?>"
/>
