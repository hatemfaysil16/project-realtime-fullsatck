<?php

namespace App\Repository;
use App\Repository\interfaces\CrudInterface;
use App\Models\Portfolio;


class portfolioRepository implements CrudInterface {
   private  $Portfolio;

    public function __construct(Portfolio $Portfolio )
    {
        $this->Portfolio = $Portfolio;
    }
    public function all(){
       return $this->Portfolio->all();
    }

    public function get($id){
        return $this->Portfolio->find($id);
    }

    public function store(array $data){
        return $this->Portfolio->create($data);
    }

    public function update($id,array $data){
        return $this->Portfolio->find($id)->update($data);
    }

}
