<?php namespace Acme\Transformers;

class HostTransformer extends Transformer
{

	public function transform($host)
	{
		return [

			'id' => $host['id'],
			'ipaddress' => $host['ipaddress'],
			'subnet' => $host['subnet'],
			'description' => $host['description'],
			'enabled' => $host['enabled']

		];
	}

}