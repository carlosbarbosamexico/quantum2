<?

/**
 * Copyright 2012 Majestic Media
*/

class AppController extends Quantum {
    
    private $facebook;
    private $user_language;
    private $registered_user;
    private $access_token;
    private $signed_request;
    private $fbuid;
    private $user_liked_page;
    
    
    function index() {
        
        $this->template = 'app';
        
        $this->bootFacebook();
        
        $this->userLikedPageHook();
       
        $this->setAppVars();
        
        $bar_width = rand(130, 430);
        
        $this->set('slider_bar_width', $bar_width);
        $this->set('slider_bar_handle_x', $bar_width+151);
        
        $this->set('total_yards_gained', 19378);
        
        header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');
        
        
    }
    
    
    
    function lobby() {
        
        $this->template = 'app';
        
        $this->bootFacebook();
        
        //$this->userLikedPageHook();
       
        $this->setAppVars();
        
        header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');
        
    }
    
    
    
    
    
    
    
    function channel() {
        
        $this->autoRender = false;
        echo '<html><head><title>FB</title><script src="//connect.facebook.net/en_US/all.js"></script></head><body></body></html>';
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    //PRIVATE METHODS
    
    
    private function setAppVars() {
        
        $this->set('server_name', $_SERVER['SERVER_NAME']);
        $this->set('environment', $this->environment);
        $this->set('app_config', $this->app_config);
        $this->set('app_url', $this->getAppUrl());
        
        
    }
    
    
    
    private function bootFacebook() {
        
        $this->initFacebook();
        
        $this->signed_request = $this->facebook->getSignedRequest();
        $this->access_token = $this->facebook->getAccessToken();
        $this->fbuid = $this->facebook->getUser();
        $this->user_liked_page = $this->signed_request["page"]["liked"];
        
    }
    
    
    private function initFacebook() {
        
        Quantum\Import::library('facebook/facebook.php');
        $this->facebook = new Facebook(array(
          'appId' => $this->app_config->app_id,
          'secret' => $this->app_config->app_secret,
          'cookie' => true,
          'scope' => 'email'
        ));
        
    }
    
    private function getSignedRequest() {
        
        if (empty($this->facebook)) {
            $this->initFacebook();
        }
       
        return $this->facebook->getSignedRequest();
    
    }
    
    private function getAppUrl() {
        
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        return $protocol.$_SERVER['SERVER_NAME'];
        
    }
    
    
    private function getFacebookUserId() {
        
        try {
            $user_id = $this->facebook->getUser();
        }
        catch (Exception $e) {
         
        }
        
        if (empty($user_id)) {
           
            try {
              $user = $this->facebook->api('/me');
              //var_dump($user);
            }
            catch (Exception $e) {
              
            }
            if (!empty($user['id'])) {
              $user_id = $user['id'];
            }
            else {
              $user_id = 'me';
            }
        }
        
        return $user_id;
        
    }
    
    private function initUserSession($member) {
        
        //session_start();
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $member->id;
        $_SESSION['facebook_id'] = $member->facebook;
        
        
    }
    
    private function locateUser($fbuid) {
        
        $member = Member::find_by_facebook($fbuid);
                
        if (!empty($member)) {
           
            $this->initUserSession($member);
            
            $this->registered_user = $member;
            
            return true;
           
        }
        
        return false;
        
    }
    
    
    
    
    private function getFacebookUserData($fbuid) {
        
        $user = $this->facebook->getUser();   
        $token = $this->facebook->getAccessToken();
        
        if ($user) {
            
            try {
                    $me = $this->facebook->api('/me');
                }
            catch (Exception $e) {
                    $failed = true;
                }
            
        } else {
        
        }
        
        if (!isset($failed)) {
            return $me;
        } else {
            return false;
        }
        
    }
    
    private function setUserFriends($limit) {
        
        $friends = $this->getUserFriends();
        $counter = 0;
        $fc = count($friends);
        
        
        while ($counter < $limit)  {
            $counter++;
            $rf = rand(0, $fc);
        
            if ($rf >= $fc && $rf != 0) {
                $rf = $rf-1;
            }
            $this->set('friend'.$counter, $friends[$rf]);
           
        }
        
    }
    
    
    private function getUserFriends() {
        
        try {
            $friends = $this->facebook->api('/me/friends');
        }
            catch (Exception $e) {
            return false;
        }
        
        return $friends['data'];
    }
    
    
    
    
    private function userLikedPageHook() {
        
        if ($this->user_liked_page === true) {
            redirect_to('/app/lobby');
        }
         
    }
    
    
  
  
    
    
    
    
  
    
  
  
  
  
  private function facebookSecurityCheck() {
    
    if ($_SESSION['facebook_id'] != $this->facebook->getUser()) {
        
        $_SESSION = array();
        $this->facebook->setAccessToken('');
        redirect_to('/app');
        exit();
    }
    
  }
  
  
  
    
    
    
   
    
}
