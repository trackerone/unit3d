@extends('layout.default')

@section('title')
    <title>{{ $user->username }} - {{ __('user.seedboxes') }} - {{ config('other.title') }}</title>
@endsection

@section('breadcrumb')
    <li>
        <a href="{{ route('users.show', ['username' => $user->username]) }}" itemprop="url"
           class="l-breadcrumb-item-link">
            <span itemprop="title" class="l-breadcrumb-item-link-title">{{ $user->username }}</span>
        </a>
    </li>
    <li>
        <a href="{{ route('seedboxes.index', ['username' => $user->username]) }}" itemprop="url"
           class="l-breadcrumb-item-link">
            <span itemprop="title"
                  class="l-breadcrumb-item-link-title">{{ $user->username }} {{ __('user.seedboxes') }}</span>
        </a>
    </li>
@endsection

@section('content')
    <div class="container">
        <div class="block">
            @include('user.buttons.client')

            <div class="some-padding">
                <div class="well">
                    <p class="lead text-orange text-center"><i
                                class="{{ config('other.font-awesome') }} fa-exclamation-triangle"></i>
                        <strong>{{ strtoupper(__('user.disclaimer')) }}</strong> <i
                                class="{{ config('other.font-awesome') }} fa-exclamation-triangle"></i></p>
                    <p class="lead text-orange text-center">{{ __('user.disclaimer-info') }}
                        &nbsp;<br><strong>{{ __('user.disclaimer-info-bordered') }}</strong></p>
                </div>
            </div>

            <div class="table-responsive">
                <button class="btn btn-md btn-success" data-toggle="modal" data-target="#seedbox">
                    <i class="{{ config('other.font-awesome') }} fa-plus"></i> Add New Seedbox
                </button>
                <table class="table table-condensed table-bordered table-striped table-hover">
                    <tr>
                        <th>{{ __('torrent.agent') }}</th>
                        <th>IP</th>
                        <th>{{ __('common.added') }}</th>
                        <th>{{ __('common.remove') }}</th>
                    </tr>
                    @foreach ($seedboxes as $seedbox)
                        <tr>
                            <td>{{ $seedbox->name }}</td>
                            <td>{{ $seedbox->ip }}</td>
                            <td>{{ $seedbox->created_at }}</td>
                            <td>
                                <form role="form" method="POST"
                                      action="{{ route('seedboxes.destroy', ['id' => $seedbox->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="{{ config('other.font-awesome') }} fa-trash"></i> {{ __('common.delete') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="text-center">
                    {{ $seedboxes->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="seedbox" tabindex="-1" role="dialog">
        <div class="modal-dialog{{ modal_style() }}" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('common.close') }}"><span
                                aria-hidden="true">&times;</span></button>
                    <h2><i class="{{ config('other.font-awesome') }} fa-server"></i> {{ __('user.add-seedbox') }}</h2>
                </div>
                <form role="form" method="POST"
                      action="{{ route('seedboxes.store', ['username' => $user->username]) }}">
                    @csrf
                    <div class="modal-body text-center">
                        <p>Enter Seedbox Details</p>
                        <fieldset>
                            <div class="form-group">
                                <label>
                                    <input type="text" name="name" class="form-control"
                                           placeholder="Seedbox {{ __('common.name') }}" required>
                                </label>
                            </div>
                            <div class="form-group">
                                <label>
                                    <input type="text" name="ip" class="form-control" minlength="7" maxlength="15"
                                           size="15"
                                           pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$"
                                           placeholder="{{ __('user.client-ip-address') }}" required>
                                </label>
                            </div>
                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <div class="text-center">
                            <button type="button" class="btn btn-md btn-primary"
                                    data-dismiss="modal">{{ __('common.cancel') }}</button>
                            <button type="submit" class="btn btn-md btn-success">{{ __('common.submit') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
