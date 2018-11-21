<?php namespace App\Events;

use App\Events\Event;

class SendPwdEvent extends Event
{

	private $id;

	private $password;

	private $mobile;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id, $password, $mobile) {

        $this->id = $id;
        $this->password = $password;
        $this->mobile = $mobile;

    }

    public function getId() {

    	return $this->id;

    }


    public function getPassword() {

    	return $this->password;

    }

    public function getMobile() {

    	return $this->mobile;

    }

}
