@extends('layouts.admin')

@section('title', 'Продукты')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Продукты</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/" style="color:grey">Пользователи</a></li>
                        <li class="breadcrumb-item active"><a href="/companies" style="color:grey">Компания</a></li>
                        <li class="breadcrumb-item active"><a href="/products">Продукты</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card bg-dark text-center">
                        <div class="card-header">
                            <!-- Кнопка добавление компании -->
                            <button type="button" class="btn btn-primary card-title me-2" data-bs-toggle="modal"
                                data-bs-target="#CreateCompany">
                                Добавить
                            </button>

                            <!-- Внутренности -->
                            <div class="modal fade" id="CreateCompany" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" style="border: 1px solid green; border-radius:7px">
                                    <div class="modal-content bg-dark">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-success" id="exampleModalLabel">Добавить
                                                продукт</h1>
                                            <button type="button" class="btn-close btn-dark" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/create-product" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div>
                                                    <label for="name" class="form-label"></label>
                                                    <input type="text"
                                                        class="form-control text-center border-success bg-dark"
                                                        id="name" name="name" placeholder="Название продукта">
                                                </div>
                                                <div>
                                                    <select name="comp_id"
                                                        class="form-control text-center border-success mt-4 bg-dark">
                                                        @foreach ($companies as $company)
                                                            <option value="{{$company->id}}">{{$company->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div>
                                                    <label for="image" class="form-label"></label>
                                                    <input type="file"
                                                        class="form-control text-center border-success bg-dark"
                                                        id="image" name="image">
                                                </div>
                                                <div>
                                                    <label for="price" class="form-label"></label>
                                                    <input type="number"
                                                        class="form-control text-center border-success bg-dark"
                                                        id="price" name="price" placeholder="Стоимость">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Назад</button>
                                                    <button type="submit" class="btn btn-success">Сохранить</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{route('product.delete_all')}}" class="btn btn-danger card-title me-2">Удалить
                                все!</a>
                            <a href="{{route('product.main')}}" class="btn btn-warning card-title me-2">Очистить</a>
                            <form class="d-flex" action="{{route('product.search')}}" role="search">
                                <input class="form-control me-2 bg-dark border-primary"
                                    style="width:400px; margin-left:205px;" name="search" type="search"
                                    placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </div>
                        @if(session('check'))
                            <div class="alert alert-{{session('check')[1]}} mt-2 alert-dismissible"
                                style="width:96%; margin-left: 22px;" role="alert">
                                {{session('check')[0]}}<br>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-dark">
                                <thead class="text-success">
                                    <tr>
                                        <th class="text-success">ID</th>
                                        <th class="text-success">NAME</th>
                                        <th class="text-success">COMPANY</th>
                                        <th class="text-success">IMAGE</th>
                                        <th class="text-success">PRICE</th>
                                        <th class="text-success">OPTION</th>
                                        <th class="text-success">EDIT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td class="text-primary">{{$product->id}}</td>
                                            <td class="text-primary">{{$product->name}}</td>
                                            <td class="text-primary">{{$product->com_name}}</td>
                                            <!-- Bu xolatda rasm chiqadi! -->
                                            <td class="text-primary"><img src="{{$product->image}}" width="100px"></td>
                                            <!--Fake informatsiya uchun sekin ishlidi-->
                                            <!-- <td class="text-primary">{{$product->image}}</td> -->
                                            <td class="text-primary">{{$product->price}}$</td>
                                            <td style="width:120px">
                                                <form action="/product/{{$product->id}}" method="POST"
                                                    style="display: inline-flex">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="btn btn-danger me-2"><i
                                                            class="bi bi-trash-fill"></i></button>
                                                    <a href="/product/{{$product->id}}" class="btn btn-info"><i
                                                            class="bi bi-book-fill"></i></a>
                                                </form>
                                            </td>
                                            <td>
                                                <!-- Кнопка обновление продукта -->
                                                <button type="button" class="btn btn-primary card-title me-2"
                                                    data-bs-toggle="modal" data-bs-target="#UpdateProduct{{$product->id}}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>

                                                <!-- Внутренности -->
                                                <div class="modal fade" id="UpdateProduct{{$product->id}}" tabindex="-1"
                                                    aria-labelledby="UpdateProductLabel" aria-hidden="true">
                                                    <div class="modal-dialog"
                                                        style="border: 1px solid blue; border-radius:7px">
                                                        <div class="modal-content bg-dark">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5 text-primary"
                                                                    id="UpdateProductLabel">Обновление
                                                                    компании: {{$product->id}}</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <form action="{{route('product.update', $product->id)}}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div>
                                                                        <label for="name" class="form-label"></label>
                                                                        <input type="text"
                                                                            class="form-control text-center border-primary bg-dark"
                                                                            id="name" name="name"
                                                                            placeholder="Название продукта">
                                                                    </div>
                                                                    <div>
                                                                        <select name="comp_id"
                                                                            class="form-control text-center border-primary mt-4 bg-dark">
                                                                            @foreach ($companies as $company)
                                                                                <option value="{{$company->id}}">
                                                                                    {{$company->name}}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div>
                                                                        <label for="image" class="form-label"></label>
                                                                        <input type="file"
                                                                            class="form-control text-center border-primary bg-dark"
                                                                            id="image" name="image">
                                                                    </div>
                                                                    <div>
                                                                        <label for="price" class="form-label"></label>
                                                                        <input type="number"
                                                                            class="form-control text-center border-primary bg-dark"
                                                                            id="price" name="price" placeholder="Стоимость">
                                                                    </div>
                                                                    <div class="modal-footer" style="margin-top:42px">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Назад</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Сохранить</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="d-flex justify-content-center bg-dark">
                            {{$products->links()}}
                        </div>
                    </div>
                </div>

            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection