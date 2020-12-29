<?php
if (!function_exists('rules_lists')) {
    function rules_lists($controller, $method="any", $custom_var = []) {
        $path = explode('\\', $controller);
        $controller = array_pop($path);

        //Login
        if ($controller == 'LoginController') {
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
                    'username' => 'required|string|max:255|unique:users',
                    'password' => 'required|string|min:6|max:100|confirmed',
                    'password_confirmation' => 'required',
                    'email' => 'required|string|max:200|unique:users',
                    'phone' => 'required|string|max:30',
                ];
            }
        }

        //Mentor
        if ($controller == 'MentorController') {
            if ($method == 'store') {
                return [
                    'name' => 'required',
                    'description' => 'required',
                    'linkedIn_url' => 'required',
                    'file' => 'image'
                ];
            } else if ($method == 'update') {
                return [
                    'name' => 'required',
                    'description' => 'required'
                ];
            }
        }
        
        //Blog
        else if ($controller == 'BlogController') {
            if ($method == 'store') {
                return [
                    'title' => 'required',
                    'content' => 'required',
                    'category_id' => 'required',
                    'tags' => 'required',
                    'image' => 'image'
                ];
            } else if ($method == 'update') {
                return [
                    'title' => 'required',
                    'content' => 'required',
                    'category_id' => 'required',
                    'tags' => 'required'
                ];
            }
        }
        
        //Academy
        else if ($controller == 'AcademyController') {
            if ($method == 'store') {
                return [
                    'name' => 'required',
                    'description' => 'required',
                    'tags' => 'required',
                    'image' => 'image'
                ];
            } else if ($method == 'update') {
                return [
                    'name' => 'required',
                    'description' => 'required',
                    'tags' => 'required',
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
                    'academy_id' => 'required',
                    'mentors' => 'required'
                ];
            } else if ($method == 'update') {
                return [
                    'period' => 'required|string|nullable',
                    'price' => 'required|integer|nullable',
                    'description' => 'required|string|nullable',
                    'academy_id' => 'required',
                    'mentors' => 'required'
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
                    'jobhun_info' => 'required',
                    'academy_ids' => 'required'
                ];
            }
        }
        
        //Ask Career
        else if ($controller == 'AskCareerController') {
            if ($method == 'store' || $method == 'update') {
                return [
                    'name' => 'required',
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
                    'name' => 'required',
                    'email' => 'required',
                    'phone' => 'required',
                    'domicile' => 'required',
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
                    //COMPANY
                    'name' => 'required|max:199',
                    'tagline' => 'required|max:199',
                    'information' => 'required',
                    'address' => 'required|max:199',
                    'site_url' => 'required|max:199',
                    'phone' => 'required|max:199',
                    'email' => 'required|max:199',
                    'employee_amount' => 'required',

                    //JOB
                    'position' => 'required|max:199',
                    'type' => 'required|max:199',
                    'job_desc' => 'required',
                    'work_time' => 'required|max:199',
                    'dress_style' => 'required|max:199',
                    'language' => 'required|max:199',
                    'facility' => 'required|max:199',
                    'salary' => 'required|max:199',
                    'how_to_send' => 'required|max:199',
                    'process_time' => 'required|max:199',
                    'jobhun_info' => 'required|max:199',
                    'expired' => 'required|max:199',
                    'sectors' => 'required',
                    'location' => 'required',
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

        //Payment
        else if ($controller == 'PaymentController') {
            if ($method == 'store') {
                return [
                    'amount' => 'required',
                    'via' => 'required',
                    'transaction_status' => 'required'
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
        else if ($controller == 'MediaController') {
            if ($method == 'store') {
                return [
                    'image' => 'required',
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