<?php


namespace App\Services;


interface Service{

    public function getAll();

    public function getOne($id);

    public function store($request);

    public function update($request,$id);

    public function destroy($id);

}