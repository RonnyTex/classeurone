<?php

namespace Ronos\Domain\User;
use Ronos\Domain\User\User;

interface UsersRepositoryInterface {

    public function save(User $user): void;

    public function find(string $uuid): ?User;

    public function findByEmail(string $email): ?User;

    public function findAll(): array;

    public function exists(string $uuid): bool;

    public function existsByEmail(string $email): bool;

    public function delete(string $uuid): void;

    public function update(User $user): void;

}