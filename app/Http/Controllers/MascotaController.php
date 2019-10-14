<?php

namespace App\Http\Controllers;

use App\DataTables\MascotaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMascotaRequest;
use App\Http\Requests\UpdateMascotaRequest;
use App\Repositories\MascotaRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class MascotaController extends AppBaseController
{
    /** @var  MascotaRepository */
    private $mascotaRepository;

    public function __construct(MascotaRepository $mascotaRepo)
    {
        $this->mascotaRepository = $mascotaRepo;
    }

    /**
     * Display a listing of the Mascota.
     *
     * @param MascotaDataTable $mascotaDataTable
     * @return Response
     */
    public function index(MascotaDataTable $mascotaDataTable)
    {
        return $mascotaDataTable->render('mascotas.index');
    }

    /**
     * Show the form for creating a new Mascota.
     *
     * @return Response
     */
    public function create()
    {
        return view('mascotas.create');
    }

    /**
     * Store a newly created Mascota in storage.
     *
     * @param CreateMascotaRequest $request
     *
     * @return Response
     */
    public function store(CreateMascotaRequest $request)
    {
        $input = $request->all();

        $mascota = $this->mascotaRepository->create($input);

        Flash::success('Mascota saved successfully.');

        return redirect(route('mascotas.index'));
    }

    /**
     * Display the specified Mascota.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $mascota = $this->mascotaRepository->find($id);

        if (empty($mascota)) {
            Flash::error('Mascota not found');

            return redirect(route('mascotas.index'));
        }

        return view('mascotas.show')->with('mascota', $mascota);
    }

    /**
     * Show the form for editing the specified Mascota.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $mascota = $this->mascotaRepository->find($id);

        if (empty($mascota)) {
            Flash::error('Mascota not found');

            return redirect(route('mascotas.index'));
        }

        return view('mascotas.edit')->with('mascota', $mascota);
    }

    /**
     * Update the specified Mascota in storage.
     *
     * @param  int              $id
     * @param UpdateMascotaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMascotaRequest $request)
    {
        $mascota = $this->mascotaRepository->find($id);

        if (empty($mascota)) {
            Flash::error('Mascota not found');

            return redirect(route('mascotas.index'));
        }

        $mascota = $this->mascotaRepository->update($request->all(), $id);

        Flash::success('Mascota updated successfully.');

        return redirect(route('mascotas.index'));
    }

    /**
     * Remove the specified Mascota from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $mascota = $this->mascotaRepository->find($id);

        if (empty($mascota)) {
            Flash::error('Mascota not found');

            return redirect(route('mascotas.index'));
        }

        $this->mascotaRepository->delete($id);

        Flash::success('Mascota deleted successfully.');

        return redirect(route('mascotas.index'));
    }
}
