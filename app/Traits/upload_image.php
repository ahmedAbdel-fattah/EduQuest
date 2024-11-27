<?php

namespace App\Traits;

trait upload_image
{
    public function upload_image($req,$input_name,$folder){
        $img=$req->file($input_name)->getClientOriginalName();
        $final_name=time() . str_replace(' ',"-",$img);
        $path= $req->file($input_name)->storeAs($folder,$final_name,'public_folder');
        return $path;
    }
}
