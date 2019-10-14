<?php

namespace App\Http\Controllers;

use App\DataTables\SexoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSexoRequest;
use App\Http\Requests\UpdateSexoRequest;
use App\Repositories\SexoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class SexoController extends AppBaseController
{
    /** @var  SexoRepository */
    private $sexoRepository;

    public function __construct(SexoRepository $sexoRepo)
    {
        $this->sexoRepository = $sexoRepo;
    }

    /**
     * Display a listing of the Sexo.
     *
     * @param SexoDataTable $sexoDataTable
     * @return Response
     */
    public function index(SexoDataTable $sexoDataTable)
    {
        return $sexoDataTable->render('sexos.index');
    }

    /**
     * Show the form for creating a new Sexo.
     *
     * @return Response
     */
    public function create()
    {
        return view('sexos.create');
    }

    /**
     * Store a newly created Sexo in storage.
     *
     * @param CreateSexoRequest $request
     *
     * @return Response
     */
    public function store(CreateSexoRequest $request)
    {
        $input = $request->all();

        $sexo = $this->sexoRepository->create($input);

        Flash::success('Sexo saved successfully.');

        return redirect(route('sexos.index'));
    }

    /**
     * Display the specified Sexo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sexo = $this->sexoRepository->find($id);

        if (empty($sexo)) {
            Flash::error('Sexo not found');

            return redirect(route('sexos.index'));
        }

        return view('sexos.show')->with('sexo', $sexo);
    }

    /**
     * Show the form for editing the specified Sexo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sexo = $this->sexoRepository->find($id);

        if (empty($sexo)) {
            Flash::error('Sexo not found');

            return redirect(route('sexos.index'));
        }

        return view('sexos.edit')->with('sexo', $sexo);
    }

    /**
     * Update the specified Sexo in storage.
     *
     * @param  int              $id
     * @param UpdateSexoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSexoRequest $request)
    {
        $sexo = $this->sexoRepository->find($id);

        if (empty($sexo)) {
            Flash::error('Sexo not found');

            return redirect(route('sexos.index'));
        }

        $sexo = $this->sexoRepository->update($request->all(), $id);

        Flash::success('Sexo updated successfully.');

        return redirect(route('sexos.index'));
    }

    /**
     * Remove the specified Sexo from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sexo = $this->sexoRepository->find($id);

        if (empty($sexo)) {
            Flash::error('Sexo not found');

            return redirect(route('sexos.index'));
        }

        $this->sexoRepository->delete($id);

        Flash::success('Sexo deleted successfully.');

        return redirect(route('sexos.index'));
    }
}
