@extends('../index')

@section('title', 'Equipment list')

@section('con')
    <!-- Content area -->

    <div class="content pt-0 mt-5">
        {{-- @if (Auth::user()->hasPermissionTo('user.create'))
            <button type="button" class="btn btn-light mb-2" data-toggle="modal" data-target="#modal_default">Equipment
                create</button>
        @endif --}}
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
        {{-- <div id="modal_default" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Basic modal</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('salary.create') }}" method="post">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Staff</label>
                                <select class="form-control" name="staf_id" id="exampleFormControlSelect1">
                                    <option selected disabled>Staff</option>
                                    @foreach ($stafs as $staf)
                                        <option value="{{ $staf->id }}">{{ $staf->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="date" name="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Salary Types</label>
                                <select class="form-control" name="type_id" id="exampleFormControlSelect1">
                                    <option selected disabled>Salary Types</option>
                                    @foreach ($salaryTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="summa" class="form-control" placeholder="Summa">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
        <!-- /basic modal -->

        <!-- Page length options -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title">Equipment</h5>
            </div>

            <table class="table datatable-show-all">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Salary</th>
                        <th>Department</th>
                        <th>Oylik</th>
                        <th>Berildi</th>
                        <th>working_time</th>
                        <th>Oyli berish</th>
                        <th>Jarima</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stafs as $staf)
                        <tr>
                            <td>{{ $staf->id }}</td>
                            <td>{{ $staf->name }}</td>
                            <td>{{ $staf->salary_type->name }}</td>
                            <td>{{ $staf->department->name }}</td>
                            <td>{{ $staf->sum }}</td>
                            <td>
                                @if (Auth::user()->hasPermissionTo('user.create'))
                                    <button type="button" class="btn btn-light mb-2" data-toggle="modal"
                                        data-target="#modal_default1{{ $staf->id }}">Olingan summa</button>
                                @endif
                                <!-- Basic modal -->
                                <div id="modal_default1{{ $staf->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content pb-5">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Basic modal</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            @foreach ($staf->salary as $salary)
                                                <h2 class="text-center">
                                                    {{ \Carbon\Carbon::parse($salary->date)->format('M-Y') }}
                                                </h2>
                                                <div class="table-responsive mb-5">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Name</th>
                                                                <th>Value</th>
                                                                <th>Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($salary->salary_type_values as $salary_type_value)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $salary_type_value->type->name }}</td>
                                                                    <td>{{ $salary_type_value->value }}</td>
                                                                    <td>{{ $salary_type_value->created_at->format('H:i , d - M - Y') }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- /basic modal -->
                            </td>
                            <td>{{ $staf->working_time }}</td>
                            <td>
                                @if (Auth::user()->hasPermissionTo('user.create'))
                                    <button type="button" class="btn btn-light mb-2" data-toggle="modal"
                                        data-target="#modal_default{{ $staf->id }}">Oyli berish</button>
                                @endif
                                <!-- Oylik berish modal -->
                                <div id="modal_default{{ $staf->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Oylik berish</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('salary.create') }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1">Staf</label>
                                                        <select class="form-control" name="staf_id"
                                                            id="exampleFormControlSelect1">
                                                            <option value="{{ $staf->id }}">
                                                                {{ $staf->name }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="date">Date</label>
                                                        <input type="date" id="date" name="date"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1">Salary Types</label>
                                                        <select class="form-control" name="type_id"
                                                            id="exampleFormControlSelect1">
                                                            <option selected disabled>Salary Types</option>
                                                            @foreach ($salaryTypes as $type)
                                                                <option value="{{ $type->id }}">{{ $type->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="sum">Summa</label>
                                                        <input type="text" id="sum" name="summa"
                                                            class="form-control" placeholder="Summa">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /basic modal -->
                            </td>
                            <td>
                                @if (Auth::user()->hasPermissionTo('user.create'))
                                    <button type="button" class="btn btn-light mb-2" data-toggle="modal"
                                        data-target="#modal_defaultjarima{{ $staf->id }}">Jarima</button>
                                @endif
                                <!-- Jarima berish modal -->
                                <div id="modal_defaultjarima{{ $staf->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Jarima berish</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('fines.create') }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1">Staf</label>
                                                        <select class="form-control" name="staf_id"
                                                            id="exampleFormControlSelect1">
                                                            <option value="{{ $staf->id }}">
                                                                {{ $staf->name }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="date">Date</label>
                                                        <input type="date" id="date" name="date"
                                                            class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="sum">Summa</label>
                                                        <input type="text" id="sum" name="summa"
                                                            class="form-control" placeholder="Summa">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="com">Comment</label>
                                                        <textarea class="form-control" id="com" name="comment" placeholder="Comment" rows="3"></textarea>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /basic modal -->
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
