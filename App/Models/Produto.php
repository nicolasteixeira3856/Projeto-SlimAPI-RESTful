<?php

    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    /*
    usuarios            -> Usuario
    carrinhos           -> Carrinho
    carrinho_compras    -> CarrinhoCompra
    */

    class Produto extends Model{
        protected $fillable = [
            'titulo','descricao','preco','fabricante', 'updated_at', 'created_at'
        ];
    }
    
?>