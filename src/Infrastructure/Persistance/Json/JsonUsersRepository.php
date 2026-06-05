<?php

namespace Infrastructure\Persistance\Json;

use Infrastructure\Persistance\Json\JsonBaseRepository;
use Infrastructure\Persistance\Json\JsonFileManager;
use Domain\User\Exceptions\EmailAlreadyExistsException;
use Domain\User\UsersRepositoryInterface;
use Domain\User\VO\Email;
use Domain\User\VO\Password;
use Domain\User\VO\CommonName;
use Domain\User\User;

class JsonUsersRepository extends JsonBaseRepository implements UsersRepositoryInterface {

    private string $file = 'users.json';

    public function __construct()
    {
        parent::__construct(new JsonFileManager(dirname(__DIR__, 4) . '/data/users.json'));
    }
   
    public function save(User $user): void
    {
        $data = $this->load();
        $found = false;  

        if($this->existsByEmail($user->getEmail())){
            throw new EmailAlreadyExistsException("Adresse email déjà utilisée");
        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
        foreach($data as &$item){
            if($item['uuid'] === $user->getUuid()){
                $item = $this->mapToArray($user);
                $found = true;
                break;
            }
        }

        if(!$found){
            $data[] = $this->mapToArray($user);
        }

        $this->persist($data);
    }

    public function find(string $uuid): ?User
    {
        $raw = $this->findRawBy('uuid', $uuid);

        return $raw ? $this->mapToEntity($raw) : null;
    }

    public function findByEmail(string $email): ?User
    {
        $raw = $this->findRawBy('email', $email);

        return $raw ? $this->mapToEntity($raw) : null;
    }

    public function findAll(): array
    {
        return array_map(
            fn ($item) => $this->mapToEntity($item),
            $this->load()
        );
    }

    public function exists(string $uuid): bool
    {
        return $this->existRaw('uuid', $uuid);
    }
    
    public function existsByEmail(string $email): bool
    {   
        return $this->existsRaw('email', $email);
    }

    public function delete(string $uuid): void
    {
        $this->deleteRaw('uuid', $uuid);
    }

    public function update(User $user): void
    {
        $data = $this->load();

        foreach($data as $index => $item){
            if($item['uuid'] === $user->getUuid()){
                $data[$index] = $this->mapToArray($user);
            }
        }

        $this->persist($data);
    }

    private function mapToEntity(array $data): User
    {
        return new User( 
            $data['uuid'],
            new CommonName('firstname', $data['firstname']),
            new CommonName('lastname', $data['lastname']),
            new Email($data['email']),
            new Password($data['password']),
        );
    }

    private function mapToArray(User $user): array 
    {
        return [
            'uuid' => $user->getUuid(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail(),
            'password' => Password::makeHash($user->getPassword()),
        ];
    }
}