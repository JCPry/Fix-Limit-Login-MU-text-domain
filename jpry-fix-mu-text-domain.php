<?php
/**
 * Plugin Name: Fix MU Text Domain
 * Plugin URI: https://github.com/JCPry/Fix-Limit-Login-MU-text-domain
 * Description: When the "Limit Login Attempts" plugin is placed in the /wp-content/mu-plugins folder instead of the normal /wp-content/plugins folder, the text domain (for translation) is broken. This plugin fixes the text domain issue.
 * Version: 1.0
 * Author: Jeremy Pry <jeremy@wpengine.com>
 * Author URI: http://jeremypry.com
 * License GPL3
 */

add_filter( 'load_textdomain_mofile', 'jpry_fix_mu_text_domain', 10, 2 );
/**
 * This filters the default location of the .mo file for the Limit Login Attempts plugin on WP Engine
 * 
 * @author Jeremy Pry <jeremy@wpengine.com>
 * @param string $mofile The current location of the .mo file
 * @param string $domain The plugin domain, used in determine whether or not to actually filter the results
 * @return string New location of <var>$mofile</var>
 */
function jpry_fix_mu_text_domain( $mofile, $domain ) {
    // Only filter for limit-login-attempts
    if ( $domain == 'limit-login-attempts' ) {
        $locale = apply_filters( 'plugin_locale', get_locale(), $domain );
        $mofile = WPMU_PLUGIN_DIR . "/$domain/$domain-$locale.mo";
    }
    return $mofile;
}
