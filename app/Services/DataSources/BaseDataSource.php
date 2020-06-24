<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services\DataSources;

use Log;

class BaseDataSource{
    
    private $model_class;


    function setModelClass($class){
        $this->model_class = $class;
    }
    
    function paginate($query,$pageSize){
        if($pageSize == -1){
            return $query->get();
        }else if($pageSize == 1){
            return $query->first();
        }else{
            return $query->paginate($pageSize);
        }
    }

    public function create($params) {
        $model = $this->model_class::create($params);
        $this->update($model);
        return $model;

    }

    public function destroy($model) {

    }

    public function show($id) {
        return $this->model_class::findOrFail($id);
    }

    public function showList($idList){
        $list = $this->model_class::whereIn('id',$idList)->get();

        return $list;
    }

    public function store($model) {
        $model->save();
        $this->update($model);
        return $model;
    }

    public function update($model) {


    }
    public function edit($id, $params) {

    }

    public function where(&$query, $filter,array $columns, $operator = '='){

        foreach($columns as $key=>$column){
            if(!empty($filter[$column])){

                if(is_int($key)){
                    $query = $query->where($column,$operator,$filter[$column]);
                }else{
                    $query = $query->where($key,$operator,$filter[$column]);
                }

            }
        }

    }

    public function whereNull(&$query,array $params){
        foreach($params as $param){
            $query = $query->whereNull($param);
        }
    }

    public function whereNotNull(&$query,array $params){
        foreach($params as $param){
            $query = $query->whereNotNull($param);
        }
    }


    /**
     * @param $query
     * @param $filter
     * @param $expressions
     */
    public function whereFilter(&$query,$filter,$expressions){

        foreach($filter as $key => $value){


            if(!array_key_exists($key,$expressions) || empty($value)){
                continue;
            }

            $expression = $expressions[$key];
            if(is_callable($expression)){
                $expression($query,$value);
            }else{
                $arguments = $expression['arguments'];

                $value_type = gettype($value);

                if($value_type == 'array'){
                    array_push($arguments,$value);
                }else if($value_type == 'object'){
                    array_push($arguments,$value->all());
                }else{
                    $arguments = array_merge($arguments,
                        [($expression['prefix'] ?? '') . $value . ($expression['suffix'] ?? '')]
                    );
                }

                $function = $expression['function'];
                $query = $query->$function(...$arguments);
            }

        }

    }


}