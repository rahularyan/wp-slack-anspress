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
function pio_ap_processed_new_question ( $events ) {
    $events['action_on_new_post'] = array(
        'action'      => 'transition_post_status',
        'description' => __( 'When a question is published', 'slack' ),
        'message'     => function( $new_status, $old_status, $post ) {
            $pio_ap_notified_post_types = apply_filters( 'pio_ap_slack_event_transition_post_status', array(
                'question'
            ) );

            if ( ! in_array( $post->post_type, $pio_ap_notified_post_types ) ) {
                return false;
            }

            if ( 'publish' !== $old_status && 'publish' === $new_status ) {
                return apply_filters( 'pio_ap_pending_review_message',
                sprintf(
                __( 'New question published: *<%1$s|%2$s>* by *%3$s*', 'slack'),
                get_permalink( $post->ID ),
                get_the_title( $post->ID ),
                get_the_author_meta( 'display_name', $post->post_author )
                )
            );
        }
    }
);
return $events;
}
add_filter( 'slack_get_events', 'pio_ap_processed_new_question' );


?>
