<?php
/*
 * Template Name: Login Designer
 *
 * Template to display the WordPress login form in the Customizer.
 * This is essentially a stripped down version of wp-login.php, though not accessible from outside the Customizer.
 *
 * @package   Login Designer
 * @author    Rich Tabor from ThatPluginCompany
 * @license   GPL-3.0
 */

// Redirect if viewed from outside the Customizer.
if ( ! is_customize_preview() ) {

	// Pull the Login Designer page from options.
	$page = get_permalink( Login_Designer()->get_login_designer_page() );

	// Generate the redirect url.
	$url = add_query_arg(
		array(
			'autofocus[section]' => 'login_designer__section--templates',
			'return'             => admin_url( 'index.php' ),
			'url'                => rawurlencode( $page ),
		),
		admin_url( 'customize.php' )
	);

	wp_safe_redirect( $url );
}

/**
 * Output the login page header.
 *
 * @param string   $title    Optional. WordPress login Page title to display in the `<title>` element.
 *                           Default 'Log In'.
 * @param string   $message  Optional. Message to display in header. Default empty.
 * @param WP_Error $wp_error Optional. The error to pass. Default empty.
 */
function logindesigner_login_header( $title = 'Log In', $message = '', $wp_error = '' ) {

	global $error, $interim_login, $action;

	// Don't index any of these forms.
	add_action( 'login_head', 'wp_no_robots' );

	if ( empty( $wp_error ) ) {
		$wp_error = new WP_Error();
	}

	$login_title = get_bloginfo( 'name', 'display' );

	/* translators: Login screen title. 1: Login screen name, 2: Network or site name */
	$login_title = sprintf( __( '%1$s &lsaquo; %2$s &#8212; WordPress' ), $title, $login_title );
	/**
	 * Filters the title tag content for login page.
	 *
	 * @since 4.9.0
	 *
	 * @param string $login_title The page title, with extra context added.
	 * @param string $title       The original page title.
	 */
	$login_title = apply_filters( 'login_title', $login_title, $title );
	?><!DOCTYPE html>
	<head>
	<title><?php echo esc_attr( $login_title ); ?></title>
	<?php
	wp_enqueue_style( 'login' );

	/**
	 * Enqueue scripts and styles for the login page.
	 *
	 * @since 3.1.0
	 */
	do_action( 'login_enqueue_scripts' );

	/**
	 * Fires in the login page header after scripts are enqueued.
	 *
	 * @since 2.1.0
	 */
	do_action( 'login_head' );

	$login_header_url   = __( 'https://wordpress.org/' );
	$login_header_title = __( 'Powered by WordPress' );

	/**
	 * Filters link URL of the header logo above login form.
	 *
	 * @since 2.1.0
	 *
	 * @param string $login_header_url Login header logo URL.
	 */
	$login_header_url = apply_filters( 'login_headerurl', $login_header_url );

	/**
	 * Filters the title attribute of the header logo above login form.
	 *
	 * @since 2.1.0
	 *
	 * @param string $login_header_title Login header logo title attribute.
	 */
	$login_header_title = apply_filters( 'login_headertitle', $login_header_title );
	$classes            = array( 'login-action-' . $action, 'wp-core-ui' );
	$classes[]          = ' locale-' . sanitize_html_class( strtolower( str_replace( '_', '-', get_locale() ) ) );

	/**
	 * Filters the login page body classes.
	 *
	 * @since 3.5.0
	 *
	 * @param array  $classes An array of body classes.
	 * @param string $action  The action that brought the visitor to the login page.
	 */
	$classes = apply_filters( 'login_body_class', $classes, $action );
	?>
	</head>

	<body class="login <?php echo esc_attr( implode( ' ', $classes ) ); ?>">

	<?php
	/**
	 * Fires in the login page header after the body tag is opened.
	 *
	 * @since 4.6.0
	 */
	do_action( 'login_header' );
	?>

	<div id="login-designer--background-hint" data-hint="Click here to upload a background image, choose from the gallery and set a background color." data-hintPosition="middle-right" data-position="bottom-right-aligned"></div>

	<div id="login-designer--templates-hint" data-hint="Click here to select a display template for your login page." data-hintPosition="middle-right" data-position="bottom"></div>

	<div id="login">
		<h1 id="login-designer-logo-h1" data-hint="Click on the logo below to upload your own and set the image's height and width." data-hintPosition="top-middle" data-position="right"><a id="login-designer-logo" class="customize-unpreviewable" href="<?php echo esc_url( $login_header_url ); ?>" title="<?php echo esc_attr( $login_header_title ); ?>" tabindex="-1"><?php bloginfo( 'name' ); ?></a></h1>
	<?php
	unset( $login_header_url, $login_header_title );
	/**
	 * Filters the message to display above the login form.
	 *
	 * @since 2.1.0
	 *
	 * @param string $message Login message text.
	 */
	$message = apply_filters( 'login_message', $message );

	if ( !empty( $message ) )
		echo $message . "\n";
	// In case a plugin uses $error rather than the $wp_errors object
	if ( !empty( $error ) ) {
		$wp_error->add('error', $error);
		unset($error);
	}
	if ( $wp_error->get_error_code() ) {
		$errors = '';
		$messages = '';
		foreach ( $wp_error->get_error_codes() as $code ) {
			$severity = $wp_error->get_error_data( $code );
			foreach ( $wp_error->get_error_messages( $code ) as $error_message ) {
				if ( 'message' == $severity )
					$messages .= '	' . $error_message . "<br />\n";
				else
					$errors .= '	' . $error_message . "<br />\n";
			}
		}
		if ( ! empty( $errors ) ) {
			/**
			 * Filters the error messages displayed above the login form.
			 *
			 * @since 2.1.0
			 *
			 * @param string $errors Login error message.
			 */
			echo '<div id="login_error">' . apply_filters( 'login_errors', $errors ) . "</div>\n";
		}
		if ( ! empty( $messages ) ) {
			/**
			 * Filters instructional messages displayed above the login form.
			 *
			 * @since 2.5.0
			 *
			 * @param string $messages Login messages.
			 */
			echo '<p class="message">' . apply_filters( 'login_messages', $messages ) . "</p>\n";
		}
	}
} // End of logindesigner_login_header()
/**
 * Outputs the footer for the login page.
 *
 * @param string $input_id Which input to auto-focus
 */
function logindesigner_login_footer($input_id = '') {
	global $interim_login;
	// Don't allow interim logins to navigate away from the page.
	if ( ! $interim_login ): ?>
	<p id="backtoblog"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php
		/* translators: %s: site title */
		printf( _x( '&larr; Back to %s', 'site' ), get_bloginfo( 'title', 'display' ) );
	?></a></p>
</div>
	<?php endif; ?>

	</div>



	<?php
	/**
	 * Fires in the login page footer.
	 *
	 * @since 3.1.0
	 */
	do_action( 'login_footer' ); ?>
	<div class="clear"></div>
	<div id="login-designer-background"></div>
	</body>
	</html>
	<?php
}

//
// Main
//
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'login';
$errors = new WP_Error();
if ( isset($_GET['key']) )
	$action = 'resetpass';
// validate action so as to default to the login screen
if ( !in_array( $action, array( 'postpass', 'logout', 'lostpassword', 'retrievepassword', 'resetpass', 'rp', 'register', 'login' ), true ) && false === has_filter( 'login_form_' . $action ) )
	$action = 'login';
nocache_headers();
header('Content-Type: '.get_bloginfo('html_type').'; charset='.get_bloginfo('charset'));
if ( defined( 'RELOCATE' ) && RELOCATE ) { // Move flag is set
	if ( isset( $_SERVER['PATH_INFO'] ) && ($_SERVER['PATH_INFO'] != $_SERVER['PHP_SELF']) )
		$_SERVER['PHP_SELF'] = str_replace( $_SERVER['PATH_INFO'], '', $_SERVER['PHP_SELF'] );
	$url = dirname( set_url_scheme( 'http://' .  $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ) );
	if ( $url != get_option( 'siteurl' ) )
		update_option( 'siteurl', $url );
}
//Set a cookie now to see if they are supported by the browser.
$secure = ( 'https' === parse_url( wp_login_url(), PHP_URL_SCHEME ) );
setcookie( TEST_COOKIE, 'WP Cookie check', 0, COOKIEPATH, COOKIE_DOMAIN, $secure );
if ( SITECOOKIEPATH != COOKIEPATH )
	setcookie( TEST_COOKIE, 'WP Cookie check', 0, SITECOOKIEPATH, COOKIE_DOMAIN, $secure );
$lang            = ! empty( $_GET['wp_lang'] ) ? sanitize_text_field( $_GET['wp_lang'] ) : '';
$switched_locale = switch_to_locale( $lang );
/**
 * Fires when the login form is initialized.
 *
 * @since 3.2.0
 */
do_action( 'login_init' );
/**
 * Fires before a specified login form action.
 *
 * The dynamic portion of the hook name, `$action`, refers to the action
 * that brought the visitor to the login form. Actions include 'postpass',
 * 'logout', 'lostpassword', etc.
 *
 * @since 2.8.0
 */
do_action( "login_form_{$action}" );
$http_post = ('POST' == $_SERVER['REQUEST_METHOD']);
$interim_login = isset($_REQUEST['interim-login']);
/**
 * Filters the separator used between login form navigation links.
 *
 * @since 4.9.0
 *
 * @param string $login_link_separator The separator used between login form navigation links.
 */
$login_link_separator = apply_filters( 'login_link_separator', ' | ' );
switch ($action) {
case 'postpass' :
	if ( ! array_key_exists( 'post_password', $_POST ) ) {
		wp_safe_redirect( wp_get_referer() );
		exit();
	}
	require_once ABSPATH . WPINC . '/class-phpass.php';
	$hasher = new PasswordHash( 8, true );
	/**
	 * Filters the life span of the post password cookie.
	 *
	 * By default, the cookie expires 10 days from creation. To turn this
	 * into a session cookie, return 0.
	 *
	 * @since 3.7.0
	 *
	 * @param int $expires The expiry time, as passed to setcookie().
	 */
	$expire = apply_filters( 'post_password_expires', time() + 10 * DAY_IN_SECONDS );
	$referer = wp_get_referer();
	if ( $referer ) {
		$secure = ( 'https' === parse_url( $referer, PHP_URL_SCHEME ) );
	} else {
		$secure = false;
	}
	setcookie( 'wp-postpass_' . COOKIEHASH, $hasher->HashPassword( wp_unslash( $_POST['post_password'] ) ), $expire, COOKIEPATH, COOKIE_DOMAIN, $secure );
	if ( $switched_locale ) {
	    restore_previous_locale();
	}
	wp_safe_redirect( wp_get_referer() );
	exit();
case 'logout' :
	check_admin_referer('log-out');
	$user = wp_get_current_user();
	wp_logout();
	if ( ! empty( $_REQUEST['redirect_to'] ) ) {
		$redirect_to = $requested_redirect_to = $_REQUEST['redirect_to'];
	} else {
		$redirect_to = 'wp-login.php?loggedout=true';
		$requested_redirect_to = '';
	}
	if ( $switched_locale ) {
	    restore_previous_locale();
	}
	/**
	 * Filters the log out redirect URL.
	 *
	 * @since 4.2.0
	 *
	 * @param string  $redirect_to           The redirect destination URL.
	 * @param string  $requested_redirect_to The requested redirect destination URL passed as a parameter.
	 * @param WP_User $user                  The WP_User object for the user that's logging out.
	 */
	$redirect_to = apply_filters( 'logout_redirect', $redirect_to, $requested_redirect_to, $user );
	wp_safe_redirect( $redirect_to );
	exit();
case 'lostpassword' :
case 'retrievepassword' :
	if ( $http_post ) {
		$errors = retrieve_password();
		if ( !is_wp_error($errors) ) {
			$redirect_to = !empty( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : 'wp-login.php?checkemail=confirm';
			wp_safe_redirect( $redirect_to );
			exit();
		}
	}
	if ( isset( $_GET['error'] ) ) {
		if ( 'invalidkey' == $_GET['error'] ) {
			$errors->add( 'invalidkey', __( 'Your password reset link appears to be invalid. Please request a new link below.' ) );
		} elseif ( 'expiredkey' == $_GET['error'] ) {
			$errors->add( 'expiredkey', __( 'Your password reset link has expired. Please request a new link below.' ) );
		}
	}
	$lostpassword_redirect = ! empty( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : '';
	/**
	 * Filters the URL redirected to after submitting the lostpassword/retrievepassword form.
	 *
	 * @since 3.0.0
	 *
	 * @param string $lostpassword_redirect The redirect destination URL.
	 */
	$redirect_to = apply_filters( 'lostpassword_redirect', $lostpassword_redirect );
	/**
	 * Fires before the lost password form.
	 *
	 * @since 1.5.1
	 */
	do_action( 'lost_password' );
	logindesigner_login_header( __('Lost Password'), '<p class="message">' . __('Please enter your username or email address. You will receive a link to create a new password via email.') . '</p>', $errors);
	$user_login = '';
	if ( isset( $_POST['user_login'] ) && is_string( $_POST['user_login'] ) ) {
		$user_login = wp_unslash( $_POST['user_login'] );
	}
?>

<form name="lostpasswordform" id="lostpasswordform" action="<?php echo esc_url( network_site_url( 'wp-login.php?action=lostpassword', 'login_post' ) ); ?>" method="post">
	<p>
		<label for="user_login" ><?php _e( 'Username or Email Address' ); ?><br />
		<input type="text" name="user_login" id="user_login" class="input" size="20" /></label>
	</p>
	<?php
	/**
	 * Fires inside the lostpassword form tags, before the hidden fields.
	 *
	 * @since 2.1.0
	 */
	do_action( 'lostpassword_form' ); ?>
	<input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>" />
	<p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e('Get New Password'); ?>" /></p>
</form>

<div id="login-designer--below-form">
	<p id="nav">
	<a href="<?php echo esc_url( wp_login_url() ); ?>"><?php _e('Log in') ?></a>
<?php
if ( get_option( 'users_can_register' ) ) :
	$registration_url = sprintf( '<a href="%s">%s</a>', esc_url( wp_registration_url() ), __( 'Register' ) );
	echo esc_html( $login_link_separator );
	/** This filter is documented in wp-includes/general-template.php */
	echo apply_filters( 'register', $registration_url );
endif;
?>
</p>

<?php
logindesigner_login_footer( 'user_login' );
if ( $switched_locale ) {
    restore_previous_locale();
}
break;
case 'resetpass' :
case 'rp' :
	list( $rp_path ) = explode( '?', wp_unslash( $_SERVER['REQUEST_URI'] ) );
	$rp_cookie = 'wp-resetpass-' . COOKIEHASH;
	if ( isset( $_GET['key'] ) ) {
		$value = sprintf( '%s:%s', wp_unslash( $_GET['login'] ), wp_unslash( $_GET['key'] ) );
		setcookie( $rp_cookie, $value, 0, $rp_path, COOKIE_DOMAIN, is_ssl(), true );
		wp_safe_redirect( remove_query_arg( array( 'key', 'login' ) ) );
		exit;
	}
	if ( isset( $_COOKIE[ $rp_cookie ] ) && 0 < strpos( $_COOKIE[ $rp_cookie ], ':' ) ) {
		list( $rp_login, $rp_key ) = explode( ':', wp_unslash( $_COOKIE[ $rp_cookie ] ), 2 );
		$user = check_password_reset_key( $rp_key, $rp_login );
		if ( isset( $_POST['pass1'] ) && ! hash_equals( $rp_key, $_POST['rp_key'] ) ) {
			$user = false;
		}
	} else {
		$user = false;
	}
	if ( ! $user || is_wp_error( $user ) ) {
		setcookie( $rp_cookie, ' ', time() - YEAR_IN_SECONDS, $rp_path, COOKIE_DOMAIN, is_ssl(), true );
		if ( $user && $user->get_error_code() === 'expired_key' )
			wp_redirect( site_url( 'wp-login.php?action=lostpassword&error=expiredkey' ) );
		else
			wp_redirect( site_url( 'wp-login.php?action=lostpassword&error=invalidkey' ) );
		exit;
	}
	$errors = new WP_Error();
	if ( isset($_POST['pass1']) && $_POST['pass1'] != $_POST['pass2'] )
		$errors->add( 'password_reset_mismatch', __( 'The passwords do not match.' ) );
	/**
	 * Fires before the password reset procedure is validated.
	 *
	 * @since 3.5.0
	 *
	 * @param object           $errors WP Error object.
	 * @param WP_User|WP_Error $user   WP_User object if the login and reset key match. WP_Error object otherwise.
	 */
	do_action( 'validate_password_reset', $errors, $user );
	if ( ( ! $errors->get_error_code() ) && isset( $_POST['pass1'] ) && !empty( $_POST['pass1'] ) ) {
		reset_password($user, $_POST['pass1']);
		setcookie( $rp_cookie, ' ', time() - YEAR_IN_SECONDS, $rp_path, COOKIE_DOMAIN, is_ssl(), true );
		logindesigner_login_header( __( 'Password Reset' ), '<p class="message reset-pass">' . __( 'Your password has been reset.' ) . ' <a href="' . esc_url( wp_login_url() ) . '">' . __( 'Log in' ) . '</a></p>' );
		logindesigner_login_footer();
		exit;
	}
	wp_enqueue_script('utils');
	wp_enqueue_script('user-profile');
	logindesigner_login_header(__('Reset Password'), '<p class="message reset-pass">' . __('Enter your new password below.') . '</p>', $errors );
?>
<form name="resetpassform" id="resetpassform" action="<?php echo esc_url( network_site_url( 'wp-login.php?action=resetpass', 'login_post' ) ); ?>" method="post" autocomplete="off">
	<input type="hidden" id="user_login" value="<?php echo esc_attr( $rp_login ); ?>" autocomplete="off" />

	<div class="user-pass1-wrap">
		<p>
			<label for="pass1"><?php _e( 'New password' ) ?></label>
		</p>

		<div class="wp-pwd">
			<div class="password-input-wrapper">
				<input type="password" data-reveal="1" data-pw="<?php echo esc_attr( wp_generate_password( 16 ) ); ?>" name="pass1" id="pass1" class="input password-input" size="24" value="" autocomplete="off" aria-describedby="pass-strength-result" />
				<span class="button button-secondary wp-hide-pw hide-if-no-js">
					<span class="dashicons dashicons-hidden"></span>
				</span>
			</div>
			<div id="pass-strength-result" class="hide-if-no-js" aria-live="polite"><?php _e( 'Strength indicator' ); ?></div>
		</div>
		<div class="pw-weak">
			<label>
				<input type="checkbox" name="pw_weak" class="pw-checkbox" />
				<?php _e( 'Confirm use of weak password' ); ?>
			</label>
		</div>
	</div>

	<p class="user-pass2-wrap">
		<label for="pass2"><?php _e( 'Confirm new password' ) ?></label><br />
		<input type="password" name="pass2" id="pass2" class="input" size="20" value="" autocomplete="off" />
	</p>

	<p class="description indicator-hint"><?php echo wp_get_password_hint(); ?></p>
	<br class="clear" />

	<?php
	/**
	 * Fires following the 'Strength indicator' meter in the user password reset form.
	 *
	 * @since 3.9.0
	 *
	 * @param WP_User $user User object of the user whose password is being reset.
	 */
	do_action( 'resetpass_form', $user );
	?>
	<input type="hidden" name="rp_key" value="<?php echo esc_attr( $rp_key ); ?>" />
	<p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e('Reset Password'); ?>" /></p>
</form>

<div id="login-designer--below-form">
<p id="nav">
<a href="<?php echo esc_url( wp_login_url() ); ?>"><?php _e( 'Log in' ); ?></a>
<?php
if ( get_option( 'users_can_register' ) ) :
	$registration_url = sprintf( '<a href="%s">%s</a>', esc_url( wp_registration_url() ), __( 'Register' ) );
	echo esc_html( $login_link_separator );
	/** This filter is documented in wp-includes/general-template.php */
	echo apply_filters( 'register', $registration_url );
endif;
?>
</p>

<?php
logindesigner_login_footer('user_pass');
if ( $switched_locale ) {
    restore_previous_locale();
}
break;
case 'register' :

	$user_login = '';
	$user_email = '';
	if ( $http_post ) {
		if ( isset( $_POST['user_login'] ) && is_string( $_POST['user_login'] ) ) {
			$user_login = $_POST['user_login'];
		}
		if ( isset( $_POST['user_email'] ) && is_string( $_POST['user_email'] ) ) {
			$user_email = wp_unslash( $_POST['user_email'] );
		}
		$errors = register_new_user($user_login, $user_email);
		if ( !is_wp_error($errors) ) {
			$redirect_to = !empty( $_POST['redirect_to'] ) ? $_POST['redirect_to'] : 'wp-login.php?checkemail=registered';
			wp_safe_redirect( $redirect_to );
			exit();
		}
	}
	$registration_redirect = ! empty( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : '';
	/**
	 * Filters the registration redirect URL.
	 *
	 * @since 3.0.0
	 *
	 * @param string $registration_redirect The redirect destination URL.
	 */
	$redirect_to = apply_filters( 'registration_redirect', $registration_redirect );
	logindesigner_login_header(__('Registration Form'), '<p class="message register">' . __('Register For This Site') . '</p>', $errors);
?>
<form name="registerform" id="registerform" action="<?php echo esc_url( site_url( 'wp-login.php?action=register', 'login_post' ) ); ?>" method="post" novalidate="novalidate">
	<p>
		<label for="user_login"><?php _e('Username') ?><br />
		<input type="text" name="user_login" id="user_login" class="input" value="<?php echo esc_attr(wp_unslash($user_login)); ?>" size="20" /></label>
	</p>
	<p>
		<label for="user_email"><?php _e('Email') ?><br />
		<input type="email" name="user_email" id="user_email" class="input" value="<?php echo esc_attr( wp_unslash( $user_email ) ); ?>" size="25" /></label>
	</p>
	<?php
	/**
	 * Fires following the 'Email' field in the user registration form.
	 *
	 * @since 2.1.0
	 */
	do_action( 'register_form' );
	?>
	<p id="reg_passmail"><?php _e( 'Registration confirmation will be emailed to you.' ); ?></p>
	<br class="clear" />
	<input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>" />
	<p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e('Register'); ?>" /></p>
</form>
<div id="login-designer--below-form">
<p id="nav">
<a href="<?php echo esc_url( wp_login_url() ); ?>"><?php _e( 'Log in' ); ?></a>
<?php echo esc_html( $login_link_separator ); ?>
<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?' ); ?></a>
</p>

<?php
logindesigner_login_footer('user_login');
if ( $switched_locale ) {
    restore_previous_locale();
}
break;
case 'login' :
default:

	// $customize_login = isset( $_REQUEST['customize-login'] );
	// if ( $customize_login )
	// 	wp_enqueue_script( 'customize-base' );

	/**
	 * Filters the login page errors.
	 *
	 * @since 3.6.0
	 *
	 * @param object $errors      WP Error object.
	 * @param string $redirect_to Redirect destination URL.
	 */
	logindesigner_login_header( __( 'Log In' ), '', $errors);

	$rememberme = ! empty( $_POST['rememberme'] );
?>

<form name="loginform" id="loginform" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post">
	<p>
		<label id="login-designer--username-label" for="user_login"><span><?php _e( 'Username or Email Address' ); ?></span><br />
		<div id="login-designer--username">
			<input type="text" name="log" id="user_login" class="input" value="email@address.com" size="20" /></label>
		</div>
	</p>
	<p>

		<label id="login-designer--password-label" for="user_pass"><span><?php _e( 'Password' ); ?></span><br />
			<div id="login-designer--password">
		<input type="password" name="pwd" id="user_pass" class="input" value="password" size="20" /></label>
	</div>
	</p>
	<?php
	/**
	 * Fires following the 'Password' field in the login form.
	 *
	 * @since 2.1.0
	 */
	do_action( 'login_form' );
	?>
	<p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php esc_html_e( 'Remember Me' ); ?></label></p>
	<p class="submit">
		<span id="login-designer--button">
			<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e('Log In'); ?>" />
		</span>
	</p>
</form>

<?php if ( ! $interim_login ) { ?>
<div id="login-designer--below-form" data-hint="Click on the elements below the form to modify each one." data-hintPosition="middle-right" data-position="bottom-right-aligned">
<p id="nav">
<?php if ( ! isset( $_GET['checkemail'] ) || ! in_array( $_GET['checkemail'], array( 'confirm', 'newpass' ) ) ) :
	if ( get_option( 'users_can_register' ) ) :
		$registration_url = sprintf( '<a href="%s">%s</a>', esc_url( wp_registration_url() ), __( 'Register' ) );
		/** This filter is documented in wp-includes/general-template.php */
		echo apply_filters( 'register', $registration_url );
		echo esc_html( $login_link_separator );
	endif;
	?>
	<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?' ); ?></a>
<?php endif; ?>
</p>
<?php } ?>


<?php
logindesigner_login_footer();
if ( $switched_locale ) {
    restore_previous_locale();
}
break;
}

wp_footer();
