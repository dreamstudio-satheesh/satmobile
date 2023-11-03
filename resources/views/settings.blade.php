@extends('layouts')

@section('content')
    <div class="container">
      <div class="card">
        <div class="card-body">
                <div class="row">
                        <form id="settingsForm" action="{{ route('selectline') }}" method="post">
                                @csrf
                        <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                        <label>Select Line <span class="manitory">*</span></label>
                                        <select name="line_id" id="line" " class="form-control" >
                                                <option selected value="">-- Select Line --</option>
                                                @foreach ($lines as $line)
                                                <option value="{{ $line->id }}">{{ $line->name }}</option>
                                                @endforeach
                                              </select>
                                           
                                            @error('line_id')
                                                <span class="text-danger small" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                </div>
                        </div>
                        
                        <div class="row">
                                <div class="col-lg-12">
                                  <br>
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                        <a  onclick="history.back()" class="btn btn-warning">Cancel</a>
                                </div>
                        </div>
                        </form>
                </div>
        </div>
</div>
    </div>
@endsection

@push('scripts')

<script>
  document.getElementById('settingsForm').addEventListener('submit', function() {
    // Clear selectedCustomerId and storedCustomers from local storage
    localStorage.removeItem('selectedCustomerId');
    localStorage.removeItem('storedCustomers');
});
</script>

@endpush
