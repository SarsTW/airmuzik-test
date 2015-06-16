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

		parent::elementSetup();
		$this->setBrowserUrl($this->websiteUrl);
	}


/* ##to do right comment to check status code
	public function testTrackProfile() {

		$this->url($this->websiteUrl);

		parent::menu('HomepageArrow');
		parent::wait(1);
		parent::menu('HomepagePlayList');
		parent::wait(1);


		$window = $this->windowHandles();
		$this->windows[0]['id'] = $window[0];
		$this->windows[1]['id'] = $window[1];
		$this->windows[1]['target'] = 'information';

		$this->currentWindow = $this->windows[1]['id'];


		#switch to festival page
		$this->window($this->currentWindow);
		parent::wait(1);

		#go to a track profile
		parent::menu('GotoPlayListTrackProfile');
		parent::wait(1);
		$record_url = $this->url();

		#click 'like' and check if it goes to member login
		parent::trackProfile('like');
		$this->assertEquals($this->loginUrl, $this->url(), "url error! not member login page");

		#go to last page
		$this->url($record_url);

		#click 'add' and check if it goes to member login
		parent::trackProfile('add');
		$this->assertEquals($this->loginUrl, $this->url(), "url error! not member login page");
		$this->url($record_url);

		#click 'share' and take a screenshot
		parent::trackProfile('share');
		parent::screenshot( __DIR__.'/report/'.'trackProfile_share_click'.'-'.time(). '.png');
		
		#click 'play' and change the target to 'player'
		parent::trackProfile('play');

		$window = $this->windowHandles();
		$this->windows[2]['id'] = $window[2];
		$this->windows[2]['target'] = 'player';

		$this->currentWindow = $this->windows[2]['id'];
		$this->window($this->currentWindow);

		$this->assertNotEquals($record_url, $this->url(), "url error! not player page!");

	}
*/
/*	
	public function testSearch() {
		
		$this->url($this->websiteUrl);

		parent::menu('HomepageArrow');

		$window = $this->windowHandles();
		parent::search('mozart');

		$this->windows[1]['id'] = $window[0];

		parent::wait(1);
		$record_url = $this->url();

		#click 'add' in search result list
		parent::searchOperation('add');
		$this->assertEquals($this->url(), $this->loginUrl, "add url error");
		$this->url($record_url);

		#click 'composer' in search result list
		$keyword = parent::searchOperation('composer');
		$this->assertEquals($this->searchUrl.$keyword, urldecode($this->url()), "composer url error");
		$this->url($record_url);

		#click 'airtist' in search result list
		$keyword = parent::searchOperation('artist');
		$this->assertEquals($this->searchUrl.$keyword, urldecode($this->url()), "artist url error");
		$this->url($record_url);

		#click 'share' and take a screenshot in search result list
		parent::searchOperation('share');
		parent::screenshot( __DIR__.'/report/'.'search_share_click'.'-'.time(). '.png');

		#click 'track' in search result list
		$keyword = parent::searchOperation('track');
		$this->assertEquals(strpos($this->url(), $keyword), 0, "track url error!");
		$this->url($record_url);

		#click 'play' in search result list
		parent::searchOperation('play');

		$window = $this->windowHandles();
		$this->windows[2]['id'] = $window[1];
		$this->windows[2]['target'] = 'player';

		$this->currentWindow = $this->windows[2]['id'];
		$this->window($this->currentWindow);

		$this->assertNotEquals($record_url, $this->url(), "url error! not player page!");
	}
*/
/*
	public function testPlayer() {

		$this->url($this->websiteUrl);
		parent::menu('HomepageArrow');
		sleep(3);
		parent::search('mozart');
		parent::wait(1);

		$record_url = $this->url();
	}
*/

	
/*
	public function testOtherMember() {
		
		$this->url($this->websiteUrl);

		parent::menu('HomepageArrow');
		parent::search('mozart');
		parent::wait(1);

		#click 'track' and go to track profile
		$keyword = parent::searchOperation('track');
		$this->assertEquals(strpos($this->url(), $keyword), 0, "track url error!");

		parent::trackProfile('member');
		$this->assertEquals(strpos($this->url(), $this->memberUrl), 0, "member url error!");

		$listNum = parent::countMemberTrackList();
		$trackNum = parent::selectMemberTrackList($listNum, 1);
		
		#click 'share' and take a screenshot
		parent::memberTracksOperation('share');
		
		#click ''
		sleep(10);
	}
*/
}

?>