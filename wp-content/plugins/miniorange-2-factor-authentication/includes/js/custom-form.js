jQuery(document).ready(function () {
	let $mo = jQuery;
	let ajaxurl = otpverificationObj.siteURL;
	let nonce = otpverificationObj.nonce;
	let submitSelector = otpverificationObj.submitSelector;
	let formSubmit = otpverificationObj.formSubmit;
	let formName = otpverificationObj.formname;
	let emailSelector = otpverificationObj.emailselector;
	let phoneSelector = otpverificationObj.phoneSelector;
	let notificationSelector = otpverificationObj.notificationSelector;
	let successClass = otpverificationObj.successClass;
	let errorClass = otpverificationObj.errorClass;
	let txId = "";
	let txIdNew = "";
	let isValidated = false;
	let isSecond = false;
	let authType = otpverificationObj.authType;
	let isShortEnabled = otpverificationObj.isEnabledShortcode;
	let isRegistered = otpverificationObj.isRegistered;
	const otpEdit =
		'<input type="text"' +
		'name="edit_otp"' +
		'id="edit_otp"' +
		'placeholder="Enter OTP"' +
		'style="display:none; ">';
	const messageTextMobile =
		'<p id="otpmessage">' + otpverificationStringsObj.otp_sent_phone + "</p>";
	const messageTextBoth =
		'<p id="otpmessage">' + otpverificationStringsObj.otp_sent_both + "</p>";
	const messageTextEmail =
		'<p id="otpmessage">' + otpverificationStringsObj.otp_sent_email + "</p>";
	const sendButton =
		'<button type="button" class="button" ' +
		'id ="otp_send_button">' +
		otpverificationStringsObj.send_otp +
		"</button> " +
		'<div class="button" ' +
		'id ="timer" ' +
		'style="display:none;margin-top:1em">00</div>';
	const validateButton =
		'<button type="button" class="button" ' +
		'id ="validate_otp" style="display:none;margin-top:1em">' +
		otpverificationStringsObj.validate_otp +
		"</button><br>";

	const phonelabel =
		'<label for="reg_phone">' +
		otpverificationStringsObj.phone_num +
		'&nbsp;<span class="required">*</span></label>';
	const style = document.createElement("style");
	style.innerHTML = `
			  .mo2f_red {
				color:red;
			  }
			  .mo2f_green {
				color:green;
			  }
			`;
	document.head.appendChild(style);

	if (isRegistered === "false") {
		const messageNotRegistered =
			'<p id="registermessage" style="color: red;font-size: 18px;border: red 1px solid;padding: 5px" > ' +
			otpverificationStringsObj.account_register +
			"</p>";
		$mo(emailSelector).after("<br>" + messageNotRegistered);
	} else if (
		($mo(formName).length || $mo(submitSelector).length) &&
		isRegistered !== false &&
		isShortEnabled !== "false"
	) {
		function mo2f_setMessage(message_key, color) {
			setMessage(otpverificationStringsObj[message_key], color);
		}
		function setMessage(message, color) {
			var offset = $mo(notificationSelector).offset();
			$mo(notificationSelector).text("");
			if (color == "red") {
				$mo(notificationSelector)
					.text(message)
					.removeClass(successClass)
					.css("display", "block")
					.addClass(errorClass);
				window.location.href = notificationSelector;
				if(offset.top != 0){
					window.scroll({
						top: offset.top-screen.height*0.25, // error notification will appear on 0.25% from top
						behavior: 'smooth'
					  });
				}
			} else {
				$mo(notificationSelector)
					.text(message)
					.css("display", "block")
					.removeClass(errorClass)
					.addClass(successClass);
			}
		}

		function sendChallenge(authType, phone, email, nonce, ajaxurl) {
			txId = "";
			let timeLeft = 0;
			let timerId;
			let data = {
				action: "mo_shortcode",
				mo_action: "challenge",
				email: email,
				phone: phone,
				nonce: nonce,
				authTypeSend: authType,
			};

			$mo("#otp_send_button").text(otpverificationStringsObj.sending_otp);
			$mo.post(ajaxurl, data, function (response) {
				response.status == "SUCCESS";
				if (response === null) {
					mo2f_setMessage("contact_admin", "red");
				} else {
					switch (response.status) {
						case "SUCCESS":
							$mo("#edit_otp").css("display", "block");
							$mo("#validate_otp").css("display", "block");
							setMessage(response.message, "green");

							txId = response.txId;
							if (isSecond) {
								clearInterval(timerId);
							} else {
								timeLeft = 30;
							}
							$mo("#validate_otp").click(function (e) {
								e.preventDefault();
								otp = $mo("#edit_otp").val();
								validateOTP(otp, nonce, phone, txId, email);
							});
							timerId = setInterval(countdown, 1000);

							function countdown() {
								if (timeLeft === 0) {
									clearTimeout(timerId);
									$mo("#otp_send_button").css("display", "block");
									$mo("#timer").css("display", "none");
									$mo("#otp_send_button").text(
										otpverificationStringsObj.resend_otp
									);
								} else {
									$mo("#timer").css("display", "block");
									$mo("#otp_send_button").css("display", "none");
									$mo("#timer").text(timeLeft);
									timeLeft--;
								}
							}
							break;
							case "FAILED":
							case "ERROR":
								$mo("#otp_send_button").text(otpverificationStringsObj.send_otp);
								setMessage(response.message, "red");
								break;
						}
					}
				});
			}
			function validateOTP(otp, nonce, phone, txId, email) {
			let data = {
				action: "mo_shortcode",
				mo_action: "validate",
				otp: otp,
				nonce: nonce,
				mobile: phone,
				txId: txId,
				email: email,
			};
			if (isValidated === false) {
				$mo.post(ajaxurl, data, function (response) {
					if (response === null) {
						mo2f_setMessage("validation_error", "red");
						isValidated = false;
					} else
						switch (response.status) {
							case "SUCCESS":
								setMessage(response.message, "green");
								isValidated = true;
								if (submitSelector === ".ur-submit-button") {
									setTimeout(function () {
										location.reload();
									}, 15000);
								}
								if(formSubmit == 'true'){
									$mo(submitSelector).unbind("click").click();
								}else{
									$mo(submitSelector).unbind("click"); 
								}
								return true;
							case "FAILED":
								setMessage(response.message, "red");
								$mo(submitSelector).removeAttr("disabled");
								return false;
							case "ERROR":
								$mo(submitSelector).removeAttr("disabled");
								return false;
						}
				});
			} else {
			}
		}
		function validateBoth(otp, nonce, phone, txId, email, isFirst) {
			let data = {
				action: "mo_shortcode",
				mo_action: "validate",
				otp: otp,
				nonce: nonce,
				mobile: phone,
				txId: txId,
				email: email,
			};

			if (isValidated === false) {
				if (isFirst)
					$mo.post(ajaxurl, data, function (response) {
						isFirst = false;

						if (response === null) {
							mo2f_setMessage("validation_error", "red");
							isValidated = false;
						} else
							switch (response.status) {
								case "SUCCESS":
									setMessage(
										phone +
											" " +
											response.message +
											" " +
											otpverificationStringsObj.sending_otp +
											email,
										"green"
									);

									isValidated = false;
									isSecond = true;

                                    setTimeout(function () {
                                        sendChallenge('email',null,email,nonce,ajaxurl)
                                    },3000)

									$mo("#edit_otp").val("");
									$mo("#edit_otp").css(
										"placeholder",
										otpverificationStringsObj.enter_otp
									);
									$mo("#reg_phone").after(
										'<br><p style="color:green;">' +
											otpverificationStringsObj.phone_validated +
											"</p>"
									);
									$mo("#reg_phone").attr("disabled", "true");
									$mo(submitSelector).text(otpverificationStringsObj.register);

									$mo(submitSelector).click(function (e) {
										if (isValidated == false) {
											e.preventDefault();
											otp = $mo("#edit_otp").val();
											validateOTP(otp, nonce, phone, txIdNew, email);
										}
									});
									break;
								case "FAILED":
									setMessage(response.message, "red");
									break;
								case "ERROR":
									setMessage(response.message, "red");
									break;
							}
					});
			} else {
				mo2f_setMessage("already_validated", "red");
				jQuery.reload();
			}
		}

		let phone, email, otp;
		switch (authType) {
			case "phone":
				if (!$mo(phoneSelector).length) {
					const messageNotRegistered =
						'<p id="phoneFieldLabel" style="color: red;font-size: 18px;border: red 1px solid;padding: 5px" >' +
						otpverificationStringsObj.phone_field_not_found +
						"</p>";
					$mo(emailSelector).after("<br>" + messageNotRegistered);
					return;
				}
				$mo(phoneSelector).after(
					messageTextMobile + otpEdit + sendButton + validateButton
				);
				$mo(phoneSelector).intlTelInput({});
				$mo("#otp_send_button").click(function () {
					phone = $mo(phoneSelector).val();
					phone = phone.replace(/\s+/g, "");
					email = $mo(emailSelector).val();
					if (!validatePhone(phone)) {
						mo2f_setMessage("invalid_phone", "red");
						return;
					}
					if (!validateEmail(email)) {
						mo2f_setMessage("invalid_email", "red");
						return;
					}
					isSecond = false;
                    sendChallenge(authType,phone,null,nonce,ajaxurl)
				});

				$mo(submitSelector).click(function (e) {
					e.preventDefault();
					if (isValidated === false) {
						otp = $mo("#edit_otp").val();
						if (!otp) {
							mo2f_setMessage("validate_phone", "red");
						} else validateOTP(otp, nonce, phone, txId, email);
					} else {
					}
				});

				break;

			case "email":
				if ($mo("#reg_passmail").length) {
					$mo("#reg_passmail").css("visibility", "hidden");
					$mo(".clear").remove();
				}

				let a = $mo(emailSelector).attr("class");
				$mo("#edit_otp").addClass(a);

				let b = $mo(submitSelector).attr("class");
				$mo("#otp_send_button").attr("class", b);

				if (!$mo(emailSelector).length) {
					const messageNotRegistered =
						'<p id="emailFieldLabel" style="color: red;font-size: 18px;border: red 1px solid;padding: 5px" > ' +
						otpverificationStringsObj.email_field +
						emailSelector +
						otpverificationStringsObj.not_found +
						"</p>";
					if ($mo(formName).length)
						$mo(formName).after("<br>" + messageNotRegistered);
					else if ($mo(submitSelector).length)
						$mo(submitSelector).after("<br>" + messageNotRegistered);
					return;
				}

				$mo(emailSelector).after(
					messageTextEmail + otpEdit + sendButton + validateButton
				);

				$mo("#otp_send_button").click(function () {
					email = $mo(emailSelector).val();
					if (!validateEmail(email)) {
						mo2f_setMessage("invalid_email", "red");
						return;
					}
					isSecond = false;
                    sendChallenge(authType,null,email,nonce,ajaxurl)
				});

				$mo(submitSelector).click(function (e) {
					e.preventDefault();
					if (isValidated === false) {
						otp = $mo("#edit_otp").val();
						if (!otp) {
							mo2f_setMessage("validate_email", "red");
						} else validateOTP(otp, nonce, phone, txId, email);
					} else {
					}
				});

				break;

			case "both":
				$mo(emailSelector).after(
					"<br>" + messageTextBoth + otpEdit + sendButton + validateButton
				);
				$mo(phoneSelector).intlTelInput({});
				if (!$mo(phoneSelector).length) {
					const messageNotRegistered =
						'<p id="phoneFieldLabel" style="color: red;font-size: 18px;border: red 1px solid;padding: 5px" > ' +
						otpverificationStringsObj.phone_field_not_found +
						"</p>";
					$mo(emailSelector).after("<br>" + messageNotRegistered);
					return;
				}
				$mo("#otp_send_button").click(function () {
					phone = $mo(phoneSelector).val();
					phone = phone.replace(/\s+/g, "");
					email = $mo(emailSelector).val();
					if (!validatePhone(phone)) {
						mo2f_setMessage("invalid_phone", "red");
						return;
					}
					if (!validateEmail(email)) {
						mo2f_setMessage("invalid_email", "red");
						return;
					} 
          if (!isSecond)
                        sendChallenge('phone', phone, null, nonce, ajaxurl)
                    else
                    {
                        sendChallenge('email', null, email, nonce, ajaxurl)
                        $mo(submitSelector).text(otpverificationStringsObj.register);
                    }
					$mo(submitSelector).text(otpverificationStringsObj.validate_otp);
				});

				$mo(submitSelector).click(function (e) {
					e.preventDefault();
					if (isValidated === false) {
						email = $mo(emailSelector).val();
						otp = $mo("#edit_otp").val();
						if (!otp || !email) {
							mo2f_setMessage("validate_both", "red");
						} else validateBoth(otp, nonce, phone, txId, email, true);
					} else {
					}
				});
		}

		function validateEmail(email_address) {
			let email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
			if (!email_regex.test(email_address)) {
				return false;
			}
			return true;
		}
		function validatePhone(phone) {
			let intRegex = /[0-9 -()+]+$/;
			if (phone.length < 10 || phone.length == 0 || !intRegex.test(phone)) {
				return false;
			}
			return true;
		}
	} else {
	}
});
