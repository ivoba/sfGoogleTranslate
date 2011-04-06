<?php

/*
 * This plugin requires the sfWebBrowser plugin.
 */

class sfGoogleTranslate {

    protected $result = false;
    
    private $lang_from,
    $lang_to,
    $browser,
    $options;
    
    private static $validOptions = array('callback',
                                       'context',
                                       'format',
                                       'key',
                                       'userip');
    
    private static $uri = 'https://ajax.googleapis.com/ajax/services/language/';

    function __construct($lang_from='de', $lang_to='en', $options = array()) {
        $this->lang_from = $lang_from;
        $this->lang_to = $lang_to;
        $this->browser = new sfWebBrowser();
        $this->browser->setUserAgent(isset($options['userAgent']) ? $options['userAgent'] : 'sfGoogleTranslate/0.01');
        $this->options = $options;
    }

    public function translate($phrase,$options = array()) {
        $uri = self::$uri.'translate?v=1.0&q=' . urlencode($phrase) . '&langpair=' . $this->lang_from . '%7C' . $this->lang_to;
        $uri .= $this->addOptions($options);
        if ($this->browser->get($uri)->responseIsError()) {
            $error = 'The given URL (%s) returns an error (%s: %s)';
            $error = sprintf($error, $uri, $this->browser->getResponseCode(), $this->browser->getResponseMessage());
            throw new Exception($error);
        }
        $feedString = $this->browser->getResponseText();

        $this->result = json_decode($feedString);
        if ($this->result->responseStatus == '200') {
            $translated = $this->result->responseData->translatedText;
            return $translated;
        } 
    }
    
    public function getRawResult(){
        return $this->result;
    }

    public function detect($phrase,$options = array()) {
        $uri = self::$uri.'detect?v=1.0&q=' . urlencode($phrase);
        $uri .= $this->addOptions($options);
        if ($this->browser->get($uri)->responseIsError()) {
            $error = 'The given URL (%s) returns an error (%s: %s)';
            $error = sprintf($error, $uri, $this->browser->getResponseCode(), $this->browser->getResponseMessage());
            throw new Exception($error);
        }
        $feedString = $this->browser->getResponseText();

        $this->result = json_decode($feedString);
        if ($this->result->responseStatus == '200') {
            $language = $this->result->responseData->language;
            return $language;
        } 
        return false;
    }
    
    private function addOptions($options) {
       $opt_str = '';
       if(!empty($options)){
            foreach ($options as $key => $value) {
                if(isset (self::$validOptions[$key])){
                    $opt_str .= '&'.$key.'='.$value;
                }
                else{
                    //TODO log?
                }
            }
        }
        return $opt_str;
    }
}