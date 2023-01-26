<?php

/**
 * Class BrowserVersionCop
 * https://en.wikipedia.org/wiki/Safari_version_history
 * https://en.wikipedia.org/wiki/Google_Chrome_version_history
 * https://en.wikipedia.org/wiki/Firefox_version_history
 * https://ru.wikipedia.org/wiki/%D0%A1%D0%BF%D0%B8%D1%81%D0%BE%D0%BA_%D0%B2%D0%B5%D1%80%D1%81%D0%B8%D0%B9_%D0%AF%D0%BD%D0%B4%D0%B5%D0%BA%D1%81.%D0%91%D1%80%D0%B0%D1%83%D0%B7%D0%B5%D1%80%D0%B0
 */
class BrowserVersionCop
{
    public array $os = [];
    public array $client = [];

    /**
     * BrowserVersionCop constructor.
     * @param array $os - device-detector os result
     * @param array $client - device-detector client result
     */
    public function __construct(array $os, array $client)
    {
        $this->os = $os;
        $this->client = $client;
    }


    public function versionToArray(string $version): array
    {
        $data = explode('.', $version);
        // [$major, $minor, $path, $revision]
        if (count($data) === 3) {
            $data['type'] = 'sem-ver';
           return $data;
        }
        if (count($data) === 4) {
            $data['type'] = 'build-revision';
            if (strlen($data[3]) === 4) {
                $data['type'] = 'maintenance-build';
            }
           return $data;
        }

        return $data;
    }

}