<?php
namespace SimpleAbstractPdo;

interface DBInterface
{
	public function save();

	public function update();

	public function delete();

	public function find();
}