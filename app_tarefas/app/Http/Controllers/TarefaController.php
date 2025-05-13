<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tarefa;

class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // GET /api/tarefas
    public function index(Request $request)
    {
        // Filtros opcionais
        $query = Tarefa::with('status');

        if ($request->has('status_id')) {
            $query->where('status_id', $request->status_id);
        }

        if ($request->has('vencimento')) {
            $query->whereDate('vencimento', $request->vencimento);
        }

        $tarefas = $query->orderBy('vencimento')->get();

        return response()->json($tarefas);
    }

    /**
     * Store a newly created resource in storage.
     */
    // POST /api/tarefas
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo'     => 'required|string|max:255',
            'descricao'  => 'nullable|string',
            'vencimento' => 'required|date',
            'status_id'  => 'required|exists:statuses,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['erros' => $validator->errors()], 422);
        }

        $tarefa = Tarefa::create($validator->validated());
        return response()->json($tarefa, 201);
    }

    /**
     * Display the specified resource.
     */
    // GET /api/tarefas/{id}
    public function show($id)
    {
        $tarefa = Tarefa::with('status')->find($id);

        if (!$tarefa) {
            return response()->json(['mensagem' => 'Tarefa não encontrada.'], 404);
        }

        return response()->json($tarefa);
    }

    /**
     * Update the specified resource in storage.
     */
    // PUT /api/tarefas/{id}
    public function update(Request $request, $id)
    {
        $tarefa = Tarefa::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'titulo'     => 'required|string|max:255',
            'descricao'  => 'nullable|string',
            'vencimento' => 'required|date',
            'status_id'  => 'required|exists:statuses,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['erros' => $validator->errors()], 422);
        }

        $tarefa->update($validator->validated());
        return response()->json($tarefa);
    }

    /**
     * Remove the specified resource from storage.
     */
    // DELETE /api/tarefas/{id}
    public function destroy($id)
    {
        $tarefa = Tarefa::findOrFail($id);
        $tarefa->delete();

        return response()->json(['mensagem' => 'Tarefa excluída com sucesso.'], 204);
    }
}
