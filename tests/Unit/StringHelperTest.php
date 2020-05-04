<?php

namespace Tests\Unit;

use App\Helpers\StringHelper;
use PHPUnit\Framework\TestCase;

class StringHelperTest extends TestCase
{
    /**
     * @param $pattern
     * @param $row
     *
     * @dataProvider successValidationProvider
     */
    public function testCheckSignsBy_AcceptableSigns($pattern, $row)
    {
        $result = StringHelper::checkSignsBy($pattern, $row);

        $this->assertTrue($result, 'Pattern should be extended');
    }

    public function successValidationProvider()
    {
        return [
            'sort param' => [
                '#[a-z,\-\+\s]+#', '-total',
            ],
            'email' => [
                '#[a-z@\.]+#', 'bee@gmail.com',
            ],
            'common smile' => [
                '#[\:\)]+#', ':)',
            ],
            'poor email' => [
                '#[a-z@\.]+#', 'bee@mail',
            ]
        ];
    }

    /**
     * @param $pattern
     * @param $row
     * @dataProvider failedValidationProvider
     */
    public function testCheckSignsBy_NotMatched($pattern, $row)
    {
        $result = StringHelper::checkSignsBy($pattern, $row);

        $this->assertFalse($result, 'Pattern has all needed signs');
    }

    public function failedValidationProvider()
    {
        return [
            'sort param with ^' => [
                '#[a-z,\-\+\s]+#', '^-total',
            ],
            'email with !' => [
                '#[a-z@\.]+#', 'bee!@gmail.com',
            ],
            'common smile with !' => [
                '#[\:\)]+#', '!:)',
            ],
            'sort param with =' => [
                '#[a-z,\-\+\s]+#', '=price',
            ],
        ];
    }
}
