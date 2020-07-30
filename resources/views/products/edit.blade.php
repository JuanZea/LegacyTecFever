@extends('layouts.app')

@section('content')
<div class="container mt-3">
	<div class="row">
		<div class="col">
			<h1 class="text-center">Editar Producto</h1>
			<form action="{{ route('products.update',$product) }}" method="POST">
				@csrf @method('PUT')
			  <div class="form-row">
			    <div class="form-group col-md-6">
			      <label for="name">Nombre</label>
			      <input name="name" type="text" class="form-control" id="name" value="{{ $product->name }}">
			    </div>
			    <div class="form-group col-md-6">
			      <label for="category">Categoría</label>
				  <select name="category" class="form-control custom-select" id="category">
				    <option selected>Computadores</option>
				    <option value="1">Celulares</option>
				    <option value="2">Accesorios</option>
				  </select>
			    </div>
			  </div>
			  <div class="form-row">
			    <div class="form-group col-md-6">
			      <label for="color">Color</label>
			      <input name="color" type="text" class="form-control" id="color" value="{{ $product->color }}">
			    </div>
			    <div class="form-group col-md-6">
			      <label for="price">Precio</label>
			      <input name="price" type="number" class="form-control" id="price" value="{{ $product->price }}">
			    </div>
			  </div>
			  <div class="form-row">
			      <div class="custom-file form-group col-md-6">
				  <input accept="image/*" name="image" type="file" class="custom-file-input" id="customFile">
				  <label  class="custom-file-label" for="customFile">Elije una imagen</label>
				</div>
			  </div>
			  <button type="submit" class="btn btn-success btn-block">Guardar</button>
			</form>
		</div>
	</div>
</div>
@endsection