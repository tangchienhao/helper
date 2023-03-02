# chtang/helper
helper
此套件為個人專用，請勿於正式環境直接下載使用。

# PHP版本限制
PHP >= 8.1

# 安裝
正式版
```bash
composer require chtang/helper
```
開發版
```bash
composer require chtang/helper:dev-main
```

# 使用

JSON資料介接格式
```bash
use Chtang\Helper\DataExchange\Enums\Status;
use Chtang\Helper\DataExchange\JsonFormat;

//測試樣本
$sampleMessage = '訊息';
$sampleData = [['張三', 18], ['李四', 20]];
$sampleOption = ['Option1' => '訊息1', 'Option2' => '訊息2'];

$response = JsonFormat::makeResponse(Status::SUCCESS, $sampleMessage, $sampleData, $sampleOption);
$response->send();

//http response
//{"status":"success","message":"訊息","data":[["張三",18],["李四",20]],"option":{"Option1":"訊息1","Option2":"訊息2"}}
```

資料集輔助功能
```bash
use Chtang\Helper\DataSet\DataSetHelper;
use PHPUnit\Framework\TestCase;


//一、案例
//recursiveChangeKey() 遞迴歷遍所有陣列元素，依$set(轉換資料陣列)重新命名陣列索引值(index)名稱
$arr = [
    0 => 'One',
    1 => 'Two',
    2 => 'Tree'
];

$set = [0 => 'column1', 1 => 'column2', 2 => 'column3'];
$newArr = DataSetHelper::recursiveChangeKey($arr, $set);
/*
$newArr = [
    'column1' => 'One',
    'column2' => 'Two',
    'column3' => 'Tree'
];


//二、案例
//selectColumn() 將資料庫查詢後之資料陣列，篩選所需欄位後回傳。
$dataResultSet = [
    ['column1' => 'A1', 'column2' => 'A2', 'column3' => 'A3'],
    ['column1' => 'B1', 'column2' => 'B2', 'column3' => 'B3'],
    ['column1' => 'C1', 'column2' => 'C2', 'column3' => 'C3']
];

$selectColumn = ['column1' => 'newColumn1'];
$newArr = DataSetHelper::selectColumn($dataResultSet, $selectColumn);
/*
$newArr = [
    ['newColumn1' => 'A1'],
    ['newColumn1' => 'B1'],
    ['newColumn1' => 'C1']
];
*/
```