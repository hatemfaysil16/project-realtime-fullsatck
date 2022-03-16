<?php

namespace App\Repository;
use App\Repository\interfaces\CrudInterface;
use App\Models\Question;


class QuestionRepository implements CrudInterface {
   private  $Question;

    public function __construct(Question $Question )
    {
        $this->Question = $Question;
    }
    public function all(){
       return $this->Question->all();
    }

    public function get($id){
        return $this->Question->find($id);
    }

    public function store(array $data){
        return $this->Question->create($data);
    }

    public function update($id,array $data){
        return $this->Question->find($id)->update($data);
    }

}
