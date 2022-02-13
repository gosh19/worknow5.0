<?php

namespace App\Http\Controllers;

use App\Carrito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CarritoController extends Controller
{
   public function addProd(\App\Product $Product)
   {
       $carrito = Carrito::firstOrCreate(['user_id'=> Auth::user()->id, 'estado' => 'abierto']);

       $prodPedido = \App\ProdPedido::firstOrNew(['carrito_id' => $carrito->id, 'product_id' => $Product->id]);

       $prodPedido->cant++;
       $prodPedido->save();

       return redirect()->back();
   }
   public function addCant(\App\ProdPedido $ProdPedido)
   {
        $ProdPedido->cant++;
        $ProdPedido->save();
        return redirect()->back();
   }
   public function descCant(\App\ProdPedido $ProdPedido)
   {
       $ProdPedido->cant--;

       if ($ProdPedido->cant == 0) {
            $ProdPedido->delete();
       }else {
            $ProdPedido->save();
       }

       return redirect()->back();
   }

   public function delete(Carrito $Carrito)
   {
        $Carrito->delete();

        return redirect()->back();
   }
}
