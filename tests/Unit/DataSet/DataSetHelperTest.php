<?php

namespace tests\Unit\DataSet;

use Chtang\Helper\DataSet\DataSetHelper;
use PHPUnit\Framework\TestCase;

final class DataSetHelperTest extends TestCase
{
    /**
     * 測試 recursiveChangeKey
     *
     * @return void
     */
    public function testRecursiveChangeKey(): void
    {
        $arr = [0 => 'One', 1 => 'Two', 2 => 'Tree'];
        //案例
        $set = [0 => 'column1', 1 => 'column2', 2 => 'column3'];
        $checkArr = ['column1' => 'One', 'column2' => 'Two', 'column3' => 'Tree'];
        $this->assertEquals(DataSetHelper::recursiveChangeKey($arr, $set), $checkArr);

        //案例
        $set = [0 => 'column1', 2 => 'column3'];
        $checkArr = ['column1' => 'One', 1 => 'Two', 'column3' => 'Tree'];
        $this->assertEquals(DataSetHelper::recursiveChangeKey($arr, $set), $checkArr);

        //案例
        $set = [0 => 'column1'];
        $checkArr = ['column1' => 'One', 1 => 'Two', 2 => 'Tree'];
        $this->assertEquals(DataSetHelper::recursiveChangeKey($arr, $set), $checkArr);

        //案例
        $set = [2 => 'column3'];
        $checkArr = [0 => 'One', 1 => 'Two', 'column3' => 'Tree'];
        $this->assertEquals(DataSetHelper::recursiveChangeKey($arr, $set), $checkArr);

        $arr = [[0 => 'One', 1 => 'Two', 2 => 'Tree']];
        //案例
        $set = [0 => 'column1', 1 => 'column2', 2 => 'column3'];
        $checkArr = ['column1' => ['column1' => 'One', 'column2' => 'Two', 'column3' => 'Tree']];
        $this->assertEquals(DataSetHelper::recursiveChangeKey($arr, $set), $checkArr);
    }

    /**
     * 測試 selectColumn
     *
     * @return void
     */
    public function testSelectColumn(): void
    {
        $dataResultSet = [
            ['column1' => 'A1', 'column2' => 'A2', 'column3' => 'A3'],
            ['column1' => 'B1', 'column2' => 'B2', 'column3' => 'B3'],
            ['column1' => 'C1', 'column2' => 'C2', 'column3' => 'C3']
        ];

        //案例
        $selectColumn = ['column1' => ''];
        $check = [
            ['column1' => 'A1'],
            ['column1' => 'B1'],
            ['column1' => 'C1']
        ];
        $this->assertEquals(DataSetHelper::selectColumn($dataResultSet, $selectColumn), $check);

        //案例
        $selectColumn = ['column1' => 'newColumn1'];
        $check = [
            ['newColumn1' => 'A1'],
            ['newColumn1' => 'B1'],
            ['newColumn1' => 'C1']
        ];
        $this->assertEquals(DataSetHelper::selectColumn($dataResultSet, $selectColumn), $check);

        //案例
        $selectColumn = ['column1' => '', 'column3' => ''];
        $check = [
            ['column1' => 'A1', 'column3' => 'A3'],
            ['column1' => 'B1', 'column3' => 'B3'],
            ['column1' => 'C1', 'column3' => 'C3']
        ];
        $this->assertEquals(DataSetHelper::selectColumn($dataResultSet, $selectColumn), $check);
    }
}
