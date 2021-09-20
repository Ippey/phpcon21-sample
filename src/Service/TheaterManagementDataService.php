<?php

namespace App\Service;

use App\Core\TheaterManagementDataServiceInterface;
use App\Entity\Theater;
use App\Repository\TheaterRoomRepository;
use App\Repository\UserRepository;

class TheaterManagementDataService implements TheaterManagementDataServiceInterface
{
    public function __construct(
        private UserRepository $userRepository,
        private TheaterRoomRepository $theaterRoomRepository
    )
    {
    }

    public function findActivatedUsers(Theater $theater): array
    {
        return $this->userRepository->findBy([
            'theater' => $theater,
            'isActivated' => true,
        ]);
    }
}