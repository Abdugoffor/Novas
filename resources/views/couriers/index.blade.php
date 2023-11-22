@extends('../index')

@section('title', 'Courier list')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-5">
        {{-- {{ Auth::user()->roles->pluck('name')->implode(', ') }} --}}
        @if (Auth::user()->hasPermissionTo('user.create'))
            <button type="button" class="btn btn-light mb-2" data-toggle="modal" data-target="#modal_default">Courier
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
                        <h5 class="modal-title">Courier</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('courier.create') }}" method="post">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Staf</label>
                                <select class="form-control" name="staf_id" id="exampleFormControlSelect1">
                                    <option>-- Staf --</option>
                                    @foreach ($stafs as $staf)
                                        <option value="{{ $staf->id }}">
                                            {{ $staf->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="phone">Phone</label>
                                <input type="number" name="phone" id="phone" class="form-control"
                                    placeholder="Phone 998 99 999 99 99">
                            </div>
                            <div class="mb-3">
                                <label for="car_number">Car number</label>
                                <input type="number" name="car_number" id="car_number" class="form-control"
                                    placeholder="Car number">
                            </div>
                            <div class="mb-3">
                                <label for="car_number">Telegram id</label>
                                <input type="number" name="telegram_id" id="telegram_id" class="form-control"
                                    placeholder="Telegram id">
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
                        <th>Phone</th>
                        <th>Car number</th>
                        <th>Telegram id</th>
                        <th>View</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>{{ $model->staf->name }}</td>
                            <td><a href="tel:+{{ $model->phone }}">+{{ number_format($model->phone, 0, '', ' ') }}</a>
                            </td>
                            <td>{{ $model->car_number }}</td>
                            <td>{{ $model->telegram_id }}</td>
                            <td><a href="{{ route('courier.show', $model->id) }}" class="btn btn-info">View</a></td>
                            <td>
                                @if ($model->status == 1)
                                    <a href="{{ route('courier.status', $model->id) }}" class="badge badge-success">
                                        Active
                                    </a>
                                @else
                                    <a href="{{ route('courier.status', $model->id) }}" class="badge badge-danger">
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
                                            <form action="{{ route('courier.update', $model->id) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1">Staf</label>
                                                        <select class="form-control" name="staf_id"
                                                            id="exampleFormControlSelect1">
                                                            <option>-- Staf --</option>
                                                            @foreach ($stafs as $staf)
                                                                <option value="{{ $staf->id }}"
                                                                    {{ $staf->id == $model->staf_id ? 'selected' : '' }}>
                                                                    {{ $staf->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="phone">Phone</label>
                                                        <input type="number" value="{{ $model->phone }}" name="phone"
                                                            id="phone" class="form-control"
                                                            placeholder="Phone 998 99 999 99 99">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="car_number">Car number</label>
                                                        <input type="number" value="{{ $model->car_number }}"
                                                            name="car_number" id="car_number" class="form-control"
                                                            placeholder="Car number">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="car_number">Telegram id</label>
                                                        <input type="number" value="{{ $model->telegram_id }}"
                                                            name="telegram_id" id="telegram_id" class="form-control"
                                                            placeholder="Telegram id">
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
                                            <form action="{{ route('courier.delete', $model->id) }}" method="post">
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
