totango
=======

Totango PHP 

This should allow developers to quickly connect to the Totango Api and send data and events.

Example Use
============

Totango::track('nadeemrashid87@gmail.com','0208N','subscriber','visited plus page','plus',
			array('account'=>'plus','payment_provider'=>'paypal','Status'=>'Paying'),
			array('name'=>'Nadeem Rashid', 'age'=>'26'),
		);
		

as

Totango::track([username],[user_id],[account type],[user activity],[module],
      array([any account details]),
      array([any user info]),
);

The account and user details arrays will be prepended with sdr_o and sdr_u accoridingly so this doesnt need to be added 
to any of the account details.



