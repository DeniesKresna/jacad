<?php
if (! function_exists('rules_lists')) {
    function rules_lists($controller, $method="any", $custom_var = [])
    {
        $path = explode('\\', $controller);
        $controller = array_pop($path);

        //================================Category=======================
        if($controller == "CategoryController"){
            if($method=="store"){
                return [
                    'name' => 'required|max:199'
                ];
            }
            else {
                return [
                    'name' => 'required|max:199'
                ];
            }

        }

        //================================Location =================================
        else if($controller == "LocationController"){
            if($method=="store"){
                return [
                    'name' => 'required|max:199',
                ];
            }
            else{
                return [
                    'name' => 'required|max:199',
                ];
            }
        }

        //================================Media=================================
        else if($controller == "MediaController"){
            if($method=="store"){
                return [
                    'image' => 'required',
                ];
            }
        }

        //================================Post=================================
        else if($controller == "PostController"){
            if($method=="store"){
                return [
                    'title' => 'required|max:199',
                    'content' => 'required'
                ];
            }else{
                return [
                    'title' => 'required|max:199',
                    'content' => 'required'
                ];
            }
        }
        
        //========================Global============================================

        else if($controller == "Global"){
            if($method=="any"){
                return [
                    'start_date' => 'date|date_format:Y-m-d',
                    'end_date' => 'date|date_format:Y-m-d|after_or_equal:start_date',
                    'start_time' => 'date_format:Y-m-d H:i:s',
                    'end_time' => 'date_format:Y-m-d H:i:s'
                ];
            }
        }
        return [];
    }
}