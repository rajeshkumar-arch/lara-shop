<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * @var int
     */
    protected $statusCode = 200;

    protected $dataBag = [];

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }


    /**
     * @param int $statusCode
     *
     * @return $this
     */
    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param array $successArr
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($successArr = [], $message = null)
    {
        $arr = [];
        if (!is_array($successArr)) {
            $arr['success'] = $successArr;
            $arr['message'] = $message;
        } else {
            $arr = $successArr;
        }

        $response = $this->responseFormat($arr, $this->dataBag);

        return response()
            ->json($response, $this->getStatusCode());
    }

    /**
     * @param array $successArr
     * @param array $dataArr
     *
     * @return array
     */
    protected function responseFormat(array $successArr, array $dataArr = [])
    {
        return [
            'status' => [
                'success' => $successArr['success'],
                'http_code' => $this->getStatusCode(),
                'message' => $successArr['message'],
            ],
            'data' => $dataArr,
            '__links' => [

            ],
        ];
    }

    public function setDataBag(array $value = [])
    {
        $this->dataBag = $value;

        return $this;
    }

    public function getDataBag()
    {
        return $this->dataBag;
    }
}
