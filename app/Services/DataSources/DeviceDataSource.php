<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services\DataSources;

use App\Models\Device as Model;

use DB;

use App\Services\DataSources\DataSourceInterface;
use App\Services\DataSources\BaseDataSource;


class DeviceDataSource extends BaseDataSource implements DataSourceInterface{


    public function create($params) {
        $model = Model::create($params);
        $this->update($model);
        return $model;
    }

    public function destroy($model) {

    }

    public function edit($id, $params) {

    }


    public function index($filter, $pageSize, $count = false, $distinct = null) {
        $query = new Model;

        $expressions = [
            'mobile' => [
                'function' => 'where',
                'arguments' => ['mobile','like'],
                'prefix' => '%',
                'suffix' => '%'
            ],
            'dev_id' => [
                'function' => 'where',
                'arguments' => ['dev_id','like'],
                'prefix' => '%',
                'suffix' => '%'
            ],
            'shop_id' => [
                'function' => 'where',
                'arguments' => ['href','like'],
                'prefix' => '%shop_id=',
                'suffix' => '%'
            ],
            'referrer' => [
                'function' => 'where',
                'arguments' => ['referrer','like'],
                'prefix' => '%',
                'suffix' => '%'
            ],
            'customer_id' => [
                'function' => 'where',
                'arguments' => ['customer_id','='],
            ],
            'from' => [
                'function' => 'where',
                'arguments' => ['from','='],
            ],
            'customer_phone' => function(&$query,$value){
                $query = $query->whereHas('customer',function($query) use ($value){
                    $query->where('phone',$value);
                });
            },
            'created_end' => [
                'function' => 'where',
                'arguments' => ['created_at','<'],
            ],
            'created_start' => [
                'function' => 'where',
                'arguments' => ['created_at','>='],
            ],
            'status' => function(&$query,$value){
                $query = $query->whereRaw('(status & ' . $value . ') = ' . $value);
            },
            'no_status' => function(&$query,$value){
                $query = $query->whereRaw('(status & ' . $value . ') = 0');
            }
        ];
        $this->whereFilter($query,$filter,$expressions);

        if($count){
            if(!empty($distinct)){
                return $query->count(DB::raw('distinct ' . $distinct));
            }
            return $query->count();
        }

        if(!empty($filter['orderBy'])){
            $query = $query->orderBy($filter['orderBy'],$filter['orderByType']);
        }else{
            $query = $query->orderBy('int_id','desc');
        }

        return $this->paginate($query, $pageSize);
    }

    public function show($id) {
        return Model::findOrFail($id);
    }
    public function showList($idList){
        $list = Model::whereIn('id',$idList)->get();

        return $list;
    }
    public function store($model) {
        $model->save();
        $this->update($model);
        return $model;
    }

    public function update($model) {


    }

}