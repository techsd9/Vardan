<?php

include_once('two_fa_short_gateway.php');

class TwoFACustomRegFormAPI
{
    public function __construct()
    {

    }

    public static function challenge($phone_number,$email,$authTypeSend)
    {

        if($authTypeSend == 'email')
        {
            $auierpyasdcRy  = MoWpnsUtility::get_mo2f_db_option('cmVtYWluaW5nT1RQ', 'site_option');
            $cmVtYWluaW5nT1RQ 	= $auierpyasdcRy? $auierpyasdcRy : 0;
            if($cmVtYWluaW5nT1RQ > 0)
            {
                $response = TwoFAMOGateway:: mo_send_otp_token('EMAIL', '', $email);
                update_site_option("cmVtYWluaW5nT1RQ",$cmVtYWluaW5nT1RQ-1);
            }
            else
            {
                $response = ['status'=>'ERROR','message'=>__('Email Transaction Limit Exceeded', 'miniorange-2-factor-authentication')];
                wp_send_json($response);
            }
        }
        else
        { 
            $response = TwoFAMOGateway::  mo_send_otp_token('SMS', $phone_number, $email);
        }
        if(isset($response['status']) && isset($response['message']) && $response['status'] == 'ERROR' && strpos($response['message'],'curl extension')!== false){
            $response['message'] = 'Please enable curl extension.';
        }
        if(isset( $response['phoneDelivery']) && isset( $response['phoneDelivery']['contact']))
        $response['message'] = Mo2fConstants:: langTranslate('SENT_OTP') . " " . MO2f_Utility::get_hidden_phone( $response['phoneDelivery']['contact'] ) . Mo2fConstants:: langTranslate('ENTER_SENT_OTP');
        else if(isset( $response['emailDelivery']) && isset( $response['emailDelivery']['contact']))
        $response['message'] = Mo2fConstants:: langTranslate('SENT_OTP') . " " . MO2f_Utility::get_hidden_phone( $response['emailDelivery']['contact'] ) . Mo2fConstants:: langTranslate('ENTER_SENT_OTP');
        else if(isset($response['message']))
        $response['message'] = Mo2fConstants:: langTranslate($response['message']);

        wp_send_json($response);
    }

    public static function validate($txId, $otp)
    {
        $response = TwoFAMOGateway :: mo_validate_otp_token('OTP',$txId, $otp);
        if(isset($response['message']))
        $response['message'] = Mo2fConstants:: langTranslate($response['message']);
        wp_send_json($response);
    }
}