@extends('layouts.app')
@section('content')
    <div class="container" style="padding-top: 70px;">
        <div class="container justify-content-center border-left border-right">
            @foreach ($categories as $category)
                <div class="d-flex py-1">
                    <div class="second py-2 px-2">
                        <span class="text1 ms-2 ubuntu-font">
                            <a href="{{ route('categories.show', $category->slug) }}" style="text-decoration: none;"> <i
                                    class="fas fa-folder"></i>
                                {{ $category->name }}
                            </a>
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
