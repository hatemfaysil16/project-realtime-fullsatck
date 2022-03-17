<?php

namespace App\Repository;
use App\Repository\interfaces\CrudInterface;
use App\Models\Pricing;


class PricingRepository implements CrudInterface {
   private  $Pricing;

    public function __construct(Pricing $Pricing )
    {
        $this->Pricing = $Pricing;
    }
    public function all(){
       return $this->Pricing->all();
    }

    public function get($id){
        return $this->Pricing->find($id);
    }

    public function store(array $data){
        return $this->Pricing->create($data);
    }

    public function update($id,array $data){
        return $this->Pricing->find($id)->update($data);
    }

}

