@extends('layouts.admin')

@section('title', 'Пользователи')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Пользователи</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('user.main')}}">Пользователи</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('company.main')}}"
                                style="color:grey">Компания</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('product.main')}}"
                                style="color:grey">Продукты</a></li>
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

                    <div class="card bg-dark text-center mt-2">
                        <div class="card-header">
                            <!-- Кнопка добавление пользователя -->
                            <button type="button" class="btn btn-primary card-title me-2" data-bs-toggle="modal"
                                data-bs-target="#CreateUser">
                                Добавить
                            </button>

                            <!-- Внутренности -->
                            <div class="modal fade" id="CreateUser" tabindex="-1" aria-labelledby="CreateUserLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" style="border: 1px solid green; border-radius:7px">
                                    <div class="modal-content bg-dark">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-success" id="CreateUserLabel">Добавить
                                                пользователя</h1>
                                            <button type="button" class="btn-close btn-dark" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('user.store')}}" method="POST">
                                                @csrf
                                                <div>
                                                    <label for="name" class="form-label"></label>
                                                    <input type="text"
                                                        class="form-control text-center border-success bg-dark"
                                                        id="name" name="name" placeholder="Имя пользователя">
                                                </div>
                                                <div class="modal-footer" style="margin-top:42px">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Назад</button>
                                                    <button type="submit" class="btn btn-success">Сохранить</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="{{route('user.delete.all')}}" class="btn btn-danger card-title me-2">Удалить
                                все!</a>
                            <a href="{{route('user.main')}}" class="btn btn-warning card-title me-2">Очистить</a>
                            <form class="d-flex" action="{{route('user.search')}}" role="search">
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
                                        <th class="text-success">OPTION</th>
                                        <th class="text-success">EDIT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="text-primary">{{$user->id}}</td>
                                            <td class="text-primary">{{$user->name}}</td>
                                            <td style="width:120px">
                                                <form action="{{route('user.delete', $user->id)}}" method="POST"
                                                    style="display: inline-flex">
                                                    @csrf
                                                    @method("DELETE")

                                                    <button type="submit" class="btn btn-danger me-2"><i
                                                            class="bi bi-trash-fill"></i></button>

                                                    <a href="/user/{{$user->id}}" class="btn btn-info me-2"><i
                                                            class="bi bi-book-fill"></i></a>

                                                </form>
                                            </td>
                                            <td style="width:60px">
                                                <!-- Кнопка обновление пользователя -->
                                                <button type="button" class="btn btn-primary card-title me-2"
                                                    data-bs-toggle="modal" data-bs-target="#UpdateUser{{$user->id}}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>

                                                <!-- Внутренности -->
                                                <div class="modal fade" id="UpdateUser{{$user->id}}" tabindex="-1"
                                                    aria-labelledby="UpdateUserLabel" aria-hidden="true">
                                                    <div class="modal-dialog"
                                                        style="border: 1px solid blue; border-radius:7px">
                                                        <div class="modal-content bg-dark">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5 text-primary"
                                                                    id="UpdateUserLabel">обновление пользователя:
                                                                    {{$user->id}}
                                                                </h1>
                                                                <button type="button" class="btn-close btn-dark"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{route('user.update', $user->id)}}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="mt-1">
                                                                        <label for="name" class="form-label"></label>
                                                                        <input type="text"
                                                                            class="form-control text-center text-primary border-primary bg-dark"
                                                                            id="name" name="name" value="{{$user->name}}"
                                                                            placeholder="Имя пользователя">
                                                                    </div>
                                                                    <div class="modal-footer" style="margin-top:42px">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Назад</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Обновить</button>
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
                            {{$users->links()}}
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