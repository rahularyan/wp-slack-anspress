# WP Slack Anspress

Integrate Anspress events for sending notifications to Slack.

**Contributors:** [rachelwhitton](https://github.com/rachelwhitton), [bmackinney](https://github.com/bmackinney)
    **Tags:** [slack](http://wordpress.org/plugins/tags/slack), [api](http://wordpress.org/plugins/tags/api), [chat](http://wordpress.org/plugins/tags/chat), [notification](http://wordpress.org/plugins/tags/notification), [anspress](https://wordpress.org/plugins/tags/anspress)
**Requires at least:** 3.6
**Tested up to:** 3.8.1
**Stable tag:** trunk (master)
**License:** [GPLv2 or later](http://www.gnu.org/licenses/gpl-2.0.html)

## Description

This plugin is an extension to the [Slack plugin](http://wordpress.org/plugins/slack) and provides Anspress integration via the following events:

- When there is a new comment on Questions/Answers
- When a Question/Answer type post is flagged by a user
- When a user deletes their account
- When a user registers


Events are available on the **Slack Integration** page within the **Events to Notify** section.

**Development of this plugin is done on [GitHub](https://github.com/bmackinney/wp-slack-anspress). Pull requests are always welcome**.

## Installation

1. Install and activate [Anspress](https://wordpress.org/plugins/anspress-question-answer/) and [Slack](http://wordpress.org/plugins/slack) plugins.
1. Install [**WP Slack Anspress**](https://github.com/bmackinney/wp-slack-anspress/archive/master.zip) by uploading the zip file to your site's `wp-content/plugins/` directory, then activate.
1. You will see new events on the **Slack Integration** page within the **Events to Notify** section.

## Screenshots

### Slack Integration: Events to Notify

![New events on integration page](assets/events.png)

### Slack Channel Notification: Triggered Event

![Slack channel notification of Anspress event](assets/slack.png)

## Changelog

### 0.1.0
Initial release
