<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRazaAPIRequest;
use App\Http\Requests\API\UpdateRazaAPIRequest;
use App\Models\Raza;
use App\Repositories\RazaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RazaController
 * @package App\Http\Controllers\API
 */

class RazaAPIController extends AppBaseController
{
    /** @var  RazaRepository */
    private $razaRepository;

    public function __construct(RazaRepository $razaRepo)
    {
        $this->razaRepository = $razaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/razas",
     *      summary="Get a listing of the Razas.",
     *      tags={"Raza"},
     *      description="Get all Razas",
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
     *                  @SWG\Items(ref="#/definitions/Raza")
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
        $razas = $this->razaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($razas->toArray(), 'Razas retrieved successfully');
    }

    /**
     * @param CreateRazaAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/razas",
     *      summary="Store a newly created Raza in storage",
     *      tags={"Raza"},
     *      description="Store Raza",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Raza that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Raza")
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
     *                  ref="#/definitions/Raza"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateRazaAPIRequest $request)
    {
        $input = $request->all();

        $raza = $this->razaRepository->create($input);

        return $this->sendResponse($raza->toArray(), 'Raza saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/razas/{id}",
     *      summary="Display the specified Raza",
     *      tags={"Raza"},
     *      description="Get Raza",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Raza",
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
     *                  ref="#/definitions/Raza"
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
        /** @var Raza $raza */
        $raza = $this->razaRepository->find($id);

        if (empty($raza)) {
            return $this->sendError('Raza not found');
        }

        return $this->sendResponse($raza->toArray(), 'Raza retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateRazaAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/razas/{id}",
     *      summary="Update the specified Raza in storage",
     *      tags={"Raza"},
     *      description="Update Raza",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Raza",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Raza that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Raza")
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
     *                  ref="#/definitions/Raza"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateRazaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Raza $raza */
        $raza = $this->razaRepository->find($id);

        if (empty($raza)) {
            return $this->sendError('Raza not found');
        }

        $raza = $this->razaRepository->update($input, $id);

        return $this->sendResponse($raza->toArray(), 'Raza updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/razas/{id}",
     *      summary="Remove the specified Raza from storage",
     *      tags={"Raza"},
     *      description="Delete Raza",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Raza",
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
        /** @var Raza $raza */
        $raza = $this->razaRepository->find($id);

        if (empty($raza)) {
            return $this->sendError('Raza not found');
        }

        $raza->delete();

        return $this->sendResponse($id, 'Raza deleted successfully');
    }
}
