<?php

namespace App\Http\Controllers\User\Setting;

use App\Http\Controllers\Controller;
use App\Model\Pages\page_setting;
use Illuminate\Http\Request;

class SpecialPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,page_setting $page_setting)
    {
       // return  $request->all();
        foreach ($request->all() as $key=>$index){
            $data=[];
         if($key=='mode') continue;
         if($key=='lang') continue;
             if($index['mode']=='slider'){
                 $data=$this->getSliderdata($index['data']);
                 $page_setting->updateOrCreate(
                     ['lang'=>$request->lang,'name'=>$key],
                     ['image'=>$data,'method'=>$request->mode,'model'=>'slider']
                 );
             };
            if($index['mode']=='img'){
                $data=$index['data'];
                $page_setting->updateOrCreate(
                    ['lang'=>$request->lang,'name'=>$key],
                    ['image'=>$data,'method'=>$request->mode,'model'=>'img']
                );
            };
            if($index['mode']=='longtext'){
                $data=$index['data'];
                $page_setting->updateOrCreate(
                    ['lang'=>$request->lang,'name'=>$key],
                    ['text'=>$data,'method'=>$request->mode,'model'=>'longtext']
                );
            };
            if($index['mode']=='text'){
                $data=$index['data'];
                $page_setting->updateOrCreate(
                    ['lang'=>$request->lang,'name'=>$key],
                    ['text'=>$data,'method'=>$request->mode,'model'=>'text']
                );
            };
            if($index['mode']=='product'){
                $data=$this->getSliderdata($index['data']);

                $page_setting->updateOrCreate(
                    ['lang'=>$request->lang,'name'=>$key],
                    ['image'=>$data,'method'=>$request->mode,'model'=>'product']
                );
            };
            if($index['mode']=='article'){
                $data=$this->getSliderdata($index['data']);

                $page_setting->updateOrCreate(
                    ['lang'=>$request->lang,'name'=>$key],
                    ['image'=>$data,'method'=>$request->mode,'model'=>'article']
                );
            };
        }
    }
    private function getSliderdata($data){

        return $data['id'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request,page_setting $page_setting)
    {
        $data=$page_setting->where('method',$id)->where('lang',$request->lang)->get();
        return  $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
