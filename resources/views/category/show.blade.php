@extends('../layout')

@section('content')
  <div class="category">
      <div class="btn btn-danger">
          <a>Borrar</a>
      </div>
    <h1>{{ $category->name }}</h1>
  </div>

  @include('job.list', ['jobs' => $category->activeJobs])

  {{ $category->activeJobs->links() }}

  <div class="pagination_desc">
    <strong>{{ $category->activeJobs->total() }}</strong> jobs in this category
  </div>
  @endsection
