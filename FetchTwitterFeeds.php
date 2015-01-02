<?php

class FetchTwitterFeeds {
    public function twitter_timeline( $username, $limit, $oauth_access_token, $oauth_access_token_secret, $consumer_key, $consumer_secret ) {
        require_once 'vendor/j7mbo/twitter-api-php/TwitterAPIExchange.php';

        $settings = array(
            'oauth_access_token'        => $oauth_access_token,
            'oauth_access_token_secret' => $oauth_access_token_secret,
            'consumer_key'              => $consumer_key,
            'consumer_secret'           => $consumer_secret
        );

        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?screen_name=' . $username . '&count=' . $limit;
        $request_method = 'GET';

        $twitter_instance = new TwitterAPIExchange( $settings );

        $timeline = $twitter_instance
            ->setGetfield( $getfield )
            ->buildOauth( $url, $request_method )
            ->performRequest();

        return $timeline;
    }

    public function createTimeline ($username, $limit) {
        $dir = __DIR__ . '/config.ini';
        $config = parse_ini_file($dir);

        if (!$username) {
            $username = 'anders_bergmann';
        }

        if (!$limit) {
            $limit = 25;
        }

        $username                    = $username;
        $limit                       = $limit;
        $oauth_access_token          = $config['oauth_access_token'];
        $oauth_access_token_secret   = $config['oauth_access_token_secret'];
        $consumer_key                = $config['consumer_key'];
        $consumer_secret             = $config['consumer_secret'];

        $timeline = $this->twitter_timeline( $username, $limit, $oauth_access_token, $oauth_access_token_secret, $consumer_key, $consumer_secret );

        if ( $timeline ) {
            echo $timeline;
        } else {
            echo 'Error with loading in tweets.';
        }
    }
}

$FetchTwitterFeeds = new FetchTwitterFeeds();
$FetchTwitterFeeds->createTimeline('anders_bergmann', 10);

?>