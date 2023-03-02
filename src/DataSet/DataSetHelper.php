<?php

namespace Chtang\Helper\DataSet;

/**
 * 資料集輔助功能
 *
 * 注意：如資料量龐大時，將影響效能。
 */
class DataSetHelper
{
    /**
     * 遞迴歷遍所有陣列元素，依$set(轉換資料陣列)重新命名陣列索引值(index)名稱
     *
     * 未重新命名陣列索引值則保留<br>
     * 改變數組鍵而不改變順序（多維數組能力）<br>
     * 時間複雜度Big O (n)<br>
     *
     * @param array $arr n-D Arrays (original array)
     * @param array $set 1-D Arrays (array containing old keys as keys and new keys as values)
     * @return array
     */
    public static function recursiveChangeKey(array $arr, array $set): array
    {
        $newArr = [];
        foreach ($arr as $k => $v) {
            $key = array_key_exists($k, $set) ? $set[$k] : $k;
            $newArr[$key] = is_array($v) ? self::recursiveChangeKey($v, $set) : $v;
        }
        unset($v);

        return $newArr;
    }

    /**
     * 將資料庫查詢後之資料陣列，篩選所需欄位後回傳。
     *
     * 依篩選所需欄位陣列的順序排序<br>
     * 時間複雜度Big O (n)
     *
     * @param array $dataResultSet 資料庫查詢資料陣列<br>[row][Column => value, ...]
     * @param array $selectColumn 篩選所需欄位並重新命名<br>[ColumnName => NewColumnName, ...]<br>(NewColumnName為空值時則不更換index名稱)
     * @return array
     */
    public static function selectColumn(array $dataResultSet, array $selectColumn): array
    {
        //取得須篩選的欄位名稱為key的陣列，不含值。
        //array_keys：只取得key名稱陣列
        //array_flip：key、value互換
        $filterColumnTmp = array_flip(array_keys($selectColumn));
        //將值設為null
        $keys = array_keys($filterColumnTmp);
        $filterColumn = array_fill_keys($keys, null);

        //新舊名稱對照表陣列，[key：舊名稱；value：新名稱]
        $changeKey = [];
        foreach ($selectColumn as $item => $value) {
            //新名稱不為empty時，則需異動名稱。
            if (!empty($value)) {
                $changeKey[$item] = $value;
            }
        }
        unset($value);

        //一、欄位篩選
        $newDataSetFilter = [];
        if (!empty($filterColumn)) {
            foreach ($dataResultSet as $value) {
                $tempSet = null;
                $tempSetSort = null;

                //array_intersect_key：回傳key交集的陣列 (依第一個陣列的順序、value為主)
                $tempSet = array_intersect_key($value, $filterColumn);

                //排序
                //array_merge：合併，以filterColumn順序、value為主
                $tempSetSort = array_merge($filterColumn, $tempSet);

                $newDataSetFilter[] = $tempSetSort;
            }
            unset($value);
        } else {
            $newDataSetFilter = $dataResultSet;
        }

        //二、key值重新命名後回傳
        return self::recursiveChangeKey($newDataSetFilter, $changeKey);
    }
}
