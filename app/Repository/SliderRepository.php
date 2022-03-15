<?php

namespace App\Repository;
use App\Repository\interfaces\CrudInterface;
use App\Models\Slider;


class SliderRepository implements CrudInterface {
   private  $slider;

    public function __construct(Slider $slider )
    {
        $this->slider = $slider;
    }
    public function all(){
       return $this->slider->all();
    }

    public function get($id){
        return $this->slider->find($id);
    }

    public function store(array $data){
        return $this->slider->create($data);
    }

    public function update($id,array $data){
        return $this->slider->find($id)->update($data);
    }

}
