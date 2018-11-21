<?php

namespace App\Main\Reward;

use Illuminate\Database\Eloquent\Model;

class RewardSetting extends Model
{
    protected $table = 'reward_setting';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
