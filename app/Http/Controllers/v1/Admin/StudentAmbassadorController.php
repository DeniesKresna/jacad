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
        $datas = StudentAmbassador::where('id', '>', 0);
        
        if ($request->has('search')) {
            $datas = $datas->where('name', 'LIKE', '%'.$search.'%');
        }

        $datas = $datas->orderBy('id', 'desc')->paginate($page_size);
        
        return response()->json($datas);
    }

    public function update($id) {
        $jsa= StudentAmbassador::where(['id' => $id])->first();

        if ($jsa) {
            $jsa->status= 1;
            $jsa->save();
            
            Notification::route('mail', $jsa->email)
                        ->notify(new NotifyJSA(
                            'Selamat anda sudah berhasil bergabung sebagai Jobhun Student Ambassador!
                            \r\nDitunggu informasi selanjutnya dari kami ya. Terima kasih!'
                        ));
            
            return response()->json([
                'data' => $jsa,
                'message' => 'JSA accepted'
            ]);
        } else {
            return response()->json([
                'data' => $jsa,
                'message' => 'Data not found'
            ]);
        }
    }

    public function destroy($id) {
        $jsa= StudentAmbassador::where(['id' => $id])->first();

        if ($jsa) {
            $jsa->delete();
            
            Notification::route('mail', $jsa->email)
                        ->notify(new NotifyJSA(
                            'Maaf pendaftaran anda tidak diterima, dikarenakan ada beberapa hal yang tidak seusai dengan kriteria.
                            \r\nTetap semangat dan coba lagi lain kali ya! Terima kasih.'
                        ));
            
            return response()->json([
                'data' => $jsa,
                'message' => 'JSA rejected'
            ]);
        } else {
            return response()->json([
                'data' => $jsa,
                'message' => 'Data not found'
            ]);
        }
    }
}