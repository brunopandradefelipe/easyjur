<?php
namespace App\Models;

final class TaskModel 
{
    /**
     * @var int
     */
    private $task_id; // Chave Primaria

	/**
     * @var int
     */
    private $user_id; // Chave Estrangeira / Ref tabela: users

    /**
     * @var string
     */
    private $task_name; // Obrigatório - Nome da Tarefa

    /**
     * @var string
     */
    private $task_description; // Obrigatório - Descrição da Tarefa

	/**
     * @var string
     */
    private $status; // Obrigatório - Descrição da Tarefa

    /**
     * @var string
     */
    private $create_at; // Obrigatório - Data de Criação

	/**
     * @var string
     */
    private $update_at; // Obrigatório - Data de atualização

	/**
     * @var string
     */
    private $date_conclusion; // Obrigatório - Data de conclusão


    /**
     * Dados para atualização de dados - UPDATE
     *
     * @return array
     */
    public function getArrayUpdate(): array
    {
        $data = [
			'task_id' => $this->getId(),
            'user_id' => $this->getUserId(),
			'task_name' => $this->getTaskName(),
			'task_description' => $this->getTaskDescription(),
			'status' => $this->getStatus(),
			'update_at' => $this->getUpdateAt(),
			'date_conclusion' => $this->getDateConclusion()
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
			'task_id' => $this->getId(),
            'user_id' => $this->getUserId(),
			'task_name' => $this->getTaskName(),
			'task_description' => $this->getTaskDescription(),
			'status' => $this->getStatus(),
        ];
        return $data;
    }

    /**
     * Set Dados Model
     *
     * @param array|null $task
     * @return TaskModel
     */
    public static function setTask(?array $task): TaskModel
    {
        if ($task != null) {
            $task =  isset($task) ? $task : $task;
            $taskModelRetorno = new self();
            foreach ($task as $key => $campo) {
                if (strcmp($key, 'task_id') == 0) {
                    $taskModelRetorno->setId($campo);
                } elseif (strcmp($key, 'user_id') == 0) {
                    $taskModelRetorno->setUserId($campo);
                } elseif (strcmp($key, 'task_name') == 0) {
                    $taskModelRetorno->setTaskName($campo);
                } elseif (strcmp($key, 'task_description') == 0) {
                    $taskModelRetorno->setTaskDescription($campo);
                } elseif (strcmp($key, 'status') == 0) {
                    $taskModelRetorno->setStatus($campo);
                } elseif (strcmp($key, 'create_at') == 0) {
                    $taskModelRetorno->setCreateAt($campo);
                } elseif (strcmp($key, 'update_at') == 0) {
                    $taskModelRetorno->setUpdateAt($campo);
                } elseif (strcmp($key, 'date_conclusion') == 0) {
                    $taskModelRetorno->setDateConclusion($campo);
                }
            }
        } else {
            $taskModelRetorno = null;
        }
        return $taskModelRetorno;
    }

	/**
	 * Get the value of task_id
	 *
	 * @return int
	 */
	
	public function getId(): ?int
	{
		return $this->task_id;
	}

	/**
	 * Set the value of task_id
	 *
	 * @param   int  $task_id  
	 *
	 * @return  self
	 */
	
	public function setId(?int $task_id): void
	{
		if (empty($task_id)) {
			$task_id = null;
		} 
		$this->task_id = $task_id;
	}

	/**
	 * Get the value of user_id
	 *
	 * @return int
	 */
	
	public function getUserId(): ?int
	{
		return $this->user_id;
	}

	/**
	 * Set the value of user_id
	 *
	 * @param   int  $user_id  
	 *
	 * @return  self
	 */
	
	public function setUserId(?int $user_id): void
	{
		if (empty($user_id)) {
			$user_id = null;
		} 
		$this->user_id = $user_id;
	}

	/**
	 * Get the value of task_name
	 *
	 * @return string
	 */
	
	public function getTaskName(): ?string
	{
		return $this->task_name;
	}

	/**
	 * Set the value of task_name
	 *
	 * @param   string  $task_name  
	 *
	 * @return  self
	 */
	
	public function setTaskName(?string $task_name): void
	{
		if (empty($task_name)) {
			$task_name = null;
		} 
		$this->task_name = $task_name;
	}

	/**
	 * Get the value of task_description
	 *
	 * @return string
	 */
	
	public function getTaskDescription(): ?string
	{
		return $this->task_description;
	}

	/**
	 * Set the value of task_description
	 *
	 * @param   string  $task_description  
	 *
	 * @return  self
	 */
	
	public function setTaskDescription(?string $task_description): void
	{
		if (empty($task_description)) {
			$task_description = null;
		} 
		$this->task_description = $task_description;
	}

	/**
	 * Get the value of create_at
	 *
	 * @return string
	 */
	
	public function getCreateAt(): ?string
	{
		return $this->create_at;
	}

	/**
	 * Set the value of create_at
	 *
	 * @param   string  $create_at  
	 *
	 * @return  self
	 */
	
	public function setCreateAt(?string $create_at): void
	{
		if (empty($create_at)) {
			$create_at = null;
		} 
		$this->create_at = "NOW()";
	}

	/**
	 * Get the value of update_at
	 *
	 * @return string
	 */
	
	public function getUpdateAt(): ?string
	{
		return $this->update_at;
	}

	/**
	 * Set the value of update_at
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
		$this->update_at = $update_at;
	}

	/**
	 * Get the value of date_conclusion
	 *
	 * @return string
	 */
	
	public function getDateConclusion(): ?string
	{
		return $this->date_conclusion;
	}

	/**
	 * Set the value of date_conclusion
	 *
	 * @param   string  $date_conclusion  
	 *
	 * @return  self
	 */
	
	public function setDateConclusion(?string $date_conclusion): void
	{
		if (empty($date_conclusion)) {
			$date_conclusion = null;
		} 
		$this->date_conclusion = $date_conclusion;
	}

	/**
	 * Get the value of status
	 *
	 * @return string
	 */
	
	public function getStatus(): ?string
	{
		return $this->status;
	}

	/**
	 * Set the value of status
	 *
	 * @param   string  $status  
	 *
	 * @return  self
	 */
	
	public function setStatus(?string $status): void
	{
		if (empty($status)) {
			$status = null;
		} 
		$this->status = $status;
	}
}