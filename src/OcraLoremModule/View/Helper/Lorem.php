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

/**
 * Helper to be used to produce lorem output
 *
 * @author Marco Pivetta <ocramius@gmail.com>
 * @license MIT
 *
 * @todo interfaces/type hinting
 */
class Lorem extends AbstractHelper
{
    /**
     * @var LoremIpsumGenerator
     */
    protected $loremGenerator;

    public function __invoke($count = 100)
    {
        return $this->getLoremGenerator()->getContent($count);
    }

    public function setLoremGenerator($loremGenerator)
    {
        $this->loremGenerator = $loremGenerator;
    }

    /**
     * @return LoremIpsumGenerator
     */
    public function getLoremGenerator()
    {
        // @todo do this via the factory/hard dependency in constructor
        if (null === $this->loremGenerator) {
            $this->loremGenerator = new LoremIpsumGenerator();
        }

        return $this->loremGenerator;
    }
}
