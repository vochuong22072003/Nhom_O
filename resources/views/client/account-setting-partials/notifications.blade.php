@extends('client.layouts.account-settings')

@section('form-group')
     <!-- account notifications beggin -->
     <div class="tab-pane fade active show" id="account-notifications">
        <div class="card-body pb-2">

          <h6 class="mb-4">Activity</h6>

          <div class="form-group">
            <label class="switcher">
              <input type="checkbox" class="switcher-input" checked="">
              <span class="switcher-indicator">
                <span class="switcher-yes"></span>
                <span class="switcher-no"></span>
              </span>
              <span class="switcher-label">Email me when someone comments on my article</span>
            </label>
          </div>
          <div class="form-group">
            <label class="switcher">
              <input type="checkbox" class="switcher-input" checked="">
              <span class="switcher-indicator">
                <span class="switcher-yes"></span>
                <span class="switcher-no"></span>
              </span>
              <span class="switcher-label">Email me when someone answers on my forum thread</span>
            </label>
          </div>
          <div class="form-group">
            <label class="switcher">
              <input type="checkbox" class="switcher-input">
              <span class="switcher-indicator">
                <span class="switcher-yes"></span>
                <span class="switcher-no"></span>
              </span>
              <span class="switcher-label">Email me when someone follows me</span>
            </label>
          </div>
        </div>
        <hr class="border-light m-0">
        <div class="card-body pb-2">

          <h6 class="mb-4">Application</h6>

          <div class="form-group">
            <label class="switcher">
              <input type="checkbox" class="switcher-input" checked="">
              <span class="switcher-indicator">
                <span class="switcher-yes"></span>
                <span class="switcher-no"></span>
              </span>
              <span class="switcher-label">News and announcements</span>
            </label>
          </div>
          <div class="form-group">
            <label class="switcher">
              <input type="checkbox" class="switcher-input">
              <span class="switcher-indicator">
                <span class="switcher-yes"></span>
                <span class="switcher-no"></span>
              </span>
              <span class="switcher-label">Weekly product updates</span>
            </label>
          </div>
          <div class="form-group">
            <label class="switcher">
              <input type="checkbox" class="switcher-input" checked="">
              <span class="switcher-indicator">
                <span class="switcher-yes"></span>
                <span class="switcher-no"></span>
              </span>
              <span class="switcher-label">Weekly blog digest</span>
            </label>
          </div>

        </div>
      </div>
      <!-- account notifications end -->
@endsection

@section('form-id', 'notification-form')