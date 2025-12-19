<?php

namespace Tests\Traits;

trait ApiTokenTrait
{
    protected function getApiToken(): string
    {
        return '3|jxOmNMFc6irbGoP1cloITnap1y5tsUSZIkorJrv6e7012b48';
    }

    protected function withApiTokenHeaders(array $additionalHeaders = []): array
    {
        return array_merge($additionalHeaders, [
            'Authorization' => 'Bearer ' . $this->getApiToken(),
        ]);
    }
}
//tests/Traits/ApiTokenTrait.php