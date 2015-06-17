<?php

require_once('./airmuzikcomponent.php');

class AirMuzikTest extends AirMuzikComponent {

	protected $websiteUrl = 'http://dev.airmuzik.com:5636/tw';
	protected $searchUrl = 'http://dev.airmuzik.com:5636/tw/search/';
	protected $loginUrl = 'http://dev.airmuzik.com:5636/tw/member/login';
	protected $memberUrl = 'http://dev.airmuzik.com:5636/tw/member';
	protected $width = 430;
	protected $height = 530;

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

	public static $member2 = array('account' => '', 'password' => '');


	protected function setUp() {

		parent::elementSetup();
		$this->setHostAndPortByUser();
		$this->setBrowserUrl($this->websiteUrl);
	}

	public function setHostAndPortByUser() {

                global $argv, $argc;

                $count = 0;
                foreach ($argv as $value) {
                        $count += 1;
                        if(strcmp($value, "--host_ip_user") === 0){
                                $this->setHost($argv[$count]);
                        }
                        if(strcmp($value, "--host_port_user") === 0){
                                $this->setPort((int)$argv[$count]);
                        }
                }
    }


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


	public function testPlayer() {

		$this->url($this->websiteUrl);
		parent::menu('HomepageArrow');
		sleep(3);
		parent::menu('HomepagePlayList');
		parent::wait(1);

		$window = $this->windowHandles();
		$this->windows[0]['id'] = $window[0];
		$this->windows[1]['id'] = $window[1];

		$this->currentWindow = $this->windows[1]['id'];

		#switch to festival page
		$this->window($this->currentWindow);
		parent::wait(1);

		#go for playing
		parent::menu('GoforPlaying');

		$window = $this->windowHandles();
		$this->windows[2]['id'] = $window[2];
		$this->currentWindow = $this->windows[2]['id'];

		#switch to player window
		$this->window($this->currentWindow);
		$record_url = $this->url();
		sleep(2);

		#click 'add' and check if it goes to member login
		parent::player('add');
		$this->assertEquals($this->loginUrl, $this->url(), "url error! not member login page");
		sleep(2);

		#go to last page
		$this->url($record_url);

		#click 'composer'
		$keyword = parent::player('composer');
		$this->currentWindow = $this->windows[1]['id'];
		$this->window($this->currentWindow);

		$this->assertEquals($this->searchUrl.$keyword, urldecode($this->url()), "composer url error");

		$this->currentWindow = $this->windows[2]['id'];
		$this->window($this->currentWindow);

		#click 'track'
		$keyword = parent::player('track');
		$this->assertEquals(strpos($this->url(), $keyword), 0, "track url error!");

		$this->url($record_url);
		
		#click 'artist'
		$keyword = parent::player('artist');
		$this->currentWindow = $this->windows[1]['id'];
		$this->window($this->currentWindow);

		$this->assertEquals($this->searchUrl.$keyword, urldecode($this->url()), "artist url error");

		$this->currentWindow = $this->windows[2]['id'];
		$this->window($this->currentWindow);

		#click 'play'
		parent::player('play');
		sleep(3);

		#click 'like'
		parent::player('like');
		$this->assertEquals($this->loginUrl, $this->url(), "url error! not member login page");

		$this->url($record_url);

		#click 'comment'
		$keyword = parent::player('comment');
		$this->currentWindow = $this->windows[1]['id'];
		$this->window($this->currentWindow);
		$this->assertEquals(strpos($this->url(), $keyword), 0, "track url error!");
		
		#click 'share'
		$this->currentWindow = $this->windows[2]['id'];
		$this->window($this->currentWindow);
		parent::player('share');
		parent::screenshot( __DIR__.'/report/'.'player_share_click'.'-'.time(). '.png');
	}


	public function testMemberRegisterRWD() {

		$this->url($this->websiteUrl);
        
        $window = $this->currentWindow();
        $window->size(array('width' => $this->width, 'height' => $this->height));

        parent::menu('HomepageArrow');

		parent::menu('Register');
		sleep(2);
		$account = parent::memberAccountGenerate();
		self::$member1['account'] = $account;
		$password = parent::memberPasswordGenerate();
		self::$member1['password'] = $password;

		parent::register(self::$member1['account'], self::$member1['password']);
		
	}


	public function testMemberPlayerRWD() {

		$this->url($this->websiteUrl);

		$window = $this->currentWindow();
		$window->size(array('width' => $this->width, 'height' => $this->height));

		parent::menu('HomepageArrow');

		parent::menu('Login');
		sleep(2);
		parent::login('gosick@test.com','gosick');
		//parent::login(self::$member1['account'], self::$member1['password']);
		sleep(2);

		parent::menu('HomepagePlayList');
		sleep(3);

		$window = $this->windowHandles();
		$this->windows[0]['id'] = $window[0];
		$this->windows[1]['id'] = $window[1];

		$this->currentWindow = $this->windows[1]['id'];

		#switch to festival page
		$this->window($this->currentWindow);
		parent::wait(1);

		#go for playing
		parent::menu('GoforPlaying');

		$window = $this->windowHandles();
		$this->windows[2]['id'] = $window[2];
		$this->currentWindow = $this->windows[2]['id'];

		#switch to player window
		$this->window($this->currentWindow);
		$record_url = $this->url();
		sleep(2);

		#click 'track'
		$keyword = parent::playerRWD('track');
		$this->window($this->windows[1]['id']);
		$this->assertEquals(strpos($this->url(), $keyword), 0, "track url error!");
		
		$this->window($this->window[2]['id']));

		$this->url($record_url);

		#click 'play'
		parent::playerRWD('play');
		sleep(4);
	}


	public function testMemberTrackListRWD() {

		$this->url($this->websiteUrl);
        
        $window = $this->currentWindow();
        $window->size(array('width' => $this->width, 'height' => $this->height));

        parent::menu('HomepageArrow');

		parent::menu('Login');
		sleep(2);
		parent::login('gosick@test.com', 'gosick');
		sleep(2);

		parent::memberPlaylist();

		sleep(5);
	}



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
		
	}

}

?>