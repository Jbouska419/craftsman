<?php
/**
 * @package	HikaShop for Joomla!
 * @version	2.3.1
 * @author	hikashop.com
 * @copyright	(C) 2010-2014 HIKARI SOFTWARE. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?><?php
class plgHikashoppaymentPaypalAdvanced extends hikashopPaymentPlugin {

	var $name = 'paypaladvanced'; //Payment plugin name (the name of the PHP file)
	var $accepted_currencies = array (
		'USD','AUD','BRL','CAD','CHF','CZK','DKK','EUR','GBP','HDK','HUF','ILS','JPY','MXN','MYR','NOK','NZD','PHP','PLN','SEK','SGD','THB','TRY','TWD'
	);
	var $doc_form = 'paypaladvanced';
	var $multiple = true;

	function __construct(& $subject, $config) {
		parent::__construct($subject, $config);
	}

	function onPaymentConfiguration(&$element) {
		parent::onPaymentConfiguration($element);
		$secret_code = @$element->payment_params->secret_code;
		if(empty($secret_code)) {
			$secret_code = uniqid('').'_'.time()."p";
		}

		$this->secret_code = '<input type="hidden" name="data[payment][payment_params][secret_code]" value="'.$secret_code.'"/>
		Make sure that the "Use Silent Post" field is set to "Yes" in your <a href="https://manager.paypal.com/loginPage.do">PayPal manager</a> account.<br/>
		If you want to use the Iframe type of display, make sure you select the Layout C in your <a href="https://manager.paypal.com/loginPage.do">PayPal manager</a> account and otherwise, select either A or B.';

		$pb = '';
		if(empty($element->payment_params->vendor)){
			$pb .=', '.JText::_('ATOS_MERCHANT_ID');
		}

		if(empty($element->payment_params->partner)){
			$pb .=', '.JText::_('PARTNER');
		}

		if (empty ($element->payment_params->password)){
			$pb .=', '.JText::_('HIKA_PASSWORD');
		}

		if(!empty($pb)){
			$app = JFactory::getApplication();
			$app->enqueueMessage(JText::sprintf('ENTER_INFO_REGISTER_IF_NEEDED', 'PayPal Advanced', $pb, 'PayPal Advanced', 'https://www.paypal.com/webapps/mpp/paypal-payments-advanced'));
		}
	}

	function onAfterOrderConfirm(&$order, &$methods, $method_id) {
		parent::onAfterOrderConfirm($order, $methods, $method_id); // This is a mandatory line in order to initialize the attributes of the payment method

		$notify_url = (HIKASHOP_LIVE.'paypaladvanced_'.$method_id.'_'.$this->payment_params->secret_code.'.php');
		$cancel_url = (HIKASHOP_LIVE.'paypaladvanced_'.$method_id.'.php?from_user=cancel');
		$return_url = (HIKASHOP_LIVE.'paypaladvanced_'.$method_id.'.php?from_user=return');//return URL to the page of redirection created in onPaymentConfigurationSave(), this can't change

		$vars = array (//required variables for the PayPal Advanced transaction
			'USER' => $this->payment_params->user,
			'PWD' => $this->payment_params->password,
			'VENDOR' => $this->payment_params->vendor,
			'PARTNER' => $this->payment_params->partner,
			'SECURETOKENID' => uniqid('',true), 
			'SECURETOKEN' => '',
			'AMT' => @ round($order->cart->order_full_price, (int)$this->currency->currency_locale['int_frac_digits']), 
			'SILENT_POST_URL' => $notify_url,
			'RETURN_URL' => $return_url,//see comments before to understand why it's not $this->payment_params->return_url
			'CANCEL_URL' => $cancel_url,
			'CURRENCYCODE' => $this->currency->currency_code,
			'EMAIL' => $this->user->user_email,
			'STREET' => @ $order->cart->billing_address->address_street,
			'STREET2' => @ $order->cart->billing_address->address_street2,
			'CITY' => @ $order->cart->billing_address->address_city,
			'STATE' => @ $order->cart->billing_address->address_state->zone_name,
			'COUNTRYCODE' => @ $order->cart->billing_address->address_country->zone_code_2,
			'ZIP' => @ $order->cart->billing_address->address_post_code,
			'HOST_ADDR' => 'https://payflowpro.paypal.com', //address to send the curl data to PayPal
		);

		echo $vars['AMT'];

		if($this->payment_params->test_mode=='1'){//if we are in test mode, the adress isn't the same
			$vars['HOST_ADDR']= 'https://pilot-payflowpro.paypal.com';
		}

		$postdata =
		"USER=" . $vars['USER'].
		"&VENDOR=" . $vars['VENDOR'].
		"&PARTNER=" . $vars['PARTNER'].
		"&PWD=" . $vars['PWD'].
		"&CREATESECURETOKEN=".'Y'.
		"&SECURETOKENID=".$vars['SECURETOKENID'].
		"&TRXTYPE=S".
		"&AMT=".$vars['AMT'].
		"&CURRENCY=".$vars['CURRENCYCODE'].
		"&SHOWAMOUNT=TRUE".
		"&INVNUM=".$order->order_id.
		"&SILENTPOSTURL=".$vars['SILENT_POST_URL'].
		"&RETURNURL=".$vars['RETURN_URL'].
		"&CANCELURL=".$vars['CANCEL_URL'].
		"&BILLTOEMAIL=".$vars['EMAIL'].
		"&BILLTOFIRSTNAME=".$order->cart->billing_address->address_firstname.
		"&BILLTOLASTNAME=".$order->cart->billing_address->address_lastname;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $vars['HOST_ADDR']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_POST, TRUE); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
		$resp = curl_exec($ch);

		if (!$resp) {
			echo "<p>No response from PayPal's servers, please try again. </p>";
		}

		$arr = null;
		parse_str($resp, $arr);

		if ($arr['RESULT']!=0) {
			echo "<p>An error has occurred, please try again.</p>";
		}


		$vars['SECURETOKEN'] = $arr['SECURETOKEN'];
		$this->vars = $vars;
		echo $this->getOrder((int)@$vars['invoice']);
		return $this->showPage('end');
	}


	function onPaymentNotification(&$statuses) {
		global $Itemid;
		$this->url_itemid = empty($Itemid) ? '' : '&Itemid=' . $Itemid;
		if(!empty($_REQUEST['from_user'])) {
			$app = JFactory::getApplication();
			$from_user = $_REQUEST['from_user'];
			switch($from_user) {
				case 'return':
					$url = HIKASHOP_LIVE.'index.php?option=com_hikashop&ctrl=checkout&task=after_end'.$this->url_itemid;
					break;
				case 'cancel':
					$url = HIKASHOP_LIVE.'index.php?option=com_hikashop&ctrl=order&task=cancel_order'.$this->url_itemid;
					break;
				default:
					$url = HIKASHOP_LIVE.'index.php?option=com_hikashop&ctrl=checkout&task=after_end'.$this->url_itemid;
					break;
			}
			$doc = JFactory::getDocument();
			$doc->addScriptDeclaration("window.hikashop.ready(function() {window.parent.location='".$url."'});");	
			return true;
		}

		$vars = array();
		$data = array();
		$filter = JFilterInput::getInstance();
		foreach($_REQUEST as $key => $value) {
			$key = $filter->clean($key);
			if(preg_match('#^[0-9a-z_-]{1,30}$#i', $key) && !preg_match('#^cmd$#i', $key)) {
				$value = JRequest::getString($key);
				$vars[$key] = $value;
				$data[] = $key . '=' . urlencode($value);
			}
		}

		if($this->payment_params->debug) {
			echo print_r($vars, true) . "\r\n\r\n";
		}

		$data = implode('&', $data) . '&cmd=_notify-validate';
		$order_id = (int)@$vars['INVNUM'];
		$dbOrder = $this->getOrder($order_id);
		$this->loadPaymentParams($dbOrder);

		if($this->payment_params->debug) {
			echo print_r($dbOrder, true) . "\r\n\r\n";
		}

		if(empty($this->payment_params))
			return false;

		if($vars['RESULT'] == '0') {//if payment is OK with the right security code 
			$history = new stdClass();
			$email = new stdClass();
			$email = new stdClass();
			$history->notified = 1;
			$history->amount = $vars['AMT'];
			$history->data = ob_get_clean();
			$email->subject = JText::sprintf('PAYMENT_NOTIFICATION_FOR_ORDER','PayPal Advanced',$vars['RESULT'],$dbOrder->order_number);
			$body = str_replace('<br/>',"\r\n",JText::sprintf('PAYMENT_NOTIFICATION_STATUS','PayPal Advanced',$vars['RESULT'])).' '.JText::sprintf('ORDER_STATUS_CHANGED',$this->payment_params->verified_status)."\r\n\r\n".$order_text;
			$email->body = $body;

			$Orderclass = hikashop_get('class.order');
			$order = $Orderclass->get($order_id);
			if($order->order_status != $this->payment_params->verified_status){
				$this->modifyOrder($order_id, $this->payment_params->verified_status, $history, $email);}

			return true;	
		}
		else if($vars['RESULT'] >= 126 && $vars['STATUS'] <= 128){//if it is blocked by the fraud protection service

			$email = new stdClass();
			$email->subject = JText::sprintf('NOTIFICATION_REFUSED_FOR_THE_ORDER', $this->name).'invalid response';
			$email->body = JText::sprintf("Hello,\r\n A PayPal Advanced notification was refused because the response from the PayPal Advanced server was invalid")."\r\n\r\n".$order_text;
			$Orderclass = hikashop_get('class.order');
			$order = $Orderclass->get($order_id);
			if($order->order_status != $this->payment_params->invalid_status)
				$this->modifyOrder($order_id, $this->payment_params->pending_status, false, $email);

			$app->enqueueMessage('Transaction Failed with the status number : '.$vars['RESULT']);

			return false;
		}
		else if($vars['RESULT'] >= 10 && $vars['STATUS'] < 126){ //if an error has occurred

			$email = new stdClass();
			$email->subject = JText::sprintf('NOTIFICATION_REFUSED_FOR_THE_ORDER', $this->name).'invalid response';
			$email->body = JText::sprintf("Hello,\r\n A PayPal Advanced notification was refused because the response from the PayPal Advanced server was invalid")."\r\n\r\n".$order_text;
			$Orderclass = hikashop_get('class.order');
			$order = $Orderclass->get($order_id);
			if($order->order_status != $this->payment_params->invalid_status)
				$this->modifyOrder($order_id, $this->payment_params->invalid_status, false, $email);

			$app->enqueueMessage('Transaction Failed with the status number : '.$vars['RESULT']);

			return false;
		}
	}



	function getPaymentDefaultValues(& $element) {
		$element->payment_name = 'Paypal Advanced';
		$element->payment_description = 'You can pay by credit card using this payment method';
		$element->payment_images = 'MasterCard,VISA,Credit_card,American_Express';
		$element->payment_params->address_type = "billing";
		$element->payment_params->notification = 1;
		$element->payment_params->invalid_status='cancelled';
		$element->payment_params->pending_status='created';
		$element->payment_params->verified_status='confirmed';
		$element->payment_params->return_url = '';
		$element->payment_params->cancel_url ='';
		$element->payment_params->height ='540';
		$element->payment_params->width ='570';
	}

	function onPaymentConfigurationSave(&$element) {
		parent::onPaymentConfigurationSave($element);
		$secret = $element->payment_params->secret_code;
		if(empty($element->payment_id)) {
			$pluginClass = hikashop_get('class.payment');
			$status = $pluginClass->save($element);
			if(!$status)
				return true;
			$element->payment_id = $status;
		}

		$app = JFactory::getApplication();
		jimport('joomla.filesystem.file');
		jimport('joomla.filesystem.path');
		$lang = JFactory::getLanguage();
		$locale = strtolower(substr($lang->get('tag'),0,2));
		$content = '<?php
		$_GET[\'option\']=\'com_hikashop\';
		$_GET[\'tmpl\']=\'component\';
		$_GET[\'ctrl\']=\'checkout\';
		$_GET[\'task\']=\'notify\';
		$_GET[\'notif_payment\']=\'paypaladvanced\';
		$_GET[\'format\']=\'html\';
		$_GET[\'lang\']=\''.$locale.'\';
		$_GET[\'notif_id\']=\''.$element->payment_id.'\';
		$_REQUEST[\'option\']=\'com_hikashop\';
		$_REQUEST[\'tmpl\']=\'component\';
		$_REQUEST[\'ctrl\']=\'checkout\';
		$_REQUEST[\'task\']=\'notify\';
		$_REQUEST[\'notif_payment\']=\'paypaladvanced\';
		$_REQUEST[\'format\']=\'html\';
		$_REQUEST[\'lang\']=\''.$locale.'\';
		$_REQUEST[\'notif_id\']=\''.$element->payment_id.'\';
		include(\'index.php\');';
		JFile::write(JPATH_ROOT.DS.'paypaladvanced_'.$element->payment_id.'.php', $content);
		JFile::write(JPATH_ROOT.DS.'paypaladvanced_'.$element->payment_id.'_'.$secret.'.php', $content);

		return true;
	}


}

?>
