<?php

class Host extends Eloquent
{
	
	protected $table = 'authorised_host';
	protected $fillable = ['ipaddress', 'subnet', 'description', 'enabled'];
}