<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSexoAPIRequest;
use App\Http\Requests\API\UpdateSexoAPIRequest;
use App\Models\Sexo;
use App\Repositories\SexoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SexoController
 * @package App\Http\Controllers\API
 */

class SexoAPIController extends AppBaseController
{
    /** @var  SexoRepository */
    private $sexoRepository;

    public function __construct(SexoRepository $sexoRepo)
    {
        $this->sexoRepository = $sexoRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/sexos",
     *      summary="Get a listing of the Sexos.",
     *      tags={"Sexo"},
     *      description="Get all Sexos",
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
     *                  @SWG\Items(ref="#/definitions/Sexo")
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
        $sexos = $this->sexoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($sexos->toArray(), 'Sexos retrieved successfully');
    }

    /**
     * @param CreateSexoAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/sexos",
     *      summary="Store a newly created Sexo in storage",
     *      tags={"Sexo"},
     *      description="Store Sexo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Sexo that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Sexo")
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
     *                  ref="#/definitions/Sexo"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSexoAPIRequest $request)
    {
        $input = $request->all();

        $sexo = $this->sexoRepository->create($input);

        return $this->sendResponse($sexo->toArray(), 'Sexo saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/sexos/{id}",
     *      summary="Display the specified Sexo",
     *      tags={"Sexo"},
     *      description="Get Sexo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Sexo",
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
     *                  ref="#/definitions/Sexo"
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
        /** @var Sexo $sexo */
        $sexo = $this->sexoRepository->find($id);

        if (empty($sexo)) {
            return $this->sendError('Sexo not found');
        }

        return $this->sendResponse($sexo->toArray(), 'Sexo retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSexoAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/sexos/{id}",
     *      summary="Update the specified Sexo in storage",
     *      tags={"Sexo"},
     *      description="Update Sexo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Sexo",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Sexo that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Sexo")
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
     *                  ref="#/definitions/Sexo"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSexoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Sexo $sexo */
        $sexo = $this->sexoRepository->find($id);

        if (empty($sexo)) {
            return $this->sendError('Sexo not found');
        }

        $sexo = $this->sexoRepository->update($input, $id);

        return $this->sendResponse($sexo->toArray(), 'Sexo updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/sexos/{id}",
     *      summary="Remove the specified Sexo from storage",
     *      tags={"Sexo"},
     *      description="Delete Sexo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Sexo",
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
        /** @var Sexo $sexo */
        $sexo = $this->sexoRepository->find($id);

        if (empty($sexo)) {
            return $this->sendError('Sexo not found');
        }

        $sexo->delete();

        return $this->sendResponse($id, 'Sexo deleted successfully');
    }
}
