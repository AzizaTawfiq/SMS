@extends('layout.app')
@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Subjects ({{ $subjects->total() }})</h3>
                    </div>
                    <div class="col-sm-6 text-end">
                        <a href="{{ url('admin/subjects/add') }}" class="btn btn-primary">Add Subject</a>
                    </div>
                </div>
                <!--end::Row-->

                     <!--begin::Row-->
                     <div class="row">
                      <div class="col-sm-6">
                          <p class="mb-0">Search</p>
                      </div>
                      <form action="{{ route('subjects.search') }}" method="GET">
                        <div class="row">
                            <div class="col-4">
                                <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Search for subject name">
                            </div>
                            <div class="col-4">
                                <input type="date" class="form-control" name="search_date" value="{{ request('search_by_date') }}" placeholder="Search ...">
                            </div>
                            <div class="col-4">
                                <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                                <a href="{{route('subjects.list')}}" class="btn btn-primary"><i class="bi bi-arrow-clockwise"></i></a>

                            </div>
                        </div>
                    </form>
                  </div>
                  <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('_message')
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Subjects list</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                            @if($subjects->count() > 0)
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subjects as $item)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    @if ($item->type == 0)
                                                        <span class="badge bg-primary">Theory</span>
                                                    @else
                                                        <span class="badge bg-warning">Practical</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->status == 0)
                                                        <span class="badge bg-primary">Active</span>
                                                    @else
                                                        <span class="badge bg-warning">InActive</span>
                                                    @endif
                                                </td>
                                                <td>{{ $item->user->name }}</td>
                                                <td>{{ $item->created_at }}</td>

                                                <td>
                                                    <form action="{{ route('subjects.update', $item->id) }}" method="POST" style="display: inline !important;">
                                                        @csrf
                                                        @method('PUT')
                                                        <a href="{{ route('subjects.edit', $item->id) }}"
                                                            class="text-primary" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal{{ $item->id }}"
                                                            style="width:75px !important;"><i class="bi bi-pencil"></i></a>
                                                        <div class="modal fade" id="exampleModal{{ $item->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                            Edit Subject</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group mb-3">
                                                                            <label for="name"
                                                                                class="form-label fw-bold">Subject
                                                                                Title</label>
                                                                            <input type="text" class="form-control"
                                                                                id="name" placeholder="subject title"
                                                                                name="name"
                                                                                value="{{ $item->name }}" />
                                                                        </div>
                                                                        <div class="form-group mb-3">
                                                                            <label class="form-label fw-bold">Types</label>
                                                                            <select name="type" class="form-control">
                                                                                <option>Select Type</option>
                                                                                <option @if($item->type==0) selected @endif value="0">Theory</option>
                                                                                <option @if($item->type==1) selected @endif value="1">Practical</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group mb-3">
                                                                          <label class="form-label fw-bold">Status</label>
                                                                          <select name="status" class="form-control">
                                                                              <option>Select Status</option>
                                                                              <option @if($item->status==0) selected @endif value="0">Active</option>
                                                                              <option @if($item->status==1) selected @endif value="1">InActive</option>
                                                                          </select>
                                                                      </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-primary">Save</button>
                                                                        <button type="button" class="btn btn-outline-primary"
                                                                            data-bs-dismiss="modal">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <form action="{{ route('subjects.destroy', $item->id) }}"
                                                      method="POST" style="display: inline !important;">
                                                      @csrf
                                                      @method('DELETE')
                                                      <button type="button" class="text-primary" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal2{{ $item->id }}"
                                                        style="width:75px !important;"><i class="bi bi-trash"></i></button>
                                                    <div class="modal fade" id="exampleModal2{{ $item->id }}"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                        Delete Subject</h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                  Are you sure you want to delete <span class="text-primary">{{$item->name}}</span>?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-primary">Delete</button>
                                                                    <button type="button" class="btn btn-outline-primary"
                                                                        data-bs-dismiss="modal">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                  </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <p>{{ $subjects->links() }}</p>
                            @else
                        <x-empty-state message="No administrators found in the system." />
                    @endif
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
