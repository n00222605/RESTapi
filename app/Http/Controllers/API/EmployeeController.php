<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Http\Controllers\API\BaseController as BaseController;
use App\http\Resources\EmployeeResource;
use App\Models\Employee;

use validator;

class EmployeeController extends BaseController
{
    public function index(): JsonResponse
    {
        $employees = Employee::all();

        return $this->sendResponse(
            EmployeeResource::collection($employees), '
            Employees retrieved successfully'
        );
    }

    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'ppsn' => 'required',
            'address' => 'required',
            'salary' => 'required',
            'name' => 'required',
            'email' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $employee = Employee::create($input);

        return $this->sendResponse(new EmployeeResource($employee), 'Employee created successfully.');
    }

    public function show($id): JsonResponse
    {
        $employee = Employee::find($id);

        if (is_null($employee)) {
            return $this->sendError('Employee not found');
        }

        return $this->sendResponse(new EmployeeResource($employee), 'Employee retrived successfully');
    }

    public function update(Request $request, Employee $employee): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'ppsn' => 'required',
            'address' => 'required',
            'salary' => 'required',
            'name' => 'required',
            'email' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $employee->title = $input['title'];
        $employee->address = $input['address'];
        $employee->salary = $input['salary'];
        $employee->name = $input['name'];
        $employee->email = $input['email'];
        $employee->save();

        return $this->sendResponse(new EmployeeResource($employee), 'Employee updated successfully');
    }

    public function destroy(Employee $employee): JsonResponse
    {
        $employee->delete();

        return $this->sendResponse([], 'Employee deleted successfully');
    }
}
