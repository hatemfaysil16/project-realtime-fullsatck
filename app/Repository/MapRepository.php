<?php

namespace App\Repository;
use App\Repository\interfaces\CrudInterface;
use App\Models\Map;


class MapRepository implements CrudInterface {
   private  $Map;

    public function __construct(Map $Map )
    {
        $this->Map = $Map;
    }
    public function all(){
       return $this->Map->all();
    }

    public function get($id){
        return $this->Map->find($id);
    }

    public function store(array $data){
        return $this->Map->create($data);
    }

    public function update($id,array $data){
        return $this->Map->find($id)->update($data);
    }

}

