@extends('layouts.dash')

@section('content')


<div class="container-fluid row" style="visibility:hidden; height:170px;">
</div>

@if(session()->has('createdGroup'))
                <div class="alert alert-success">
                <p>{{ session('createdGroup') }}</p>
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
            
            @if ($userNotFound)
            <div class="alert alert-danger">
                {{ $userNotFound }}
            </div>
            @endif
            

<div class="container-fluid fill d-flex justify-content-center align-items-center" style="height:700px;">
    <div class="card bg-success" style="width:600px; height:540px;">
        <div class="card-body">
        
        <h2 class="card-title text-white" style="text-align:center;">Create New Group</h2>
        
            <form method="post" action="{{ route('group.create') }}" enctype="multipart/form-data">
                @csrf 
                @method('POST')
                <br>
                <label for="name" style="color:white; font-size:20px">Group Name:</label>
                <input class="form-control me-3 ms-1" name="name">
                <br>
                <label for="description" style="color:white; font-size:20px">Group Description:</label>
                <textarea class="form-control me-3 ms-1" name="description" rows="3"></textarea>
                <br>
                <label for="invitations" style="color:white; font-size:20px">Send Invitations To:</label>
                <textarea class="form-control me-3 ms-1" name="invitations" rows="3" placeholder="Use users' emails and seperate with space only         name1@company.com name2@company.com"></textarea>

                <button type="submit" class="btn btn-primary mt-4 text-white" style="float:right; font-size:18px;">Create Group</button>
            </form>
        </div>
    </div>
</div>
           

@endsection