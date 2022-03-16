<?php

namespace App\Repository;
use App\Repository\interfaces\CrudInterface;
use App\Models\Features;


class FeaturesRepository implements CrudInterface {
   private  $Features;

    public function __construct(Features $Features )
    {
        $this->Features = $Features;
    }
    public function all(){
       return $this->Features->all();
    }

    public function get($id){
        return $this->Features->find($id);
    }

    public function store(array $data){
        return $this->Features->create($data);
    }

    public function update($id,array $data){
        return $this->Features->find($id)->update($data);
    }

}


