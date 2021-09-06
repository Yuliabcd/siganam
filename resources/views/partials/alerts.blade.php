@if ($errors->isNotEmpty())

  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-ban"></i> Error!</h5>
    <ul class="list-unstyled">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

@if (session()->has('success'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Success!</h5>
    @if (is_array(session()->get('success')))
      <ul class="list-unstyled">
        @foreach (session()->get('success') as $success)
          <li>{{ $success }}</li>
        @endforeach
      </ul>
    @else
      {{ session()->get('success') }}
    @endif
  </div>
@endif

@if (session()->has('warning'))
  <div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-exclamation-triangle"></i> Warning!</h5>
    @if (is_array(session()->get('warning')))
      <ul class="list-unstyled">
        @foreach (session()->get('warning') as $warning)
          <li>{{ $warning }}</li>
        @endforeach
      </ul>
    @else
      {{ session()->get('warning') }}
    @endif
  </div>
@endif
