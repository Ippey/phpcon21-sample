<?php

namespace App\Core;

interface TheaterRoomRepositoryInterface
{
    public function findBy(array $conditions): array;
}