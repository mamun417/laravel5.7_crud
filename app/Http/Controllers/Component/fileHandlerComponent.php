<?php

namespace App\Http\Controllers\Component;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class fileHandlerComponent extends Controller
{

    public function currentController()
    {
        $current_controller = strtolower(str_replace('Controller', '', class_basename(Route::current()->controller)));

        return $current_controller;
    }

    /**
     * @param $image
     * @return string
     */
    public function imageUpload($image, $field_name){

        // Validation
        if($field_name){
            request()->validate([
                $field_name => 'mimes:jpg,jpeg,bmp,png|max:500'
            ], [
                $field_name.'.mimes' => 'Invalid file try to upload!'
            ]);
        }

        $image_name = strtolower(str_random(5).'_'.$image->getClientOriginalName());
        $upload_image = $image->move(public_path('admin/uploads/images/').$this->currentController(), $image_name);

        if ($upload_image){
            return $image_name;
        }
    }

    public function deleteImage($image_name){

        $image_path = 'admin/uploads/images/'.$this->currentController().'/'.$image_name;

        if (file_exists($image_path)){
            unlink($image_path);
        }
    }
}
