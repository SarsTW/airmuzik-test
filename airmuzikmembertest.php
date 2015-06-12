<?php

require_once('./airmuzikcomponent.php');

class AirMuzikTest extends AirMuzikComponent {

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

	public static $member1 = array('account' => 'f56112000@gmail.com', 'password' => 'ss07290420');

	public static $member2 = array('account' => 'gosick@test.com', 'password' => 'gosick');


	protected function setUp() {

		$this->setBrowserUrl($this->websiteUrl);
	}


 ##test
/*
	public function testCommentTrack() {

		$this->url($this->websiteUrl);

		parent::menu('HomepageArrow');

		$window = $this->windowHandles();
		parent::search('mozart');

		$this->window[1]['id'] = $window[0];

		parent::wait(1);
		$keyword = parent::searchOperation('track');
		
		$this->byCssSelector('form.track-comment-form > a')->click();
		parent::login(self::$member1['account'], self::$member1['password']);

		parent::trackProfile('comment');
		
		sleep(10);
		#
	}
*/

}

?>