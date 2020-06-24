<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services\DataSources;


use DB;
use Cache;
use Exception;


class DataSource{

    private $query;

    public function __construct($class){
        $this->query = new $class;
    }

    private function limit(){
        return 1000;
    }

    public function withTrashed(){
        $this->query = $this->query->withTrashed();
        return $this;
    }

    public function select(array $select){
        $this->query = $this->query->select($select);
        return $this;
    }

    public function first(){
        return $this->query->first();
    }

    public function paginate($pageSize){
        $limit = $this->limit();

        if($pageSize > $limit){
            throw new Exception('out of limit ' . $limit);
        }

        return $this->query->paginate($pageSize);
    }

    public function create($params) {
        return $this->query::create($params);
    }

    public function delete($model) {
        return $model->delete();
    }

    public function find($id) {
        return $this->query::find($id);
    }

    public function findOrFail($id){
        return $this->query::findOrFail($id);
    }

    public function get($pageSize){
        $limit = $this->limit();

        if($pageSize > $limit){
            throw new Exception('out of limit ' . $limit);
        }

        return $this->query->take($pageSize)->get();
    }

    public function where(array $where,$operator = '='){
        foreach($where as $column => $value){
            $this->query = $this->query->where($column,$operator,$value);
        }

        return $this;
    }

    public function whereIn(array $whereIn){
        foreach($whereIn as $column => $value){
            $this->query = $this->query->whereIn($column,$value);
        }

        return $this;
    }

    public function whereRaw(array $whereRaw){

    }

    public function save($model) {
        return $model->save();
    }

    public function update($id,$params) {
        return $this->query->where('id', $id)
            ->update($params);
    }

}