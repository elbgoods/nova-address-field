<?php

namespace Elbgoods\NovaAddressField;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class NovaAddressField extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-address-field';

    public function __construct(string $name, ?string $attribute = null, ?callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->latitude('latitude')
            ->longitude('longitude')
            ->fieldOptions([])
            ->at(53.54923, 9.98832);
    }

    public function usingHere(): self
    {
        return $this->withMeta([
            'geo_provider' => 'here',
            'api_url' => 'https://discover.search.hereapi.com/v1/discover',
        ]);
    }

    public function withApiKey(string $apiKey): self
    {
        return $this->withMeta([
            'api_key' => $apiKey,
        ]);
    }

    public function proxied(): self
    {
        return $this->withMeta([
            'is_proxy' => true,
        ]);
    }

    public function withUrl(string $url): self
    {
        return $this->withMeta([
            'api_url' => $url,
        ]);
    }

    public function fieldOptions(array $fieldOptions): self
    {
        return $this->withMeta([
            'field_options' => $fieldOptions,
        ]);
    }

    public function searchLabel(string $label): self
    {
        return $this->withMeta([
            'search_label' => $label,
        ]);
    }

    public function referencePoint(float $latitude, float $longitude): self
    {
        return $this->withMeta([
            'here_at' => implode(',', [$latitude, $longitude]),
        ]);
    }

    public function latitude(string $field): self
    {
        return $this->withMeta([__FUNCTION__ => $field]);
    }

    public function longitude(string $field): self
    {
        return $this->withMeta([__FUNCTION__ => $field]);
    }

    /**
     * Hydrate the given attribute on the model based on the incoming request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  string  $requestAttribute
     * @param  object  $model
     * @param  string  $attribute
     *
     * @return void
     */
    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute): void
    {
        if ($request->exists($requestAttribute)) {
            $model->{$attribute} = json_decode($request[$requestAttribute], true);
        }
    }
}
