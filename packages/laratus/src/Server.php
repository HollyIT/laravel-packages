<?php

namespace Hollyit\Laratus;

use Hollyit\Laratus\Helpers\Filesize;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Request as HttpRequest;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class Server
{
    public const TUS_PROTOCOL_VERSION = '1.0.0';

    /**
     * @var Request
     */
    protected mixed $request;

    public static bool $shouldRegisterRoutes = true;

    public const HTTP_VERBS = [
        HttpRequest::METHOD_GET,
        HttpRequest::METHOD_POST,
        HttpRequest::METHOD_PATCH,
        HttpRequest::METHOD_DELETE,
        HttpRequest::METHOD_HEAD,
        HttpRequest::METHOD_OPTIONS,
    ];

    protected int $maximumUploadSize;

    protected TusCacheRepository $cache;

    public function __construct(TusCacheRepository $cache, ?Request $request)
    {
        $this->request = $request ?: request();
        $this->maximumUploadSize = Filesize::convertToBytes(config('laratus.max_size'));
        $this->cache = $cache;

    }

    public static function withoutRoutes(): void
    {
        static::$shouldRegisterRoutes = false;
    }

    public static function getMiddleware(): array
    {
        return config('laratus.middleware', []);
    }

    public function getMaximumUploadSize(): int
    {
        return $this->maximumUploadSize;
    }

    public function setMaximumUploadSize(int $maximumUploadSize): static
    {
        $this->maximumUploadSize = Filesize::convertToBytes($maximumUploadSize);

        return $this;
    }

    public function allowedExtensions(): array
    {

        return config('laratus.allowed_extensions', [
            'creation',
            'termination',
            'checksum',
            'concatenation',
        ]);
    }

    public function maxChunkSize(): int
    {
        $sizes = [
            Filesize::convertToBytes(ini_get('post_max_size')),
            Filesize::convertToBytes(ini_get('post_max_size')),
        ];

        if ($configured = config('laratus.max_chunk_size')) {
            $sizes[] = Filesize::convertToBytes($configured);
        }

        return min($sizes);
    }

    /**
     * Get list of supported hash algorithms.
     */
    protected function getSupportedHashAlgorithms(): string
    {
        $supportedAlgorithms = hash_algos();

        $algorithms = [];
        foreach ($supportedAlgorithms as $hashAlgo) {
            if (str_contains($hashAlgo, ',')) {
                $algorithms[] = "'$hashAlgo'";
            } else {
                $algorithms[] = $hashAlgo;
            }
        }

        return implode(',', $algorithms);
    }

    protected function getClientChecksum(): Response|string
    {
        $checksumHeader = $this->request->header('Upload-Checksum');

        if (empty($checksumHeader)) {
            return '';
        }

        [$checksumAlgorithm, $checksum] = explode(' ', $checksumHeader);

        $checksum = base64_decode($checksum);

        if ($checksum === false || ! in_array($checksumAlgorithm, hash_algos(), true)) {
            return response()->noContent(HttpResponse::HTTP_BAD_REQUEST);
        }

        return $checksum;
    }

    public function handleOptions(): Response
    {
        $headers = [
            'Allow' => implode(',', static::HTTP_VERBS),
            'Tus-Version' => self::TUS_PROTOCOL_VERSION,
            'Tus-Extension' => implode(',', $this->allowedExtensions()),
            'Tus-Checksum-Algorithm' => $this->getSupportedHashAlgorithms(),
        ];

        if ($this->maximumUploadSize > 0) {
            $headers['Tus-Max-Size'] = $this->maximumUploadSize;
        }

        return response()->noContent(HttpResponse::HTTP_OK, $headers);
    }

    public function maximumUploadSize(): int
    {
        return Filesize::convertToBytes(config('laratus.max_size'));
    }

    protected function verifyUploadSize(): bool
    {

        if ($this->maximumUploadSize > 0 && $this->request->header('Upload-Length') > $this->maximumUploadSize) {
            return false;
        }

        return true;
    }

    protected function makeKey(): string {}

    public function handlePost() {}

    public function handlePatch() {}

    public function handleDelete() {}

    public function handleHead() {}
}
