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
    <div style="background-image: url( '{{ asset('images/mainBackgroundTest.jpg') }}' ); height:100vh;">
        <div class="fixed-top container-fluid bg-black">
            <a class="rounded-pill" href="{{ route('welcome') }}" role="button" style="text-decoration:none;"><h1 class="text-success" style="text-align: center;">Team Organizer</h1></a>
        
        <div class="rounded-pill bg-black" style="margin-bottom:13px;">
            <nav class="rounded-pill navbar navbar-expand-sm bg-black navbar-black">
                <div class="container-fluid">
                    <ul class="nav"> 
                        <li class="nav rounded-pill"><a id="tab3" class="rounded-pill mainTab bg-success" href="{{ route('dashboard') }}" role="button" onclick="activeTab('tab3')" style="color:white;">Dashboard</a></li>
                        <li class="nav rounded-pill"><a id="tab8" class="rounded-pill mainTab" href="{{ route('groups') }}" role="button" onclick="activeTab('tab8')" style="color:white;">Groups</a></li>
                        <li class="nav rounded-pill"><a id="tab9" class="rounded-pill mainTab" href="{{ route('personal') }}" role="button" onclick="activeTab('tab9')" style="color:white;">Personal</a></li>
                        <li class="nav rounded-pill"><a id="tab10" class="rounded-pill mainTab" href="{{ route('create') }}" role="button" onclick="activeTab('tab10')" style="color:white;">Create</a></li>
                        <li class="nav rounded-pill"><a id="tab11" class="rounded-pill mainTab" href="{{ route('message') }}" role="button" onclick="activeTab('tab11')" style="color:white;">Message</a></li>
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

function openGroup(groupId) {

    // Hide all groups
    var allGroups = document.querySelectorAll('[id^="g"]');
    for (var i = 0; i < allGroups.length; i++) {
        allGroups[i].style.display = 'none';
    }

    // Show the selected group
    var selectedGroup = document.getElementById(groupId);
    if (selectedGroup) {
        selectedGroup.style.display = 'block';
    }

    localStorage.setItem("selectedGroup", groupId);
}

function applySelectedGroup() {
    var selectedGroupId = localStorage.getItem("selectedGroup");
    if (selectedGroupId) {
        openGroup(selectedGroupId);
    }
}

// Call the function to apply the selected group on page load
applySelectedGroup();

        </script>
        
    </body>
</html>