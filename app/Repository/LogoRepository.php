<?php

namespace App\Repository;
use App\Repository\interfaces\CrudInterface;
use App\Models\Logo;


class LogoRepository implements CrudInterface {
   private  $Logo;

    public function __construct(Logo $Logo )
    {
        $this->Logo = $Logo;
    }
    public function all(){
       return $this->Logo->all();
    }

    public function get($id){
        return $this->Logo->find($id);
    }

    public function store(array $data){
        return $this->Logo->create($data);
    }

    public function update($id,array $data){
        return $this->Logo->find($id)->update($data);
    }

}
