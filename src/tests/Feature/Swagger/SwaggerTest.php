<?php

namespace Tests\Feature\Swagger;

use Tests\FunctionalTestCase;

class SwaggerTest extends FunctionalTestCase
{
    public function testShouldReturn200WhenAccessingSwaggerIndex()
    {
        $this->get('/');
        $this->assertResponseOk();
    }
}
