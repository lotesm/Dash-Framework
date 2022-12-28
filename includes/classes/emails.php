<?php

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	
	class Email {

		function admin_reg( $email, $name, $password ){

			$img_footer = '<div style="height: 222px; width: 100%"><center><img src="'.get_host_domain().'/img/mail-footer.jpg"></center></div>';

			$body = '<p style="color: #053961">Hello '. $name . '<br>You have been ceated account as Admin at ASAS<br><br>
			Email: '. $email . '<br>
			Password: ' . $password . '<br>

			You will  login to your dashboard. <a href="'.get_host_domain().'">here</a><br><br>

			Kind regards<br>ASAS team</p>'.$img_footer;

			$mail = new PHPMailer(true);

			try {

			    //Recipients
			    $mail->setFrom('non-reply@jkmolapo.space', 'ASAS Support');
			    $mail->addAddress( $email, $name );     // Add a recipient
			    $mail->addReplyTo('non-reply@jkmolapo.space', 'Non Replay');


			    // Content
			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = 'Registration';
			    $mail->Body    = $body;


			    $mail->send();


			} catch (Exception $e) {

			    $headers[] = 'From: ASAS <non-reply@jkmolapo.space>';
				$headers[] = 'MIME-Version: 1.0';
				$headers[] = 'Content-type: text/html; charset=iso-8859-1';

				mail( $email,"Registration", $body , implode("\r\n", $headers) );

			}

		}

		function agent_reg( $email, $username, $password ){

			$img_footer = '<div style="height: 222px; width: 100%"><center><img src="'.get_host_domain().'/img/mail-footer.jpg"></center></div>';

			$body = '<p style="color: #053961">Good day <br>Your account at ASAS has been activated<br><br>
			Email: '. $email . '<br>
			Username: '. $username . '<br>
			Password: ' . $password . '<br>

			You can  login no your dashboard. <a href="'.get_host_domain().'">here</a><br><br>

			Kind regards<br>ASAS team</p>'.$img_footer;

			$mail = new PHPMailer(true);

			try {

			    //Recipients
			    $mail->setFrom('non-reply@jkmolapo.space', 'ASAS Support');
			    $mail->addAddress( $email, $username );     // Add a recipient
			    $mail->addReplyTo('non-reply@jkmolapo.space', 'Non Replay');


			    // Content
			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = 'Registration';
			    $mail->Body    = $body;


			    $mail->send();


			} catch (Exception $e) {

			    $headers[] = 'From: ASAS <non-reply@jkmolapo.space>';
				$headers[] = 'MIME-Version: 1.0';
				$headers[] = 'Content-type: text/html; charset=iso-8859-1';

				mail( $email,"Registration", $body , implode("\r\n", $headers) );

			}

		}

		function agent_reg_waiting( $email, $agentcode, $name ){

			$img_footer = '<div style="height: 222px; width: 100%"><center><img src="'.get_host_domain().'/img/mail-footer.jpg"></center></div>';

			$body = '<p style="color: #053961">Good day '.$name.'<br>You have been registerd at Alliance Sales Agent Portal<br><br>
			Email: '. $email . '<br>
			Agent code: '. $agentcode . '<br>

			You can  create your account <a href="'.get_host_domain().'">here</a><br><br>

			Kind regards<br>ASAS team</p>'.$img_footer;

			$mail = new PHPMailer(true);

			try {

			    //Recipients
			    $mail->setFrom('non-reply@jkmolapo.space', 'ASAS Support');
			    $mail->addAddress( $email, $name );     // Add a recipient
			    $mail->addReplyTo('non-reply@jkmolapo.space', 'Non Replay');


			    // Content
			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = 'Registration';
			    $mail->Body    = $body;


			    $mail->send();


			} catch (Exception $e) {

			    $headers[] = 'From: ASAS <non-reply@jkmolapo.space>';
				$headers[] = 'MIME-Version: 1.0';
				$headers[] = 'Content-type: text/html; charset=iso-8859-1';

				mail( $email,"Registration", $body , implode("\r\n", $headers) );

			}

		}

		function sent_agent_activation( $email, $username, $key ){

			$link = get_host_domain().'/user-activation.php?token='.$key;

			$img_footer = '<div style="height: 222px; width: 100%"><center><img src="'.get_host_domain().'/img/mail-footer.jpg"></center></div>';

			$body = '<p style="color: #053961">Good day <br>You have created agent account at ASAS<br><br>

			Please <a href="'.$link.'">Click Here</a> or follow the link below or copy it to your browser URL input to setup and activate your account<br>
			Link: '.$link.'<br><br>

			Kind regards<br>ASAS team</p>'.$img_footer;

			$mail = new PHPMailer(true);

			try {

			    //Recipients
			    $mail->setFrom('non-reply@jkmolapo.space', 'ASAS Support');
			    $mail->addAddress( $email, $username );     // Add a recipient
			    $mail->addReplyTo('non-reply@jkmolapo.space', 'Non Replay');


			    // Content
			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = 'Activation';
			    $mail->Body    = $body;


			    $mail->send();


			} catch (Exception $e) {

			    $headers[] = 'From: ASAS <non-reply@jkmolapo.space>';
				$headers[] = 'MIME-Version: 1.0';
				$headers[] = 'Content-type: text/html; charset=iso-8859-1';

				mail( $email,"Activation", $body , implode("\r\n", $headers) );

			}

		}

		function admin_info_edit( $email, $name = 'Name'){

			$admin 	= new Admin();
			$sett 	= new Settings();

			$username = $admin->make_username( $email );

			$setting = $sett->get_notification( $username, 'profile' );


			if( $setting == 'on' ){

				$img_footer = '<div style="height: 222px; width: 100%"><center><img src="'.get_host_domain().'/img/mail-footer.jpg"></center></div>';

				$body = '<p style="color: #053961">Hello '. $name . '<br>Your acoount profile has been updated<br><br>

				You will  login to your dashboard. <a href="#">here</a><br><br>

				Kind regards<br>ASAS team</p>'.$img_footer;

				$mail = new PHPMailer(true);

				try {

				    //Recipients
				    $mail->setFrom('non-reply@jkmolapo.space', 'ASAS Support');
				    $mail->addAddress( $email, $name );     // Add a recipient
				    $mail->addReplyTo('non-reply@asas.com', 'Non Replay');


				    // Content
				    $mail->isHTML(true);                                  // Set email format to HTML
				    $mail->Subject = 'Profile update';
				    $mail->Body    = $body;


				    $mail->send();


				} catch (Exception $e) {

				    $headers[] = 'From: ASAS <non-reply@jkmolapo.space>';
					$headers[] = 'MIME-Version: 1.0';
					$headers[] = 'Content-type: text/html; charset=iso-8859-1';

					mail( $email,"Profile update", $body , implode("\r\n", $headers) );

				}
			}
			
		}

		function admin_pass_res( $email, $name, $password ){

			$admin 	= new Admin();
			$sett 	= new Settings();

			$username = $admin->make_username( $email );

			$setting = $sett->get_notification( $username, 'password' );


			$img_footer = '<div style="height: 222px; width: 100%"><center><img src="'.get_host_domain().'/img/mail-footer.jpg"></center></div>';

			$body = '<p style="color: #053961">Hello '. $name . '<br>Your password has need updated<br><br>
			Password: ' . $password . '<br>

			You will  login to your dashboard. <a href="'.get_host_domain().'">here</a><br><br>

			Kind regards<br>ASAS team</p>'.$img_footer;

			$mail = new PHPMailer(true);

			try {

			    //Recipients
			    $mail->setFrom('non-reply@jkmolapo.space', 'ASAS Support');
			    $mail->addAddress( $email, $name );     // Add a recipient
			    $mail->addReplyTo('non-reply@jkmolapo.space', 'Non Replay');


			    // Content
			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = 'Password update';
			    $mail->Body    = $body;


			    $mail->send();


			} catch (Exception $e) {

			    $headers[] = 'From: ASAS <non-reply@jkmolapo.space>';
				$headers[] = 'MIME-Version: 1.0';
				$headers[] = 'Content-type: text/html; charset=iso-8859-1';

				mail( $email,"Password update", $body , implode("\r\n", $headers) );

			}
			
			
		}



		function admin_acc_man( $email, $name, $status ){

			if ($status == 'active'){

				$status = 'Activated and you can login again,<br>You will  login to your dashboard. <a href="'.get_host_domain().'">here</a>';

			} else {

				$status = 'suspended for any inquiries regarding this matter please call in on your broker';
			}

			$img_footer = '<div style="height: 222px; width: 100%"><center><img src="'.get_host_domain().'/img/mail-footer.jpg"></center></div>';

			$body = '<p style="color: #053961">Hello '. $name . '<br>Your you account has just been '.$status.'<br><br>

			Kind regards<br>ASAS team</p>'.$img_footer;

			$mail = new PHPMailer(true);

			try {

			    //Recipients
			    $mail->setFrom('non-reply@jkmolapo.space', 'ASAS Support');
			    $mail->addAddress( $email, $name );     // Add a recipient
			    $mail->addReplyTo('non-reply@jkmolapo.space', 'Non Replay');


			    // Content
			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = 'activation';
			    $mail->Body    = $body;


			    $mail->send();


			} catch (Exception $e) {

			    $headers[] = 'From: ASAS <non-reply@jkmolapo.space>';
				$headers[] = 'MIME-Version: 1.0';
				$headers[] = 'Content-type: text/html; charset=iso-8859-1';

				mail( $email,"Account activation", $body , implode("\r\n", $headers) );

			}


		}



		/*
		* notify both amdin and Agent when account is logged out
		*
		*/
		function acc_logout_notification( $email, $username ){


			$img_footer = '<div style="height: 222px; width: 100%"><center><img src="'.get_host_domain().'/img/mail-footer.jpg"></center></div>';

			$body = '<p style="color: #053961">Your you username ('.$username.') has just been suspended due to too many bad login attempts, if you were unaware of this please notify Administration<br><br>

			Kind regards<br>ASAS team</p>'.$img_footer;

			$mail = new PHPMailer(true);

			try {

			    //Recipients
			    $mail->setFrom('non-reply@jkmolapo.space', 'ASAS Support');
			    $mail->addAddress( $email, $name );     // Add a recipient
			    $mail->addReplyTo('non-reply@jkmolapo.space', 'Non Replay');


			    // Content
			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = 'activation';
			    $mail->Body    = $body;


			    $mail->send();


			} catch (Exception $e) {

			    $headers[] = 'From: ASAS <non-reply@jkmolapo.space>';
				$headers[] = 'MIME-Version: 1.0';
				$headers[] = 'Content-type: text/html; charset=iso-8859-1';

				mail( $email,"Account activation", $body , implode("\r\n", $headers) );

			}


		}

		/*
		* notify user when successful login
		*
		*/
		function login_notification($username, $email ){

			$sett 	= new Settings();

			$setting = $sett->get_notification( $username, 'login' );


			if( $setting == 'on' ){

				$agent = getBrowser();

				$img_footer = '<div style="height: 222px; width: 100%"><center><img src="'.get_host_domain().'/img/mail-footer.jpg"></center></div>';

				$body = '<p style="color: #053961">Your you username ('.$username.') has just logged in <br><br><b>Session detail</b><br>

					Time: '.date('Y-m-d  H:m').'<br>

					Browser: '.$agent['name'].', version-'.$agent['version'].'<br>

					Platform: '.$agent['platform'].'<br><br>

					if you were unaware of this please notify Administration<br><br>

				Kind regards<br>ASAS team</p>'.$img_footer;

				$mail = new PHPMailer(true);

				try {

				    //Recipients
				    $mail->setFrom('non-reply@jkmolapo.space', 'ASAS Support');
				    $mail->addAddress( $email, $username );     // Add a recipient
				    $mail->addReplyTo('non-reply@jkmolapo.space', 'Non Replay');


				    // Content
				    $mail->isHTML(true);                                  // Set email format to HTML
				    $mail->Subject = 'Account Login';
				    $mail->Body    = $body;


				    $mail->send();


				} catch (Exception $e) {

				    $headers[] = 'From: ASAS <non-reply@jkmolapo.space>';
					$headers[] = 'MIME-Version: 1.0';
					$headers[] = 'Content-type: text/html; charset=iso-8859-1';

					mail( $email,"Account activation", $body , implode("\r\n", $headers) );

				}

			}
		}


		/*
		* notify agent when one of their policies have been queried
		*
		*/
		function query_notification($agentcode, $email, $policynumber ){

			$img_footer = '<div style="height: 222px; width: 100%"><center><img src="'.get_host_domain().'/img/mail-footer.jpg"></center></div>';

			$body = '<p style="color: #053961">Hello agent ('.$agentcode.')<br><br>

				Your Policy (Policy Number: '.$policynumber.') has just been queried<br>
				please login on your portal for more details
				
				<br><br>

				Kind regards<br>ASAS team</p>'.$img_footer;

			$mail = new PHPMailer(true);

			try {

			    //Recipients
			    $mail->setFrom('non-reply@jkmolapo.space', 'ASAS Support');
			    $mail->addAddress( $email, $agentcode );     // Add a recipient
			    $mail->addReplyTo('non-reply@jkmolapo.space', 'Non Replay');


			    // Content
			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = 'Policy Query';
			    $mail->Body    = $body;


			    $mail->send();


			} catch (Exception $e) {

			    $headers[] = 'From: ASAS <non-reply@jkmolapo.space>';
				$headers[] = 'MIME-Version: 1.0';
				$headers[] = 'Content-type: text/html; charset=iso-8859-1';

				mail( $email,"Policy Query", $body , implode("\r\n", $headers) );

			}

		}


	}


	$mail = new Email();

	
?>