<?php

/**
 * @return array
 */
function getAgent()
{
    $device = new \Jenssegers\Agent\Agent();
    $browser = $device->browser();
    $platform = $device->platform();

    return [
        "user_agent" => $device->getUserAgent(),
        "browser" => $browser ?? null,
        "browser_version" => $device->version($browser) ?? null,
        "platform" => $platform ?? null,
        "platform_version" => null,
        "ip" => getClientIpAddress(),
    ];
}

/**
 * @return mixed|string
 */
function getClientIpAddress()
{
    return request()->server->get('HTTP_X_FORWARDED_FOR') ?
        explode(',', request()->server->get('HTTP_X_FORWARDED_FOR'))[0] :
        request()->server->get('REMOTE_ADDR');
}
