<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'imagen' => empty($this->imagen)
                ? null
                : (preg_match('/^https?:\/\//i', $this->imagen)
                    ? $this->imagen
                    : asset($this->imagen)),
        ];
    }
}
