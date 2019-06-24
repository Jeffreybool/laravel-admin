<?php
/**
 * Created by PhpStorm.
 * User: JeffreyBool
 * Date: 2018/8/27
 * Time: 00:21
 */

namespace App\Http\Proxy;

use GuzzleHttp\Client;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TokenProxy
{

    const ADMIN_PROVIDER = "admin";
    const USER_PROVIDER  = "users";

    /**
     *  获取令牌.
     * @param string $provider
     * @param array  $params
     * @param string $grant_type
     * @return mixed
     */
    public function issueToken($provider, array $params, string $grant_type)
    {
        //oauth/token
        $data = [
            'client_id'     => $provider == 'admin' ? env('ADMIN_PASSPORT_CLIENT_ID') : env('PASSPORT_CLIENT_ID'),
            'client_secret' => $provider == 'admin' ? env('ADMIN_PASSPORT_CLIENT_SECRET') : env('PASSPORT_CLIENT_SECRET'),
            'grant_type'    => $grant_type,
            "provider"      => $provider,
        ];
        $data = array_merge($data, $params);
        $response = app(Client::class)->post(url('oauth/token'), [
            'form_params' => $data,
            'http_errors' => false,
        ]);

        $resp = json_decode((string)$response->getBody(), true);
        if($response->getStatusCode() != 200) {
            throw new HttpException(422, "账号或密码错误");
        }

        return $resp;
    }

}