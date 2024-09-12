<?php

declare(strict_types=1);

namespace LaminasTest\Test\PHPUnit\Controller;

use LaminasTest\Test\PHPUnit\Controller\AbstractHttpControllerTestCaseTest;

class TemplateNameTest extends AbstractHttpControllerTestCaseTest
{
    public function setUp(): void
    {
        $this->setApplicationConfig(
            include __DIR__ . '/../../_files/application.config.php'
        );
        parent::setUp();
    }

    /**
     * Test case for a controller returning a view with 2 children
     * View hierarchy:
     *   layout/layout -> baz/index/childview -> child1 -> child3
     *                                        -> child2
     */
    public function testAssertTemplateWithMultipleChildren(): void
    {
        $this->dispatch('/childview');

        // Check that the rendered content
        $this->assertQueryContentContains('p', 'Parent');
        $this->assertQueryContentContains('p', 'Child 1');
        $this->assertQueryContentContains('p', 'Child 2');
        $this->assertQueryContentContains('p', 'Child 3');

        $this->assertTemplateName('layout/layout');
        $this->assertTemplateName('baz/index/childview');
        $this->assertTemplateName('child1');
        $this->assertTemplateName('child2');
        $this->assertTemplateName('child3');
        $this->assertNotTemplateName('foo');
    }
}
