<?php

namespace Tests\Unit;

use App\Features\Filtering\SortParam;
use PHPUnit\Framework\TestCase;

class SortParamTest extends TestCase
{
    public function testBackOrder()
    {
        $str = '-client,-total';
        $expects = 'client desc,total desc';

        $param = new SortParam($str);

        $this->assertEquals($expects, $param->toSqlString());
    }

    public function testEmptyRow()
    {
        $str = '';
        $expects = '';

        $param = new SortParam($str);

        $this->assertEquals($expects, $param->toSqlString());
    }

    public function testClearColumn()
    {
        $str = 'title';
        $expects = 'title asc';

        $param = new SortParam($str);

        $this->assertEquals($expects, $param->toSqlString());
    }

    public function testDefaultOrder()
    {
        $str = '+category';
        $expects = 'category asc';

        $param = new SortParam($str);

        $this->assertEquals($expects, $param->toSqlString());
    }

    public function testColumnTrio()
    {
        $str = '-product,+category,-vendor';
        $expects = 'product desc,category asc,vendor desc';

        $param = new SortParam($str);

        $this->assertEquals($expects, $param->toSqlString());
    }

    public function testTrashParam()
    {
        $this->expectExceptionMessage('Invalid argument `sort param` passed');
        $str = '=price';
        $param = new SortParam($str);
        $result = $param->parse();
    }
}
