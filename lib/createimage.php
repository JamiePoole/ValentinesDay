<?php
use PHPImageWorkshop\ImageWorkshop;

class createImage {

	protected static $instance;

	public $bgSet;

	private $background;
	private $recipient;
	private $message;

	private $backgroundPath;

	public function __construct(){
		$bgSet = array();
		$this->backgroundPath = dirname(__FILE__) . '/images/backgrounds/';
		$this->getBackgrounds();
	}

	public static function getInstance(){
		if(!self::$instance)
			self::$instance = new self();
		return self::$instance;
	}

	public function set($background, $recipient, $message){
		$this->background = $background;
		$this->recipient = $recipient;
		$this->message = $message;
	}

	public function getBackgrounds(){
		$bgSet = array();
		foreach(glob($this->backgroundPath.'*') as $bgPath){
			$bgName = substr($bgPath, strpos($bgPath, $this->backgroundPath) + strlen($this->backgroundPath));
			$bgName = substr($bgName, 0, strrpos($bgName, '.'));
			$bgName = str_replace(array('_', '-', '.'), ' ', $bgName);
			$bgSet['name'] = $bgName;
			$bgSet['path'] = $bgPath;
			$this->bgSet[] = $bgSet;
		}
	}

	public function countBackgrounds(){
		return count($this->bgSet);
	}

	public function makeImage(){
		$bg = $this->background;
		$to = $this->recipient;
		$msg = $this->message;
		$msg = wordwrap($msg, 30, "\n", true);

		$i = 0;

		$font_path = dirname(__FILE__) . '/images/fonts/';
		$to_color = '000000';
		$to_font = 'justanotherhand-regular.ttf';
		$to_size = 32;
		$to_rotate = 92;
		$msg_color = 'ff3949';
		$msg_font = 'justanotherhand-regular.ttf';
		$msg_size = 32;
		$msg_rotate = 1;
		$line_height = 40;

		$image = ImageWorkshop::initFromPath($this->bgSet[$bg]['path']);
		$lines_group = ImageWorkshop::initVirginLayer(300, 420);
		
		$to_layer = ImageWorkshop::initTextLayer($to, $font_path . $to_font, $to_size, $to_color, $to_rotate);
		$image->addLayer(2, $to_layer, 60, 5, 'LM');

		$line_layer = ImageWorkshop::initTextLayer($msg, $font_path . $msg_font, $msg_size, $msg_color, 0);
		$lines_group->addLayer(1, $line_layer, 0, 0, 'MM');
	
		// foreach($lines as $line){
		// 	$line_layer[$i] = ImageWorkshop::initTextLayer($line, $font_path . $msg_font, $msg_size, $msg_color, 0);
		// 	$posy = ($line_height*$i)-($line_height*(count($lines)/2))+$line_height/2;
		// 	$lines_group->addLayer(1, $line_layer[$i], 0, $posy, 'MM');
		// 	$i++; 
		// }

		$lines_group->rotate($msg_rotate);
		$image->addLayer(3, $lines_group, 25, 15, 'RB');

		return $image;
	}

}