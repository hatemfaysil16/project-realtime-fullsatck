<?php

namespace App\Repository;
use App\Repository\interfaces\CrudInterface;
use App\Models\ContactUs;


class ContactUsRepository implements CrudInterface {
   private  $ContactUs;

    public function __construct(ContactUs $ContactUs )
    {
        $this->ContactUs = $ContactUs;
    }
    public function all(){
       return $this->ContactUs->all();
    }

    public function get($id){
        return $this->ContactUs->find($id);
    }

    public function store(array $data){
        return $this->ContactUs->create($data);
    }

    public function update($id,array $data){
        return $this->ContactUs->find($id)->update($data);
    }

}

