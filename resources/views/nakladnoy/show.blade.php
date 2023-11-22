@extends('../index')

@section('title', $model->shipper)

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-5">
        <!-- Page length options -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title">Material Prixod list</h5>
            </div>

            <table class="table datatable-show-all">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nakladnoy</th>
                        <th>Material</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Sum</th>
                        <th>Expiry date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($model->prixods as $prixod)
                        <tr>
                            <td>{{ $prixod->id }}</td>
                            <td>{{ $prixod->nakladnoy->shipper }}</td>
                            <td>{{ $prixod->material->name }}</td>
                            <td>{{ $prixod->unit }}</td>
                            <td>{{ $prixod->quantity }}</td>
                            <td>{{ $prixod->price }}</td>
                            <td>{{ $prixod->sum }}</td>
                            <td>{{ $prixod->term }}</td>
                            <td>{{ $prixod->created_at->format('Y-m-d H-i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /page length options -->


    </div>
    <!-- /content area -->
@endsection
