@extends('layouts.main')

@section('content')

<div class="tab-pane container active" id="home">
                <div class="container-fluid row" style="visibility:hidden; height:170px;">
                </div>
            <div class="container-fluid row">
                @if(session()->has('messageDelete'))
                <div class="alert alert-success">
                <p>{{ session('messageDelete') }}</p>
            </div>
            @endif

            @if(session()->has('messageAdd'))
            <div class="alert alert-success">
                <p>{{ session('messageAdd') }}</p>
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
                    <h1 style="font-family: Arial, Helvetica, sans-serif; margin-top: 30px; margin-bottom:30px;">Welcome</h1>

                    <div class="container-fluid row" style="margin-bottom:50px;">
                    <div class="col-6">
                    <p style="text-indent:40px;">
                            A home page is the default or front page of a site. 
                        It is the first page that visitors see when they load a URL.
                        Web managers can control the home page as a way of directing 
                        the user experience.
                    </p>
                    <p style="text-indent:40px;">
                            Home pages are located in the root directory of the website. 
                        Many home pages act as a virtual directory for a site — they 
                        provide top-level menus where visitors can go deeper into various 
                        areas of the site. For instance, a typical website has a homepage 
                        with menu items like “about,” “contact,” “products,” “services,” 
                        “press” or “news.”
                    </p>
                    <p style="text-indent:40px;">
                            In addition, the home page often serves to orient visitors by 
                        providing titles, headlines and images and visuals that show what 
                        the website is about, and in some cases, who owns it and maintains 
                        it. One of the best examples is the average business website, 
                        which has the business name in a prominent place, and often features 
                        the logo, while also showing pictures related to that business, for 
                        instance, who works there, what the business produces, or what it 
                        does in a community.
                    </p>
                    </div>
                    <div class="col-6">
                    <div id="forhome" class="carousel slide" data-bs-ride="carousel" style="margin-left: 50px;">

                        <div class="carousel-indicators">
                          <button type="button" data-bs-target="#forhome" data-bs-slide-to="0" class="active"></button>
                          <button type="button" data-bs-target="#forhome" data-bs-slide-to="1"></button>
                          <button type="button" data-bs-target="#forhome" data-bs-slide-to="2"></button>
                          <button type="button" data-bs-target="#forhome" data-bs-slide-to="3"></button>
                        </div>
                      
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img src="Images/groupwork1.jpeg" alt="Company Image" class="d-block" style="width:max-content;height:400px;">
                          </div>
                          <div class="carousel-item">
                            <img src="Images/groupwork2.jpeg" alt="Company Image" class="d-block" style="width:max-content;height:400px;">
                          </div>
                          <div class="carousel-item">
                            <img src="Images/groupwork3.jpeg" alt="Company Image" class="d-block" style="width:max-content;height:400px;">
                          </div>
                          <div class="carousel-item">
                            <img src="Images/groupwork4.webp" alt="Company Image" class="d-block" style="width:max-content;height:400px;">
                          </div>
                        </div>
                      
                        <button class="carousel-control-prev" type="button" data-bs-target="#forhome" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#forhome" data-bs-slide="next">
                          <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                    </div>
                    </div>
                    
                
                    
                
        </div>
</div>

@endsection