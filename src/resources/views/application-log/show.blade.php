@extends('tracking-application-log::layout.app')

@section('content')
    <div class="md:flex">
        <div class="sm:w-full md:w-2/3 md:mr-10 mb-10">
            <div>
                <div>
                    Descrizione: {{ $applicationLog->description }}
                </div>

                <div>
                    @if($applicationLog->actor_id)
                        ID Utente: {{ $applicationLog->actor_id }}
                    @endif
                </div>

                <div>
                    Soggetto: {!! $applicationLog->subject !!}
                </div>

                <div>
                    Livello: {!! $applicationLog->level ?? '-' !!}
                </div>

                <div>
                    User Agent: {!! $applicationLog->user_agent ?? '-' !!}
                </div>

                <div>
                    Browser: {!! $applicationLog->browser ?? '-' !!}
                </div>

                <div>
                    Versione Browser: {!! $applicationLog->browser_version ?? '-' !!}
                </div>

                <div>
                    Piattaforma: {!! $applicationLog->platform ?? '-' !!}
                </div>

                <div>
                    Versione Piattaforma: {!! $applicationLog->platform_version ?? '-' !!}
                </div>

                <div>
                    IP: {!! $applicationLog->ip ?? '-' !!}
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
