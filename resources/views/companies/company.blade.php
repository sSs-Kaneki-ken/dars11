@extends('layouts.admin')

@section('title', 'Компания')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Компания</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('user.main')}}" style="color:grey">Пользователи</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="{{route('company.main')}}">Компания</a></li>
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
                    <div class="card bg-dark text-center">
                        <div class="card-header">
                            <!-- Кнопка добавление продукта -->
                            <button type="button" class="btn btn-primary card-title me-2" data-bs-toggle="modal"
                                data-bs-target="#CreateCompany">
                                Добавить
                            </button>

                            <!-- Внутренности -->
                            <div class="modal fade" id="CreateCompany" tabindex="-1"
                                aria-labelledby="CreateCompanyLabel" aria-hidden="true">
                                <div class="modal-dialog" style="border: 1px solid green; border-radius:7px">
                                    <div class="modal-content bg-dark">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-success" id="CreateCompanyLabel">Создать
                                                компанию</h1>
                                            <button type="button" class="btn-close btn-dark" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('company.store')}}" method="POST">
                                                @csrf
                                                <div>
                                                    <label for="name" class="form-label"></label>
                                                    <input type="text"
                                                        class="form-control text-center border-success bg-dark"
                                                        id="name" name="name" placeholder="Название компании">
                                                </div>
                                                <div>
                                                    <label for="phone" class="form-label"></label>
                                                    <input type="tel"
                                                        class="form-control text-center border-success bg-dark"
                                                        id="phone" name="phone" placeholder="Телефон номер">
                                                </div>
                                                <div>
                                                    <select name="user_id"
                                                        class="form-control text-center border-success mt-4 bg-dark">
                                                        @foreach ($users as $user)
                                                            <option value="{{$user->id}}">{{$user->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
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
                            <a href="" class="btn btn-danger card-title me-2">Удалить все!</a>
                            <a href="{{route("company.main")}}" class="btn btn-warning card-title me-2">Очистить</a>
                            <form class="d-flex" action="{{route('company.search')}}" role="search">
                                <input class="form-control me-2 bg-dark border-primary"style="width:400px; margin-left:205px;" name="search" type="search" placeholder="Search" aria-label="Search">
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
                                        <th class="text-success">PHONE</th>
                                        <th class="text-success">BOSS</th>
                                        <th class="text-success">ACTIVE</th>
                                        <th class="text-success">OPTION</th>
                                        <th class="text-success">EDIT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($companies as $company)
                                        <tr>
                                            <td class="text-primary">{{$company->id}}</td>
                                            <td class="text-primary">{{$company->name}}</td>
                                            <td class="text-primary">{{$company->phone}}</td>
                                            <td class="text-primary">{{$company->user_name}}</td>
                                            <td class="text-primary">{{$company->is_active}}</td>
                                            <td style="width:160px">
                                                <form action="{{route('company.delete', $company->id)}}" method="POST"
                                                    style="display: inline-flex">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="btn btn-danger me-2"><i
                                                            class="bi bi-trash-fill"></i></button>
                                                    <a href="/company/{{$company->id}}" class="btn btn-info me-2"><i
                                                            class="bi bi-book-fill"></i></a>
                                                    <a href="/products" class="btn btn-primary">+</a>
                                                </form>
                                            </td>
                                            <td style="width:60px">
                                                <!-- Кнопка обновление продукта -->
                                                <button type="button" class="btn btn-primary card-title me-2"
                                                    data-bs-toggle="modal" data-bs-target="#UpdateCompany{{$company->id}}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>

                                                <!-- Внутренности -->
                                                <div class="modal fade" id="UpdateCompany{{$company->id}}" tabindex="-1"
                                                    aria-labelledby="UpdateCompanyLabel" aria-hidden="true">
                                                    <div class="modal-dialog"
                                                        style="border: 1px solid blue; border-radius:7px">
                                                        <div class="modal-content bg-dark">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5 text-primary"
                                                                    id="UpdateCompanyLabel">Обновление
                                                                    компании: {{$company->id}}</h1>
                                                                <button type="button" class="btn-close btn-dark"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{route('company.update', $company->id)}}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div>
                                                                        <label for="name" class="form-label"></label>
                                                                        <input type="text"
                                                                            class="form-control text-center text-primary border-primary bg-dark"
                                                                            id="name" name="name" value="{{$company->name}}"
                                                                            placeholder="Название компании">
                                                                    </div>
                                                                    <div>
                                                                        <label for="phone" class="form-label"></label>
                                                                        <input type="tel"
                                                                            class="form-control text-center text-primary border-primary bg-dark"
                                                                            id="phone" name="phone"
                                                                            value="{{ $company->phone }}"
                                                                            placeholder="Телефон номер">
                                                                    </div>
                                                                    <div>
                                                                        <select name="user_id"
                                                                            class="form-control text-center text-primary border-primary mt-4 bg-dark">
                                                                            @foreach ($users as $user)
                                                                                <option value="{{$user->id}}">
                                                                                    {{$user->name}}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
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
                            {{$companies->links()}}
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