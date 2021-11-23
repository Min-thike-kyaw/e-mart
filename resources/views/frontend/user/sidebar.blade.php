<div class="list-group">
    <a href="{{route('user.dashboard')}}" class="list-group-item list-group-item-action {{\Request::is('user/dashboard') ? 'active' : ''}}" aria-current="true">
      <h4>Dashboard</h4>
    </a>
    <a href="{{route('user.order')}}" class="list-group-item list-group-item-action {{\Request::is('user/order')? 'active' : ''}}"><h4>Order</h4></a>
    <a href="{{route('user.address')}}" class="list-group-item list-group-item-action {{\Request::is('user/address')? 'active' : ''}}"><h4>Address</h4></a>
    <a href="{{route('user.detail')}}" class="list-group-item list-group-item-action {{\Request::is('user/account-detail')? 'active' : ''}}" ><h4>Account Detail</h4></a>
    <a class="list-group-item list-group-item-action disabled"><h4>Logout</h4></a>
  </div>
