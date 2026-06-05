<?php

namespace Infrastructure\Framework\Container;

use Infrastructure\Framework\Container\ContainerInterface;

class Container implements ContainerInterface {

    private array $definitions = [];
    private array $instances = [];

    public function set(string $id, callable | string $concrete): void
    {  
        $this->definitions[$id] = $concrete;
    }

    public function get(string $id): mixed
    {
        # Lazy Singleton
        if(isset($this->instances[$id])){
            return $this->instances[$id];
        }

        # Définition manuelle
        if(isset($this->definitions[$id])){
            $concrete = $this->definitions[$id];
            if(is_callable($concrete)){
               return $this->instances[$id] = $concrete($this); 
            }

            return $this->instances[$id] = $this->get($concrete);            
        }

        # Autowiring intelligent
        if(class_exists($id)){
            $ref = new \ReflectionClass($id);

            if(!$ref->getConstructor()){
                return $this->instances[$id] = new $id();
            }
            
            $params = [];

            foreach ($ref->getConstructor()->getParameters() as $param) {
                $type = $param->getType();

                if(!$type || $type->isBuiltin()){
           
                    throw new \Exception("Impossible d'autowirer le parametre \$" . $param->getName());
                }
            
                $params[] = $this->get($type->getName());
            }

            return $this->instances[$id] = $ref->newInstanceArgs($params);
            
        }
        
        throw new \Exception("Service $id not found");
    }
}