<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;

use Validator;

class DepartmentController extends BaseController
{
    public function index(): JsonResponse
    {
        $departments = Department::all();

        return $this->sendResponse(
            DepartmentResource::collection($departments), '
            Departments retrieved successfully'
        );
    }

    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'location' => 'required',
            'website' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $department = Department::create($input);

        return $this->sendResponse(new DepartmentResource($department), 'Department created successfully.');
    }

    public function show($id): JsonResponse
    {
        $department = Department::find($id);

        if (is_null($department)) {
            return $this->sendError('Department not found');
        }

        return $this->sendResponse(new DepartmentResource($department), 'Department retrived successfully');
    }

    public function update(Request $request, Department $department): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'location' => 'required',
            'website' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $department->title = $input['title'];
        // $department->location = $input['description'];
        $department->location = $input['location'];
        $department->website = $input['website'];
        $department->save();

        return $this->sendResponse(new DepartmentResource($department), 'Department updated successfully');
    }

    public function destroy(Department $department): JsonResponse
    {
        $department->delete();

        return $this->sendResponse([], 'Department deleted successfully');
    }
}
