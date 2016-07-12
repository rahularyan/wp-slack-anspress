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

/**
 * Post a message to Slack from WordPress
 *
 * @param string $message the message to be sent to Slack
 * @param string $channel the #channel to send the message to (or @user for a DM)
 * @param string $username the username for this bot eg : WordPress bot
 * @param string $icon_emoji the icon emoji name for this bot eg :monkey:
 *
 * @link slack incoming webhook docs https://api.slack.com/incoming-webhooks
 * @example ar_post_to_slack('message','#channel','bot-name',':monkey:');
 */
function anspress_post_to_slack($message, $channel = '#general', $username = '@anspress', $icon_emoji = ':rocket:') {

	// Slack webhook endpoint from Slack settings
	$slack_endpoint = 'https://hooks.slack.com/services/'; // <!--- REPLACE THIS

	// Prepare the data / payload to be posted to Slack
	$data = array(
		'payload'   => json_encode( array(
			'channel'       => $channel,
			'text'          => $message['event'],
			'username'	=> $username,
			'icon_emoji'    => $icon_emoji,

		    'attachments' => [
		        array(
		            'title' => $message['title'],
		            // "pretext"=> $message['pre'],
		            'text' => $message['desc'],
		        ),
		    ],

		    )
		),
	);
	// Post our data via the slack webhook endpoint using wp_remote_post
	$posting_to_slack = wp_remote_post( $slack_endpoint, array(
		'method' => 'POST',
		'timeout' => 30,
		'redirection' => 5,
		'httpversion' => '1.0',
		'blocking' => true,
		'headers' => array(),
		'body' => $data,
		'cookies' => array(),
		)
	);
}

function pio_ap_processed_new_question ( $post_id ) {
	$question = get_post( $post_id );
	$message = array(
		'event' => 'New question posted',
		'title' => $question->post_title,
		'desc' => wp_trim_words( sanitize_text_field( $question->post_content ), 40 ),
	);
	anspress_post_to_slack( $message );
}
add_action( 'ap_processed_new_question', 'pio_ap_processed_new_question' );



?>
