# Change Log

## [v1.1.0] - 2023-03-02
增加資料集輔助功能
- recursiveChangeKey() 遞迴歷遍所有陣列元素，依$set(轉換資料陣列)重新命名陣列索引值(index)名稱
- selectColumn() 將資料庫查詢後之資料陣列，篩選所需欄位後回傳。

## [v1.0.0] - 2023-01-18
增加JSON傳輸資料格式定義
相容PHP 8.1以上

### Added
- 新增 Chtang\Helper\DataExchange\JsonFormat::makeResponse() JSON傳輸資料格式定義
