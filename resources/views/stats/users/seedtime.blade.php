@extends('layout.default')

@section('title')
    <title>{{ __('stat.stats') }} - {{ config('other.title') }}</title>
@endsection

@section('breadcrumb')
    <li class="active">
        <a href="{{ route('stats') }}" itemprop="url" class="l-breadcrumb-item-link">
            <span itemprop="title" class="l-breadcrumb-item-link-title">{{ __('stat.stats') }}</span>
        </a>
    </li>
    <li>
        <a href="{{ route('seedtime') }}" itemprop="url" class="l-breadcrumb-item-link">
            <span itemprop="title" class="l-breadcrumb-item-link-title">{{ __('stat.top-seedtime') }}</span>
        </a>
    </li>
@endsection

@section('content')
    <div class="container">
        @include('partials.statsusermenu')

        <div class="block">
            <h2>{{ __('stat.top-seedtime') }}</h2>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <p class="text-purple"><strong><i
                                    class="{{ config('other.font-awesome') }} fa-star"></i> {{ __('stat.top-seedtime') }}
                        </strong>
                    </p>
                    <table class="table table-condensed table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('common.user') }}</th>
                            <th>{{ __('torrent.seedtime') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($seedtime as $key => $s)
                            <tr>
                                <td>
                                    {{ ++$key }}
                                </td>
                                <td @if (auth()->user()->username == $s->user->username) class="mentions" @endif>
                                    @if ($s->private_profile == 1)
                                        <span class="badge-user text-bold"><span class="text-orange"><i
                                                        class="{{ config('other.font-awesome') }} fa-eye-slash"
                                                        aria-hidden="true"></i>{{ strtoupper(__('common.hidden')) }}</span>@if (auth()->user()->id == $b->id || auth()->user()->group->is_modo)
                                                <a href="{{ route('users.show', ['username' => $s->username]) }}">({{ $s->username }}</a></span>
                                    @endif
                                    @else
                                        <span class="badge-user text-bold"><a
                                                    href="{{ route('users.show', ['username' => $s->username]) }}">{{ $s->username }}</a></span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-purple">{{ App\Helpers\StringHelper::timeElapsed($s) }}</span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
