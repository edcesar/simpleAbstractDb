<?php
class ServiceDB
{
	private $id;

	private $db;

	private $cliente;

	protected $table = "clientes";

	public function __construct(\PDO $db, Cliente $cliente)
	{
		$this->db = $db;
		$this->cliente = $cliente;
	}

	public function insert()
	{
		$query = "insert into clientes (nome, email) values(:nome, :email)";

		$stmt = $this->db->prepare($query);

		$stmt->bindValue(':nome', $this->cliente->getNome());
		$stmt->bindValue(':email', $this->cliente->getEmail());
		$stmt->execute();

		$lastId = $this->db->lastInsertId();

		$this->id = $lastId;

		return $this;

	}

	public function delete($id)
	{
		$query = "delete from clientes where id = :id";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue('id', $id);
		$stmt->execute();

		if($stmt){
			return true;
		}
			return false;
	}

	public function update()
	{
		$query = "update clientes set nome = :nome, email = :email where id = :id";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':nome', $this->cliente->getNome());
		$stmt->bindValue(':email', $this->cliente->getEmail());
		$stmt->bindValue(':id', $this->cliente->getId());

		$stmt->execute();

		if($stmt){
			return true;
		}
			return false;
	}

	public function list()
	{
		$query = "select * from clientes";
		$stmt = $this->db->query($query);
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
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