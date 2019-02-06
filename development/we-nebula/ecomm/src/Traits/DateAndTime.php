<?php

namespace nebula\we\Traits;

Trait DateAndTime{
	function setDate($date){
        $this->memorize('current_date',$date);
        $this->now = date('Y-m-d H:i:s',strtotime($date));
        $this->today = date('Y-m-d',strtotime($date));
    }
}