@if ($errors->any())
  <div class="alert alert-danger" >
    <button type="button" class="close" data-dismiss="alert" name="button">
      &times;
    </button>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
@if (isset($menssage))
  <div class="alert alert-success" >
    <button type="button" class="close" data-dismiss="alert" name="button">
      &times;
    </button>
    <ul>
      <li>{{ $menssage }}</li>
    </ul>
  </div>
@endif