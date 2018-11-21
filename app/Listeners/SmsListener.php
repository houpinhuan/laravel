<?php namespace App\Listeners;

use Illuminate\Http\Request;

class SmsListener
{

	private $request;

	private $account = 'I2811076';
	private $password = 'Rsdf9UlOn';
	private $send_url = 'http://intapi.253.com/send/json?';


	/**
     * 创建监听器
     *
     * 构造函数
     */
    public function __construct(Request $request) {

        $this->request = $request;

    }

    public function onSendPwd($event) {

    	$mobile = '86' . $event->getMobile();
    	$id = $event->getId();
    	$password = $event->getPassword();

    	$data = [
    		'account' => $this->account,
    		'password' => $this->password,
    		'msg' => "【意约】欢迎使用代理服务，您的代理账号为：{$id}，密码为：{$password}",
    		'mobile' => $mobile
    	];

    	$this->_curl_post($this->send_url, $data);

    }

    private function _curl_post($url, $data) {

		$ch = curl_init ();
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type: application/json; charset=utf-8'
		]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_TIMEOUT, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		$ret = curl_exec($ch);echo $ret;
		if (false == $ret) 
		{
			$result = curl_error($ch);
		} else {
			$rsp = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if (200 !== $rsp) 
			{
				$result = "请求状态 ". $rsp . " " . curl_error($ch);
			} else {
				$result = $ret;
			}
		}

		curl_close($ch);
		return $result;

    }


    /**
     * @param $events
     *
     * 为订阅者注册监听器
     */
    public function subscribe($events) {

        $events->listen(
            'App\Events\SendPwdEvent',
            'App\Listeners\SmsListener@onSendPwd'
        );
    }

}