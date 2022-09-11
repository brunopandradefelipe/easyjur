<?php
namespace App\Models;

final class UserModel 
{
    /**
     * @var int
     */
    private $user_id; // Chave Primaria

    /**
     * @var string
     */
    private $login; // Obrigatório - Nome de Usúario

    /**
     * @var string
     */
    private $name; // Obrigatório - Nome

    /**
     * @var string
     */
    private $cpf; // Obrigatório - CPF

	/**
     * @var string
     */
    private $telefone; // Obrigatório - Telefone

    /**
     * @var string
     */
    private $email; // Obrigatório - Email

    /**
     * @var string
     */
    private $password; // Obrigatório - Senha

    /**
     * @var string
     */
    private $admin; // Obrigatório - Nivel Permissao

    /**
     * @var string
     */
    private $created_at; // Obrigatório - Data de Criação

    /**
     * @var string
     */
    private $update_at; // Obrigatório - Data De Atualização

    /**
     * Dados para atualização de dados - UPDATE
     *
     * @return array
     */
    public function getArrayUpdate(): array
    {
        $data = [
            'user_id' => $this->getId(),
            'name' => $this->getName(),
            'cpf' => $this->getCpf(),
			'telefone' => $this->getTelefone(),
            'login' => $this->getLogin(),
            'senha' => $this->getPassword(),
            'email' => $this->getEmail(),
            'admin' => $this->getAdmin(),
            'update_at' => $this->getUpdateAt(),
        ];
        return $data;
    }

    /**
     * Dados para persistencia de dados - INSERT
     *
     * @return array
     */
    public function getArrayInsert(): array
    {
        $data = [
            'name' => $this->getName(),
            'cpf' => $this->getCpf(),
			'telefone' => $this->getTelefone(),
            'login' => $this->getLogin(),
            'senha' => $this->getPassword(),
            'email' => $this->getEmail(),
            'admin' => $this->getAdmin(),
        ];
        return $data;
    }

    /**
     * Set Dados Model
     *
     * @param array|null $user
     * @return UserModel
     */
    public static function setUser(?array $user): UserModel
    {
        if ($user != null) {
            $user =  isset($user) ? $user : $user;
            $userModelRetorno = new self();
            foreach ($user as $key => $campo) {
                if (strcmp($key, 'user_id') == 0) {
                    $userModelRetorno->setId($campo);
                } elseif (strcmp($key, 'name') == 0) {
                    $userModelRetorno->setName($campo);
                } elseif (strcmp($key, 'cpf') == 0) {
                    $userModelRetorno->setCpf($campo);
                } elseif (strcmp($key, 'telefone') == 0) {
                    $userModelRetorno->setTelefone($campo);
                } elseif (strcmp($key, 'login') == 0) {
                    $userModelRetorno->setLogin($campo);
                } elseif (strcmp($key, 'senha') == 0) {
                    $userModelRetorno->setPassword($campo);
                } elseif (strcmp($key, 'email') == 0) {
                    $userModelRetorno->setEmail($campo);
                } elseif (strcmp($key, 'admin') == 0) {
                    $userModelRetorno->setAdmin($campo);
                } elseif (strcmp($key, 'created_at') == 0) {
                    $userModelRetorno->setCreatedAt($campo);
                } elseif (strcmp($key, 'update_at') == 0) {
                    $userModelRetorno->setUpdateAt($campo);
                }
            }
        } else {
            $userModelRetorno = null;
        }
        return $userModelRetorno;
    }

	/**
	 * Pega o valor de user_id
	 *
	 * @return int
	 */
	
	public function getId(): ?int
	{
		return $this->user_id;
	}

	/**
	 * Seta um valor user_id
	 *
	 * @param   int  $user_id  
	 *
	 * @return  self
	 */
	
	public function setId(?int $user_id): void
	{
		if (empty($user_id)) {
			$user_id = null;
		} 
		$this->user_id = $user_id;
	}

	/**
	 * Pega o valor de login
	 *
	 * @return string
	 */
	
	public function getLogin(): ?string
	{
		return $this->login;
	}

	/**
	 * Seta um valor login
	 *
	 * @param   string  $login  
	 *
	 * @return  self
	 */
	
	public function setLogin(?string $login): void
	{
		if (empty($login)) {
			$login = null;
		} 
		$this->login = $login;
	}

	/**
	 * Pega o valor de name
	 *
	 * @return string
	 */
	
	public function getName(): ?string
	{
		return $this->name;
	}

	/**
	 * Seta um valor name
	 *
	 * @param   string  $name  
	 *
	 * @return  self
	 */
	
	public function setName(?string $name): void
	{
		if (empty($name)) {
			$name = null;
		} 
		$this->name = $name;
	}

	/**
	 * Pega o valor de cpf
	 *
	 * @return string
	 */
	
	public function getCpf(): ?string
	{
		return $this->cpf;
	}

	/**
	 * Seta um valor cpf
	 *
	 * @param   string  $cpf  
	 *
	 * @return  self
	 */
	
	public function setCpf(?string $cpf): void
	{
		if (empty($cpf)) {
			$cpf = null;
		} 
		$this->cpf = $cpf;
	}

	/**
	 * Pega o valor de email
	 *
	 * @return string
	 */
	
	public function getEmail(): ?string
	{
		return $this->email;
	}

	/**
	 * Seta um valor email
	 *
	 * @param   string  $email  
	 *
	 * @return  self
	 */
	
	public function setEmail(?string $email): void
	{
		if (empty($email)) {
			$email = null;
		} 
		$this->email = $email;
	}

	/**
	 * Pega o valor de password
	 *
	 * @return string
	 */
	
	public function getPassword(): ?string
	{
		return $this->password;
	}

	/**
	 * Seta um valor password
	 *
	 * @param   string  $password  
	 *
	 * @return  self
	 */
	
	public function setPassword(?string $password): void
	{
		if (empty($password)) {
			$password = null;
		} 
		$this->password = $password;
	}

	/**
	 * Pega o valor de admin
	 *
	 * @return string
	 */
	
	public function getAdmin(): ?string
	{
		return $this->admin;
	}

	/**
	 * Seta um valor admin
	 *
	 * @param   string  $admin  
	 *
	 * @return  self
	 */
	
	public function setAdmin(?string $admin): void
	{
		if (empty($admin)) {
			$admin = null;
		} 
		$this->admin = $admin;
	}

	/**
	 * Pega o valor de created_at
	 *
	 * @return string
	 */
	
	public function getCreatedAt(): ?string
	{
		return $this->created_at;
	}

	/**
	 * Seta um valor created_at
	 *
	 * @param   string  $created_at  
	 *
	 * @return  self
	 */
	
	public function setCreatedAt(?string $created_at): void
	{
		if (empty($created_at)) {
			$created_at = null;
		} 
		$this->created_at = $created_at;
	}

	/**
	 * Pega o valor de update_at
	 *
	 * @return string
	 */
	
	public function getUpdateAt(): ?string
	{
		return $this->update_at;
	}

	/**
	 * Seta um valor update_at
	 *
	 * @param   string  $update_at  
	 *
	 * @return  self
	 */
	
	public function setUpdateAt(?string $update_at): void
	{
		if (empty($update_at)) {
			$update_at = null;
		} 
		$this->update_at = 'NOW()';
	}

	/**
	 * Get the value of telefone
	 *
	 * @return string
	 */
	
	public function getTelefone(): ?string
	{
		return $this->telefone;
	}

	/**
	 * Set the value of telefone
	 *
	 * @param   string  $telefone  
	 *
	 * @return  self
	 */
	
	public function setTelefone(?string $telefone): void
	{
		if (empty($telefone)) {
			$telefone = null;
		} 
		$this->telefone = $telefone;
	}
}