<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMascotaAPIRequest;
use App\Http\Requests\API\UpdateMascotaAPIRequest;
use App\Models\Mascota;
use App\Repositories\MascotaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MascotaController
 * @package App\Http\Controllers\API
 */

class MascotaAPIController extends AppBaseController
{
    /** @var  MascotaRepository */
    private $mascotaRepository;

    public function __construct(MascotaRepository $mascotaRepo)
    {
        $this->mascotaRepository = $mascotaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/mascotas",
     *      summary="Get a listing of the Mascotas.",
     *      tags={"Mascota"},
     *      description="Get all Mascotas",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Mascota")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $mascotas = $this->mascotaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        )->load('propietario');

        return $this->sendResponse($mascotas->toArray(), 'Mascotas retrieved successfully');
    }

    /**
     * @param CreateMascotaAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/mascotas",
     *      summary="Store a newly created Mascota in storage",
     *      tags={"Mascota"},
     *      description="Store Mascota",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Mascota that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Mascota")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Mascota"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMascotaAPIRequest $request)
    {
        $input = $request->all();

        $mascota = $this->mascotaRepository->create($input);

        return $this->sendResponse($mascota->toArray(), 'Mascota saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/mascotas/{id}",
     *      summary="Display the specified Mascota",
     *      tags={"Mascota"},
     *      description="Get Mascota",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Mascota",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Mascota"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Mascota $mascota */
        $mascota = $this->mascotaRepository->find($id);

        if (empty($mascota)) {
            return $this->sendError('Mascota not found');
        }

        return $this->sendResponse($mascota->toArray(), 'Mascota retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMascotaAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/mascotas/{id}",
     *      summary="Update the specified Mascota in storage",
     *      tags={"Mascota"},
     *      description="Update Mascota",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Mascota",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Mascota that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Mascota")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Mascota"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMascotaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Mascota $mascota */
        $mascota = $this->mascotaRepository->find($id);

        if (empty($mascota)) {
            return $this->sendError('Mascota not found');
        }

        $mascota = $this->mascotaRepository->update($input, $id);

        return $this->sendResponse($mascota->toArray(), 'Mascota updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/mascotas/{id}",
     *      summary="Remove the specified Mascota from storage",
     *      tags={"Mascota"},
     *      description="Delete Mascota",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Mascota",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Mascota $mascota */
        $mascota = $this->mascotaRepository->find($id);

        if (empty($mascota)) {
            return $this->sendError('Mascota not found');
        }

        $mascota->delete();

        return $this->sendResponse($id, 'Mascota deleted successfully');
    }
}
