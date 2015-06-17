<?php

class AirMuzikComponent extends PHPUnit_Extensions_Selenium2TestCase {

	protected $trackAmountFlag;
	protected $checklogin;

	public function elementSetup() {
		$this->trackAmountFlag = "true";
		$this->checklogin = "false";
	}

	public function wait($second) {

		$this->timeouts()->implicitWait($second * 1000);
	}

	public function menu($option) {

		switch ($option) {

			case 'Homepage':

				$this->byCssSelector('a.logo')->click();
				break;

			case 'HomepageArrow':

				$this->byCssSelector('a.listen.js-header-banner-scroll')->click();
				break;

			case 'HomepagePlayList':
				//festival list
				$this->byCssSelector('li.scenario-list.scenario-list-wide.scenario-list-situation > ul > li:nth-child(1) > a')->click();
				break;

			case 'BusinessPlayList':
				//relax list
				$this->byCssSelector('li.scenario-list.scenario-list-feature > ul > li:nth-child(1) > a')->click();
			case 'GoforPlaying':

				$this->homepagePlayList($option);
				break;

			case 'GotoPlayListTrackProfile':

				$this->homepagePlayList($option);
				break;

			case 'Login':

				sleep(1);
				$this->byCssSelector('a.login')->click();
				break;

			case 'Register':

				sleep(1);
				$this->byCssSelector('a.login')->click();
				$this->byCssSelector('div.center > a:nth-child(3)')->click();
				break;

			case 'Logout':

				$this->logout();
			
			default:
				break;
		}
	}

	public function homepagePlayList($option) {

		if($option == 'GoforPlaying') {

			$this->byCssSelector('a.play.button-primary')->click();
		}
		else if($option == 'GotoPlayListTrackProfile') {

			$this->byCssSelector('div.playlist > ul > li:nth-child(1) > a')->click();
		}
	}

	public function trackProfile($option) {
		$text = 'test comment 3';
		$select = 2;
		switch ($option) {

			case 'play':

				$this->byCssSelector('div.menu > div > a:nth-child(1)')->click();
				break;
			
			case 'like':

				$this->byCssSelector('div.menu > div.control > a.playlist-like')->click();
				break;

			case 'add':

				$this->byCssSelector('div.menu > div > a:nth-child(3)')->click();
				break;

			case 'share':

				$this->byCssSelector('div.menu > div > div > a')->click();
				break;

			case 'member':

				$this->byCssSelector('div.viewport > ul > li:nth-child('.$select.') > a')->click();
				break;
			/*
			case 'comment':

				$this->assertEquals('true', $this->checklogin, "member does not login, can't post a comment");
				$this->commentPost($text);
				break;
			*/
			default:
				break;
		}
		
	}

	public function searchOperation($option) {//temporary use track2

		$keyword = '';
		switch ($option) {

			case 'play':

				$this->byCssSelector('div.playlist-table > div:nth-child(1) > div:nth-child(2) > div:nth-child(2) > div:nth-child(1) > a:nth-child(1)')->click();
				break;

			case 'add':

				$this->byCssSelector('div.playlist-table > div:nth-child(1) > div:nth-child(2) > div:nth-child(2) > div:nth-child(1) > a:nth-child(2)')->click();
				break;

			case 'composer':

				$keyword = $this->byCssSelector('div.playlist-table > div:nth-child(1) > div:nth-child(2) > div:nth-child(2) > div:nth-child(2) > a')->attribute('title');
				$this->byCssSelector('div.playlist-table > div:nth-child(1) > div:nth-child(2) > div:nth-child(2) > div:nth-child(2) > a')->click();
				break;

			case 'track':

				$keyword = $this->byCssSelector('div.playlist-table > div:nth-child(1) > div:nth-child(2) > div:nth-child(2) > div:nth-child(3) > a')->attribute('href');
				$this->byCssSelector('div.playlist-table > div:nth-child(1) > div:nth-child(2) > div:nth-child(2) > div:nth-child(3) > a')->click();
				break;

			case 'artist':

				$keyword = $this->byCssSelector('div.playlist-table > div:nth-child(1) > div:nth-child(2) > div:nth-child(2) > div:nth-child(4) > a')->attribute('title');
				$this->byCssSelector('div.playlist-table > div:nth-child(1) > div:nth-child(2) > div:nth-child(2) > div:nth-child(4) > a')->click();
				break;

			case 'share':

				$this->byCssSelector('div.playlist-table > div:nth-child(1) > div:nth-child(2) > div:nth-child(2) > div:nth-child(6) > div > a')->click();
				break;

			default:
				break;
		}

		return $keyword;
	}

	public function memberPlayListOperation($option) {

		#need to check if the list null
		#need to check if the list has no tracks
		#need to check member login
		switch ($option) {

			case 'playall':
				
				break;
			
			case 'sharelist':

				break;

			case 'edit':

				break;

			case 'deletelist':

				break;

			case 'deletesong':

				break;

			case 'play':

				break;

			case 'add':

				break;

			case 'composer':

				break;

			case 'track':

				break;

			case 'artist':

				break;

			case 'share':

				break;
			default:
				break;
		}
	}
/*
	public function commentPost($text) {
		
		$this->byCssSelector('textarea.input')->value($text);
		$this->byCssSelector('div.clearfix > button')->click();
	}
*/

	public function player($option) {//test track 2

		$keyword = '';
		switch ($option) {

			case 'play':
				
				$this->byCssSelector('div.tbody > div:nth-child(2) > div:nth-child(1) > a:nth-child(1)')->click();
				break;

			case 'add':
			
				$this->byCssSelector('div.tbody > div:nth-child(2) > div:nth-child(1) > a:nth-child(2)')->click();
				break;

			case 'composer':

				$keyword = $this->byCssSelector('div.tbody > div:nth-child(2) > div:nth-child(2) > a')->attribute('title');
				$this->byCssSelector('div.tbody > div:nth-child(2) > div:nth-child(2) > a')->click();
				break;

			case 'track':

				$keyword = $this->byCssSelector('div.tbody > div:nth-child(2) > div:nth-child(3) > a')->attribute('href');
				$this->byCssSelector('div.tbody > div:nth-child(2) > div:nth-child(3) > a')->click();
				break;

			case 'artist':

				$keyword = $this->byCssSelector('div.tbody > div:nth-child(2) > div:nth-child(4) > a:nth-child(1)')->attribute('title');
				$this->byCssSelector('div.tbody > div:nth-child(2) > div:nth-child(4) > a:nth-child(1)')->click();
				break;

			case 'share':

				$this->moveto($this->byCssSelector('div.tbody > div:nth-child(2) > div:nth-child(6) > div'));
				$this->byCssSelector('div.tbody > div:nth-child(2) > div:nth-child(6) > div > a:nth-child(1)')->click();
				break;

			case 'like':

				$this->byCssSelector('div.tbody > div:nth-child(2) > div:nth-child(7) > a:nth-child(1)')->click();
				break;

			case 'comment':

				$keyword = $this->byCssSelector('div.tbody > div:nth-child(2) > div:nth-child(7) > a:nth-child(2)')->attribute('href');
				$this->byCssSelector('div.tbody > div:nth-child(2) > div:nth-child(7) > a:nth-child(2)')->click();
				break;

			default:
				break;
		}

		return $keyword;
		
	}

	public function playerRWD($option) {

		$keyword = '';
		switch ($option) {

			case 'play':

				$this->byCssSelector('div.tbody > div:nth-child(2) > div:nth-child(1) > a:nth-child(1)')->click();
				break;

			case 'track':

				$keyword = $this->byCssSelector('div.tbody > div:nth-child(2) > div:nth-child(5) > a')->attribute('href');
				$this->byCssSelector('div.tbody > div:nth-child(2) > div:nth-child(5) > a')->click();
				break;

			case 'more':
				$this->byCssSelector('div.tbody > div:nth-child(2) > div:nth-child(6) > a.icon.icon-more.js-playlist-table-more')->click();
				break;
/*
			case 'add':

				$this->byCssSelector('div.tbody > div:nth-child(2) > div.td.time > a.icon.icon-more.js-playlist-table-more')->click();
				$this->byCssSelector('div.tbody > div:nth-child(2) > div.td.time > a.icon.icon-add.js-playlist-table-add')->click();
				break;

			case 'share':

				$this->byCssSelector('div.tbody > div:nth-child(2) > div:nth-child(6) > a.icon.icon-more.js-playlist-table-more')->click();
				$this->byCssSelector('div.tbody > div:nth-child(2) > div:nth-child(6) > a.icon.icon-add.js-playlist-table-add')->click();
				break;

			case 'like':

				$this->byCssSelector('div.tbody > div:nth-child(2) > div:nth-child(6) > a.icon.icon-more.js-playlist-table-more')->click();
				sleep(1);
				$this->byCssSelector('div.tbody > div:nth-child(2) > div:nth-child(7) > a:nth-child(1)')->click();
				break;

			case 'comment':

				$this->byCssSelector('div.tbody > div:nth-child(2) > div:nth-child(6) > a.icon.icon-more.js-playlist-table-more')->click();
				sleep(1);
				$this->byCssSelector('div.tbody > div:nth-child(2) > div:nth-child(7) > a:nth-child(2)')->click();
				break;

*/
			default:
				break;
		}
		return $keyword;
	}


	public function login($account, $password) {

		$this->byName('email')->value($account);
		$this->byName('password')->value($password);
		$this->wait(1);
		$this->byCssSelector('button.submit-circle.button-primary')->click();

		if(!empty($this->cookie()->get('air_member'))){
			$this->checklogin = "true";
		}
	}

	public function memberAccountGenerate() {

        $length = 10;
        $account = '';

        for($index = 1; $index <= $length; $index++) {
            $choose = rand(1, 3);
            if($choose == 1) {
                $result = chr(rand(97, 122));
            }
            if($choose == 2) {
                $result = chr(rand(65, 90));
            }
            if($choose == 3) {
                $result = rand(0, 9);
            }
            $account .= $result;
        }
        $account .= "@test.com";
        return $account;

    }

    public function memberPasswordGenerate() {

        $length = 10;
        $password = '';
        $word = 'abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ0123456789';
        $len = strlen($word);

        for ($index = 0; $index < $length; $index++) {
            $password .= $word[rand() % $len];
        }

        return $password;
    }

	public function register($account, $password) {

		$this->byName('email')->value($account);
		$this->byName('password')->value($password);
		$this->byName('password_confirm')->value($password);
		$this->wait(1);
		$this->byCssSelector('button.submit.button-primary')->click();

		if(!empty($this->cookie()->get('air_member'))){
			$this->checklogin = "true";
		}

	}

	public function memeberNotification() {

		$this->assertEquals($this->checklogin, "true", "member does not login");
		$this->byCssSelector('a.image.js-member-panel-image')->click();
		$this->byCssSelector('div.list > ul > li:nth-child(2) > a')->click();
		
	}

	public function memberPlaylist() {

		$this->assertEquals($this->checklogin, "true", "member does not login");
		$this->byCssSelector('a.image.js-member-panel-image')->click();
		$this->byCssSelector('div.list > ul > li:nth-child(3) > a')->click();

	}

	public function logout() {

		$this->byCssSelector('a.image.js-member-panel-image')->click();
		$this->byCssSelector('div.list > ul > li:nth-child(4) > a')->click();

		$this->checklogin = "false";
		$this->cookie()->clear();
	}

	public function search($keyword) {

		sleep(1);
		$this->byCssSelector('div.control > form > button')->click();
		sleep(1);
		$this->byCssSelector('div.control > form > input')->clear();
		$this->byCssSelector('div.control > form > input')->value($keyword);
		$this->byCssSelector('div.control > form > button')->click();
	}

	public function scrollView() {

		$script = 'window.scrollBy(0, 250)';
        $scroll = array('script' => $script, 'args' => array());        
        $this->execute($scroll);
	}

	public function screenshot($file) {

		$filedata = $this->currentScreenshot();
        file_put_contents($file, $filedata);
	}

	public function countMemberTrackList() {

		return count(
			$this->elements($this->using('css selector')->value('div.list.tinyscrollbar.tinyscrollbar-disable.js-notification-recommend-scrollbar > div > ul > li'))
		) - 1;
		
	}

	public function countMemberTracks() {

		$trackNum = count(
			$this->elements($this->using('css selector')->value('div.table.js-playlist-id > div:nth-child(2) > div'))
		) - 1;

		return $trackNum;
	}

	public function selectMemberTrackList($amount, $select) {

		$this->assertTrue($select <= $amount && $select > 0, "select a non-exist track list");
		$this->byCssSelector('div.list.tinyscrollbar.tinyscrollbar-disable.js-notification-recommend-scrollbar > div > ul > li:nth-child('.$select.')')->click();

		$tracks = $this->countMemberTracks();

		if($tracks == -1) {
			$this->trackAmountFlag = "false";
			$trackAmount = $tracks + 1;
		}
		else {
			$this->trackAmountFlag = "true";
			$trackAmount = $tracks;
		}
		
		return $tracks;
	}

	public function memberTracksOperation($option) {

		$this->assertEquals($this->trackAmountFlag, "true", "track amount is zero");
		//$this->assertTrue($select <= $amount && $select > 0, "select a non-exist track");
		$select = 1;
		$select2 = 1;

		//song null only can do sharelist playall
		switch ($option) {

			case 'playall':


				$this->byCssSelector('div.menu > div > a ')->click();			
				break;
			
			case 'sharelist':

				$this->byCssSelector('div.menu > div > div')->click();
				break;

			case 'editlist':

				break;

			case 'deletelist':

				break;

			case 'play':

				$this->byCssSelector('div.table.js-playlist-id > div:nth-child(2) > div:nth-child('.$select.') > div:nth-child(1) > a:nth-child(1)')->click();
				break;

			case 'delete':

				break;

			case 'add':

				$this->byCssSelector('div.table.js-playlist-id > div:nth-child(2) > div:nth-child('.$select.') > div:nth-child(1) > a:nth-child(2)')->click();
				break;

			case 'composer':

				$this->byCssSelector('div.table.js-playlist-id > div:nth-child(2) > div:nth-child('.$select.') > div:nth-child(2) > a')->click();
				break;

			case 'track':

				$this->byCssSelector('div.table.js-playlist-id > div:nth-child(2) > div:nth-child('.$select.') > div:nth-child(3) > a')->click();
				break;

			case 'artist':

				$this->byCssSelector('div.table.js-playlist-id > div:nth-child(2) > div:nth-child('.$select.') > div:nth-child(4) > a:nth-child('.$select2.')')->click();
				break;

			case 'share':

				$this->byCssSelector('div.table.js-playlist-id > div:nth-child(2) > div:nth-child('.$select.') > div:nth-child(6) > div > a')->click();
				break;

			default:
				break;
		}
	}


}


?>