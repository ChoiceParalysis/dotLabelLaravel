<?php namespace Acme\Transformers;

class HostTransformer extends Transformer
{

	/**
	 * Transform the host object to avoid direct repository and API linking
	 * @param  array $host 
	 * @return array
	 */
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