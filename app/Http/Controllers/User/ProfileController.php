<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $supplier = Supplier::find(auth()->user()->id);
        return view('users.profile.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $supplier = Supplier::find(auth()->user()->id);
        return view('users.profile.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Response\SupplierRequest  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierRequest $request): RedirectResponse
    {
        $supplier = Supplier::find(auth()->user()->id);
        $supplier->updateWithRelations($request->all(), $supplier);
        return redirect()->route('users.profile.show')
            ->with('status', 'success')
            ->with('msg', 'Perfil actualizado correctamente.');
    }
}
