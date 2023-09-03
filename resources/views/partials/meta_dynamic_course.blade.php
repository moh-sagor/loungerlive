@section('meta_title')
    {{ $course->meta_title }}
@endsection

@section('meta_description')
    {{ strip_tags($course->meta_description) }}
@endsection
