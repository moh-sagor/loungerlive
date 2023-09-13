@section('meta_title')
    {{ $movie->meta_title }}
@endsection

@section('meta_description')
    {{ strip_tags($movie->meta_description) }}
@endsection
