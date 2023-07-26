<?php

declare(strict_types=1);

namespace App\Database\Entities;

use DateTime;

abstract class BaseEntity
{
    protected int $id;

    protected DateTime $createdAt;

    protected DateTime $updatedAt;

    public function create(): static
    {
        return new static();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }
}
