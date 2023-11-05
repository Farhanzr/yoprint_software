
<li class="relative px-2 py-1 ">
    <a  onclick="loading()" class="inline-flex items-center w-full text-sm font-semibold uppercase  cursor-pointer 
        @if(Route::current()->uri == $uri)
        bg-teal-500 p-1 rounded-lg text-teal-300 
        
        @else
        transform  hover:scale-105 transition duration-300 
        text-white hover:text-teal-300
        @endif" href="{{$route}}">
        {{$slot}}
        <span class="ml-4 hide">{{$title}}</span>
    </a>
</li>
