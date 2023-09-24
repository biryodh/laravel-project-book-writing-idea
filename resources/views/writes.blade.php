<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session('success'))
              <div class="col-sm-12">
                  <div class="alert  alert-success alert-dismissible fade show" role="alert">
                      {{ session('success') }}
                  </div>
              </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg  mb-3">
                <div class="p-6 text-gray-900">
                 <form method="post" action="/addwrites">
                 @csrf
                    <div>
                      <label>Select Parent to write</label>
                      <select name="section" >
                        <option>Select Section</option>
                        @foreach($sections as $section)
                          <option value="{{$section->id}}">{{$section->name}}</option>
                          @if(count($section->child)>0)
                              @include("subchilds",["childs"=>$section->child,"space"=>""]);
                          @endif
                        @endforeach
                      </select>
                    </div>

                    <div>
                      
                      <input name="book_id" type="hidden" value="{{$section->book_id}}" placeholder="Enter Sub Section" class="block font-medium text-sm text-gray-700"/>
                    </div>

                    <div>
                      
                      <textarea name="data" type="text" rows="10" cols="50" >

                      </textarea>
                    </div>

                    <br>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'" >
                      Add </button>
                 </form>
                
                </div>
                
            </div>
           
        </div>
    </div>
</x-app-layout>
