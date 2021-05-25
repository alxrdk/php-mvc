<?php

namespace App\Models;

class Tasks extends \App\Model
{

    public function get(string $order, bool $asc, int $offset, int $limit)
    {
        $asc = $asc?'ASC':'DESC';
        return $this->db()->query("SELECT * FROM `tasks` ORDER BY `$order` $asc LIMIT $offset, $limit")
            ->getAll();
    }

    public function getById($id)
    {
        return $this->db()->query('SELECT * FROM `tasks` WHERE `id` = :id')
            ->bind(':id', $id)
            ->get();
    }

    public function add($username, $email, $description, $complited)
    {
        return $this->db()->query('INSERT INTO `tasks` (`username`, `email`, `description`, `complited`) VALUES (:username, :email, :description, :complited)')
            ->bind(':username', $username)
            ->bind(':email', $email)
            ->bind(':description', $description)
            ->bind(':complited', $complited)
            ->execute();
    }

    public function edit($id, $username, $email, $description, $complited)
    {
        return $this->db()->query('UPDATE `tasks` SET `username` = :username, `email` = :email, `description` = :description, `complited` = :complited, `updated` = 1 WHERE `id` = :id')
            ->bind(':id', $id)
            ->bind(':username', $username)
            ->bind(':email', $email)
            ->bind(':description', $description)
            ->bind(':complited', $complited)
            ->execute();
    }

    public function complite($id, $complited)
    {
        return $this->db()->query('UPDATE `tasks` SET `complited` = :complited, `updated` = 1 WHERE `id` = :id')
            ->bind(':id', $id)
            ->bind(':complited', $complited)
            ->execute();
    }

    public function delete($id)
    {
        return $this->db()->query('DELETE FROM `tasks` where `id` = :id')
            ->bind(':id', $id)
            ->execute();
    }

    public function count()
    {
        return $this->db()->query('SELECT COUNT(*) as count FROM `tasks`')
            ->get()->count;
    }

}
