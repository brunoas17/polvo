<?php

namespace App\Http\Controllers\Produtos;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Produto;
use Illuminate\Http\Request;

class ProdutosController extends Controller
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

        if(isset($_GET['ajax']) && !empty($_GET['ajax']))
        {
            $produtos = Produto::select('id','nome as name','preco','sku')->get();
            return json_encode($produtos);
        } else {

            if (!empty($keyword)) {
                $produtos = Produto::where('sku', 'LIKE', "%$keyword%")
                    ->orWhere('nome', 'LIKE', "%$keyword%")
                    ->orWhere('descricao', 'LIKE', "%$keyword%")
                    ->orWhere('preco', 'LIKE', "%$keyword%")
                    ->latest()->paginate($perPage);
            } else {
                $produtos = Produto::latest()->paginate($perPage);
            }

            return view('produtos.index', compact('produtos'));

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('produtos.create');
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
        
        Produto::create($requestData);

        return redirect('produtos')->with('flash_message', 'Produto added!');
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
        $produto = Produto::findOrFail($id);

        return view('produtos.show', compact('produto'));
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
        $produto = Produto::findOrFail($id);

        return view('produtos.edit', compact('produto'));
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
        
        $produto = Produto::findOrFail($id);
        $produto->update($requestData);

        return redirect('produtos')->with('flash_message', 'Produto updated!');
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
        Produto::destroy($id);

        return redirect('produtos')->with('flash_message', 'Produto deleted!');
    }

}
