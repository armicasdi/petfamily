<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePropietarioAPIRequest;
use App\Http\Requests\API\UpdatePropietarioAPIRequest;
use App\Models\Propietario;
use App\Repositories\PropietarioRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PropietarioController
 * @package App\Http\Controllers\API
 */

class PropietarioAPIController extends AppBaseController
{
    /** @var  PropietarioRepository */
    private $propietarioRepository;

    public function __construct(PropietarioRepository $propietarioRepo)
    {
        $this->propietarioRepository = $propietarioRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/propietarios",
     *      summary="Get a listing of the Propietarios.",
     *      tags={"Propietario"},
     *      description="Get all Propietarios",
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
     *                  @SWG\Items(ref="#/definitions/Propietario")
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
        $propietarios = $this->propietarioRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        )->load('mascotas');

        return $this->sendResponse($propietarios->toArray(), 'Propietarios retrieved successfully');
    }

    /**
     * @param CreatePropietarioAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/propietarios",
     *      summary="Store a newly created Propietario in storage",
     *      tags={"Propietario"},
     *      description="Store Propietario",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Propietario that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Propietario")
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
     *                  ref="#/definitions/Propietario"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePropietarioAPIRequest $request)
    {
        $input = $request->all();

        $propietario = $this->propietarioRepository->create($input);

        return $this->sendResponse($propietario->toArray(), 'Propietario saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/propietarios/{id}",
     *      summary="Display the specified Propietario",
     *      tags={"Propietario"},
     *      description="Get Propietario",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Propietario",
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
     *                  ref="#/definitions/Propietario"
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
        /** @var Propietario $propietario */
        //$propietario = $this->propietarioRepository->find($id);
        $propietario = Propietario::with('mascotas')->get()->find($id);

        if (empty($propietario)) {
            return $this->sendError('Propietario not found');
        }

        return $this->sendResponse($propietario->toArray(), 'Propietario retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePropietarioAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/propietarios/{id}",
     *      summary="Update the specified Propietario in storage",
     *      tags={"Propietario"},
     *      description="Update Propietario",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Propietario",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Propietario that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Propietario")
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
     *                  ref="#/definitions/Propietario"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePropietarioAPIRequest $request)
    {
        $input = $request->all();

        /** @var Propietario $propietario */
        $propietario = $this->propietarioRepository->find($id);

        if (empty($propietario)) {
            return $this->sendError('Propietario not found');
        }

        $propietario = $this->propietarioRepository->update($input, $id);

        return $this->sendResponse($propietario->toArray(), 'Propietario updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/propietarios/{id}",
     *      summary="Remove the specified Propietario from storage",
     *      tags={"Propietario"},
     *      description="Delete Propietario",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Propietario",
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
        /** @var Propietario $propietario */
        $propietario = $this->propietarioRepository->find($id);

        if (empty($propietario)) {
            return $this->sendError('Propietario not found');
        }

        $propietario->delete();

        return $this->sendResponse($id, 'Propietario deleted successfully');
    }
}
