<?php
use PHPImageWorkshop\ImageWorkshop;
require_once('PHPImageWorkshop/ImageWorkshop.php');

class generateImage {
	
	protected static $instance;

	private $recipient;
	private $message;

	public function __construct(){
		// TODO
	}

	public static function getInstance(){
		if(!self::$instance)
			self::$instance = new self();
		return self::$instance;
	}

	public function setDetails($to, $msg){
		$this->recipient = $to;
		$this->message = $msg;
	}

	private function parseMessage($msg){
		$lineLength = 30;
		$currPos = 0;
		$lines = array(1 => '');
		$currLine = 1;
		$message = explode(' ', $msg);
		
		foreach($message as $word){
			if(strlen($word) > $lineLength){
				$timesToSplit = floor(strlen($word) / $lineLength);
				$strings = array();
				for($i=0; $i<$timesToSplit; $i++){
					$line = str_split($word, $lineLength-3);
					$lines[$currLine] = $line[0] . '-';
					$currPos = strlen($lines[$currLine]);
					$currLine += 1;
					$word = $line[1];
				}
			}

			if($currPos < ($lineLength - strlen($word))){
				$lines[$currLine] .= (($currPos == 0) ? '' : ' ') . $word;
				$currPos += (strlen($word) + 1);
			} else {
				$currPos = -1;
				$currLine += 1;
				$lines[$currLine] = $word;
				$currPos += (strlen($word) + 1);
			}
		}

		return implode("\n", $lines);
	}

	public function paintImage(){
		// Image Settings
		$width = 700;
		$height = 700;
		$bgColor = 'FFC4C6';
		$fontDirectory = 'assets/fonts/';
		// Border Settings
		$border = 9;
		$borderColor = 'FFFFFF';
		// Recipient Settings
		$toColor = 'f51e6b';
		$toFontSize = 25;
		$toGreeting = 'Dear';
		// Sender Settings
		$fromColor = 'f51e6b';
		$fromFontSize = 16;
		$fromMessage = 'an Admirer';
		// Message Settings
		$message = $this->parseMessage($this->message);
		$msgColor = 'FFFFFF';
		$msgFontSize = 26;
		
		// Initialise Layers
		$bgLayer = ImageWorkshop::initVirginLayer($width, $height, $bgColor);
		// Footer
		$footerLayer = ImageWorkshop::initVirginLayer($bgLayer->getWidth(), $bgLayer->getHeight());
		$footerBird = ImageWorkshop::initFromPath('assets/img/shareable/footer-bird.png');
		$footerFrom = ImageWorkshop::initTextLayer(strtoupper($fromMessage), $fontDirectory.'Proxima_Nova/PROXIMANOVA-SEMIBOLD.OTF', $fromFontSize, $fromColor, 0);
		// Border
		$borderLayer = ImageWorkshop::initVirginLayer($bgLayer->getWidth(), $bgLayer->getHeight());
		$hBorder = ImageWorkshop::initVirginLayer($width, $border, $borderColor);
		$vBorder = ImageWorkshop::initVirginLayer($border, $height, $borderColor);
		// Recipient
		$toLayer = ImageWorkshop::initVirginLayer($bgLayer->getWidth(), $bgLayer->getHeight());
		$toText = ImageWorkshop::initTextLayer(strtoupper($toGreeting. ' ' . $this->recipient), $fontDirectory.'Proxima_Nova/PROXIMANOVA-REGULAR.OTF', $toFontSize, $toColor, 0, $borderColor);
		$toBackground = ImageWorkshop::initVirginlayer($toText->getWidth() + ($toFontSize*2), $toFontSize*2, $borderColor);
		$toLeftBorder = ImageWorkshop::initFromPath('assets/img/shareable/to-bookend-left.png');
		$toRightBorder = ImageWorkshop::initFromPath('assets/img/shareable/to-bookend-right.png');
		// Message
		$msgLayer = ImageWorkshop::initVirginLayer($bgLayer->getWidth(), $bgLayer->getHeight());
		$msgText = ImageWorkshop::initTextLayer(strtoupper($message), $fontDirectory.'Proxima_Nova/PROXIMANOVA-SEMIBOLD.OTF', $msgFontSize, $msgColor, 0);

		// Add Layers
		// Recipient
		$toLayer->addLayer(1, $toBackground, 0, 100 - ($toFontSize/2), 'MT');
		$toLayer->addLayer(2, $toText, 0, 100, 'MT');
		$toLayer->addLayer(3, $toLeftBorder, 0 - (($toBackground->getWidth()/2) + ($toLeftBorder->getWidth()/2)), 100 - ($toFontSize/2), 'MT');
		$toLayer->addLayer(3, $toRightBorder, 0 - 1 + (($toBackground->getWidth()/2) + ($toLeftBorder->getWidth()/2)), 100 - ($toFontSize/2), 'MT');
		// Add Message
		$msgLayer->addLayer(1, $msgText, 0, -50 + ($msgText->getHeight() / (substr_count($message, "\n") + 1)), 'MM');
		// Add Borders
		$borderLayer->addLayer(1, $hBorder, 0, 0);
		$borderLayer->addLayer(1, $hBorder, 0, 0, 'LB');
		$borderLayer->addLayer(1, $vBorder, 0, 0);
		$borderLayer->addLayer(1, $vBorder, 0, 0, 'RT');
		// Add Footer
		$footerLayer->addLayer(1, $footerBird, 0, 0, 'MB');
		$footerLayer->addLayer(1, $footerFrom, $fromFontSize*5.5, $fromFontSize*5, 'RM');
		
		// Create Image
		$bgLayer->addLayer(1, $footerLayer);
		$bgLayer->addLayer(2, $toLayer);
		$bgLayer->addLayer(2, $msgLayer);
		$bgLayer->addLayer(3, $borderLayer);

		// Resize
		$bgLayer->resizeInPixel(440, null, true);

		return $bgLayer->getResult('FFFFFF');
	}

	public function saveImage($image, $token){
		$filename = md5(uniqid($token, true));
		$filetype = 'png';
		$createFolders = false;
		$backgroundColor = null;
		$imageQuality = 95;

		try {
			$image->save($dir, $filename.'.'.$filetype, $createFolders, $backgroundColor, $imageQuality);
		} catch(Exception $e){
			return $e;
		}

		return array('filename' => $filename, 'filetype' => $filetype);
	}

}