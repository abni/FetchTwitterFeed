## Simple PHP class for fetching tweets

## Installation
Create a `config.ini` file and fill out API key and other authentication fields (checkout config.example.ini for an example).
Run `composer update` to download the one dependency, TwitterAPIExchange.

## Use
Create an instance of the class:
    `$FetchTwitterFeeds = new TwitterWidget();`

Call the method createTimeline:
    `$FetchTwitterFeeds->createTimeline('username', int limit);`.

The method takes two parametars, username (string) and limit (int).