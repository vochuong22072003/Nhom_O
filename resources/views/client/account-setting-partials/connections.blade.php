@extends('client.layouts.account-settings')

@section('form-group')
                <!-- account connections beggin -->
                <div class="tab-pane fade active show" id="account-connections">
                    <div class="card-body">
                      <button type="button" class="btn btn-twitter">Connect to <strong>Twitter</strong></button>
                    </div>
                    <hr class="border-light m-0">
                    <div class="card-body">
                      <h5 class="mb-2">
                        <a href="javascript:void(0)" class="float-right text-muted text-tiny"><i class="ion ion-md-close"></i>
                          Remove</a>
                        <i class="ion ion-logo-google text-google"></i>
                        You are connected to Google:
                      </h5>
                      <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                        data-cfemail="f39d9e928b84969f9fb39e929a9fdd909c9e">[email&#160;protected]</a>
                    </div>
                    <hr class="border-light m-0">
                    <div class="card-body">
                      <button type="button" class="btn btn-facebook">Connect to <strong>Facebook</strong></button>
                    </div>
                    <hr class="border-light m-0">
                    <div class="card-body">
                      <button type="button" class="btn btn-instagram">Connect to <strong>Instagram</strong></button>
                    </div>
                  </div>
                  <!-- account connections end -->
@endsection

@section('form-id', 'connection-form')