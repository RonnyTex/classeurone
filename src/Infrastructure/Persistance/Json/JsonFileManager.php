<?php

namespace Ronos\Infrastructure\Persistance\Json;

class JsonFileManager {

    private string $file;

    public function __construct(string $file)
    {
        $this->file = $file;
        # Créer le fichier si il n'existe pas
        if(!file_exists($file)){
            file_put_contents($file, json_encode([], ));
        }
    }

    public function read(): array
    {
        $content = file_get_contents($this->file);
        return json_decode($content, true) ?? [];
    }

    public function write(array $data): void
    {
        # LOCK_EX évite la corruption concurrente
        file_put_contents($this->file, json_encode($data, JSON_PRETTY_PRINT), LOCK_EX);
    }

}