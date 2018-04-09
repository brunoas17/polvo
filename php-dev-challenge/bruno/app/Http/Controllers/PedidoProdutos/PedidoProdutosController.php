<?php

namespace App\Http\Controllers\PedidoProdutos;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PedidoProduto;
use Illuminate\Http\Request;

class PedidoProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $pedidoprodutos = PedidoProduto::where('id_pedido', 'LIKE', "%$keyword%")
                ->orWhere('id_produto', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $pedidoprodutos = PedidoProduto::latest()->paginate($perPage);
        }

        return view('pedido-produtos.index', compact('pedidoprodutos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pedido-produtos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        PedidoProduto::create($requestData);

        return redirect('pedido-produtos')->with('flash_message', 'PedidoProduto added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $pedidoproduto = PedidoProduto::findOrFail($id);

        return view('pedido-produtos.show', compact('pedidoproduto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $pedidoproduto = PedidoProduto::findOrFail($id);

        return view('pedido-produtos.edit', compact('pedidoproduto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        echo 'aqui';
        die;
        $requestData = $request->all();
        
        $pedidoproduto = PedidoProduto::findOrFail($id);
        $pedidoproduto->update($requestData);

        return redirect('pedido-produtos')->with('flash_message', 'PedidoProduto updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        PedidoProduto::destroy($id);

        return redirect('pedido-produtos')->with('flash_message', 'PedidoProduto deleted!');
    }
}
