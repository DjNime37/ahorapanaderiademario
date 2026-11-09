<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property float $precio
 * @property string|null $imagen
 * @property bool $disponible
 * @property int|null $categoria_id
 * @property mixed $categoria
 */
class ProductoResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion ?? null,
            'precio' => (float) $this->precio,
            'precio_formateado' => number_format($this->precio, 2) . ' €',
            'imagen' => empty($this->imagen) ? null : (preg_match('/^https?:\/\//i', $this->imagen) ? $this->imagen : asset('storage/' . $this->imagen)),
            'disponible' => (bool) $this->disponible,
            'categoria_id' => $this->categoria_id ?? null,
            'categoria' => new CategoriaResource($this->whenLoaded('categoria')),
        ];
    }
}
