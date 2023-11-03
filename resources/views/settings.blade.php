@extends('layouts')

@section('content')
    <div class="container">
      <div class="card">
        <div class="card-body">
                <div class="row">
                        <form action="{{ route('selectline') }}" method="post">
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
                                        <input type="submit" class="btn btn-submit me-2" value="Submit">
                                        <a  onclick="history.back()" class="btn btn-cancel">Cancel</a>
                                </div>
                        </div>
                        </form>
                </div>
        </div>
</div>
    </div>
@endsection
