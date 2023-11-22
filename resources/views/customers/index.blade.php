@extends('../index')

@section('title', 'Customer list')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-5">
        {{-- {{ Auth::user()->roles->pluck('name')->implode(', ') }} --}}
        @if (Auth::user()->hasPermissionTo('user.create'))
            <button type="button" class="btn btn-light mb-2" data-toggle="modal" data-target="#modal_default">Customer
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
                        <h5 class="modal-title">Customer</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('customer.create') }}" method="post">
                        @csrf

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                            </div>
                            <div class="mb-3">
                                <label for="phone1">Phone 1</label>
                                <input type="tel" name="phone1" id="phone1" class="form-control" placeholder="Phone 1">
                            </div>
                            <div class="mb-3">
                                <label for="phone2">Phone 1</label>
                                <input type="tel" name="phone2" id="phone2" class="form-control" placeholder="Phone 2">
                            </div>
                            <div class="mb-3">
                                <label for="balans">Balans</label>
                                <input type="number" name="balans" id="balans" class="form-control" placeholder="Balans">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /basic modal -->

        <!-- Page length options -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title">Customers</h5>
            </div>

            <table class="table datatable-show-all">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone 1</th>
                        <th>Phone 2</th>
                        <th>Balans</th>
                        <th>Firms</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>{{ $model->name }}</td>
                            <td>{{ $model->phone1 }}</td>
                            <td>{{ $model->phone2 }}</td>
                            <td>{{ $model->balans }}</td>
                            <td><a href="{{ route('customer.show', $model->id) }}" class="btn btn-info">Firms</a></td>
                            <td>
                                @if ($model->status == 1)
                                    <a href="{{ route('customer.status', $model->id) }}" class="badge badge-success">
                                        Active
                                    </a>
                                @else
                                    <a href="{{ route('customer.status', $model->id) }}" class="badge badge-danger">
                                        Suspended
                                    </a>
                                @endif
                            </td>
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
                                                <h5 class="modal-title">Customer</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('customer.update', $model->id) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="name">Name</label>
                                                        <input type="text" name="name" id="name" value="{{ $model->name }}"
                                                            class="form-control" placeholder="Name">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="phone1">Phone 1</label>
                                                        <input type="tel" id="phone1" name="phone1" value="{{ $model->phone1 }}"
                                                            class="form-control" placeholder="Phone 1">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="phone2">Phone 2</label>
                                                        <input type="tel" id="phone2" name="phone2" value="{{ $model->phone2 }}"
                                                            class="form-control" placeholder="Phone 2">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="balans">Balans</label>
                                                        <input type="tel" id="balans" name="balans"
                                                            value="{{ $model->balans }}" class="form-control"
                                                            placeholder="Balans">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
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
                                                <h5 class="modal-title">Customer</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('customer.delete', $model->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <div class="modal-body">
                                                    <h2>O'chirishni hohlaysizmi </h2>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
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
