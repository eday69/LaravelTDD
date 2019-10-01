@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-gray-600 text-sm font-normal no-underline">
                <a href="/projects" class="text-gray-600 text-sm font-normal no-underline">My Projects</a> / {{ $project->title }}
            </p>
            <a href="{{ $project->path() . '/edit' }}" class="button" >Edit Project</a>
        </div>
    </header>
    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-lg text-gray-600 font-normal mb-3">Tasks</h2>
                    {{-- tasks --}}
                    @foreach($project->tasks as $task)
                        <div class="card mb-3">
                            <form method="POST" action="{{ $task->path() }}">
                                @method('PATCH')
                                @csrf
                                <div class="flex">
                                    <input name="body" value="{{ $task->body }}" class="w-full {{ $task->completed ? 'text-gray-400' : '' }}">
                                    <input name="completed" type="checkbox" onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                                </div>
                            </form>
                        </div>
                    @endforeach
                    <div class="card mb-3">
                        <form action="{{ $project->path() . '/tasks' }}" method="POST">
                            @csrf

                            <input placeholder="Add a new task..." class="w-full" name="body">
                        </form>
                    </div>
                </div>
                <div>
                    <h2 class="text-lg text-gray-600 font-normal mb-3">General Notes</h2>

                    {{-- general notes --}}
                    <form method="POST" action="{{ $project->path() }}">
                        @method('PATCH')
                        @csrf
                        <textarea
                            name="notes"
                            class="card w-full mb-4"
                            style="min-height: 200px;"
                            placeholder="Anything special that you want to make note of?"
                        >{{ $project->notes }}
                        </textarea>
                        <button type="submit" class="button">Save</button>
                    </form>

                    @if ($errors->any())
                        <div class="field mt-6">
                            @if ($errors->any())
                                @foreach($errors->all() as $error)
                                    <li class="text-sm text-red-400">{{ $error }}</li>
                                @endforeach
                            @endif
                        </div>
                    @endif

                </div>
            </div>
            <div class="lg:w-1/4 px-3">
                <h2 class="text-lg text-gray-600 font-normal mb-3">&nbsp</h2>
                @include('projects.card')
                @include('projects.activity.card')
            </div>
        </div>

    </main>

@endsection
