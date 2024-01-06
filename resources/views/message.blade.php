@extends('layouts.dash')

@section('content')

<div class="container-fluid row" style="visibility:hidden; height:170px;">
</div>

@if(session()->has('messageSent'))
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
            
            
            

<div class="container-fluid fill d-flex justify-content-center align-items-center" style="height:700px;">
    <div class="card bg-light" style="width:1200px; height:620px;">
        <div class="card-body">
        
        <h2 class="card-title text-success">Send New Message</h2>
        
            <form method="post" action="{{ route('group.create') }}" enctype="multipart/form-data">
                @csrf 
                @method('POST')
                <br>
                <label for="to" style="color:green; font-size:20px">To:</label>
                <input class="form-control me-3 ms-1" name="to" placeholder="Use users' emails and seperate with space only: name1@company.com name2@company.com">
                <br>
                <label for="subject" style="color:green; font-size:20px">Subject:</label>
                <textarea class="form-control me-3 ms-1" name="subject" rows="1"></textarea>
                <br>
                <label for="message" style="color:green; font-size:20px">Message:</label>
                <textarea class="form-control me-3 ms-1" name="message" rows="8"></textarea>

                <button type="submit" class="btn btn-primary mt-4 text-white" style="float:right; font-size:18px;">Send</button>
            </form>
        </div>
    </div>
</div>

@endsection