<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\API\BaseController as BaseController; // Keep the alias
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Support\Facades\Validator; // Ensure Validator is imported

class ProjectController extends BaseController // Extend BaseController
{
    public function index(): JsonResponse
    {
        // Load all projects with their related employees
        $projects = Project::with('employees')->get();

        return $this->sendResponse(
            ProjectResource::collection($projects),
            'Projects retrieved successfully'
        );
    }

    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $project = Project::create($input);

        return $this->sendResponse(new ProjectResource($project), 'Project created successfully.');
    }

    public function show($id): JsonResponse
    {
        $project = Project::with('employees')->findOrFail($id);

        return $this->sendResponse(new ProjectResource($project), 'Project retrieved successfully');
    }

    public function update(Request $request, Project $project): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        // Update project attributes
        $project->title = $input['title'];
        $project->description = $input['description'];
        $project->start = $input['start'];
        $project->end = $input['end'];
        $project->save();

        return $this->sendResponse(new ProjectResource($project), 'Project updated successfully');
    }

    public function destroy(Project $project): JsonResponse
    {
        $project->delete();

        return $this->sendResponse([], 'Project deleted successfully');
    }
}
