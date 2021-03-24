@extends('layouts.master')

@section('body')
    <div class="col-xl-9 col-lg-8 col-md-7">
        <ul class="blog-filter">
            <li><a href="#">Racing</a></li>
            <li><a href="#">Shooters</a></li>
            <li><a href="#">Strategy</a></li>
            <li><a href="#">Online</a></li>
        </ul>
        <div class="big-blog-item">
            <img src="img/blog-big/1.jpg" alt="#" class="blog-thumbnail">
            <div class="blog-content text-box text-white">
                <div class="top-meta">11.11.18 / in <a href="">Games</a></div>
                <h3>The best VR games on the market</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Lorem ipsum dolor
                    sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                    magna aliqua.....</p>
                <a href="#" class="read-more">Read More <img src="img/icons/double-arrow.png" alt="#" /></a>
            </div>
        </div>
        <div class="big-blog-item">
            <img src="img/blog-big/2.jpg" alt="#" class="blog-thumbnail">
            <div class="blog-content text-box text-white">
                <div class="top-meta">11.11.18 / with <a href="">Rp76</a></div>
                <h3>The best online game is out now!</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Lorem ipsum dolor
                    sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                    magna aliqua.....</p>
                <a href="#" class="read-more">Read More <img src="img/icons/double-arrow.png" alt="#" /></a>
            </div>
        </div>
        <div class="big-blog-item">
            <img src="img/blog-big/3.jpg" alt="#" class="blog-thumbnail">
            <div class="blog-content text-box text-white">
                <div class="top-meta">11.11.18 / in <a href="">Games</a></div>
                <h3>The best online game is out now!</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Lorem ipsum dolor
                    sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                    magna aliqua.....</p>
                <a href="#" class="read-more">Read More <img src="img/icons/double-arrow.png" alt="#" /></a>
            </div>
        </div>
        <paginate total="15" current="{{Request()->page}}"></paginate>
    </div>

@endsection
