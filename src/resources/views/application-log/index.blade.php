@extends('tracking-application-log::layout.app')

@section('search')
    <div class="w-1/3">
        <form action="{{ route('application_logs.index') }}" method="get" class="w-full flex items-center" >
            <i class="fa fa-search fa-lg ml-3 mt-0 z-10 text-gray-800 absolute"></i>
            <input id="q" name="q" class="input bg-white py-2 pl-10" placeholder="Search" value="{{ request('q') }}"/>
            @if(request('q'))
                <a href="{{ route('application_logs.index') }}">
                    <i class="fa fa-times fa-lg -mt-2 -ml-6 z-10 text-gray-700 cursor-pointer hover:text-blue-500 absolute"></i>
                </a>
            @endif
        </form>
    </div>
@endsection

@section('content')
    <h1 class="text-2xl text-gray-800">Application Logs</h1>
    <div class="my-4 p-5 bg-white rounded-lg shadow-lg">
        <table class="border w-full">
            <tr>
                <th class="py-4 px-6 bg-gray-200 font-bold uppercase text-sm text-left text-gray-800">
                    Email
                </th>
                <th class="py-4 px-6 bg-gray-200 font-bold uppercase text-sm text-left text-gray-800">
                    Subject
                </th>
                <th class="py-4 px-6 bg-gray-200 font-bold uppercase text-sm text-left text-gray-800">
                    Description
                </th>
                <th class="py-4 px-6 bg-gray-200 font-bold uppercase text-sm text-left text-gray-800">
                    Level
                </th>
                <th class="py-4 px-6 bg-gray-200 font-bold uppercase text-sm text-left text-gray-800">
                    Ip
                </th>
                <th class="py-4 px-6 bg-gray-200 font-bold uppercase text-sm text-left text-gray-800">

                </th>
            </tr>

            @foreach($applicationLogs as $applicationLog)
                <tr class="border-b border-gray-300 hover:bg-blue-100">
                    <td class="py-4 px-6">
                        @if(isset($applicationLog->actor))
                            {{ $applicationLog->actor->email }}
                        @elseif(isset($applicationLog->log) && isset(json_decode($applicationLog->log)->user_email))
                            {{ json_decode($applicationLog->log)->user_email }}
                        @else
                             -
                        @endif
                    </td>
                    <td class="py-4 px-6">
                        {{ $applicationLog->subject }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $applicationLog->description }}
                        @if($applicationLog->subject_link)
                            <a href="{{ $applicationLog->subject_link }}" class="link-teal"><i class="fa fa-fw fa-external-link-alt"></i></a>
                        @endif
                    </td>
                    <td class="py-4 px-6">
                        {{ $applicationLog->level }}
                    </td>

                    <td class="py-4 px-6">
                        {{ $applicationLog->ip }}
                    </td>
                    <td class="py-4 px-6" align="right">
                        <a href="{{ route('application_logs.show', [ 'application_log' => $applicationLog ]) }}" class="button-icon-gray"><i class="far fa-fw fa-eye"></i></a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {{ $applicationLogs->links() }}

@endsection
