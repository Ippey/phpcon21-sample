<?php

namespace App\Core;

use App\Entity\Theater;

interface TheaterManagementDataServiceInterface
{
    /**
     * 紐づく有効なユーザ一覧を取得.
     */
    public function findActivatedUsers(Theater $theater): array;
}
