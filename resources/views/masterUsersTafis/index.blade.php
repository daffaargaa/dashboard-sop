@extends('layout.sidebar')

@section('masterUsersTafisActive', 'active')

@section('content')

    {{-- Add new Modal --}}
    <div class="container">
        @if (Session::has('input_success'))
            <div class="alert alert-success">
                {{ Session::get('input_success') }}
            </div>
        @endif
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add New
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Sub Dept</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ @route('masterUsersTafisStore') }}" method="post">
                        @csrf
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="" class="form-label">Dept</label>
                                <select class="form-select" aria-label="Default select example" name="kode_dept">
                                    <option selected>Pilih Dept</option>
                                    @foreach ($dept as $item)
                                        <option value="{{ $item->id }}">{{ $item->departemen }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Sub Dept</label>
                                <input type="text" class="form-control" name="sub_dept">
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckChecked" name="active" value="ENABLED" checked>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
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
    </div>

    {{-- Table --}}
    <div class="container p-2">
        <table class="table table-striped table-hover" style="margin-top: 10px;">
            <thead>
                <tr>
                    <th>Dept</th>
                    <th>Sub Dept</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tafis_ms_users_hdr as $item)
                    <tr>
                        <td>{{ $item->departemen }}</td>
                        <td>{{ $item->sub_dept }}</td>
                        <td>
                            @if ($item->status == 'ENABLED')
                                <div class="enabled">● Enabled</div>
                            @else
                                <div class="disabled">● Disabled</div>
                            @endif
                        </td>
                        <td>
                            <a href="/masterUsersTafis/destroy/{{ $item->id }}" class="btn btn-danger"><i
                                    class='bx bxs-trash'></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
