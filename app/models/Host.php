<?php

class Host extends Eloquent
{

	protected $table = 'authorised_host';
	protected $fillable = ['ipaddress', 'subnet', 'description', 'enabled'];


	protected function getEnabledAttribute($value)
	{
		return (boolean) $value;
	}

}