<?php

namespace App\Repository;

use App\Entity\EntityInterface;

interface RepositoryInterface {
    public function save(EntityInterface $entity): void;
    public function delete(EntityInterface $entity): void;
}

