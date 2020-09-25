<?php
class MultilevelVerticalMenu extends CWidget {
/**
 * The transition effect. To choose between 1,2,3,4 and 5.
 * @var integer
 */
  public $transition;
  
/**
 * The menu items' data
 * @var array
 */
  private $_menu;

  /**
   * The html output of the widget
   * @var String
   */
  private $_html;
  /**
   * The assets url
   * @var String
   */
  private $_baseUrl;


  /**
   * Gets the html output of the widget
   * @return String
   */
  public function getHtml() {
    return $this->_html;
  }

  /**
   * Sets the menu data
   * @param array $menu
   *
   */
  public function setMenu($menu) {
    if(is_array($menu)) {
      $this->_menu = $menu;
    } else {
      throw new CException('Menu must be an array');
    }
  }

  /**
   * Execute the widget
   */
  public function run() {
    if(!isset ($this->_menu) || $this->_menu == array()) {
      throw new CException('Menu is not set or it\'s empty');
    }
    $this->registerClientScripts();
    $this->createMarkup();
  }

  /**
   * Registers the clientside widget files (css & js)
   */
  public function registerClientScripts() {
  	$resources = dirname(__FILE__).DIRECTORY_SEPARATOR.'resources';
    $this->_baseUrl = Yii::app()->assetManager->publish($resources);
    Yii::app()->clientScript->registerScriptFile($this->_baseUrl.'/jquery.dlmenu.js', CClientScript::POS_END);
	Yii::app()->clientScript->registerScriptFile($this->_baseUrl.'/modernizr.custom.js', CClientScript::POS_HEAD);
	Yii::app()->clientScript->registerScript('menuscript', '
    $(\'#dl-menu\').dlmenu({
        animationClasses : { classin : \'dl-animate-in-' . $this->transition . '\', classout : \'dl-animate-out-' . $this->transition . '\' }
    });	');
    Yii::app()->clientScript->registerCssFile($this->_baseUrl.'/component.css');
  }

  /**
   * Creates the html markup needed by the widget
   */
  public function createMarkUp() {
  	$this->_html = '<div class="dl-container"><div id="dl-menu" class="dl-menuwrapper">';
    $this->_html .= '<ul class="dl-menu">';
    $this->_createMenu($this->_menu);
    $this->_html .= '</ul>';
	$this->_html .= '</div></div>';

    echo $this->_html;
  }

  /**
   * Creates the menu unordered list
   * @param array $menu : The menu array
   * @param if we're on a sub menu or not $rec
   */
  private function _createMenu($menu,$sub = false) {
    if(is_array($menu)) {
      foreach ($menu as $data) {
        isset($data['disabled']) ? $disabled = true : $disabled = false;
        isset($data['url']['params']) ? $params = $data['url']['params'] : $params = array();
        isset($data['url']['htmlOptions']) ? $htmlOptions = $data['url']['htmlOptions'] : $htmlOptions = array();
        isset($data['label']) ? $label = $data['label'] : $label = '';
        if($this->_isMenuItem($data)) {
          $url = $this->_createUrl($data);
          if (!$this->hasChild($data)) {		
            $this->_html .= "<li>";
            $this->_html .= CHtml::link($label, $url, $htmlOptions);
            $this->_html .= "</li>\n";
          } else {
            $this->_html .= "<li>";
            $this->_html .= CHtml::link($label, $url, $htmlOptions);
            $this->_html .= "<ul class=\"dl-submenu\">\n";
            $this->_html .= $this->_createMenu($data,true);
            $this->_html .= "</ul>\n";
          }
        }
      }
    }
  }

  /**
   * Checks if there's a menu item to display
   * $data must be an array with a label key
   * and if the key visible is set it must be true
   * @param array $data
   * @return true if there's a menu item
   */
  private function _isMenuItem($data) {
    isset($data['label']) ? $label = $data['label'] : $label = '';
    if(is_array($data) && $label && (!isset($data['visible']) || $data['visible']))
    {
      return true;
    }
	
    return false;
  }

  /**
   * Create the url link
   * @param array $data
   */
  private function _createUrl($data) {
    isset($data['url']['route']) ? $route = $data['url']['route'] : $route = '';
    isset($data['disabled']) ? $disabled = $data['disabled'] : $disabled = '' ;
    isset($data['url']['params']) ? $params = $data['url']['params'] : $params = array();
    isset($data['url']['link']) ? $link = $data['url']['link'] : $link = '';
    if(($route!= '' || $data['url'] != array()) && !$disabled) {
      if($route) {
        $url = Yii::app()->getUrlManager()->createUrl($route,$params);
      } else {
        $url = $link;
      }
    } else {
      $url='';
    }

    return $url;
  }

  /**
   * Checks if this menu array has a submenu
   * @param array $arr
   * @return true if there's a submenu
   */
  private function hasChild($arr) {
    if(!is_array($arr)) {
      return false;
    }
    foreach ($arr as $title=>$value) {
      if(!$title == 'url') {
        if(is_array($value)) {
          return true;
        }
      }
    }
    return false;
  }

  private function set($param){
    isset($param) ? $param = $param : $param = '';
  }
}
?>
