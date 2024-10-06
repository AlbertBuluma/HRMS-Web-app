<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->withToken('1|TCF1plXy2UU6gEaCNn2V6btHu0pkWM6prfcPF6XD3fc44002')
            ->get('http://127.0.0.1:8010/api/staff');

        $data = $response->json();
//        dd($data['data']);

        return view('staff.index', [
            'staff_list' => $response->json()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->withToken('1|TCF1plXy2UU6gEaCNn2V6btHu0pkWM6prfcPF6XD3fc44002')
            ->post('http://127.0.0.1:8010/api/staff/', [
                'surname' => $request->input('surname'),
                'other_name' => $request->input('other_name'),
                'date_of_birth' => $request->input('date_of_birth'),
                'id_photo' => $request->hasFile('id_photo') ? base64_encode($request->file('id_photo')
                    ->store('staff_images', 'public')) : null,
            ]);

        if ($response->successful()) {
            return redirect('home');
        } else{
            dd($response->json());
            return view('staff.create')->withErrors($response->json());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
//        $response = Http::withHeaders([
//            'Content-Type' => 'application/json',
//            'Accept' => 'application/json',
//        ])->withToken('13|b19vSxWhh2AmjEJqMOgn975OpVeNeC2drJDDgnDOc44a5e1a')
//            ->patch('http://127.0.0.1:8010/api/staff/'.$id);
//
//        $data = $response->json();
////        dd($data['data']);
//
//        return view('staff.index')->with('staff', $response->json());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->withToken('1|TCF1plXy2UU6gEaCNn2V6btHu0pkWM6prfcPF6XD3fc44002')
            ->get('http://127.0.0.1:8010/api/staff/' . $id);

        $data = $response->json();
//        dd($data['data']);

        return view('staff.edit')->with('staff', $data['data']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->withToken('1|TCF1plXy2UU6gEaCNn2V6btHu0pkWM6prfcPF6XD3fc44002')
            ->patch('http://127.0.0.1:8010/api/staff/'.$id,
                [
                    'surname' => $request->input('surname'),
                    'other_name' => $request->input('other_name'),
                    'date_of_birth' => $request->input('date_of_birth'),
                    'id_photo' => $request->hasFile('id_photo') ? base64_encode($request->file('id_photo')
                        ->store('staff_images', 'public')) : null
                ]);

        if ($response->successful()) {
            return redirect('home');
        }else{
            dd($response->json());
            return view('staff.edit')->withErrors($response->json());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        dd($id);
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->withToken('1|TCF1plXy2UU6gEaCNn2V6btHu0pkWM6prfcPF6XD3fc44002')->delete('http://127.0.0.1:8010/api/staff/'.$id);


        if ($response->successful()) {
            return redirect('home');
        } else{
            return view('staff.index')->withErrors($response->json());
        }
    }
}
