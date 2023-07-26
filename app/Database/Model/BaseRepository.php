<?php

declare(strict_types=1);

namespace App\Database\Model;

use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;

abstract class BaseRepository
{
    public const TABLE_NAME = '';

    public function __construct(private Explorer $database)
    {
    }

    public function all(): Selection
    {
        return $this->database->table(static::TABLE_NAME);
    }

    public function get(int $id): ?ActiveRow
    {
        return $this->all()->get($id);
    }

    /**
     * @param string $column
     * @param mixed $value
     * @return ActiveRow[]
     */
    public function findBy(string $column, mixed $value): array
    {
        return $this->where($column, $value)->fetchAll();
    }

    public function findOneBy(string $column, mixed $value): ?ActiveRow
    {
        return $this->where($column, $value)->fetch();
    }

    public function add(iterable $data): ActiveRow
    {
        return $this->all()->insert($data);
    }

    public function remove(int $id): int
    {
        return $this->get($id)->delete();
    }

    public function update(int $id, iterable $data): bool
    {
        return $this->get($id)->update($data);
    }

    public function upsert(iterable $data, ?int $id = null): ActiveRow|bool
    {
        if (!$id || !$this->get($id)) {
            return $this->add($data);
        } else {
            return $this->update($id, $data);
        }
    }

    private function where(string $column, mixed $value): Selection
    {
        return $this->all()->where($column, $value);
    }
}
