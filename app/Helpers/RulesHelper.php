<?php
if (!function_exists('rules_lists')) {
    function rules_lists($controller, $method="any", $custom_var = []) {
        $path = explode('\\', $controller);
        $controller = array_pop($path);

        //Mentor
        if ($controller == 'MentorController') {
            if ($method == 'store') {
                return [
                    'name' => 'required|max:199',
                    'description' => 'required',
                    'linkedIn_url' => 'required',
                    'file' => 'image'
                ];
            } else if ($method == 'update') {
                return [
                    'name' => 'required|max:199',
                    'description' => 'required'
                ];
            }
        }

        //Tag
        else if ($controller == 'TagController') {
            if ($method == 'store') {
                return [
                    'name' => 'required|max:199'
                ];
            }
        }
        
        //Blog
        else if ($controller == 'BlogController') {
            if ($method == 'store') {
                return [
                    'title' => 'required|max:199',
                    'content' => 'required',
                    'category' => 'required',
                    'tags' => 'required',
                    'file' => 'image'
                ];
            } else if ($method == 'update') {
                return [
                    'title' => 'required|max:199',
                    'content' => 'required',
                    'category' => 'required',
                    'tags' => 'required'
                ];
            }
        }

        //Opening
        else if ($controller == 'OpeningController') {
            if ($method == 'store') {
                return [
                    'content' => 'required'
                ];
            }
        }

        //Media
        else if ($controller == "MediaController") {
            if ($method == "store") {
                return [
                    'image' => 'required',
                ];
            }
        }

        //Location
        else if ($controller == "LocationController") {
            if ($method == "store") {
                return [
                    'name' => 'required|max:199',
                ];
            } else {
                return [
                    'name' => 'required|max:199',
                ];
            }
        }
        
        //Academy
        else if ($controller == 'AcademyController') {
            if ($method == 'store' || $method == 'update') {
                return [
                    'name' => 'required|max:199',
                    'desc' => 'required',
                    'price' => 'required',
                ];
            }
        }
        
        //Academy Period
        else if ($controller == 'AcademyPeriodController') {
            if ($method == 'store') {
                return [
                    'period' => 'required',
                    'price' => 'required',
                    'description' => 'required',
                ];
            } else if ($method == 'update') {
                return [
                    'period' => 'required|string|nullable',
                    'price' => 'required|integer|nullable',
                    'description' => 'required|string|nullable',
                ];
            }
        }
        
        //Academy Registration
        else if ($controller == 'AcademyRegistrationController') {
            if ($method == 'store') {
                return [
                    'name' => 'required',
                    'email' => 'required', 
                    'phone' => 'required',
                    'description' => 'required',
                    'domicile' => 'required',
                    'jobhun_info' => 'required'
                ];
            }
        }
        
        //Ask Career
        else if ($controller == 'AskCareerController') {
            if ($method == 'store' || $method == 'update') {
                return [
                    'name' => 'required|max:199',
                    'schedule' => 'required',
                    'price' => 'required',
                    'mentor' => 'required'
                ];
            }
        }
        
        //Mentoring 
        else if ($controller == 'MentoringController') {
            if ($method == 'store') {
                return [
                    'name' => 'required|max:199',
                    'email' => 'required|max:199',
                    'phone' => 'required',
                    'domicile' => 'required|max:199',
                    'description' => 'required',
                    'spesific_topic' => 'required',
                    'mentoring_types' => 'required',
                    'date' => 'required',
                    'time' => 'required',
                    'duration' => 'required',
                    'jobhun_info' => 'required'
                ];
            }   
        }

        //Job
        else if ($controller == "JobController") {
            if ($method == "store" || $method == 'update') {
                return [
                    'name' => 'required|max:199',
                    'tagline' => 'required|max:199',
                    'information' => 'required',
                    'address' => 'required|max:199',
                    'site_url' => 'required|max:199',
                    'phone' => 'required|max:199',
                    'email' => 'required|max:199',
                    'position' => 'required|max:199',
                    'type' => 'required|max:199',
                    'sectors' => 'required',
                    'location' => 'required',
                    'job_desc' => 'required',
                    'work_time' => 'required|max:199',
                    'dress_style' => 'required|max:199',
                    'language' => 'required|max:199',
                    'facility' => 'required|max:199',
                    'salary' => 'required|max:199',
                    'how_to_send' => 'required|max:199',
                    'expired' => 'required|max:199',
                    'process_time' => 'required|max:199',
                    'jobhun_info' => 'required|max:199',
                ];
            }
        }

        //Student Ambassador
        else if ($controller == 'StudentAmbassadorController') {
            if ($method == 'store') {
                return [
                    'email' => 'required|max:199',
                    'name' => 'required|max:199',
                    'age' => 'required|numeric',
                    'address' => 'required|max:199',
                    'university' => 'required|max:199',
                    'faculty' => 'required|max:199',
                    'major' => 'required|max:199',
                    'phone' => 'required|max:199',
                    'line_id' => 'required|max:199',
                    'ig_url' => 'required|max:199',
                    'linkedIn_url' => 'required|max:199'
                ];
            }
        }

        //Login
        else if ($controller == 'LoginController') {
            if ($method == 'index') {
                return [
                    'username' => 'required|string|max:200',
                    'password' => 'required|string|min:6|max:100'
                ];
            }
        }

        //Register
        else if ($controller == 'RegisterController') {
            if ($method == 'store') {
                return [
                    'name' => 'required|string|max:100',
                    'email' => 'required|string|max:200|unique:users',
                    'phone' => 'required|string|max:30',
                    'username' => 'required|string|max:255|unique:users',
                    'password' => 'required|string|min:6|max:100|confirmed',
                    'password_confirmation' => 'required'
                ];
            }
        }
        
        //Global
        else if ($controller == "Global"){
            if ($method == "any"){
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