<?php

namespace App\Service;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class ApiResponseFormatter implements Responsable
{

public function __construct($data = null, ?string $resource = null)
{
  $this->data = $data;

  $this->resource = $resource ?? JsonResource::class;

  $this->messages = new Collection();
}

public static function new($data = null, ?string $resource = null): self
    {
        return new self($data, $resource);
    }

public function getResponse(): JsonResponse
    {
        $resource = $this->getResource();

        return $resource
            ->response()
            ->setStatusCode($this->statusCode);
    }

public function getResource(): JsonResource
    {
        $resource = $this->newResourceInstance();

        $additional = [];

        if ($this->messages->isNotEmpty()) {
            $additional = array_merge($additional, [
                'messages' => $this->messages->toArray(),
            ]);
        }

        if ($this->meta) {
            $additional = array_merge($additional, [
                'meta' => $this->meta,
            ]);
        }

        if ($additional) {
            $resource->additional($additional);
        }

        return $resource;
    }

private function newResourceInstance(): JsonResource
    {
        // If we didn't pass in a Collection Resource, we should try and make one from our basic resource
        // But only if the data we passed through is a collection or array of arrays
        if (!$this->isCollectionResource()) {
            // If we're a collection or Paginator object, turn into a collection
            if ($this->data instanceof Collection || $this->data instanceof LengthAwarePaginator) {
                return call_user_func([$this->resource, 'collection'], $this->data);
            }

            // If we're an array that only contains arrays, turn into a collection
            if (is_array($this->data) && is_array_of_arrays($this->data)) {
                return call_user_func([$this->resource, 'collection'], $this->data);
            }
        }

        return new $this->resource($this->data);
    }

private function isCollectionResource(): bool
    {
        return is_subclass_of($this->resource, ResourceCollection::class);
    }

public function toResponse($request): JsonResponse
    {
        return $this->getResponse();
    }

}
