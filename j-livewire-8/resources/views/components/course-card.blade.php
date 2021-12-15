<div>
    <div class="px-4 py-6 text-center bg-white rounded-lg shadow-lg">
        <a href="{{route('course', $course)}}">
            <img src="{{ $course->image }}" class="mb-2 rounded-md">
            <h2 class="text-lg text-gray-600 uppercase truncate">{{ $course->name}}</h2>
            <h2 class="text-md text-gray-500">{{ $course->excerpt}}</h2>
            <img src="{{$course->image}}" class="w-16 h-16 mx-auto rounded-full">


        </a>
    </div>
</div>
