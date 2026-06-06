<?php

namespace Interface\Http\Controllers\Pages;

use Infrastructure\Framework\Http\Controllers\AbstractController;

use Psr\Http\Message\ResponseInterface;


class CreateSchoolTypePageController extends AbstractController {

    public function __invoke(): ResponseInterface
    {
        $crsf = $this->getCsrfToken();
        return $this->render('site/school.type', ['csrf' => $crsf]);
    }
}