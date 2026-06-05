<?php

namespace Infrastructure\Framework\Http\Foundation\Session;

interface SessionInterface {

    /**
     * Démarre la session ou ignore si déjà démarrée
     */
    public function start(): void;

    /**
     * Enregistre une clé
     */
    public function set(string $key, mixed $value): void;

    /**
     * Retrouve une clé et return la valeur
     */
    public function get(string $key, mixed $default = null): mixed;

    /**
     * Vérifie si une clé existe
     */
    public function has(string $key): bool;

    /**
     * Supprime une clé
     */
    public function remove(string $key): void;

    /**
     * Détruire la session
     */
    public function destroy(): void;
}