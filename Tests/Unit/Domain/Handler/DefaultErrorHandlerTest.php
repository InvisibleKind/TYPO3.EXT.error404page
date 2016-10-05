<?php

namespace R3H6\Error404page\Tests\Unit\Controller;

/*                                                                        *
 * This script is part of the TYPO3 project - inspiring people to share!  *
 *                                                                        *
 * TYPO3 is free software; you can redistribute it and/or modify it under *
 * the terms of the GNU General Public License version 3 as published by  *
 * the Free Software Foundation.                                          *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General      *
 * Public License for more details.                                       *
 *                                                                        */

use R3H6\Error404page\Domain\Model\Error;
use R3H6\Error404page\Domain\Handler\DefaultErrorHandler;

/**
 * Unit test for the ErrorHandler.
 */
class DefaultErrorHandlerTest extends \R3H6\Error404page\Tests\Unit\UnitTestCase
{
    /**
     * @var \R3H6\Error404page\Domain\Handler\DefaultErrorHandler
     */
    protected $subject;

    public function setUp()
    {
        parent::setUp();

        $this->subject = new DefaultErrorHandler();
    }

    public function tearDown()
    {
        parent::tearDown();
        unset(
            $this->subject
        );
    }

    /**
     * @test
     */
    public function handleErrorReturnsAlwaysTrue()
    {
        /** @var \R3H6\Error404page\Domain\Model\Error $errorFixture */
        $errorFixture =  new Error();
        $this->assertTrue($this->subject->handleError($errorFixture));
    }

    /**
     * @test
     */
    public function getOutputReturnsHtml()
    {
        /** @var \R3H6\Error404page\Domain\Model\Error $errorFixture */
        $errorFixture =  new Error();
        $output = $this->subject->getOutput($errorFixture);
        $this->assertContains('Page not found', $output);
        $this->assertNotContains('Reason', $output);
    }

    /**
     * @test
     */
    public function getOutputContainsErrorReason()
    {
        $expected = 'Reason ' . uniqid();
        /** @var \R3H6\Error404page\Domain\Model\Error $errorFixture */
        $errorFixture =  new Error();
        $errorFixture->setReason($expected);
        $this->assertContains($expected, $this->subject->getOutput($errorFixture));
    }
}
