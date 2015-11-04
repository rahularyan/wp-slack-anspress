<?php
/**
* Plugin Name: WP Slack Anspress
* Plugin URI: https://github.com/bmackinney/wp-slack-anspress
* Description: This plugin integrates Anspress notifications to Slack.
* Version: 0.1.0
* Author: Rachel Whitton
* Author URI: https://github.com/rachelwhitton
* License: GPL v4 or later
* Requires at least: 3.6
* Tested up to: 3.8
*
* This program is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation; either version 2 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*/
/**
* Adds new event to notify Slack upon user registration
*
* @param  array $events
* @return array
*
* @filter slack_get_events
*/
function wp_slack_anspress_user_reg( $events ) {
    $events['user_register'] = array(
        // WP core hook for user registrations. user_register is located in /wp-includes/user.php within the function wp_insert_user()
        'action' => 'user_register',

        // Description within the integration setting.
        'description' => __( 'When a user registers', 'slack' ),

        // Message delivered in Slack channel.
        'message' => function( $user_id ) {
            sprintf(__('[%s] just created a Questions profile. :boom:', 'slack' ), $user_email);
            }
return $events;
}
add_filter( 'slack_get_events', 'wp_slack_anspress_user_reg' );
?>
