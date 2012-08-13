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

namespace OcraLoremModule\View\Helper;

use OcraLoremModule\LoremIpsumGenerator;
use Zend\View\Helper\AbstractHelper;
use Zend\Escaper\Escaper;

/**
 * Helper to be used to produce lorem pixum IMG html tag
 *
 * @author Marco Pivetta <ocramius@gmail.com>
 * @license MIT
 */
class LoremPixel extends AbstractHelper
{
    const BASE_URL = 'http://lorempixel.com/';

    /**
     * @var Escaper
     */
    protected $escaper;

    public function __construct(Escaper $escaper)
    {
        $this->escaper = $escaper;
    }

    public function __invoke(
        $width = 640,
        $height = 480,
        $color = true,
        $category = null,
        $imageText = null,
        $categoryIndex = null
    ) {
        if (!((int) $width && (int) $height)) {
            throw new \InvalidArgumentException('Both width and height must be defined');
        }

        $src = static::BASE_URL;

        if (!$color) {
            $src .= 'g/';
        }

        $src .= ((int) $width) . '/' . ((int) $height) . '/';

        if ($category) {
            $src .= $this->escaper->escapeUrl((string) $category) . '/';

            if ((int) $categoryIndex) {
                $src .= ((int) $categoryIndex) . '/';
            }

            if ($imageText) {
                $src .= $this->escaper->escapeUrl((string) $imageText) . '/';
            }
        }

        return '<img src="'
            . $this->escaper->escapeHtmlAttr($src)
            . '" alt="'
            . $this->escaper->escapeHtml($imageText ? $imageText : 'Lorem Pixel')
            . '"/>';
    }
}
