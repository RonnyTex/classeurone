<?php

namespace Infrastructure\Framework\Security;

class TokenGenerator {

    static public function generate(int $bytes): string 
    {
        return bin2hex(random_bytes($bytes));
    }
}