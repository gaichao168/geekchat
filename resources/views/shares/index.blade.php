
<x-app-layout>
    @section('title','知识科普')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold pb-2">文章列表</h1>
                    <ul>
                        @foreach($shares as $share)
                        <li>
                            <a class="block hover:text-teal-500" href="{{route('shares.show',$share->id)}}" title="{{$share->title}}">{{$share->title}}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
