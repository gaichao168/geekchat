
<x-app-layout>
    @section('title',$share->title)
    @section('keyword',$share->keyword)
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden min-h-screen shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold pb-4 text-center">{{$share->title}}</h1>
                    <div class="my-4">
                        {!! $share->content !!}
                    </div>

                    <hr>
                    <div class="mt-4 flex justify-end">
                        发布时间：{{$share->created_at}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
