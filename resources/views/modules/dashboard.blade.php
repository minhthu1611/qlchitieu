@extends('masterlayout')
@section('content')
    <div id="content" class="page-main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-status bg-red"></div>
                        <div class="card-header">
                            <form action="#">
                                    <div class="input-group justify-content-end">
                                        <input type="text" class="form-control" placeholder="Tìm kiếm...">
                                        <span class="input-group-append">
                                            <button class="btn btn-danger" type="button"><i class="fe fe-search"></i></button>
                                        </span>
                                    </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="bg-red">
                                            <th><button class="btn btn-danger"><i class="fe fe-trash"></i></button></th>
                                            <th>cc</th>
                                            <th>cc</th>
                                            <th>cc</th>
                                            <th>cc</th>
                                            <th>cc</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox ml-3">
                                                    <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1" checked>
                                                    <span class="custom-control-label">&nbsp</span>
                                                </label>
                                            </td>
                                            <td>cc</td>
                                            <td>cc</td>
                                            <td>cc</td>
                                            <td>cc</td>
                                            <td>cc</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection