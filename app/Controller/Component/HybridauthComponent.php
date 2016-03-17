<?php

/**
 * CakePHP HybridauthComponent
 * @author mike
 */
class HybridauthComponent extends Component
{

    public $hybridauth = null;
    public $adapter = null;
    public $user_profile = null;
    public $error = "no error so far";
    public $provider = null;
    public $debug_mode = false;
    public $debug_file = "";

    /**
     * process the
     *
     * @return string
     */
    public function processEndpoint()
    {
        App::import('Vendor', 'hybridauth/Hybrid/Endpoint');

        if (!$this->hybridauth) $this->init();
        Hybrid_Endpoint::process();
    }

    protected function init()
    {
        App::import('Vendor', 'hybridauth/Hybrid/Auth');
        $config = array(
            "base_url" => Router::url("/users/social_endpoint", true),
            "providers" => Configure::read('Hybridauth'),
            "debug_mode" => $this->debug_mode,
            "debug_file" => $this->debug_file,
        );
        $this->hybridauth = new Hybrid_Auth($config);
    }

    /**
     * get serialized array of acctual Hybridauth from provider...
     *
     * @return string
     */
    public function getSessionData()
    {
        if (!$this->hybridauth) $this->init();
        return $this->hybridauth->getSessionData();
    }

    /**
     *
     * @param string $hybridauth_session_data pass a serialized array stored previously
     */
    public function restoreSessionData($hybridauth_session_data)
    {
        if (!$this->hybridauth) $this->init();
        $hybridauth->restoreSessionData($hybridauth_session_data);
    }

    /**
     * logs you out
     */
    public function logout()
    {
        if (!$this->hybridauth) $this->init();
        $providers = $this->hybridauth->getConnectedProviders();

        if (!empty($providers)) {
            foreach ($providers as $provider) {
                $adapter = $this->hybridauth->getAdapter($provider);
                $adapter->logout();
            }
        }
    }

    /**
     * connects to a provider
     *
     *
     * @param string $provider pass Google, Facebook etc...
     * @return boolean wether you have been logged in or not
     */
    public function connect($provider)
    {

        if (!$this->hybridauth) $this->init();

        $this->provider = $provider;

        try {

            // try to authenticate the selected $provider
            $this->adapter = $this->hybridauth->authenticate($this->provider);

            // grab the user profile
            $this->user_profile = $this->normalizeSocialProfile($provider);

            return true;

        } catch (Exception $e) {
            // Display the recived error
            switch ($e->getCode()) {
                case 0 :
                    $this->error = "Unspecified error.";
                    break;
                case 1 :
                    $this->error = "Hybriauth configuration error.";
                    break;
                case 2 :
                    $this->error = "Provider [" . $provider . "] not properly configured.";
                    break;
                case 3 :
                    $this->error = "[" . $provider . "] is an unknown or disabled provider.";
                    break;
                case 4 :
                    $this->error = "Missing provider application credentials for Provider [" . $provider . "].";
                    break;
                case 5 :
                    $this->error = "Authentification failed. The user has canceled the authentication or the provider [" . $provider . "] refused the connection.";
                    break;
                case 6 :
                    $this->error = "User profile request failed. Most likely the user is not connected to the provider [" . $provider . "] and he/she should try to authenticate again.";
                    $this->adapter->logout();
                    break;
                case 7 :
                    $this->error = "User not connected to the provider [" . $provider . "].";
                    $this->adapter->logout();
                    break;
            }

            // well, basically your should not display this to the end user, just give him a hint and move on..
            if ($this->debug_mode) {
                $this->error .= "<br /><br /><b>Original error message:</b> " . $e->getMessage();
                $this->error .= "<hr /><pre>Trace:<br />" . $e->getTraceAsString() . "</pre>";
            }


            return false;
        }
    }

    /**
     * creates a social profile array based on the hybridauth profile object
     *
     *
     * @param string $provider the provider given from hybridauth
     * @return boolean wether you have been logged in or not
     */
    protected function normalizeSocialProfile($provider)
    {
        // convert our object to an array
        $incomingProfile = (Array)$this->adapter->getUserProfile();

        // populate our social profile
        $socialProfile['User']['social_network_name'] = $provider;
        $socialProfile['User']['social_network_id'] = $incomingProfile['identifier'];
        $socialProfile['User']['email'] = $incomingProfile['email'];
        $socialProfile['User']['display_name'] = $incomingProfile['displayName'];
        $socialProfile['User']['first_name'] = $incomingProfile['firstName'];
        $socialProfile['User']['last_name'] = $incomingProfile['lastName'];
        $socialProfile['User']['link'] = $incomingProfile['profileURL'];
        $socialProfile['User']['picture'] = $incomingProfile['photoURL'];
        $socialProfile['User']['created'] = date('Y-m-d h:i:s');
        $socialProfile['User']['modified'] = date('Y-m-d h:i:s');

        // twitter does not provide email so we need to build someting
        if ($provider == 'Twitter') {
            $names = explode(' ', $socialProfile['User']['first_name']);
            $socialProfile['User']['first_name'] = $names[0];
            $socialProfile['User']['last_name'] = (count($names) > 1 ? end($names) : '');
            $socialProfile['User']['display_name'] = $socialProfile['User']['first_name'] . '_' . $socialProfile['User']['last_name'];
            $socialProfile['User']['email'] = $socialProfile['User']['display_name'] . '@Twitter.com';
        }

        return $socialProfile;
    }

}
