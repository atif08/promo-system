<?php

namespace App\Models\UserAttributes;

use App\Models\UserAttribute;

trait HasUserAttributes {

    protected function getAttributesPayload(): UserAttribute {
        $user_id = $this->id;
        $payload = [];

        /** @var UserAttribute $atr */
        $atr = UserAttribute::query()
            ->firstOrCreate(
                compact('user_id'),
                compact('payload')
            );

        return $atr;
    }

    public function getUserAttribute($key, $default_value = null) {
        $atr = $this->getAttributesPayload();

        if (isset($atr->payload[$key])) {
            return $atr->payload[$key];
        }

        return $this->setUserAttribute($key, $default_value);
    }

    public function setUserAttribute($key, $default_value = null, $parent = null) {
        $atr = $this->getAttributesPayload();

        $payload = $atr->payload ?: [];

        $value = [];
        if (is_array($key) && is_array($default_value)) {
            foreach ($key as $idx => $_key) {
                $value[$_key] = $default_value[$idx];
            }
        } else {
            $value[$key] = $default_value;
        }

        if ($parent) {
            $payload[$parent] = array_merge($payload[$parent] ?? [], $value);
        } else {
            $payload = array_merge($payload, $value);
        }

        $atr->payload = $payload;
        $atr->save();

        return $default_value;
    }

}
