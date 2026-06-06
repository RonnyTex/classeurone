<?php

namespace Infrastructure\Framework\Http\Controllers;

use Infrastructure\Framework\Container\ContainerInterface;
use Infrastructure\Framework\Http\Foundation\Response\RedirectResponse;
use Infrastructure\Framework\Http\Foundation\Response\HtmlResponse;
use Infrastructure\Framework\Http\Foundation\Session\SessionInterface;
use Infrastructure\Framework\Http\Auth\AuthInterface;
use Infrastructure\Framework\View\ViewInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractController {

    public function __construct(private ContainerInterface $container)
    { }

    // Renvoie une response html avec une vue de template
    public function render(string $template, array $data = [], int $status = 200): ResponseInterface
    {   
        $view = $this->container->get(ViewInterface::class);
        return new HtmlResponse($view->render($template, $data), $status);
    }

    // Redirige vers une page avec une RedirectResponse
    public function redirect(string $path, int $status = 302): ResponseInterface
    {
        return new RedirectResponse($path, $status);
    }

    // Vérifie si l'utilisateur est connecté
    public function isAuthenticated(): bool
    {
        $auth = $this->container->get(AuthInterface::class);
        return $auth->isAuthenticated();
    }

    // Return l'id de l'utilisateur en cours
    public function getUser(): ?string
    {   
        $auth = $this->container->get(AuthInterface::class);
        return $auth->getUser();
    }

    public function notFound(): ResponseInterface
    {
        return new HtmlResponse('404 Content not found', 404);
    }

    // Permet d'avoir acces au container
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function createForm(string $entity, string $source, array $params = []): string
    {
        $fields = [];
        $ignoredFields = $this->getIgnoredFormField($params);
        
        $refEntity = new \ReflectionClass($entity);

        $repo = $this->findRepository($refEntity);

        if(!method_exists($repo, 'find')){
            throw new \Exception("La méthode find n'existe pa ssur le repository $repo");
        }

        $source = $repo->find($source);
  
        $refSource = new \ReflectionClass($source);

        foreach ($refEntity->getProperties() as $entityProp) {
            if(in_array($entityProp->getName(), $ignoredFields)){
                continue;
            }

            $fieldType = $this->matchType($entityProp->getType()->getName());
            $entityPropValue = $this->getEntityPropValue($entityProp, $source);

            $fields[$entityProp->getName()] = [$fieldType, $entityPropValue];
        }

        return $this->generateForm($fields);  
    }

    private function findRepository(\ReflectionClass $ref): mixed
    {
        $repo = $ref->getNamespaceName(). '\\' .$ref->getShortName() .'sRepositoryInterface';
        $repo = $this->container->get($repo);
        return $repo;
    }

    private function getEntityPropValue($entityProp, $source)
    {
        $value = null;
        if(is_object($entityProp->getValue($source))){
            $object = $entityProp->getValue($source);
            $refObject = new \ReflectionClass($object);
            $method = $refObject->getMethod('getValue');
            $value = $method->invoke($object);
        } else {
            $value = $entityProp->getValue($source);
        }
        return $value;
    }

    private function getIgnoredFormField(array $params): array
    {
        $ignoredFields = [
            'uuid',
            'password'
        ];

        if(array_key_exists('ignore', $params)){
            if(is_array($params['ignore'])){
                $ignoredFields = array_merge($ignoredFields, $params['ignore']);
            }
        }

        return $ignoredFields;
    }

    private function generateForm(array $fields): string
    {
        $token = $this->getCsrfToken();

        $form = '<div class="form"><form method="POST">';
        foreach($fields as $field => $value){
            [$fieldType, $fieldValue] = $value;
            $form .=  "<fieldset><div class=\"field\">
                    <label for=\"$field\">$field</label>
                    <input type=\"$fieldValue\" name=\"$field\" id=\"$field\" value=\"$fieldValue\">
                </div></fieldset>";
        }
        $form .= "<div class=\"footer\">
                <input name=\"_csrf\" type=\"hidden\" value=\"$token\"/>
                <button class=\"btn\" type=\"submit\">Enregistrer</button>
            </div></form></div>";
        return $form;
    }

    private function matchType(string $type)
    {
        $fieldType = match ($type) {
            'string' => 'text' ,
            'int' => 'number',
            default => 'text',
        };

        return $fieldType;
    }

    public function getCsrfToken(): string
    {
        $token = bin2hex(random_bytes(32));
        $session = $this->container->get(SessionInterface::class);
        $session->set('csrf.token', $token);
        return $token;
    }
}