<?php

namespace App\Repository;
use App\Repository\interfaces\CrudInterface;
use App\Models\OurTeam;


class OurTeamRepository implements CrudInterface {
   private  $OurTeam;

    public function __construct(OurTeam $OurTeam )
    {
        $this->OurTeam = $OurTeam;
    }
    public function all(){
       return $this->OurTeam->all();
    }

    public function get($id){
        return $this->OurTeam->find($id);
    }

    public function store(array $data){
        return $this->OurTeam->create($data);
    }

    public function update($id,array $data){
        return $this->OurTeam->find($id)->update($data);
    }

}

