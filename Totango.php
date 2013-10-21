<?php
namespace App;

class Totango
{
	
	static $url	 = 'sdr.totango.com/pixel.gif/';
	static $service_id = 'SP-XXXX-XX'; //Service ID

	//	Status [important] : Free/Paying/Cancelled (part of sdr_o.<Paying>)
	//  Timestamp [important] : ISO 8601 timestamp (part of sdr_o.<Create+Date>)

	//	sdr_s(service-id): API identifier of your account on Totango
	//	sdr_u(username): Email address of the username performing the action
	//	sdr_o(account id): Unique ID of the end-user’s account on your application
	//	sdr_o.<att+name>=<att+value> to add any extra info 
	//	sdr_odn(account name): A human readable name for the account (will be used on Totango’s UI and reports)
	//	sdr_a(activity): Name of the activity the user performed
	//	sdr_m(module): Name of the module the user is using within the application

	public static function track($email=null,$user_id=null,$account_type=null,$activity=null,$module=null,$account_opts=null,$user_opts=null){

		//Set for if a user is not currently known.
		if(!$email || !$user_id){ 
			$email = 'undefined';
			$user_id = 'undefined';
		}

		//Standard attributes
		$std_atts = array(	
			'sdr_s'  =>	self::$service_id,
			'sdr_u'  =>	$email,
			'sdr_o'	 =>	$user_id,
			'sdr_odn'=>	$email,
			'sdr_a'	 =>	$activity,
			'sdr_m'  =>	$module,
			'sdr_o.Create date'	=> date('c'),
			);

		//Additional Optional Account attributes (sdr_o.<att+name>=><att+value>)
		foreach ($account_opts as $key => $value) {
			$opt_acc_atts['sdr_o.'.$key] = ($value);
		}

		//Additional Optional User attributes (sdr_o.<att+name>=><att+value>)
		foreach ($user_opts as $key => $value) {
			$opt_usr_atts['sdr_u.'.$key] = ($value);
		}
		$opt_usr_atts['sdr_u.referrer'] = $_SERVER['HTTP_REFERER']; //Can be faked

		return file_get_contents(
					'http://'. //http or https
					self::$url.'?'.
					http_build_query($std_atts).'&'.
					http_build_query($opt_acc_atts).'&'.
					http_build_query($opt_usr_atts)
			);

	} 


	//	Totango::track('nadeemrashid87@gmail.com','0208N','subscriber','visited plus page','plus',
	//			array('account'=>'plus','payment_provider'=>'paypal','Status'=>'Paying'),
	//			array('name'=>'Nadeem Rashid', 'age'=>'26'),
	//		);


}
