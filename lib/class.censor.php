<?php
class censor {
	private $replace;
	private $badwords;

	public function __construct(){
		$this->replace = 'kitten';
	}

	public function setReplace($replace){
		$this->replace = $replace;
	}

	private function convertLeet($string){
		$leet = array();
		$leet['a']= '(a|a\.|a\-|4|@|Á|á|À|Â|à|Â|â|Ä|ä|Ã|ã|Å|å|α|Δ|Λ|λ)';
		$leet['b']= '(b|b\.|b\-|8|\|3|ß|Β|β)';
		$leet['c']= '(c|c\.|c\-|Ç|ç|¢|€|<|\(|{|©)';
		$leet['d']= '(d|d\.|d\-|&part;|\|\)|Þ|þ|Ð|ð)';
		$leet['e']= '(e|e\.|e\-|3|€|È|è|É|é|Ê|ê|∑)';
		$leet['f']= '(f|f\.|f\-|ƒ)';
		$leet['g']= '(g|g\.|g\-|6|9)';
		$leet['h']= '(h|h\.|h\-|Η)';
		$leet['i']= '(i|i\.|i\-|!|\||\]\[|]|1|∫|Ì|Í|Î|Ï|ì|í|î|ï)';
		$leet['j']= '(j|j\.|j\-)';
		$leet['k']= '(k|k\.|k\-|Κ|κ)';
		$leet['l']= '(l|1\.|l\-|!|\||\]\[|]|£|∫|Ì|Í|Î|Ï)';
		$leet['m']= '(m|m\.|m\-)';
		$leet['n']= '(n|n\.|n\-|η|Ν|Π)';
		$leet['o']= '(o|o\.|o\-|0|Ο|ο|Φ|¤|°|ø)';
		$leet['p']= '(p|p\.|p\-|ρ|Ρ|¶|þ)';
		$leet['q']= '(q|q\.|q\-)';
		$leet['r']= '(r|r\.|r\-|®)';
		$leet['s']= '(s|s\.|s\-|5|\$|§)';
		$leet['t']= '(t|t\.|t\-|Τ|τ)';
		$leet['u']= '(u|u\.|u\-|υ|µ)';
		$leet['v']= '(v|v\.|v\-|υ|ν)';
		$leet['w']= '(w|w\.|w\-|ω|ψ|Ψ)';
		$leet['x']= '(x|x\.|x\-|Χ|χ)';
		$leet['y']= '(y|y\.|y\-|¥|γ|ÿ|ý|Ÿ|Ý)';
		$leet['z']= '(z|z\.|z\-|Ζ)';

		$words = explode(' ', $string);
		for($i = 0; $i < count($words); $i++){
			if(strlen($words[$i]) > 1)
				$words[$i] = preg_replace(array_values($leet), array_keys($leet), $words[$i]);
		}
		
		return implode(' ', $words);
	}

	private function badWords(){
		return array(
			'analplug',
			'analsex',
			'arse',
			'assassin',
			'ass',
			'balls',
			'bastard',
			'bitch',
			'bimbo',
			'bloody',
			'bloodyhell',
			'blowjob',
			'bollocks',
			'boner',
			'boobies',
			'boobs',
			'boob',
			'bugger',
			'bukkake',
			'bullshit',
			'chink',
			'clit',
			'clitoris',
			'cocksucker',
			'cock',
			'condom',
			'coon',
			'crap',
			'cumshot',
			'cum',
			'cunt',
			'damm',
			'dammit',
			'damn',
			'dickhead',
			'dick',
			'dildo',
			'doggystyle',
			'dyke',
			'f0ck',
			'faggot',
			'fags',
			'fag',
			'fanny',
			'fck',
			'fcker',
			'fckr',
			'fcku',
			'fcuk',
			'fucking',
			'fucker',
			'fuckface',
			'fuckr',
			'fuck',
			'fuk',
			'fuct',
			'genital',
			'genitalia',
			'genitals',
			'glory hole',
			'gloryhole',
			'gobshite',
			'godammet',
			'godammit',
			'goddammet',
			'goddammit',
			'goddamn',
			'gypo',
			'handjob',
			'hitler',
			'homo',
			'hooker',
			'hore',
			'horny',
			'jesussucks',
			'jizzum',
			'jizz',
			'kaffir',
			'kill',
			'killer',
			'killin',
			'killing',
			'lesbo',
			'masturbate',
			'milf',
			'molest',
			'moron',
			'motherfuck',
			'mthrfckr',
			'murder',
			'murderer',
			'nazi',
			'negro',
			'nigga',
			'niggah',
			'nonce',
			'paedo',
			'paedophile',
			'paki',
			'pecker',
			'pedo',
			'pedofile',
			'pedophile',
			'phuk',
			'pig',
			'pimp',
			'poof',
			'porn',
			'prick',
			'pron',
			'prostitute',
			'raped',
			'rapes',
			'rapist',
			'schlong',
			'screw',
			'scrotum',
			'shag',
			'shemale',
			'shite',
			'shiz',
			'slag',
			'spastic',
			'spaz',
			'sperm',
			'spunk',
			'stripper',
			'tart',
			'terrorist',
			'tits',
			'tittyfuck',
			'tosser',
			'turd',
			'vaginal',
			'vibrator',
			'wanker',
			'weed',
			'wetback',
			'whor',
			'whore',
			'wog',
			'wtf',
			'xxx'
		);
	}

	private function replaceWords($string){
		return str_ireplace($this->badWords(), 'kitten', $string);
	}

	public function censor($string){
		$string = $this->convertLeet($string);
		$string = $this->replaceWords($string);
		return $string;
	}
}