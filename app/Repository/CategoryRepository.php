<?php

namespace App\Repository;
use App\Repository\interfaces\CrudInterface;
use App\Models\Categories;


class CategoryRepository implements CrudInterface {
   private  $category;

    public function __construct(Categories $category )
    {
        $this->category = $category;
    }
    public function all(){
       return $this->category->all();
    }

    public function get($id){
        return $this->category->find($id);
    }

    public function store(array $data){
        return $this->category->create($data);
    }

    public function update($id,array $data){
        return $this->category->find($id)->update($data);
    }

}
