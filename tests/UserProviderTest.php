<?php

namespace App\Tests;

use App\Entity\User;
use App\Repository\Interfaces\UserRepositoryInterace;
use App\Service\UserProvider;
use PHPUnit\Framework\TestCase;

class UserProviderTest extends TestCase
{
    public function testWhenUserExists(): void
    {
        $userRepository = $this->getMockBuilder(UserRepositoryInterace::class)
            ->getMock();
        $userRepository
            ->method('findUserByIp')
            ->willReturn(new User());
        $userRepository
            ->expects($this->never())
            ->method('saveUser');

        $service = new UserProvider($userRepository);

        $service->createIfNotExists('127.0.0.1');
    }

    public function testWhenUserNotExists(): void
    {
        $userRepository = $this->getMockBuilder(UserRepositoryInterace::class)
            ->getMock();
        $userRepository
            ->method('findUserByIp')
            ->willReturn(null);
        $userRepository
            ->expects($this->once())
            ->method('saveUser');

        $service = new UserProvider($userRepository);

        $service->createIfNotExists('127.0.0.1');
    }
}
