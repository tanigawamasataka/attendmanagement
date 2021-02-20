@if (session('error'))
<div>
  <div class="alert alert-danger">
      {{ session('error') }}
  </div>
</div>
@endif