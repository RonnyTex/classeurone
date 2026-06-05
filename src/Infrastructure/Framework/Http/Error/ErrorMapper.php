<?php

namespace Ronos\Infrastructure\Framework\Http\Error;

class ErrorMapper {

    /**
     * Transforme un type d'erreur en code http
     */
    public static function map(\Throwable  $errorType): int
    {
        $ref = new \ReflectionClass($errorType);
        
        $status = match ($ref->getShortName()) {
                'EmptyFieldException' => 422,
                'InvalidEmailException' => 422,
                'InvalidPasswordException' => 422,
                'InvalidCredentialException' => 401,
                'EmailAlreadyExistsException' => 409,
                'UserAlreadyExistsException' => 409,
                'NotfoundException' => 404,
                'DatabaseException' => 500,
                default => 500 
            };

        return $status;
    }

}