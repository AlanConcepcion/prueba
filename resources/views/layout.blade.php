<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', 'Jobeet - Your best job board')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}" type="text/css" media="all" />
    <link rel="shortcut icon" href="{{ asset('/images/favicon.ico') }}" />
    <link href="{{ route('job.index', ['_format' => 'atom']) }}" rel="alternate" title="RSS" type="application/rss+xml"/>
  </head>
  <body>
    <div id="container">
      <div id="header">
        <div class="content">
          <h1><a href="/">
            <img src="{{ asset('/images/logo.jpg') }}" alt="Jobeet Job Board" />
          </a></h1>

          <div id="sub_header">
            <div class="post">
              <h2>Ask for people</h2>
              <div>
                <a href="{{ route('job.create') }}">Post a Job</a>
              </div>
            </div>

            <div class="search">
              <h2>Ask for a job</h2>
              <form action="{{ action('JobController@search') }}" method="get">
                <input type="text" name="query" id="search_keywords" />
                <input type="submit" value="search" />
                <div class="help">
                  Enter some keywords (city, country, position, ...)
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>



      <div id="content">

        <div class="content">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @yield('content')
        </div>
      </div>

      <div id="footer">
        <div class="content">

        </div>
      </div>
    </div>
  </body>
</html>
