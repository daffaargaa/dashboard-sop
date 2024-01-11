@extends('layout.sidebar')

@section('arsipSopActive', 'active')

@section('content')

    <div class="container">
        @if (Session::has('input_success'))
            <div class="alert alert-success">
                {{ Session::get('input_success') }}
            </div>
        @endif
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#msDeptModal">
            Master Dept
        </button>
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#msProductModal">
            Master Product
        </button>
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#msJenisModal">
            Master Jenis
        </button>
    </div>

    {{-- List of Departments --}}
    <div class="container mt-3">
        <div class="row">

            @foreach ($ms_dept as $item)
                <!-- First Row -->
                <div class="col-md-4 mb-3">
                    <div class="card" onclick="handleCardClick('{{ $item->dept }}')">
                        <div class="card-body">
                            <h6 class="card-title"><span class="status">0</span> {{ $item->dept }}</h6>
                            {{-- <p class="card-text">{{ $item->dept }}</p> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function handleCardClick(cardName) {
                // Add your logic here, for example, navigate to a new page or perform an action
                // alert(`Clicked on ${cardName}`);
                // // Define URLs for each card
                // const cardUrls = {
                //     'Accounting': 'https://google.com',
                //     'Card 2': 'https://example.com/card2',
                //     'Card 3': 'https://example.com/card3',
                //     // Add URLs for other cards
                // };

                

                // // Get the URL based on the cardName
                // const url = cardUrls[cardName];

                // Redirect to the URL
                window.location.href = 'http://127.0.0.1:8000/arsipSop/' + cardName;
            }
        </script>



        <!-- TABLE MS DEPT -->
        <div class="modal fade" id="msDeptModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Master Dept</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    {{-- Your body goes here --}}
                    <div class="modal-body">
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                            data-bs-target="#newDeptModal">
                            Add New
                        </button>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Dept</th>
                                    <th>Inisial Dept</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ms_dept as $item)
                                    <tr>
                                        <td>{{ $item->dept }}</td>
                                        <td>{{ $item->inisial_dept }}</td>
                                        <td>
                                            @if ($item->status == 'ENABLED')
                                                <div class="enabled">● Enabled</div>
                                            @else
                                                <div class="disabled">● Disabled</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="/arsipSop/msDept/destroy/{{ $item->id }}" class="btn btn-danger"><i
                                                    class='bx bxs-trash'></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- NEW DEPT --}}
        <div class="modal fade" id="newDeptModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Dept</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    {{-- Your body goes here --}}
                    <form action="{{ route('arsipSopMsDeptStore') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="" class="form-label">Dept</label>
                                <input type="text" class="form-control" name="dept">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Inisial Dept</label>
                                <input type="text" class="form-control" name="inisial_dept">
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckChecked" name="active" value="ENABLED" checked>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- END MS DEPT --}}

        <!-- TABLE MS PRODUK -->
        <div class="modal fade" id="msProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Master Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    {{-- Your body goes here --}}
                    <div class="modal-body">
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                            data-bs-target="#newProductModal">
                            Add New
                        </button>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Inisial Product</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ms_produk as $item)
                                    <tr>
                                        <td>{{ $item->produk }}</td>
                                        <td>{{ $item->inisial_produk }}</td>
                                        <td>
                                            @if ($item->status == 'ENABLED')
                                                <div class="enabled">● Enabled</div>
                                            @else
                                                <div class="disabled">● Disabled</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="/arsipSop/msProduct/destroy/{{ $item->id }}"
                                                class="btn btn-danger"><i class='bx bxs-trash'></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- NEW Produk --}}
        <div class="modal fade" id="newProductModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    {{-- Your body goes here --}}
                    <form action="{{ route('arsipSopMsProductStore') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="" class="form-label">Product</label>
                                <input type="text" class="form-control" name="produk">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Inisial Product</label>
                                <input type="text" class="form-control" name="inisial_produk">
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckChecked" name="active" value="ENABLED" checked>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- End Master Product --}}

        <!-- TABLE MS JENIS -->
        <div class="modal fade" id="msJenisModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Master Jenis</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    {{-- Your body goes here --}}
                    <div class="modal-body">
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                            data-bs-target="#newJenisModal">
                            Add New
                        </button>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Jenis</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ms_jenis as $item)
                                    <tr>
                                        <td>{{ $item->jenis_arsip }}</td>
                                        <td>
                                            @if ($item->status == 'ENABLED')
                                                <div class="enabled">● Enabled</div>
                                            @else
                                                <div class="disabled">● Disabled</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="/arsipSop/msJenis/destroy/{{ $item->id }}"
                                                class="btn btn-danger"><i class='bx bxs-trash'></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- NEW JENIS --}}
        <div class="modal fade" id="newJenisModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Jenis</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    {{-- Your body goes here --}}
                    <form action="{{ route('arsipSopMsJenisStore') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="" class="form-label">Jenis</label>
                                <input type="text" class="form-control" name="jenis">
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckChecked" name="active" value="ENABLED" checked>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- End Master JENIS --}}



    @endsection
