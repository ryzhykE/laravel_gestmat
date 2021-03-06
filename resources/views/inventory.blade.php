@extends('dashboard.app')

@section('content')

<div class="container py-5">
    <h2 class="text-center">Adicionar produto</h2>

    @include('alerts.messages')

    <form method="post" action="{{ route('inventory.store') }}">
        @csrf
        <div class="form-group">
            <label for="inputProd">Produto</label>
            <select id="inputProd" class="form-control" name="product_id">
                <option value="none" selected disabled hidden>Selecionar...</option>
                @foreach ($products as $product)
                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="Input1">Quantidade disponível</label>
            <input type="number" class="form-control" id="Input1" name="available_quantity" value="">
        </div>

        <div class="form-group">
            <label for="Input2">Quantidade mínima</label>
            <input type="number" class="form-control" id="Input2" name="minimum_quantity" value="">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">Salvar</button>
        </div>
    </form>
</div>

<hr>

<h2 class="text-center py-5">Estoque</h2>

<div class="table-responsive pb-5">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Produto</th>
                <th>Quantidade mínima</th>
                <th>Quantidade disponível</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($inventories as $inventory)
            <tr>
                <td>{{ $inventory->id }}</td>
                <td>{{ $inventory->product->name }}</td>
                <td>{{ $inventory->minimum_quantity }}</td>
                <td class="{{ $inventory->available_quantity > $inventory->minimum_quantity ? 'text-success' : 'text-danger' }}">{{ $inventory->available_quantity }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Nenhum produto em estoque...</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex">
        <div class="mx-auto py-2">
            {{ $inventories->links() }}
        </div>
    </div>
</div>

@endsection