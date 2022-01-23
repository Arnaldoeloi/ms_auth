<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'nome'           => $this->nome,
            'email'          => $this->email,
            'rg'             => $this->rg,
            'cpf'            => $this->cpf,
            'rua'            => $this->rua,
            'numero'         => $this->numero,
            'bairro'         => $this->bairro,
            'cidade'         => $this->cidade,
            'estado'         => $this->estado,
            'telefone'       => $this->telefone,
            'celular'        => $this->celular,
            'situacao'       => $this->situacao,
            'nivel'          => $this->nivel,
        ];
    }
}
