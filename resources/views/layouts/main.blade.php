<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Team Organizer</title>

    </head>

    <body>
    <div style="background-image: url( '{{ asset('images/mainBackgroundTest.jpg') }}' );">
        <div class="fixed-top container-fluid bg-success">
            <h1 class="text-black" style="text-align: center;">Team Organizer</h1>
        
        <div class="rounded-pill bg-black" style="margin-bottom:13px;">
            <nav class="rounded-pill navbar navbar-expand-sm bg-black navbar-black">
                <div class="container-fluid">
                    <ul class="nav"> 
                        <li class="nav rounded-pill"><a id="tab1" class="rounded-pill mainTab bg-success" href="{{ route('welcome') }}" role="button" onclick="activeTab('tab1')" style="color:white;">Welcome</a></li>
                        <li class="nav rounded-pill"><a id="tab2" class="rounded-pill mainTab" href="{{ route('tutorial') }}" role="button" onclick="activeTab('tab2')" style="color:white;">Tutorial</a></li>
                        <li class="nav rounded-pill"><a id="tab3" class="rounded-pill mainTab" href="{{ route('dashboard') }}" role="button" onclick="activeTab('tab3')" style="color:white;">Dashboard</a></li>
                    </ul>
                    @php
                        $user = \Auth::user();
                    @endphp
                    <ul class="navbar-nav ml-auto"> 
                        @guest
                        <li class="nav rounded-pill"><a id="tab4" class="rounded-pill mainTab" href="{{ route('register') }}" role="button" onclick="activeTab('tab4')" style="color:white;">Sign up</a></li>
                        <li class="nav rounded-pill"><a id="tab5" class="rounded-pill mainTab" href="{{ route('login') }}" role="button" onclick="activeTab('tab5')" style="color:white;">Log In</a></li>
                        @endguest
                        @auth
                        <li class="nav rounded-pill dropdown">
                            <a id="tab6" class="rounded-pill me-1 mt-2 mainTab" href="#" role="button" data-bs-toggle="dropdown" style="color:white;">Hello, {{ $user->name }}</a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                              <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        this.closest('form').submit();">Log Out</a></li>
                        </form>
                            
                            </ul>
                        </li>
                        <li class="nav rounded-pill dropdown">
                            <a id="tab6" class="rounded-pill me-2 mainTab" href="#" role="button" data-bs-toggle="dropdown">
                                <img src="{{ asset('Images/profileiconsmall.png') }}" style="width: 36px; transform: scale(1.5);">
                            </a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                              <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        this.closest('form').submit();">Log Out</a></li>
                        </form>
                            </ul>
                        </li>
                        @endauth
                    </ul>
                    
                </div>
            </nav>
        </div> 
        </div>

        <div class="tab-content container-fluid">
            @yield('content')
        </div>
    </div>

</div>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

        <script src="{{ asset('js/script.js') }}"></script>

        <script> 

        if( window.location.hash){
          document.querySelectorAll("nav-link").forEach(pane => {
                //if(! pane) continue;
                    pane.classList.remove("active");
                });
                // console.log($("#signup"))
                document.querySelector("#signup").classList.add("active");
                // ("#signup").addClass('active')
        }

        function addToList() {
      
        var inputValue = document.getElementsByClassName("form-control")[8].value;
        document.getElementsByClassName("form-control")[8].value = "";
    
        if (inputValue == "") {
            return;
        }
    
        var alertElement = document.createElement("div");
        alertElement.classList.add("alert", "alert-success", "alert-dismissible", "show");
        alertElement.innerHTML = '<button type="button" class="btn-close" data-bs-dismiss="alert" onclick="removeFromList()"></button>' + inputValue;
    
        var container = document.getElementById("taskContainer");
        container.appendChild(alertElement);

        var allTasks = document.getElementsByClassName("alert alert-success alert-dismissible show");
        var size = allTasks.length;

        var oldBadge = document.getElementsByClassName("badge")
        for (let i = 0; i < 2; i++) {
          oldBadge[i].innerHTML = size;
        }
        }
        function removeFromList() {
          var allTasks = document.getElementsByClassName("alert alert-success alert-dismissible show");
          var size = allTasks.length;

          var oldBadge = document.getElementsByClassName("badge")
          for (let i = 0; i < 2; i++) {
            oldBadge[i].innerHTML = size;
          }
        }

        function activeTab(currentID) {
    var allTabs = document.getElementsByClassName("mainTab");
    for (let i = 0; i < allTabs.length; i++) {
        allTabs[i].classList.remove("bg-success");
    }
    
    var currentTab = document.getElementById(currentID);
    currentTab.classList.add("bg-success");
    
    // Store the selected tab in localStorage
    
    localStorage.setItem("selectedTab", currentID);
}

// Function to apply the selected tab on page load
// Function to apply the selected tab on page load
function applySelectedTab() {
    var currentPath = window.location.pathname;

    // Define route-tab mappings
    var routeTabMappings = {
        "/": "tab1",           // Root route
        "/home": "tab1",       // Alternate homepage route
        "/tutorial": "tab2",   // Tutorial route
        "/dashboard": "tab3"   // Dashboard route
        // Add more routes and corresponding tab IDs here
    };

    // Clear localStorage if the current path is in the mapping
    if (routeTabMappings.hasOwnProperty(currentPath)) {
        localStorage.removeItem("selectedTab");
    }

    var selectedTabID = localStorage.getItem("selectedTab");
    
    // Default to the mapped tab ID if no selected tab is stored
    if (!selectedTabID && routeTabMappings.hasOwnProperty(currentPath)) {
        selectedTabID = routeTabMappings[currentPath];
    }

    activeTab(selectedTabID);
}

// Call the function to apply the selected tab on page load
applySelectedTab();
        </script>
        
    </body>
</html>