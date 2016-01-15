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

	public function setDetails($to, $msg = null){
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
		$fromMessage = 'your secret crush';
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

		return $bgLayer;
	}

	public function paintFarewell(){
		// Image Settings;
		$width = 702;
		$height = 703;
		$fontDirectory = 'assets/fonts/';

		$borderColor = 'FFFFFF';
		$nameColor = '874789';
		$nameFontSize = 25;

		// Layers
		$bgLayer = ImageWorkshop::initFromPath('assets/img/shareable/thanks_blank.jpg');
		$nameLayer = ImageWorkshop::initVirginLayer($bgLayer->getWidth(), $bgLayer->getHeight());
		$nameText = ImageWorkshop::initTextLayer(strtoupper($this->recipient), $fontDirectory.'Proxima_Nova/PROXIMANOVA-SEMIBOLD.OTF', $nameFontSize, $nameColor, 0);
		$nameBackground = ImageWorkshop::initVirginlayer($nameText->getWidth() + ($nameFontSize*2), $nameFontSize*1.85, $borderColor);
		$nameLeftBorder = ImageWorkshop::initFromPath('assets/img/shareable/leftFlag.png');
		$nameRightBorder = ImageWorkshop::initFromPath('assets/img/shareable/rightFlag.png');

		$shadowLayer = ImageWorkshop::initVirginLayer($nameBackground->getWidth() + ($nameLeftBorder->getWidth()), $nameBackground->getHeight(), 'DAD9D9');
	
		// Add Layers
		$nameLayer->addLayer(1, $shadowLayer, 0, 4, 'MM');
		$nameLayer->addLayer(2, $nameBackground, 0, 0, 'MM');
		$nameLayer->addLayer(3, $nameText, 0, 0, 'MM');
		$nameLayer->addLayer(4, $nameLeftBorder, 0 - (($nameBackground->getWidth()/2) + ($nameLeftBorder->getWidth()/2) - 1), 0 - 1 + ($nameLeftBorder->getHeight()/4), 'MM');
		$nameLayer->addLayer(4, $nameRightBorder, 0 - 1 + (($nameBackground->getWidth()/2) + ($nameLeftBorder->getWidth()/2)), 0 - 1 + ($nameLeftBorder->getHeight()/4), 'MM');
		
		$max_length = 8;
		$name_letter_count = strlen($this->recipient);
		$oversize = $name_letter_count - $max_length;
		if($oversize > 0) $resize = 150 - ($oversize * 8);
		else $resize = 150;
		$nameLayer->resizeByNarrowSideInPercent($resize, true);

		$bgLayer->addLayer(1, $nameLayer, 0, 35, 'MM');

		// Resize
		$bgLayer->resizeInPixel(440, null, true);

		return $bgLayer;
	}

	public function saveImage($image, $dir, $token){
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