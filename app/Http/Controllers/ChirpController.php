<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
 
    public function index()
    {
        //[2, 7 -> Chirp.php,] Muestra los mensajes en la vista empezando por el ultimo hasta el final 
        return view('chirps.index', [
            'chirps' => Chirp::with('user')->latest()->get(),
        ]);
    }
 
    public function create()
    {
        //
    }
 
    public function store(Request $request)
    {
        //[3] Valida los datos del mensaje que cumpla con los requisitos especificados 
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        //Recopila la informacion validada pra crear el post -> User.php
        $request->user()->chirps()->create($validated);
 
        return redirect(route('chirps.index'));
    }
 
    public function show(Chirp $chirp)
    {
        //
    }
     public function edit(Chirp $chirp)
    {
        //[10] Verificamos que el usuario tenga la autorizacion para editar el post
        $this->authorize('update', $chirp);

        return view('chirps.edit', [
            'chirp' => $chirp,
        ]);
    }
     public function update(Request $request, Chirp $chirp)
    {
        //[10] -> Web.php
        $this->authorize('update', $chirp);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $chirp->update($validated);

        return redirect(route('chirps.index'));
    }
 
    public function destroy(Chirp $chirp)
    {
        //[12] Permitir la eliminacion del post para el autor -> ChirpPolicy.php
        $this->authorize('delete', $chirp);

        $chirp->delete();

        return redirect(route('chirps.index'));
    }
}
