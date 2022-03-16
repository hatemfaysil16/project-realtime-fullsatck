<?php

namespace App\Repository;

use App\Models\AboutUs;
use App\Repository\interfaces\CrudInterface;


class AboutUsRepository implements CrudInterface {
   private  $AboutUs;

    public function __construct(AboutUs $AboutUs )
    {
        $this->AboutUs = $AboutUs;
    }
    public function all(){
       return $this->AboutUs->all();
    }

    public function get($id){
        return $this->AboutUs->find($id);
    }

    public function store(array $data){
        return $this->AboutUs->create($data);
    }

    public function update($id,array $data){
        return $this->AboutUs->find($id)->update($data);
    }

}
