<?php

require_once('./airmuzikcomponent.php');

class AirMuzikRWDTest extends AirMuzikComponent {

	protected $websiteUrl = 'http://dev.airmuzik.com:5636/tw';
	protected $searchUrl = 'http://dev.airmuzik.com:5636/tw/search/';
	protected $loginUrl = 'http://dev.airmuzik.com:5636/tw/member/login';
	protected $memberUrl = 'http://dev.airmuzik.com:5636/tw/member';


	protected $windows = array(
		array(
			'id' => '',
			'target' => ''
		),
		array(
			'id' => '',
			'target' => 'information'
		),
		array(
			'id' => '',
			'target' => 'player'
		),
	);

	protected $currentWindow;
##default setting of browser

	public static $browsers = array(

        array(
            'browserName' => 'chrome',
            'host' => 'localhost',
            'port' => 4444,
        ),
        
    );

##member account

	public static $member1 = array('account' => '', 'password' => '');

	public static $member2 = array('account' => 'gosick@test.com', 'password' => 'gosick');


	protected function setUp() {

		parent::elementSetup();
		$this->setBrowserUrl($this->websiteUrl);
	}

	public function testabc(){
		
	}
/*
	public function testMemberRegisterRWD() {

		$this->url($this->websiteUrl);
        
        $window = $this->currentWindow();
        $window->size(array('width' => 430, 'height' => 530));

        parent::menu('HomepageArrow');

		parent::menu('Register');
		sleep(2);
		$account = parent::memberAccountGenerate();
		self::$member1['account'] = $account;
		$password = parent::memberPasswordGenerate();
		self::$member1['password'] = $password;

		parent::register(self::$member1['account'], self::$member1['password']);
		
	}

	public function testMemberTrackListRWD() {

		$this->url($this->websiteUrl);
        
        $window = $this->currentWindow();
        $window->size(array('width' => 430, 'height' => 530));

        parent::menu('HomepageArrow');

		parent::menu('Login');
		sleep(2);
		parent::login(self::$member1['account'], self::$member1['password']);
		sleep(2);

		parent::memberPlaylist();

		sleep(5);
	}

*/

}
?>