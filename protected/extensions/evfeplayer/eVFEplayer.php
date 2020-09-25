
<?php
/**
 * eVFEplayer
 * ==========
 *
 * Multibrowser support video player based on Video For Everybody.
 * @link http://camendesign.com/code/video_for_everybody
 *
 * You have to put in BASEURLPATH all video files in the following formats:
 *      mov
 *      swf
 *      mp4
 *      jpg (as video poster image)
 *
 * All files must to have the same name (FILENAME), differ only in their extension
 *
 * Usage:
 *
     <?php $this->widget('ext.eVFEplayer.eVFEplayer', array(
        'filename'=>'FILENAME_WITHOUT_EXTENSION',
        'altmsg'=>'...some text...',
        'baseurl'=>'URL',
        'autoplay'=>true_or_false,
        'controls'=>true_or_false,
        'width'=>INTEGER,
        'height'=>INTEGRE,
    ));?>
 *
 *
 * The rendered code will be something like:
 *
 *<video width="480" height="356" poster="images/VIDEOFILENAME.png" autoplay>
        <!-- MP4 must be first for iPad! -->
        <source src="BASEURL/VIDEOFILENAME.mov"/><!-- Safari / iOS video    -->

        <!-- fallback to Flash: -->
        <object width="480" height="356" type="application/x-shockwave-flash" data="BASEURL/VIDEOFILENAME.swf">
                <!-- Firefox uses the `data` attribute above, IE/Safari uses the param below -->
                <param name="movie" value="BASEURL/VIDEOFILENAME.swf" />
                <param name="flashvars" value="play=true&autoplay=true&file=BASEURL/VIDEOFILENAME.mp4" />
                <param name="play" value="true">
                <param name="autoplay" value="true">
                <!-- fallback image. note the title field below, put the title of the video there -->
                <img src="BASEURL/VIDEOFILENAME.png" alt="ALT MESSAGE"
                     title="ALT MESSAGE" />
        </object>

        <source src="BASEURL/VIDEOFILENAME.webm" type="video/webm" /><!-- Chrome10+, Ffx4+, Opera10.6+ -->
        <source src="BASEURL/VIDEOFILENAME.ogv" type="video/ogg" /><!-- Firefox3.6+ / Opera 10.5+ -->
</video>
 *
 *
 * To encode video for needed formats use ffmpeg, for example:
 *
    ffmpeg -y -i FILENAME.mov -ss 00:00:10.00 -vcodec mjpeg -vframes 1 -f image2 -s 640x360 FILENAME.jpg
    ffmpeg -y -i FILENAME.mov -s 640x360 -sameq -ar 44100 -ab 192 FILENAME.swf
    ffmpeg -y -i FILENAME.mov -acodec libvorbis -ac 2 -ab 96k -ar 44100 -b 345k -s 640x360 FILENAME.ogv
    ffmpeg -y -i FILENAME.mov -acodec libvorbis -ac 2 -ab 96k -ar 44100 -b 345k -s 640x360 FILENAME.webm
    ffmpeg -y -i FILENAME.mov -acodec libfaac -ab 96k -vcodec libx264 -vpre slower -vpre main -level 21 -refs 2 -b 345k -bt 345k -threads 0 -s 640x360 FILENAME.mp4
 *
 * This base code was generated with the [gii-extension-generator](http://www.yiiframework.com/extension/gii-extension-generator/)
 *
 * @version 0.1
 * @author ytannus@gmail.com
 */
class eVFEplayer extends CWidget
{

    /** video filename without extension
     * @var string
     * @since 0.1
     */
    public $filename;

    /** Alternative message when is not possible play the video
     *
     * @var string
     * @since 0.1
     */
    public $altmsg="No video playback capabilities";

    /** Base URL path where video files are located
     *
     * @var string
     * @since 0.1
     */
    public $baseurl;

    /** Autoplay video on render
     *
     * @var boolean
     * @since 0.1
     */
    public $autoplay=true;

    /** Display player controls
     *
     * @var boolean
     * @since 0.1
     */
    public $controls=true;


    /** Display player controls
     *
     * @var boolean
     * @since 0.1
     */
    public $preload=true;

    /** Video width
     *
     * @var integer
     * @since 0.1
     */
    public $width=640;

    /** Video height
     *
     * @var integer
     * @since 0.1
     */
    public $height=360;


    /** The js scripts to register.
     * @var array
     * @since 0.1
     */
    private $js = array(
        'evfeplayer.js',
    );
    /** The css scripts to register.
     * @var array
     * @since 0.1
     */
    private $css = array(
        'evfeplayer.css',
    );

    /** The asset folder after published
     * @var string
     * @since 0.1
     */
    private $assets;

    private function publishAssets()
    {
        $assets = dirname(__FILE__).DIRECTORY_SEPARATOR."assets".DIRECTORY_SEPARATOR;
        $this->assets = Yii::app()->getAssetManager()->publish($assets);
    }

    private function registerScripts()
    {
        $cs = Yii::app()->clientScript;

        foreach($this->js as $file)
        {
            $cs->registerScriptFile($this->assets."/".$file, CClientScript::POS_END);
        }
        foreach($this->css as $file)
        {
            $cs->registerCssFile($this->assets."/".$file);
        }
    }

    public function init()
    {
        $this->publishAssets();
        $this->registerScripts();
    }
    public function run()
    {
        //Get file
        //Check file codification, based on exists files extensions
        //create html output
        //render html
        echo $this->genHTMLcode();
    }

    /**
     *  Generates html code that will be rendered in the view
     *  Only generate html segments if encoded video files
     * are found in baseurl (included image poster file)
     *
     * @return string HTML Code
     */
    private function genHTMLcode()
    {

        $autoplay = ($this->autoplay)?'autoplay':'';
        $controls = ($this->controls)?'controls':'';
        $preload = ($this->preload)?'preload':'';

        //poster="'.$this->baseurl.'/'.$this->filename.'.jpg"
        $html = '<video class="video" width="'.$this->width.'" height="'.$this->height.'"     '.$autoplay.' '.$controls.' '.$preload.'>';
        $html.= '<source src="'.$this->baseurl.$this->filename.'.mp4" type="video/mp4"/>';
        $html.= '<object width="'.$this->width.'" height="'.$this->height.'" type="application/x-shockwave-flash" data="'.$this->baseurl.$this->filename.'.swf">';
        $html.= '  <param name="movie" value="'.$this->baseurl.$this->filename.'.swf" />';
        $html.= '  <param name="flashvars" value="play='.$this->autoplay.'&autoplay='.$this->autoplay.'&file='.$this->baseurl.$this->filename.'.mp4" />';
        $html.= '  <param name="play" value="'.$this->autoplay.'">';
        $html.= '  <param name="autoplay" value="'.$this->autoplay.'">';
        $html.= '  <param name="LOOP" value="false">';
        $html.= '<img src="'.$this->baseurl.$this->filename.'.jpg" alt="'.$this->altmsg.'" title="'.$this->altmsg.'" />';
        $html.= '</object>';
        $html.= '<source src="'.$this->baseurl.$this->filename.'.webm" type="video/webm" />';
        $html.= '<source src="'.$this->baseurl.$this->filename.'.ogv" type="video/ogg" />';
        $html.= '</video>';

        return $html;
    }


}
