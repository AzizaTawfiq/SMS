@extends('layout.app')
@section("content")
<main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <a href="{{ url()->previous() }}" class="btn btn-link ps-0">
                  <i class="bi bi-arrow-left me-2"></i>
                </a>
                <h3 class="mb-0 d-inline-block">Collect fees <span class="text-primary">({{$getStudentClass->name}} {{$getStudentClass->last_name}})</span></h3>
              </div>
              <div class="col-sm-6 text-end">
                <a type="button" class="btn btn-primary" id="addFees">Add fees</a>
              </div>
            </div>
          </div>
        </div>

        <div class="app-content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">

              @include('_message')
                <div class="card mb-4">
                  <div class="card-body p-0">
                  @if($getFees->count() > 0)
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Class</th>
                          <th>Total amount ($)</th>
                          <th>Paid amount($)</th>
                          <th>Remaining amount($)</th>
                          <th>Payment type</th>
                          <th>Remark</th>
                          <th>Created by</th>
                          <th>Created date</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($getFees as $value)
                        <tr>
                            <td>{{ $value->class_name }}</td>
                            <td>{{ number_format($value->total_amount,2) }}</td>
                            <td>{{ number_format($value->paid_amount,2) }}</td>
                            <td>{{ number_format($value->remaining_amount,2) }}</td>
                            <td>{{ $value->payment_type }}</td>
                            <td>{{ $value->remark }}</td>
                            <td>{{ $value->created_name }}</td>
                            <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>

                        </tr>
                        @endforeach
                      </tbody>

                    </table>
                    @else
                        <x-empty-state message="No Fees found for this student." />
                    @endif

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

         <!-- Add Modal -->
         <div class="modal fade" id="addFeesModal" tabindex="-1" aria-labelledby="addFeesModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addFeesModalLabel">Add Fees</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form id="addFeesForm" action="" method="post">
                  {{ csrf_field() }}
              <div class="modal-body">
                  <div class="mb-3">
                    <label class="form-label fw-bold">Class: {{ $getStudentClass->class_name}} </label>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-bold">Total amount: {{ number_format($getStudentClass->amount, 2)}} $</label>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-bold">Paid amount: {{ number_format($paid_amount, 2)}} $</label>
                  </div>
                  <div class="mb-3">
                    @php
                        $remaining_amount = $getStudentClass->amount - $paid_amount;
                    @endphp
                    <label class="form-label fw-bold">Remaining amount: {{ number_format($remaining_amount, 2)}} $</label>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-bold">Amount ($) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="amount">
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-bold">Payment type <span class="text-danger">*</span></label>
                    <select class="form-select" name="payment_type">
                      <option value="">Select</option>
                      <option value="cash">Cash</option>
                      <option value="cheque">Cheque</option>
                    </select>

                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-bold">Remark</label>
                    <textarea class="form-control" name="remark"></textarea>
                </div>
                </form>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" id="saveFeesBtn">Save</button>
                  <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>
      </main>

      @endsection


      @section("scripts")
      <script type="text/javascript">
        $(document).ready(function(){
            $('#addFees').click(function(){
                $('#addFeesModal').modal('show');
            });

            $('#saveFeesBtn').click(function(){
                $('#addFeesForm').submit();
            });
        });
      </script>
      @endsection
