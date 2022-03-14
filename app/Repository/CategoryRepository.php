<?php

namespace App\Repository;
use App\Models\Categories;
use App\Repository\interfaces\CrudInterface;


class CategoryRepository implements CrudInterface {

    public function all(){
       return Categories::all();
    }

    public function get($id){
        return Categories::find($id);
    }

    public function store(array $data){
        return Categories::create($data);
    }

    public function update($id,array $data){
        return Categories::find($id)->update($data);
    }

}
