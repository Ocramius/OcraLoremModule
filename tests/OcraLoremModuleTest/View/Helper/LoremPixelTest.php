<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace OcraLoremModuleTest\View\Helper;

use OcraLoremModule\View\Helper\LoremPixel;
use Zend\View\Helper\AbstractHelper;
use Zend\Escaper\Escaper;
use PHPUnit_Framework_TestCase;

/**
 * Tests for the LoremPixel view helper
 *
 * @author Marco Pivetta <ocramius@gmail.com>
 * @license MIT
 */
class LoremPixelTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var LoremPixel
     */
    protected $helper;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        $escaper = $this->getMock('Zend\Escaper\Escaper');

        $escaper
            ->expects($this->any())
            ->method('escapeHtmlAttr')
            ->will($this->returnCallback(function($value) {
                return $value;
            }));
        $escaper
            ->expects($this->any())
            ->method('escapeUrl')
            ->will($this->returnCallback(function($value) {
                return $value;
            }));
        $this->helper = new LoremPixel($escaper);
    }

    public function testDefaults()
    {
        $this->assertStringStartsWith('<img ', $this->helper->__invoke());
        $this->assertStringEndsWith('/>', $this->helper->__invoke());
    }

    public function testWillRejectInvalidWidth()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->helper->__invoke(null);
    }

    public function testWillRejectInvalidHeight()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->helper->__invoke(640, null);
    }

    public function testWidthHeight()
    {
        $this->assertSame(
            '<img src="http://lorempixel.com/300/200/" alt="Lorem Pixel"/>',
            $this->helper->__invoke(300, 200)
        );
    }

    public function testWidthHeightNoColor()
    {
        $this->assertSame(
            '<img src="http://lorempixel.com/g/300/200/" alt="Lorem Pixel"/>',
            $this->helper->__invoke(300, 200, false)
        );
    }

    public function testWidthHeightCategory()
    {
        $this->assertSame(
            '<img src="http://lorempixel.com/300/200/sports/" alt="Lorem Pixel"/>',
            $this->helper->__invoke(300, 200, true, 'sports')
        );
    }

    public function testWidthHeightCategoryImageText()
    {
        $this->assertSame(
            '<img src="http://lorempixel.com/300/200/sports/hello-world/" alt="hello-world"/>',
            $this->helper->__invoke(300, 200, true, 'sports', 'hello-world')
        );
    }

    public function testWidthHeightCategoryImageTextDirectoryIndex()
    {
        $this->assertSame(
            '<img src="http://lorempixel.com/300/200/sports/123/hello-world/" alt="hello-world"/>',
            $this->helper->__invoke(300, 200, true, 'sports', 'hello-world', 123)
        );
    }
}
