<?php

require_once('./airmuzikcomponent.php');

class AirMuzikMemberTest extends AirMuzikComponent {

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
/*
	public function testCommentTrack() {

		$this->url($this->websiteUrl);

		parent::menu('HomepageArrow');

		parent::menu('Login');
		sleep(2);
		parent::login(self::$member1['account'], self::$member1['password']);
		sleep(2);
		$window = $this->windowHandles();
		parent::search('mozart');

		$this->window[1]['id'] = $window[0];

		parent::wait(1);
		$keyword = parent::searchOperation('track');
		
		parent::trackProfile('comment');
		
	}
*/
/*
	public function testTrackProfile() {

		$this->url($this->websiteUrl);

		parent::menu('HomepageArrow');

		parent::menu('Login');
		sleep(2);
		parent::login(self::$member1['account'], self::$member1['password']);
		sleep(2);
		$window = $this->windowHandles();

		parent::search('mozart');

		parent::wait(2);
		$keyword = parent::searchOperation('track');

	//	$this->byCssSelector('div.menu > div.control > a.playlist-like.js-playlist-like')->click();
		
	//	$like = $this->byCssSelector('div.menu > div.control > a.playlist-like.js-playlist-like > span:nth-child(2)')->text();

	//	$this->byCssSelector('div.menu > div.control > a.playlist-like.js-playlist-like.playlist-like-active')->click();
		
		//$unlike = $this->byCssSelector('div.menu > div.control > a.playlist-like.js-playlist-like > span:nth-child(2)')->text();		

		//echo $like."\n".$unlike;
		//parent::trackProfile('like');
	}
*/

	public function testMemberTrackList() {

		$this->url($this->websiteUrl);

		parent::menu('HomepageArrow');

		parent::menu('Login');
		sleep(2);
		parent::login(self::$member1['account'], self::$member1['password']);
		sleep(2);

		parent::memberPlaylist();

		$window = $this->windowHandles();

		$this->windows[1]['id'] = $window[1];

		$this->currentWindow = $this->windows[1]['id'];
		$this->window($this->currentWindow);

		$a = $this->CountTrackList();
		$this->createa();
		$this->byCssSelector('div.viewport > ul > li:nth-child(2)')->click();
		$b = $this->CountTrackList();
		$c = $a + 1;
		$this->assertEquals($b, $c, "list not increase");
		
//		$this->MemberTrackListSelect(10);
//		parent::memberTracksOperation()
		sleep(20);
	}


	public function MemberTrackListOperation($option, $index) {

		switch ($option) {
			case 'a':
				# code...
				break;
			
			default:
				# code...
				break;
		}
	}

	public function CountTrackList() {

		$num = count($this->elements($this->using('css selector')->value('div.viewport > ul > li')));
		if($num >= 4) {
			return $num - 1;
		}
		else
			return $num;
	}
	public function MemberTrackListSelect($index) {

		$num = $this->CountTrackList();
		$this->assertTrue($num >= $index, "index error, can not find the list");

		$this->byCssSelector('div.viewport > ul > li:nth-child('.$index.')')->click();
	}

	public function createa() {

		$this->byCssSelector('a.button.button-primary.js-playlist-create')->click();
		$this->byName('name')->value('mynewlist');
		$this->byCssSelector('button.button.button-primary.button-submit')->click();
	}
	//select list

	//new list

	//list operation , playall, share, more(delete list, edit list)

	//track table, play, add to list, delete, track, artist, share

	public function table() {


	}
}

?>