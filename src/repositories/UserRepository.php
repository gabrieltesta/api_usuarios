<?php

namespace Src\repositories;

use Src\models\BaseModel;
use PDO;
use Src\models\User;

class UserRepository extends BaseRepository implements BaseRepositoryInterface
{
    protected PDO $db;
    protected string $baseTable = 'users';

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * Retorna todos os registros
     *
     * @param int $limit
     * @param int $offset
     * @return array<User>
     */
    public function findAll(int $limit = 0, int $offset = 0): array
    {
        $sql = $this->buildSQLSelect(
            'id, name, email, phone, gender, password, created_at, updated_at',
            $this->baseTable.' U',
            [],
            [],
            [],
            [],
            $limit,
            $offset
        );

        $rs = $this->db->query($sql)->fetchAll();

        $users = [];
        foreach($rs as $result) {
            unset($result['password']);

            $user = new User($result['id']);
            $user->getModelFromArray($result);

            $users[] = $user->serialize();
        }

        return $users;
    }

    /**
     * Retorna o usuário com id especificado
     *
     * @param int $id
     * @param int $limit
     * @param int $offset
     * @return User
     */
    public function findById(int $id, int $limit = 0, int $offset = 0): ?User
    {
        $sql = $this->buildSQLSelect(
            'id, name, email, phone, gender, password, created_at, updated_at',
            $this->baseTable.' U',
            [],
            [
                'id' => '= :id'
            ],
            [],
            [],
            $limit,
            $offset
        );

        $rs = $this->db->prepare($sql);
        $rs->bindParam(':id', $id, PDO::PARAM_INT);
        $rs->execute();

        $result = $rs->fetch(PDO::FETCH_ASSOC);
        $user = new User;

        if(!$result)
            return null;

        unset($result['password']);

        $user->getModelFromArray($result);

        return $user;

    }

    public function create(BaseModel $object): int
    {
        $user = $object->serialize();

        $sql = $this->buildSQLInsert('name, email, phone, gender, password', $this->baseTable, [
            'name' => ':name',
            'email' => ':email',
            'phone' => ':phone',
            'gender' => ':gender',
            'password' => ':password'
        ]);

        $rs = $this->db->prepare($sql);
        $rs->bindParam(':name', $user['name'], PDO::PARAM_STR);
        $rs->bindParam(':email', $user['email'], PDO::PARAM_STR);
        $rs->bindParam(':phone', $user['phone'], PDO::PARAM_STR);
        $rs->bindParam(':gender', $user['gender'], PDO::PARAM_STR_CHAR);
        $rs->bindParam(':password', $user['password'], PDO::PARAM_STR);

        if($rs->execute())
            return $this->db->lastInsertId();
        else
            return 0;

    }

    public function update(int $id, BaseModel $object)
    {
        $user = $object->serialize();

        $sql = $this->buildSQLUpdate($this->baseTable, $user, [
            'id' => '= :id'
        ]);

        $rs = $this->db->prepare($sql);
        $rs->bindParam(':id', $id, PDO::PARAM_INT);

        if($rs->execute())
            return true;

        return false;
    }

    public function delete(int $id): bool
    {
        $sql = $this->buildSQLDelete($this->baseTable, ['id' => '= :id']);

        $rs = $this->db->prepare($sql);
        $rs->bindParam(':id', $id, PDO::PARAM_INT);

        return $rs->execute();
    }
}