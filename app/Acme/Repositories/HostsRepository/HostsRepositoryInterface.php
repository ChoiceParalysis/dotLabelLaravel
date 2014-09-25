<?php namespace Acme\Repositories\HostsRepository;

interface HostsRepositoryInterface
{

	public function create($attributes);

	public function update($host, $updates);

	public function delete($id);

	public function all();

	public function find($id);



}