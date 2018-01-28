<?php
/**
 * Layout Customizer Control
 *
 * @see https://developer.wordpress.org/reference/classes/wp_customize_control/
 *
 * @package   Login Designer
 * @author    Rich Tabor from ThatPluginCompany
 * @license   GPL-3.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Exit if WP_Customize_Control does not exsist.
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * This class is for the range control in the Customizer.
 *
 * @access  public
 */
class Login_Designer_Range_Control extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'login-designer-range';

	/**
	 * Get the control default.
	 *
	 * @access public
	 * @var $type Customizer type option
	 */
	public $default = 'default';

	/**
	 * Enqueue neccessary custom control scripts.
	 */
	public function enqueue() {

		// Use this only if SCRIPT_DEBUG is turned on.
		if ( defined( 'SCRIPT_DEBUG' ) && false === SCRIPT_DEBUG ) {
			return;
		}

		// Define where the control's scripts are.
		$js_dir = LOGIN_DESIGNER_PLUGIN_URL . 'assets/js/controls/';

		// Custom control scripts.
		wp_enqueue_script( 'login-designer-range-control', $js_dir . 'login-designer-range-control.js', array( 'jquery' ), LOGIN_DESIGNER_VERSION, 'all' );
	}

	/**
	 * Render the content.
	 *
	 * @see https://developer.wordpress.org/reference/classes/wp_customize_control/render_content/
	 */
	public function render_content() {
		?>

		<div class="relative">

			<?php
			if ( ! empty( $this->label ) ) : ?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				</label>
			<?php endif; ?>

			<div class="value">
				<span><?php echo esc_attr( $this->value() ); ?></span>
				<input class="track-input" data-default-value="<?php echo esc_html( $this->default ); ?>" type="number"<?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
				<em><?php echo esc_html( $this->description ); ?></em>
			</div>

			<input class="track" data-default-value="<?php echo esc_html( $this->default ); ?>" data-input-type="range" type="range"<?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />

			<a type="button" value="reset" class="range-reset"></a>

		</div>

		<?php
	}
}
