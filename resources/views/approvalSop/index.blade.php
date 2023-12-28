@extends('layout.layout')
@section('title', 'Approval Draft SOP')

@section('content')
    <style>
        .card-body {
            display: flex;
        }

        .left-section {
            flex: 1;
        }

        .right-section {
            /* display: flex; */
            flex: 1;
            /* justify-content: flex-end; */
        }
    </style>

    <div class="container p-2">
        <div class="card">
            <div class="card-body">
                <div class="left-section">
                    <a href="/approve-rendy" class="btn btn-primary">Rendy</a>
                    @if ($urutan[0]->urutan == 1)
                        <a href="/approve-dede" class="btn btn-secondary">Dede</a>
                    @elseif ($urutan[0]->urutan == 2)
                        <a href="/approve-mka" class="btn btn-success">MKA</a>
                </div>
                <div class="right-section">
                @elseif ($urutan[0]->urutan == 3)
                    <a href="/approve-kkarpa" class="btn btn-primary">KKA-RPA</a>
                @else
                    <a href="/approve-kia" class="btn btn-secondary">KIA</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container p-2">
        <div class="card">
            <div class="card-body">
                <img src="{{ asset('sop/new_sop.png') }}">
            </div>
        </div>
    </div>
@endsection
