@extends('tracking-application-log::layout.app')

@section('content')
    <div class="md:flex">
        <div class="sm:w-full md:w-2/3 md:mr-10 mb-10">
            <div>
                <div>
                    Description: {{ $applicationLog->description }}
                </div>

                <div>
                    @if($applicationLog->actor_id)
                        Actor ID: {{ $applicationLog->actor_id }}
                    @endif
                </div>

                <div>
                    Subject: {!! $applicationLog->subject !!}
                </div>

                <div>
                    Level: {!! $applicationLog->level !!}
                </div>

                <div>
                    User Agent: {!! $applicationLog->user_agent !!}
                </div>

                <div>
                    Browser: {!! $applicationLog->browser !!}
                </div>

                <div>
                    Browser Version{!! $applicationLog->browser_version !!}
                </div>

                <div>
                    Platform: {!! $applicationLog->platform !!}
                </div>

                <div>
                    Platform Version: {!! $applicationLog->platform_version !!}
                </div>

                <div>
                    IP: {!! $applicationLog->ip !!}
                </div>

                <div>
                    <div class="font-light text-xs text-gray-600 ">
                        <div>
                            <i class="fa fa-fw fa-clock mr-1"></i>{{ $applicationLog->created_at }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
