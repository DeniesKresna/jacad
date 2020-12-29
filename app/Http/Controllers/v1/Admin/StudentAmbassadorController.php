<?php 

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

use App\Http\Controllers\ApiController;
use App\Notifications\StudentAmbassador as NotifyJSA;
use App\Models\StudentAmbassador;

class StudentAmbassadorController extends ApiController {
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $page = $request->page;
        $page_size = $request->page_size;
        $search = $request->search;

        $student_ambassadors = StudentAmbassador::when($request->has('search') && $search, function($query) use ($search) {
            $query->where('name', 'LIKE', '%'.$search.'%');
        })
        ->orderBy('id', 'DESC')
        ->paginate($page_size);
        
        return response()->json($student_ambassadors);
    }

    public function show($id) {
        $student_ambassador= StudentAmbassador::findOrFail($id);
        
        return response()->json($student_ambassador);
    }

    public function update(Request $request, $id) {
        $student_ambassador= StudentAmbassador::findOrFail($id);
        $mail_text= '';

        if (!$request->action) {
            return response()->json(['message' => 'Request not found'], 400);
        }
        
        if ($request->action === 'accept') {
            $student_ambassador->status= 1;
            $mail_text= "Selamat {$student_ambassador->name}anda sudah berhasil bergabung sebagai Jobhun Student Ambassador! 
            Ditunggu informasi selanjutnya dari kami ya. Terima kasih!";
        } else if ($request->action === 'reject') {
            $student_ambassador->status= 2;
            $mail_text= "Sorry {$student_ambassador->name}, pendaftaran anda tidak diterima, dikarenakan ada beberapa hal yang tidak seusai dengan kriteria.
            Tetap semangat dan coba lagi lain kali ya! Terima kasih!";
        } else {
            return response()->json(['message' => 'Request not valid'], 400);
        }

        $student_ambassador->save();

        $response= null;

        try {
            Notification::route('mail', $student_ambassador->email)
                        ->notify(new NotifyJSA($mail_text));
            $response= response()->json(['message' => "Student {$student_ambassador->name} {$request->action}ed!"]);
        } catch (\Throwable $th) {
            $response= response()->json(['message' => "Student {$student_ambassador->name} {$request->action}ed!, but can't send email."]);
        }

        return $response;
    }
}