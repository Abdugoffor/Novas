@extends('../index')

@section('title', 'Staff list')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-5">
        {{-- {{ Auth::user()->roles->pluck('name')->implode(', ') }} --}}
        @if (Auth::user()->hasPermissionTo('user.create'))
            <button type="button" class="btn btn-light mb-2" data-toggle="modal" data-target="#modal_default">Staff
                create</button>
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert bg-danger alert-rounded alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                    <span class="font-weight-semibold">{{ $error }}!</span>
                </div>
            @endforeach
        @endif
        @if (session('text'))
            <div class="alert bg-teal alert-rounded alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                <span class="font-weight-semibold">{{ session('text') }}!</span>
            </div>
        @endif

        <!-- Basic modal -->
        <div id="modal_default" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Basic modal</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('staf.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="Name">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="tel" name="phone" class="form-control" placeholder="Phone">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="adres" class="form-control" placeholder="Adres">
                            </div>

                            <div class="form-group form-group-float">
                                <label class="d-block form-group-float-label animate">Image</label>
                                <div class="custom-file">
                                    <input type="file" name="img" class="custom-file-input" id="custom-file-hidden">
                                    <label class="custom-file-label text-muted" for="custom-file-hidden">Image</label>
                                </div>
                            </div>
                            <div class="form-group form-group-float">
                                <label class="d-block form-group-float-label animate">File</label>
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="custom-file-hidden">
                                    <label class="custom-file-label text-muted" for="custom-file-hidden">File</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Department</label>
                                        <select class="form-control" name="department_id" id="exampleFormControlSelect1">
                                            <option selected disabled>Department</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Salary Type</label>
                                        <select class="form-control" name="salary__type_id" id="exampleFormControlSelect1">
                                            <option selected disabled>Salary Type</option>
                                            @foreach ($salarys as $salary)
                                                <option value="{{ $salary->id }}">{{ $salary->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" name="working_time" class="form-control"
                                            placeholder="Working Time">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" name="sum" class="form-control" placeholder="Sum">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /basic modal -->

        <!-- Page length options -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title">Staff</h5>
            </div>

            <table class="table datatable-show-all">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th width='15%'>Phone</th>
                        <th width='15%'>Image</th>
                        <th>Sum</th>
                        <th>Equipment Add / uskuna qo'shish</th>
                        <th width='20%'>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>{{ $model->name }}</td>
                            <td>{{ $model->phone }}</td>
                            <td><img src="{{ $model->img }}" width="100ox" alt=""></td>
                            <td>{{ $model->sum }}</td>
                            <td>
                                <a href="{{ route('staf.show', $model->id) }}" class="btn btn-info">Equipment Add</a></td>
                            <td>{{ $model->department->name }}</td>
                            <td>
                                <!-- Update modal -->
                                <button type="button" class="btn btn-outline-teal mb-2" data-toggle="modal"
                                    data-target="#modal_defaultroleupdate{{ $model->id }}"><i
                                        class="icon-pencil3"></i></button>
                                <!-- Update modal -->
                                <div id="modal_defaultroleupdate{{ $model->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Basic modal</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('staf.update', $model->id) }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <input type="text" name="name"
                                                                    value="{{ $model->name }}" class="form-control"
                                                                    placeholder="Name">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <input type="tel" name="phone"
                                                                    value="{{ $model->phone }}" class="form-control"
                                                                    placeholder="Phone">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <input type="text" name="adres" value="{{ $model->adres }}"
                                                            class="form-control" placeholder="Adres">
                                                    </div>

                                                    <div class="form-group form-group-float">
                                                        <label class="d-block form-group-float-label animate">Image</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="img"
                                                                value="{{ $model->img }}" class="custom-file-input"
                                                                id="custom-file-hidden">
                                                            <label class="custom-file-label text-muted"
                                                                for="custom-file-hidden">Image</label>
                                                        </div>
                                                        <img src="{{ $model->img }}" width="100px" class="mt-2"
                                                            alt="">
                                                    </div>
                                                    <div class="form-group form-group-float">
                                                        <label class="d-block form-group-float-label animate">File</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="file"
                                                                value="{{ $model->file }}" class="custom-file-input"
                                                                id="custom-file-hidden">
                                                            <label class="custom-file-label text-muted"
                                                                for="custom-file-hidden">File</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlSelect1">Department</label>
                                                                <select class="form-control" name="department_id"
                                                                    id="exampleFormControlSelect1">
                                                                    <option selected disabled>Department</option>
                                                                    @foreach ($departments as $department)
                                                                        <option value="{{ $department->id }}"
                                                                            {{ $model->department_id == $department->id ? 'selected' : '' }}>
                                                                            {{ $department->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlSelect1">Salary Type</label>
                                                                <select class="form-control" name="salary__type_id"
                                                                    id="exampleFormControlSelect1">
                                                                    <option selected disabled>Salary Type</option>
                                                                    @foreach ($salarys as $salary)
                                                                        <option value="{{ $salary->id }}"
                                                                            {{ $model->salary__type_id == $salary->id ? 'selected' : '' }}>
                                                                            {{ $salary->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <input type="text" name="working_time"
                                                                    value="{{ $model->working_time }}"
                                                                    class="form-control" placeholder="Working Time">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <input type="text" name="sum"
                                                                    value="{{ $model->sum }}" class="form-control"
                                                                    placeholder="Sum">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Update modal -->

                                <!-- Delete modal -->
                                <button type="button" class="btn btn-outline-danger mb-2" data-toggle="modal"
                                    data-target="#modal_defaultroledelete{{ $model->id }}"><i
                                        class="icon-bin"></i></button>
                                <!-- Delete modal -->
                                <div id="modal_defaultroledelete{{ $model->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Basic modal</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('staf.delete', $model->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <div class="modal-body">
                                                    <h2>O'chirishni hohlaysizmi </h2>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Ha</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Delete modal -->

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /page length options -->


    </div>
    <!-- /content area -->
@endsection
