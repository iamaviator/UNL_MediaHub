<?php
class UNL_MediaHub_BaseController
{
    public $options = array();
    
    /**
     * Get a cacheable version of the media player (we need to inject the controller options for this)
     *
     * @param $media
     * @return UNL_MediaHub_MediaPlayer
     */
    public function getMediaPlayer($media)
    {
        return new UNL_MediaHub_MediaPlayer($media, $this->options);
    }

    public static function addNotice(UNL_MediaHub_Notice $notice)
    {
        if (!isset($_SESSION['notices'])) {
            $_SESSION['notices'] = array();
        }

        $_SESSION['notices'][] = $notice;
    }
}