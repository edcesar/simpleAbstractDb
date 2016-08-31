<?php
namespace src\Models;

use \SimpleAbstractPdo\DB;

class Cliente extends DB
{

	protected $table = "clientes";

	protected $primaryKey = "id";
}