<?php

class AirMuzikComponent extends PHPUnit_Extensions_Selenium2TestCase {

	protected $trackAmountFlag;
	protected $checklogin;
	protected $windowChange;

	const CONNECT_TIMEOUT_MS = 500;

	public function elementSetup() {
		$this->trackAmountFlag = "true";
		$this->checklogin = "false";
		$this->windowChange = "false";
	}

	public function wait($second) {

		$this->timeouts()->implicitWait($second * 1000);
	}

	public function menu($option) {

		$keyword = '';
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
				break;

			case 'GoforPlaying':

				$keyword = $this->homepagePlayList($option);
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

		return $keyword;
	}

	public function homepagePlayList($option) {

		$keyword = '';

		if($option === 'GoforPlaying') {

			if($this->windowChange === "false") {

				$keyword = $this->byCssSelector('form > a.play.button-primary')->attribute('href');
				$this->byCssSelector('form > a.play.button-primary')->click();
			}
			else {

				$this->moveto($this->byCssSelector('a.scenario-playlist'));
				$this->byCssSelector('a.scenario-playlist')->click();
			}
		}
		else if($option === 'GotoPlayListTrackProfile') {

			//first track
			$this->byCssSelector('div.playlist > ul > li:nth-child(1) > a')->click();
		}
		return $keyword;

	}

	public function trackProfile($option) {
		$text = 'test comment 3';
		$select = 2;
		$keyword = '';
		switch ($option) {

			case 'play':

				$keyword = $this->byCssSelector('div.menu > div.control > a.play.button-primary')->attribute('href');
				$this->byCssSelector('div.menu > div.control > a.play.button-primary')->click();
				break;
			
			case 'like':

				$this->byCssSelector('div.menu > div.control > a.playlist-like')->click();
				break;

			case 'add':

				$this->byCssSelector('div.menu > div.control > a.playlist-add')->click();
				break;

			case 'share':

				$this->byCssSelector('div.menu > div.control > div > a')->click();
				//click copy
				$this->byCssSelector('div.playlist-share.js-playlist-share-panel.playlist-share-active > div.list > form.form > button')->click();
				break;
			
			default:
				break;
		}

		return $keyword;
		
	}

	public function searchOperation($option) {//temporary use track2

		$keyword = '';
		switch ($option) {

			case 'play':

				$keyword = $this->byCssSelector('div.playlist-table > div.table > div.tbody > div:nth-child(2) > div:nth-child(1) > a:nth-child(1)')->attribute('href');
				$this->byCssSelector('div.playlist-table > div.table > div.tbody > div:nth-child(2) > div:nth-child(1) > a:nth-child(1)')->click();
				break;

			case 'add':

				$this->byCssSelector('div.playlist-table > div.table > div.tbody > div:nth-child(2) > div:nth-child(1) > a:nth-child(2)')->click();
				break;

			case 'composer':

				$keyword = $this->byCssSelector('div.playlist-table > div.table > div.tbody > div:nth-child(2) > div:nth-child(2) > a')->attribute('title');
				$this->byCssSelector('div.playlist-table > div.table > div.tbody > div:nth-child(2) > div:nth-child(2) > a')->click();
				break;

			case 'track':

				$keyword = $this->byCssSelector('div.playlist-table > div.table > div.tbody > div:nth-child(2) > div:nth-child(3) > a')->attribute('href');
				$this->byCssSelector('div.playlist-table > div.table > div.tbody > div:nth-child(2) > div:nth-child(3) > a')->click();
				break;

			case 'artist':

				$keyword = $this->byCssSelector('div.playlist-table > div.table > div.tbody > div:nth-child(2) > div:nth-child(4) > a')->attribute('title');
				$this->byCssSelector('div.playlist-table > div.table > div.tbody > div:nth-child(2) > div:nth-child(4) > a')->click();
				break;
			/*
			case 'share':

				$this->byCssSelector('div.playlist-table > div.table > div.tbody > div:nth-child(2) > div:nth-child(6) > div > a')->click();
				//click copy
				$this->byCssSelector('div.playlist-table > div.table > div.tbody > div:nth-child(2) > div:nth-child(6) > div > div.list > form > button')->click();

				break;
			*/
			default:
				break;
		}

		return $keyword;
	}

	public function player($option) {//now use track 1 for test

		$keyword = '';
		switch ($option) {

			case 'play':
				
				$this->byCssSelector('div.tbody > div:nth-child(1) > div:nth-child(1) > a:nth-child(1)')->click();
				break;

			case 'add':
				
				$this->byCssSelector('div.tbody > div:nth-child(1) > div:nth-child(1) > a.icon.icon-add')->click();
				break;

			case 'composer':

				$keyword = $this->byCssSelector('div.tbody > div:nth-child(1) > div:nth-child(2) > a')->attribute('title');
				$this->byCssSelector('div.tbody > div:nth-child(1) > div:nth-child(2) > a')->click();
				break;

			case 'track':

				$keyword = $this->byCssSelector('div.tbody > div:nth-child(1) > div:nth-child(3) > a')->attribute('href');
				$this->byCssSelector('div.tbody > div:nth-child(1) > div:nth-child(3) > a')->click();
				break;

			case 'artist':

				$keyword = $this->byCssSelector('div.tbody > div:nth-child(1) > div:nth-child(4) > a:nth-child(1)')->attribute('title');
				$this->byCssSelector('div.tbody > div:nth-child(1) > div:nth-child(4) > a:nth-child(1)')->click();
				break;

			case 'share':

				$this->byCssSelector('div.tbody > div:nth-child(1) > div:nth-child(7) > a:nth-child(1)')->click();
				$this->byCssSelector('div.playlist-share.js-playlist-share-panel.playlist-share-active > div.list > form.form > button')->click();
				break;

			case 'like':

				$this->byCssSelector('div.tbody > div:nth-child(1) > div:nth-child(7) > a:nth-child(2)')->click();
				break;

			case 'comment':

				$keyword = $this->byCssSelector('div.tbody > div:nth-child(1) > div:nth-child(7) > a:nth-child(3)')->attribute('href');
				$this->byCssSelector('div.tbody > div:nth-child(1) > div:nth-child(7) > a:nth-child(3)')->click();
				break;

			default:
				break;
		}

		return $keyword;
		
	}

	public function trackcontrolboard($option) {

		$tracktime = array(
			'progress' => '',
			'duration' => ''
		);

		$tracktime['progress'] = $this->byCssSelector('div.player.clearfix.js-player > div.information > div.time > span.progress.js-player-progress')->text();
		$tracktime['duration'] = $this->byCssSelector('div.player.clearfix.js-player > div.information > div.time > span.duration.js-player-duration')->text();

		switch ($option) {

			case 'prev':
				
				$this->byCssSelector('div.player.clearfix.js-player > div.control > a.button.previous.icon-back.js-player-previous')->click();
				break;
			
			case 'next':

				$this->byCssSelector('div.player.clearfix.js-player > div.control > a.button.next.icon-next.js-player-next')->click();
				break;

			case 'play':

				$this->byCssSelector('div.player.clearfix.js-player > div.control > a.button.play.icon-play.js-player-play')->click();
				break;

			case 'pause':

				$this->byCssSelector('div.player.clearfix.js-player > div.control > a.button.pause.icon-pause.js-player-pause')->click();
				break;

			default:
				
				break;
		}

		return $tracktime;
	}

	public function playerRWD($option) {//use track 2 for test

		$keyword = '';
		switch ($option) {

			case 'play':

				$this->byCssSelector('div.tbody > div:nth-child(2) > div.td.control > a.icon.icon-play')->click();
				break;

			case 'track':

				$keyword = $this->byCssSelector('div.tbody > div:nth-child(2) > div.td.details > a.link')->attribute('href');
				$this->byCssSelector('div.tbody > div:nth-child(2) > div.td.details > a.link')->click();
				break;

			case 'add':

				$this->clickmore();

				$this->moveto($this->byCssSelector('div.tbody > div:nth-child(2) > div.td.time > a.icon.icon-add'));
				$this->byCssSelector('div.tbody > div:nth-child(2) > div.td.time > a.icon.icon-add')->click();

				$this->clickmore();
				break;

			case 'share':

				$this->clickmore();

				$this->moveto($this->byCssSelector('div.tbody > div:nth-child(2) > div.td.action > a.link.js-playlist-share'));
				$this->byCssSelector('div.tbody > div:nth-child(2) > div.td.action > a.link.js-playlist-share')->click();

				//need to add close pop-up list

				$this->clickmore();
				break;

			case 'like':

				$this->clickmore();

				$this->moveto($this->byCssSelector('div.tbody > div:nth-child(2) > div.td.action > a.link.js-playlist-like'));
				$this->byCssSelector('div.tbody > div:nth-child(2) > div.td.action > a.link.js-playlist-like')->click();

				$this->clickmore();
				break;

			case 'comment':

				$this->clickmore();

				$this->moveto($this->byCssSelector('div.tbody > div:nth-child(2) > div.td.action > a:nth-child(3)'));
				$this->byCssSelector('div.tbody > div:nth-child(2) > div.td.action > a:nth-child(3)')->click();

				$this->clickmore();
				break;


			default:
				break;
		}

		return $keyword;
	}

	public function clickmore() {

		$this->moveto($this->byCssSelector('div.tbody > div:nth-child(2) > div.td.time > a.icon.icon-more.js-playlist-table-more'));
		$this->byCssSelector('div.tbody > div:nth-child(2) > div.td.time > a.icon.icon-more.js-playlist-table-more')->click();
	}

	public function trackcontrolboardRWD($option) {

		switch ($option) {

			case 'value':
				
				break;
			
			default:
				
				break;
		}
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

	public function scrollView($length) {

		$script = 'window.scrollBy(0, '.$length.')';
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

	public function responseCode($timeout_in_ms, $url) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, self::CONNECT_TIMEOUT_MS);
        // There is a PHP bug in some versions which didn't define the constant.
        curl_setopt(
            $ch,
            156, // CURLOPT_CONNECTTIMEOUT_MS
            self::CONNECT_TIMEOUT_MS
        );

        $code = null;

        try {
          curl_exec($ch);
          $info = curl_getinfo($ch);
          $code = $info['http_code'];
        }
        catch (Exception $e) {}

        curl_close($ch);
        return $code;
    }

    public function getUrlList($url) {

        $page = file_get_contents($url);

        mb_convert_encoding($page, 'UTF-8');
        mb_regex_encoding('UTF-8');
        
        preg_match_all("/(http|https|ftp):\/\/[^<>[:space:]]+[[:alnum:]#?\/&=+%_]/", $page, $match);
        $list = $match[0];

        $recordList = array();

        foreach ($list as $value) {

        	$requestcode = strval($this->responseCode(10000, $value));
        	
        	if((strpos($requestcode, "4", 0) === 0) || (strpos($requestcode, "5", 0) === 0)) {

        		$temp = array("responseCode" => $requestcode, "url" => $value);
        		array_push($recordList, $temp);
        	}
        }
        
        return $recordList;
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