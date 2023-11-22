@extends('../index')

@section('title', 'Product model list')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-5">
        {{-- {{ Auth::user()->roles->pluck('name')->implode(', ') }} --}}
        @if (Auth::user()->hasPermissionTo('user.create'))
            <button type="button" class="btn btn-light mb-2" data-toggle="modal" data-target="#modal_default">Product model
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
                    <form action="{{ route('product_model.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <input type="text" name="name_size" class="form-control" placeholder="Mame">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="size" class="form-control" placeholder="Size">
                            </div>
                            <div class="form-group form-group-float">
                                <label class="d-block form-group-float-label animate">Image</label>
                                <div class="custom-file">
                                    <input type="file" name="imgs[]" multiple class="custom-file-input"
                                        id="custom-file-hidden">
                                    <label class="custom-file-label text-muted" for="custom-file-hidden">Image</label>
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
                <h5 class="card-title">Product model list</h5>
            </div>

            <table class="table datatable-show-all">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Size</th>
                        <th>Consumption Rate</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>{{ $model->name }}</td>
                            <td>{{ $model->size }}</td>
                            <td>{{ $model->consumption_rate }}</td>
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
                                                <h5 class="modal-title">Basic modal kamchiligi bor</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('product_model.update', $model->id) }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <input type="text" name="name"
                                                                value="{{ $model->name }}" class="form-control"
                                                                placeholder="Mame">
                                                        </div>
                                                        <div class="mb-3">
                                                            <input type="text" name="size"
                                                                value="{{ $model->size }}" class="form-control"
                                                                placeholder="Size">
                                                        </div>
                                                        <div class="mb-3">
                                                            <input type="text" name="consumption_rate"
                                                                class="form-control" value="{{ $model->consumption_rate }}"
                                                                placeholder="Consumption Rate">
                                                        </div>
                                                        <div class="form-group form-group-float">
                                                            <label
                                                                class="d-block form-group-float-label animate">Image</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="imgs[]" multiple
                                                                    class="custom-file-input" id="custom-file-hidden">
                                                                <label class="custom-file-label text-muted"
                                                                    for="custom-file-hidden">Image</label>
                                                            </div>
                                                        </div>
                                                        @foreach ($model->model_images as $model_image)
                                                            <img src="{{ $model_image->img }}" width="100px"
                                                                class="m-1" alt="">
                                                        @endforeach
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
                                            <form action="{{ route('product_model.delete', $model->id) }}"
                                                method="post">
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
