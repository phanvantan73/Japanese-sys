<?php

namespace App\Services\Api;

use App;
use Request;
use App\Models\User;
use Lcobucci\JWT\Parser;
use Laravel\Passport\Token;
use App\Exceptions\ApiException;
use App\Services\Api\BaseService;

/**
 * Service class for authentication handling
 */
class AuthService extends BaseService
{
    /**
     * Create access token by grant type
     *
     * @param  array $inputs
     * @param  array $passportConfig
     *
     * @return array
     */
    public function createAccessToken($inputs, $passportConfig)
    {
        switch ($passportConfig['grant_type']) {
            case $passportConfig['password_grant_type']:
                $params = $this->preparePasswordGrantTypeParams(
                    $inputs['email'],
                    $inputs['password'],
                    $passportConfig
                );
                break;
            case $passportConfig['refresh_token_grant_type']:
                $params = $this->prepareRefreshTokenGrantTypeParams(
                    $inputs['refresh_token'],
                    $passportConfig
                );
                break;
            default:
                $params = [];
        }

        $token = Request::create('/oauth/token', 'POST', $params);
        $response = App::handle($token);

        if ($response->getStatusCode() != 200) {
            throw new ApiException('unauthorized');
        }

        return json_decode($response->getContent());
    }

    /**
     * Get token information.
     *
     * @param  string $accessToken
     *
     * @return Laravel\Passport\Token
     */
    public function getToken($accessToken)
    {
        $tokenParse = new Parser();
        $tokenId = $tokenParse->parse($accessToken)->getHeader('jti');

        return Token::find($tokenId);
    }

    /**
     * Array params for create access token by password grant type.
     *
     * @param  string $email
     * @param  string $password
     * @param  array $passportConfig
     * @param  mixed $scope
     *
     * @return array
     */
    protected function preparePasswordGrantTypeParams($email, $password, $passportConfig, $scope = '')
    {
        return [
            'grant_type' => $passportConfig['grant_type'],
            'client_id' => $passportConfig['client_id'],
            'client_secret' => $passportConfig['client_secret'],
            'username' => $email,
            'password' => $password,
            'scope' => $scope,
        ];
    }

    /**
     * Array params for create access token by refresh token grant type.
     *
     * @param  string $refreshToken
     * @param  array $passportConfig
     * @param  mixed $scope
     *
     * @return array
     */
    protected function prepareRefreshTokenGrantTypeParams($refreshToken, $passportConfig, $scope = '')
    {
        return [
            'grant_type' => $passportConfig['grant_type'],
            'client_id' => $passportConfig['client_id'],
            'client_secret' => $passportConfig['client_secret'],
            'refresh_token' => $refreshToken,
            'scope' => $scope,
        ];
    }

    /**
     * Register new user.
     *
     * @param array $inputs
     *
     * @return void
     */
    public function register(array $inputs)
    {
        try {
            User::create(array_merge($inputs, [
                'name' => 'User',
            ]));
        } catch (Exception $e) {
            throw new ApiException('register_error');
        }
    }
}
