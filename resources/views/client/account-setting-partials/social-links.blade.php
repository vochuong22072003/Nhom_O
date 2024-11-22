@extends('client.layouts.account-settings')

@section('form-group')
                <!-- account social links beggin -->
                <div class="tab-pane fade active show" id="account-social-links">
                    <div class="card-body pb-2">
                      <div class="form-group">
                        <label class="form-label">Twitter</label>
                        <input type="text" class="form-control" value="https://twitter.com/user">
                      </div>
                      <div class="form-group">
                        <label class="form-label">Facebook</label>
                        <input type="text" class="form-control" value="https://www.facebook.com/user">
                      </div>
                      <div class="form-group">
                        <label class="form-label">Google+</label>
                        <input type="text" class="form-control" value="">
                      </div>
                      <div class="form-group">
                        <label class="form-label">LinkedIn</label>
                        <input type="text" class="form-control" value="">
                      </div>
                      <div class="form-group">
                        <label class="form-label">Instagram</label>
                        <input type="text" class="form-control" value="https://www.instagram.com/user">
                      </div>
                    </div>
                  </div>
                  <!-- account social links end -->
@endsection

@section('form-id', 'social-link-form')