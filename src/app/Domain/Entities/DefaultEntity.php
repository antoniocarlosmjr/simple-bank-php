<?php

namespace App\Domain\Entities;

use Carbon\Carbon;
use DateTime;
use Laminas\Hydrator\ArraySerializableHydrator as ArraySerializableHydrator;
use Throwable;

abstract class DefaultEntity
{
    public function getArrayCopy(): array
    {
        return get_object_vars($this);
    }

    public function toArray(): array
    {
        $entityArray = app(ArraySerializableHydrator::class)->extract($this);
        $data = [];

        foreach ($entityArray as $key => $value) {
            $data[
            ltrim(strtolower(preg_replace('/[A-Z]/', '_$0', $key)), '_')
            ] = $value;
        }

        return $data;
    }

    public function fill(array $register): DefaultEntity
    {
        $register = $this->attrsStringToDatetime($register);
        $this->assignParamsToEntityFromArray($register);

        return $this;
    }

    public function datetimeToDateString(): array
    {
        $attributes = $this->attrsDatetimeToString($this->toArray());

        array_walk(
            $attributes,
            function (&$item) {
                if ($this->verifyStringDate($item)) {
                    $item = Carbon::parse($item)->format('Y-m-d');
                }
            }
        );

        return $attributes;
    }

    public function toJson(int $options = 0): string
    {
        return json_encode($this->toArray(), $options);
    }

    private function verifyStringDate(mixed $item): bool
    {
        try {
            $date = date_parse($item);

            if (
                is_string($item) &&
                ($date['year'] && $date['month'] && $date['day']) &&
                ($date['warning_count'] === 0 && $date['error_count'] === 0)
            ) {
                return true;
            }
            return false;
        } catch (Throwable $e) {
            return false;
        }
    }

    private function verifyDatetime(mixed $item): bool
    {
        try {
            return get_class($item) === 'DateTime';
        } catch (Throwable $e) {
            return false;
        }
    }

    private function attrsStringToDatetime(array $attributes): array
    {
        array_walk(
            $attributes,
            function (&$item) {
                if ($this->verifyStringDate($item)) {
                    $item = app(DateTime::class, ['datetime' => $item]);
                }
            }
        );

        return $attributes;
    }

    private function attrsDatetimeToString(array $attributes): array
    {
        array_walk(
            $attributes,
            function (&$item) {
                if ($this->verifyDatetime($item)) {
                    $item = $item->format('Y-m-d\TH:i:s.u\Z');
                }
            }
        );

        return $attributes;
    }

    private function assignParamsToEntityFromArray(array $attributes): void
    {
        $entity = $this;

        array_walk(
            $attributes,
            function ($item, $key) use ($entity) {
                if ($key === 'id') {
                    $item = (int) $item;
                }

                $attrName = str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
                $entity->{"set$attrName"}($item);
            }
        );
    }
}
