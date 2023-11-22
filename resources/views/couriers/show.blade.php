@extends('../index')

@section('title', 'Courier show')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-5">

        <!-- Page length options -->
        <div class="card-header">
            <h5 class="card-title">Courier</h5>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ $courier->id }}</th>
                </tr>
                <tr>
                    <th>Name</th>
                    <th>{{ $courier->staf->name }}</th>
                </tr>
                <tr>
                    <th>Adres</th>
                    <th>{{ $courier->staf->adres }}</th>
                </tr>
                <tr>
                    <th>Image </th>
                    <th>
                        <a href="{{ asset($courier->staf->img) }}" target="_blank">
                            <img src="{{ asset($courier->staf->img) }}" width="200px" alt="">
                        </a>
                    </th>
                </tr>
                <tr>
                    <th>Working time</th>
                    <th>{{ $courier->staf->working_time }}</th>
                </tr>
                <tr>
                    <th>Salary</th>
                    <th>{{ $courier->staf->sum }}</th>
                </tr>
                <tr>
                    <th>Phone</th>
                    <th><a href="tel:+{{ $courier->phone }}">+{{ $courier->phone }}</a></th>
                </tr>
                <tr>
                    <th>Car number</th>
                    <th>{{ $courier->car_number }}</th>
                </tr>
                <tr>
                    <th>Telegram id</th>
                    <th>{{ $courier->telegram_id }}</th>
                </tr>
                <tr>
                    <th>Status</th>
                    <th>
                        @if ($courier->status == 1)
                            <a href="{{ route('courier.status', $courier->id) }}" class="badge badge-success">
                                Active
                            </a>
                        @else
                            <a href="{{ route('courier.status', $courier->id) }}" class="badge badge-danger">
                                Suspended
                            </a>
                        @endif
                    </th>
                </tr>
                <tr>
                    <th>Function</th>
                    <th>
                        <!-- Update modal -->
                        <button type="button" class="btn btn-outline-teal mb-2" data-toggle="modal"
                            data-target="#modal_defaultroleupdate{{ $courier->id }}"><i class="icon-pencil3"></i></button>
                        <!-- Update modal -->
                        <div id="modal_defaultroleupdate{{ $courier->id }}" class="modal fade" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Customer</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <form action="{{ route('courier.update', $courier->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Staf</label>
                                                <select class="form-control" name="staf_id" id="exampleFormControlSelect1">
                                                    <option>-- Staf --</option>
                                                    @foreach ($stafs as $staf)
                                                        <option value="{{ $staf->id }}"
                                                            {{ $staf->id == $courier->staf_id ? 'selected' : '' }}>
                                                            {{ $staf->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="phone">Phone</label>
                                                <input type="number" value="{{ $courier->phone }}" name="phone"
                                                    id="phone" class="form-control"
                                                    placeholder="Phone 998 99 999 99 99">
                                            </div>
                                            <div class="mb-3">
                                                <label for="car_number">Car number</label>
                                                <input type="number" value="{{ $courier->car_number }}" name="car_number"
                                                    id="car_number" class="form-control" placeholder="Car number">
                                            </div>
                                            <div class="mb-3">
                                                <label for="car_number">Telegram id</label>
                                                <input type="number" value="{{ $courier->telegram_id }}"
                                                    name="telegram_id" id="telegram_id" class="form-control"
                                                    placeholder="Telegram id">
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Delete modal -->
                        <button type="button" class="btn btn-outline-danger mb-2 ml-3" data-toggle="modal"
                            data-target="#modal_defaultroledelete{{ $courier->id }}"><i class="icon-bin"></i></button>
                        <!-- Delete modal -->
                        <div id="modal_defaultroledelete{{ $courier->id }}" class="modal fade" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Customer</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <form action="{{ route('courier.delete', $courier->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <div class="modal-body">
                                            <h2>O'chirishni hohlaysizmi </h2>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /Delete modal -->
                    </th>
                </tr>
            </thead>
        </table>
        <!-- /page length options -->


    </div>
    <!-- /content area -->
@endsection
