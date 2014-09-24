<?php namespace Acme\Transformers;

class Transformer
{

	public function transformCollection(array $items)
	{

		return array_map([$this, 'transform'], $items);

	}

}