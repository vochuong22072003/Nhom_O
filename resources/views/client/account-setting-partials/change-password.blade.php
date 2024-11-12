@extends('client.layouts.account-settings')

@section('form-group')
            <!-- account change password beggin -->
            <div class="tab-pane fade active show" id="account-change-password">
                <div class="card-body pb-2">
                  <div class="form-group">
                    <label class="form-label">Current password</label>
                    <input type="password" class="form-control">
                  </div>
  
                  <div class="form-group">
                    <label class="form-label">New password</label>
                    <input type="password" class="form-control">
                  </div>
  
                  <div class="form-group">
                    <label class="form-label">Repeat new password</label>
                    <input type="password" class="form-control">
                  </div>
                </div>
              </div>
              <!-- account change password end -->
@endsection

@section('form-id', 'change-password-form')