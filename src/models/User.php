<?php

namespace Src\models;

class User extends BaseModel
{
    protected string $name;
    protected string $email;
    protected string $phone;
    protected string $gender = 'O';
    protected string $password;
    protected array $fillable = ['id', 'name', 'email', 'phone', 'gender', 'password'];


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): User
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): User
    {
        $this->phone = $phone;
        return $this;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): User
    {
        $this->gender = $gender;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): User
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);

        return $this;
    }

    public function validatePassword(string $password): bool {
        return password_verify($password, $this->password);
    }


    /**
     * Retorna uma array baseada na instância atual, com as colunas 'fillable'
     *
     * @return array
     */
    public function serialize(): array {
        $array = [];

        foreach($this->fillable as $column) {
            if(isset($this->$column))
                $array[$column] = $this->$column;
        }

        return $array;
    }

    /**
     * Retorna uma instância da model, baseada nos dados da array, com as colunas 'fillable'
     *
     * @param array $user
     * @return $this
     */
    public function getModelFromArray(array $user): User {
        foreach($this->fillable as $column) {
            if($column === 'password') {
                $this->setPassword($user[$column]);
                continue;
            }

            if(array_key_exists($column, $user)) {
                $this->$column = $user[$column];
            }
        }

        return $this;
    }

}