<?php

namespace App\Repository\interfaces;

interface CrudInterface {

    public function all();

    public function get($id);

    public function store(array $data);

    public function update($id,array $data);
}
