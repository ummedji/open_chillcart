<?php
Cache::config('default', array('engine' => 'File'));

preg_match('/^(?:www\.)?(?:(.+)\.)?(.+\..+)$/i', env('HTTP_HOST'), $urlmatches);
Configure::write('SubdomainHTTP', array('subdomain' => empty($urlmatches[1]) ? false : $urlmatches[1], 'hostURL' => empty($urlmatches[2]) ? false : $urlmatches[2]));


Configure::write('Dispatcher.filters', array(
    'AssetDispatcher',
    'CacheDispatcher'
));
Configure::write('Stripe.TestSecret', 'sk_test_QcYAQLjuk0nH2VqIKlYcqLQI');
Configure::write('Stripe.LiveSecret', 'pk_test_4NJXMb2RzQRyJBIkAhaSBwZn');
Configure::write('Stripe.mode', 'Test');
Configure::write('Stripe.currency', 'eur');
/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
    'engine' => 'FileLog',
    'types' => array('notice', 'info', 'debug'),
    'file' => 'debug',
));
CakeLog::config('error', array(
    'engine' => 'FileLog',
    'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
    'file' => 'error',
));

if (getenv("APPLICATION_ENV") == "GENERAL_DEVELOPMENT"):
    Configure::write('CakeS3', array(
        's3Key' => 'AKIAJ7UUZ7Q22HDUQKMA',
        's3Secret' => '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',
        'bucket' => 'dev.chillcart.images',
        'endpoint' => 's3-eu-west-1.amazonaws.com', // [optional] Only required if your endpoint is not s3-eu-west-1.amazonaws.com
        'cdn' => 'http://dev.chillcart.images.s3-eu-west-1.amazonaws.com'
    )
);
elseif (getenv("APPLICATION_ENV") == "DEMO"):
  Configure::write('CakeS3', array(
        's3Key' => 'AKIAJ7UUZ7Q22HDUQKMA',
        's3Secret' => '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',
        'bucket' => 'demo.chillcart.images',
        'endpoint' => 's3-eu-west-1.amazonaws.com', // [optional] Only required if your endpoint is not s3-eu-west-1.amazonaws.com
        'cdn' => 'http://cdn.chillcart.ie'
    )
);
elseif (getenv("APPLICATION_ENV") == "TESTING"):
  Configure::write('CakeS3', array(
        's3Key' => 'AKIAJ7UUZ7Q22HDUQKMA',
        's3Secret' => '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',
        'bucket' => 'testing.chillcart.images',
        'endpoint' => 's3-eu-west-1.amazonaws.com', // [optional] Only required if your endpoint is not s3-eu-west-1.amazonaws.com
        'cdn' => 'http://cdn.chillcart.ie'
    )
);
else:
  Configure::write('CakeS3', array(
        's3Key' => 'AKIAJ7UUZ7Q22HDUQKMA',
        's3Secret' => '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',
        'bucket' => 'dev.chillcart.images',
        'endpoint' => 's3-eu-west-1.amazonaws.com', // [optional] Only required if your endpoint is not s3-eu-west-1.amazonaws.com
        'cdn' => 'http://dev.chillcart.images.s3-eu-west-1.amazonaws.com'
    )
);
endif;

/** 
 * HybridAuth component
 *
 */
 Configure::write('Hybridauth', array(
    // openid providers
    "Google" => array(
        "enabled" => true,
        "keys" => array("id" => "633345069118-41bhfk6f0onim7haf9koaeibgsdvt0fn.apps.googleusercontent.com","secret" => "4XEpzRATmc44oze9jp1jjrDC"),
    ),
	"Twitter" => array(
        "enabled" => true,
        "keys" => array("key" => "Your-Twitter-Key", "secret" => "Your-Twitter-Secret")
    ),
	"Facebook" => array(
        "enabled" => true,
        "keys" => array("id" => "390488147813330", "secret" => "6938131093089cf147eaf86fdde037a9"),
    ),
));

// ACabd5c1ab4205beb8f7011d7eaa0c8230 bce4b1ff455bd4d479388b6488104529	

Configure::write('Twilio.AccountSid', 'ACabd5c1ab4205beb8f7011d7eaa0c8230');
Configure::write('Twilio.AuthToken', 'bce4b1ff455bd4d479388b6488104529');
Configure::write('Twilio.from', '+16462912224');
App::import('Vendor', array('file' => 'autoload'));

CakePlugin::loadAll();
