@extends('layouts.app')
@section('content')
    <div class="container" style="padding-top: 70px;">

        <style>
            .card-v {
                transition: transform 0.2s;
                /* Add a smooth transition for the transform property */
            }

            .card-v:hover {
                transform: scale(1.10);
                /* Zoom in on hover */
            }
        </style>

        <div class="mb-2 ubuntu-font p-2"
            style="text-align: center; background-color: rgb(255, 255, 255); border-radius: 8px;">
            <h3><b>All Categories</b></h3>
        </div>
        <div class=" container justify-content-center border-left border-right">
            @foreach ($categories as $category)
                <div class="d-flex py-1 card-v">
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
