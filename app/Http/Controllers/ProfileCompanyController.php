<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Industri;
use Exception;

class ProfileCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $data =[
            'industri' => Industri::find($user->id_industri)
            
        ];
        return view('company.profile_company',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

            // $industri = Industri::create([
            //     // 'namaindustri' => $request->namaindustri,
            //     'notelpon' => $request->notelpon,
            //     'alamatindustri' => $request->alamatindustri,
            //     'description' => $request->description,
            //     // 'email' => $request->email,
            // ]);

            // return response()->json([
            //     'error' => false,
            //     'message' => 'Mitra Data successfully Created!',
            //     'url' => url('/dashbord')
            // ]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $industri = Industri::where('id_industri', $id)->first();
        return $industri;
    }

    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, $id)
     {
         try {
             $industri = Industri::where('id_industri', $id)->first();
 
             $industri->namaindustri = $request->namaindustri;
             $industri->email = $request->email;
             $industri->kategori_industri = $request->kategori_industri;
             $industri->statuskerjasama = $request->statuskerjasama;
             $industri->save();
 
             return response()->json([
                 'error' => false,
                 'message' => 'Mitra successfully Updated!',
                 'modal' => '#modal-mitraa'
             ]);
         } catch (Exception $e) {
             return response()->json([
                 'error' => true,
                 'message' => $e->getMessage(),
             ]);
         }
     }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}