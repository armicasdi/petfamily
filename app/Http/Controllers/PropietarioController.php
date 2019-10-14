<?php

namespace App\Http\Controllers;

use App\DataTables\PropietarioDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePropietarioRequest;
use App\Http\Requests\UpdatePropietarioRequest;
use App\Models\Propietario;
use App\Repositories\PropietarioRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class PropietarioController extends AppBaseController
{
    /** @var  PropietarioRepository */
    private $propietarioRepository;

    public function __construct(PropietarioRepository $propietarioRepo)
    {
        $this->propietarioRepository = $propietarioRepo;
    }

    /**
     * Display a listing of the Propietario.
     *
     * @param PropietarioDataTable $propietarioDataTable
     * @return Response
     */
    public function index(PropietarioDataTable $propietarioDataTable)
    {
        return $propietarioDataTable->render('propietarios.index');
    }

    /**
     * Show the form for creating a new Propietario.
     *
     * @return Response
     */
    public function create()
    {
        return view('propietarios.create');
    }

    /**
     * Store a newly created Propietario in storage.
     *
     * @param CreatePropietarioRequest $request
     *
     * @return Response
     */
    public function store(CreatePropietarioRequest $request)
    {
        $input = $request->all();

        $propietario = $this->propietarioRepository->create($input);

        Flash::success('Propietario saved successfully.');

        return redirect(route('propietarios.index'));
    }

    /**
     * Display the specified Propietario.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $propietario = $this->propietarioRepository->find($id);
        //$propietario = Propietario::with('mascotas')->get()->find($id);

        if (empty($propietario)) {
            Flash::error('Propietario not found');

            return redirect(route('propietarios.index'));
        }

        return view('propietarios.show')->with('propietario', $propietario);
    }

    /**
     * Show the form for editing the specified Propietario.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $propietario = $this->propietarioRepository->find($id);

        if (empty($propietario)) {
            Flash::error('Propietario not found');

            return redirect(route('propietarios.index'));
        }

        return view('propietarios.edit')->with('propietario', $propietario);
    }

    /**
     * Update the specified Propietario in storage.
     *
     * @param  int              $id
     * @param UpdatePropietarioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePropietarioRequest $request)
    {
        $propietario = $this->propietarioRepository->find($id);

        if (empty($propietario)) {
            Flash::error('Propietario not found');

            return redirect(route('propietarios.index'));
        }

        $propietario = $this->propietarioRepository->update($request->all(), $id);

        Flash::success('Propietario updated successfully.');

        return redirect(route('propietarios.index'));
    }

    /**
     * Remove the specified Propietario from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $propietario = $this->propietarioRepository->find($id);

        if (empty($propietario)) {
            Flash::error('Propietario not found');

            return redirect(route('propietarios.index'));
        }

        $this->propietarioRepository->delete($id);

        Flash::success('Propietario deleted successfully.');

        return redirect(route('propietarios.index'));
    }
}
