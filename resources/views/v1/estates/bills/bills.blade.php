@extends('layouts.estates')

@section('title')
    SmartVille - Estate Groups
@endsection

@section('styles')
@endsection

@section('content')

    @include('includes.headers.estates')

    <h1 class="page-header">Records</h1>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Header</th>
                <th>Header</th>
                <th>Header</th>
                <th>Header</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1,008</td>
                <td>Fusce</td>
                <td>nec</td>
                <td>tellus</td>
                <td>sed</td>
                <td>
                    <a href="#" role="button" class="btn btn-primary btn-xs"
                       data-toggle="modal" data-target="#modal-edit">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="#" role="button" class="btn btn-danger btn-xs" data-toggle="modal"
                       data-target="#modal-delete">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <!--modal snippet -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit record:</h4>
                </div>
                <div class="modal-body">
                    <p>Record details here&hellip;</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    </div>

    @include('includes.modals.delete')

    @include('includes.footers.estates')

    <script>
        CKEDITOR.replace('property_desc');
    </script>
@endsection
