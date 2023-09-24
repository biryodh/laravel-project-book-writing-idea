<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

   

    <div class="py-12">
     
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg  mb-3">
            @if (session('success'))
              <div class="col-sm-12">
                  <div class="alert  alert-success alert-dismissible fade show" role="alert">
                      {{ session('success') }}
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              
                          </button>
                  </div>
              </div>
            @endif
                <div class="p-6 text-gray-900">
                  <p><b>Feature as an Author:</b></p>
                  <form method="post" action="/book" >
                  @csrf
                    <div>
                      <label>Book Name</label>
                      <input name="name" type="text" placeholder="Enter Bookname" class="block font-medium text-sm text-gray-700"/>
                    </div>
                    
                    <div>
                      <label>No of Chapters</label>
                      <input name="chapters" type="number" placeholder="Enter Chapter Count" class="block font-medium text-sm text-gray-700"/>
                    </div>

                    <br>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'" >Create Book</button>

                  </form>
                
                </div>
            </div>
            <p><b>Author for Followings</b></p>
            <ul>
              @foreach($books as $book)
                <li> <b>{{$book->name}}</b> :: <a href="/write/{{$book->id}}"> Click to Write content </a> - <a href="/getsection/{{$book->id}}"> Add Sections </a> - <a href="/permission/{{$book->id}}"> Add Collaborator </a></li>
              @endforeach
            </ul>
            <br>
            <br>
            <p><b>Collab for Followings</b></p>
            <ul>
              @foreach($CollabBooks as $book)
                <li><b>{{$book->name}}</b> :: <a href="/write/{{$book->id}}"> Click to Write content </a></li>
              @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
