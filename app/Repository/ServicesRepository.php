<?php

namespace App\Repository;
use App\Repository\interfaces\CrudInterface;
use App\Models\Service;

class ServicesRepository implements CrudInterface {
   private  $Service;

    public function __construct(Service $Service )
    {
        $this->Service = $Service;
    }
    public function all(){
       return $this->Service->all();
    }

    public function get($id){
        return $this->Service->find($id);
    }

    public function store(array $data){
        return $this->Service->create($data);
    }

    public function update($id,array $data){
        return $this->Service->find($id)->update($data);
    }

}
