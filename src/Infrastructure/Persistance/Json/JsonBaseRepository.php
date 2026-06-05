<?php

namespace Infrastructure\Persistance\Json;

use Infrastructure\Persistance\Json\JsonFileManager;

abstract class JsonBaseRepository {

    protected array $cache = [];

    public function __construct(protected JsonFileManager $fileManager)
    { }

    protected function load(): array
    {
        if(!empty($this->cache)){
            return $this->cache;
        }

        $this->cache = $this->fileManager->read();

        return $this->cache;
    }

    protected function persist(array $data): void
    {
        $this->cache = $data;
        $this->fileManager->write($data);
    }

    protected function findRawBy(string $key, mixed $value): ?array
    {
        foreach($this->load() as $item){
            if($item[$key] === $value){
                return $item;
            }
        }

        return null;
    }

    protected function existsRaw(string $key, mixed $value): bool
    {
        return $this->findRawBy($key, $value) !== null;
    }

    protected function deleteRaw(string $key, mixed $value): void
    {
        $data = array_filter(
            $this->load(),
            fn ($item) => $item[$key] !== $value
        );

        $this->persist(array_values($data));
    }
}