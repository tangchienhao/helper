<?php

namespace Chtang\Helper\DataExchange;

use Chtang\Helper\DataExchange\Enums\Status;
use Symfony\Component\HttpFoundation\Response;

/**
 * 資料介接用JSON資料格式
 */
class JsonFormat
{
    /**
     * 產生JSON格式之Symfony\Component\HttpFoundation\Response
     *
     * 資料格式：<br>
     * {"status":"success","message":"訊息","data":[["張三",18],["李四",20]],"option":{"Option1":"訊息1","Option2":"訊息2"}}<br>
     * {"status":"success","message":"訊息","data":[["張三",18],["李四",20]],"Option1":"訊息1","Option2":"訊息2"}
     *
     * @param Status $status 狀態
     * @param string $message 訊息
     * @param array $data 資料陣列
     * @param array $option 選項資料陣列
     * @param bool $containOption 選項資料陣列是否包含在option索引中(預設true)
     * @return Response 回傳Symfony\Component\HttpFoundation\Response
     */
    public static function makeResponse(
        Status $status,
        string $message,
        array $data = [],
        array $option = [],
        bool $containOption = true
    ): Response {
        $output['status'] = $status;
        $output['message'] = $message;
        $output['data'] = $data;
        if ($containOption) {
            $output['option'] = $option;
        } else {
            $output = array_merge($output, $option);
        }

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json; charset=utf-8');
        $response->setContent(json_encode($output, JSON_UNESCAPED_UNICODE));

        return $response;
    }
}
