<?php
namespace SimpleAbstractPdo;

use SimpleAbstractPdo\DBInterface;

class DB implements DBInterface
{
	
	protected $table;
	
	protected $primarykey = "id";

	private $db;
	
	public $columns;

	private $parameters;

	private $columnsFomatedToSql;

	private $query;

	public function __construct()
	{
		$this->db = new \PDO("mysql:host=localhost;dbname=pdo;charset=UTF8", "root", "elite7");	
	}

	
	public function __set($var, $val)
	{
    	$this->columns[$var] = $val;
  	}

  	public function __get($var)
  	{
    	return isset($this->params[$var]) ? $this->params[$var] : "";
  	}


  	public function setColumnsFomatedToSql()
  	{
  		$columns = implode(',', array_keys($this->columns));
  		$this->columnsFomatedToSql = $columns;
  	}

  	public function getColumnsFomatedToSql()
  	{
  		$this->setColumnsFomatedToSql();
  		return $this->columnsFomatedToSql;
  	}


  	public function setParameters()
  	{
  		$columns = ':' . implode(',:', array_keys($this->columns));
  		$this->parameters = $columns;
  	}

  	public function getParameters()
  	{
  		$this->setParameters();	
  		
  		return $this->parameters;
  	}


  	public function save()
  	{
  		$query = "insert into {$this->table} ({$this->getColumnsFomatedToSql()}) values ({$this->getParameters()})";
		$stmt = $this->db->prepare($query);

		foreach ($this->columns as $key => $value) {
			$stmt->bindValue(":{$key}", $value);			
		}

		$stmt->execute();
  	}


	public function delete($id)
	{
		$this->query = "delete from {$this->table} where {$this->primarykey} = {$id} ";
		$stmt = $this->db->prepare($this->query);
		$stmt->bindValue(':{$this->primarykey}', $id);

		$stmt->execute();
	}

	public function update($id)
	{
		
		$update = "";

		foreach ($this->columns as $key => $value) {
		  $update .= "{$key} = :{$key},";			
		}

		$update = substr($update, 0, -1);

		$query = "update {$this->table} set {$update} where {$this->primarykey} = {$id}";		

		$stmt = $this->db->prepare($query);

		foreach ($this->columns as $key => $value) {
			$stmt->bindValue(":{$key}", $value);			
		}

		$stmt->execute();
	}

	public function list()
	{
		
	}

	public function findColumnsB($id = 17)
	{
		$query = "SELECT `COLUMN_NAME` 
					FROM `INFORMATION_SCHEMA`.`COLUMNS` 
					WHERE `TABLE_SCHEMA`='pdo' 
					AND `TABLE_NAME`='clientes'";
		$stmt = $this->db->prepare($query);
		
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function setColumns()
	{
		$query = "SELECT * from {$this->table} limit 1";
		$stmt = $this->db->prepare($query);
		
		$stmt->execute();

		$columns = $stmt->fetch(\PDO::FETCH_ASSOC);
		$columns = array_keys($columns);

		$this->columns = $columns;
		return $this;
	}

	public function getColumns__()
	{
		return $this->columns;
	}

	public function find($id)
	{
		$query = "select * from {$this->table} where id = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue('id', $id);
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}
}