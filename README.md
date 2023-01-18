# helper
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