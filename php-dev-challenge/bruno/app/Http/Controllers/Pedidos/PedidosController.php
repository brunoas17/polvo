<?php

namespace App\Http\Controllers\Pedidos;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Pedido;
use App\PedidoProduto;
use Illuminate\Http\Request;

class PedidosController extends Controller
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
            $pedidos = Pedido::where('total', 'LIKE', "%$keyword%")
                ->orWhere('data', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $pedidos = Pedido::latest()->paginate($perPage);
        }

        return view('pedidos.index', compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pedidos.create');
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
        
        $pedido = Pedido::create($requestData);
        if($pedido)
        {
            $produtos = explode(',',$requestData['produtos']);
            foreach ($produtos as $key => $value) {
                $pedidoProduto = ['id_pedido'=>$pedido->id,"id_produto"=>$value];

                $pedidoProduto = PedidoProduto::create($pedidoProduto);    
            }
        }

        return redirect('pedidos')->with('flash_message', 'Pedido added!');
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
        $pedido = Pedido::findOrFail($id);

        return view('pedidos.show', compact('pedido'));
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
        $pedido = Pedido::findOrFail($id);
        $pedidoProdutos = PedidoProduto::join('produtos', 'produtos.id', '=', 'pedido_produtos.id_produto')
        ->select('produtos.*')
        ->where('pedido_produtos.id_pedido',$id)
        ->get();

        return view('pedidos.edit', compact('pedido','pedidoProdutos'));
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
        
        $requestData = $request->all();
        
        $pedido = Pedido::findOrFail($id);
        $pedido->update($requestData);

        if($pedido)
        {
            $produtos = explode(',',$requestData['produtos']);
            foreach ($produtos as $key => $value) {
                $pedidoProduto = ['id_pedido'=>$pedido->id,"id_produto"=>$value];

                $pedidoProduto = PedidoProduto::create($pedidoProduto);    
            }
        }

        return redirect('pedidos')->with('flash_message', 'Pedido updated!');
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
        Pedido::destroy($id);

        return redirect('pedidos')->with('flash_message', 'Pedido deleted!');
    }
}
