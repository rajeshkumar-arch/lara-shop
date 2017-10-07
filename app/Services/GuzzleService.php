<?php
namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GuzzleService
{
    /**
     * @var
     */
    protected $host;

    /**
     * @var
     */
    protected $headers;

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param mixed $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    /**
     * Performs a Guzzle GET call
     *
     * @param $url
     *
     * @return mixed|string
     */
    public function getGuzzleRequest($url)
    {
        try {
            if (!$this->host) {
                throw new \Exception('Set Base Host Name');
            }

            $client = $this->getClient();
            $response = $client->get($url);
            $data = $response->getBody()->getContents();
            $data = json_decode($data, true);

            return $data;
        } catch (ClientException $e) {
            $this->handleRefreshException([], $e);
        } catch (ConnectException $e) {
            $this->handleRefreshException([], $e);
        } catch (RequestException $e) {
            $this->handleRefreshException([], $e);
        } catch (\Exception $e) {
            $this->handleRefreshException([], $e);
        }
    }

    /**
     * Performs a Guzzle POST Request
     *
     * @return mixed|string
     */
    protected function postGuzzleRequest($url, $data, $raw = false, $rawResponse = false)
    {
        try {
            if (!$this->host) {
                throw new \Exception('Set Base Host Name');
            }

            $client = $this->getClient();
            if (empty($data)) {
                $response = $client->post($url);
            } else {
                if (!$raw) {
                    $data = [
                        'form_params' => $data,
                    ];
                }

                $response = $client->post($url, $data);
            }

            if ($rawResponse) {
                return $response;
            }

            $data = $response->getBody()->getContents();

            $contentType = $response->getHeader('Content-Type');

            if (in_array('text/plain', $contentType) || in_array('application/pdf', $contentType)) {
                return $data;
            }

            $data = json_decode($data, true);

            return $data;
        } catch (ClientException $e) {
            $this->handleRefreshException($data, $e);
        } catch (ConnectException $e) {
            $this->handleRefreshException($data, $e);
        } catch (RequestException $e) {
            $this->handleRefreshException($data, $e);
        } catch (\Exception $e) {
            $this->handleRefreshException($data, $e);
        }
    }

    /**
     * Performs a Guzzle POST Request
     *
     * @param $url
     * @param $data
     * @param bool $raw
     * @return mixed|string
     */
    protected function putGuzzleRequest($url, $data, $raw = false)
    {
        try {
            if (!$this->host) {
                throw new \Exception('Set Base Host Name');
            }

            $client = $this->getClient();
            if (!$raw) {
                $data = [
                    'form_params' => $data
                ];
            }

            $response = $client->put($url, $data);

            $data = $response->getBody()->getContents();
            $data = json_decode($data, true);

            return $data;
        } catch (ClientException $e) {
            $this->handleRefreshException($data, $e);
        } catch (ConnectException $e) {
            $this->handleRefreshException($data, $e);
        } catch (RequestException $e) {
            $this->handleRefreshException($data, $e);
        } catch (\Exception $e) {
            $this->handleRefreshException($data, $e);
        }
    }

    /**
     * Performs a Guzzle HEAD Request
     *
     * @param $url
     * @return mixed|string
     */
    protected function headGuzzleRequest($url)
    {
        try {
            if (!$this->host) {
                throw new \Exception('Set Base Host Name');
            }

            $client = $this->getClient();

            $response = $client->head($url);

            $data = $response->getStatusCode();

            return $data;
        } catch (ClientException $e) {
            return $e->getResponse()->getStatusCode();
        } catch (ConnectException $e) {
            $this->handleRefreshException([], $e);
        } catch (RequestException $e) {
            $this->handleRefreshException([], $e);
        } catch (\Exception $e) {
            $this->handleRefreshException([], $e);
        }
    }

    /**
     * Performs a Guzzle DELETE Request
     *
     * @param $url
     * @param $data
     * @param bool $raw
     * @return mixed|string
     */
    protected function deleteGuzzleRequest($url)
    {
        try {
            if (!$this->host) {
                throw new \Exception('Set Base Host Name');
            }

            $client = $this->getClient();
            $response = $client->delete($url);

            $data = $response->getBody()->getContents();
            $data = json_decode($data, true);

            return $data;
        } catch (ClientException $e) {
            $this->handleRefreshException([], $e);
        } catch (ConnectException $e) {
            $this->handleRefreshException([], $e);
        } catch (RequestException $e) {
            $this->handleRefreshException([], $e);
        } catch (\Exception $e) {
            $this->handleRefreshException([], $e);
        }
    }

    /**
     * Sets the base client for Guzzle Operation
     *
     * @return Client
     */
    protected function getClient()
    {
        return new Client([
            'base_uri' => $this->host,
        ]);
    }

    /**
     * Handles Guzzle Exceptions
     *
     * @param $data
     * @param $e
     *
     * @return void
     */
    protected function handleRefreshException($data, $e)
    {
        $errorCode = $e->getCode();
        if ($errorCode == 0) {
            $errorCode = 404;
        }

        if ($errorCode == 422) {
            throw new HttpException(
                $errorCode,
                $e->getResponse()->getBody()->getContents()
            );
        } else {
            if (property_exists($e, 'getResponse')) {
                $response = $e->getResponse()->getBody()->getContents();
            } else {
                $response = $e->getMessage();
            }
            throw new HttpException($errorCode, $response, $e);
        }
    }
}
