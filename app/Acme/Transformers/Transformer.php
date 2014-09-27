<?php namespace Acme\Transformers;

class Transformer
{
	/**
	 * Method to transform a collection of items
	 * @param  array  $items
	 * @return array 
	 */
	public function transformCollection(array $items)
	{
		return array_map([$this, 'transform'], $items);
	}

}