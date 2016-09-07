<?php

class Slack
{
    private $ci;
    //Endpoint for Slack Webhook
    public $endpoint = 'https://hooks.slack.com/services/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';
    //Default icon
    public $icon = ':ghost:';
    //Default username
    public $username = 'ci-slack-bot';
    //Default channel to post to
    public $channel = 'general';
    //Output => Return from Slack. Outputs in array.
    public $output;

    //Error, is set to true if error occurs.
    public $error = false;

    //Errors that this class will use.
    private $_errors = array(
      'EMPTY_MESSAGE'     => 'Message can not be empty.',
      'CHANNEL_UNDEFINED' => 'At least one channel must be specified'
    );

    /**
     * We will check if a config item for this library exists.
     * If it does, we will overwrite our defaults in this class.
     * If you don't have a config file, no worries, it will ignore
     * that and just load the defaults that are already pre-defined
     * here.
     **/
    public function __construct() {
        $slack_config = require APP_PATH. 'config/slack.php';

        if ($slack_config) {
            if ($slack_config['endpoint']) {
                $this->endpoint = $slack_config['endpoint'];
            }

            if ($slack_config['username']) {
                $this->username = $slack_config['username'];
            }

            if ($slack_config['icon']) {
                $this->icon = $slack_config['icon'];
            }

            if ($slack_config['channel']) {
                $this->channel = $slack_config['channel'];
            }
        }
    }

    /**
     * ######################################################
     * Method: Send
     * @param string $message
     * @desc This method takes the data you have defined
     *       and sends it to your slack webhook.
     * ######################################################
     **/
    public function send($message) {

        if (!is_null($message) || !empty($message)) {

            /**
             * If channel is an array, it means we are sending to multiple
             * channels. In this case, we need to run a foreach loop.
             ***/
            if (is_array($this->channel) && count($this->channel) >= 1) {

                foreach ($this->channel as $key => $c) {
                    $data = 'payload=' . json_encode(
                        array(
                            "channel"       =>  "#{$c}",
                            "username"      =>  $this->username,
                            "text"          =>  $message,
                            "icon_emoji"    =>  $this->icon
                        )
                    );

                    $output = $this->_communicate($data);
                    $this->output[] = $output;
                }

                return true;

            /**
             * If channel is not an array, but is also not empty, this means
             * we are sending to only one channel.
             **/
            } elseif (!is_array($this->channel) && !empty($this->channel)) {

                $data = 'payload=' . json_encode(
                    array(
                        "channel"       =>  "#" . $this->channel,
                        "username"      =>  $this->username,
                        "text"          =>  $message,
                        "icon_emoji"    =>  $this->icon
                    )
                );

                $output = $this->_communicate($data);
                $this->output[] = $output;

                return true;
            } else {
                $this->error = $this->_errors['CHANNEL_UNDEFINED'];

                return false;
            }
        } else {
            $this->error = $this->_errors['EMPTY_MESSAGE'];

            return false;
        }
    }

    /**
     * ######################################################
     * Method: Communicate
     * @param array $data
     * @desc This is the background worker, and communicates
     *       with Slack via CURL.
     * ######################################################
     **/
    private function _communicate($data) {

        //Initialize CURL, setup, and send data.
        $ch = curl_init($this->endpoint);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $result = curl_exec($ch);
        // $err = curl_error($ch);
        curl_close($ch);
        //Return response from Slack.
        return $result;
    }
}