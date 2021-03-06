<div class="col-xs-12 section-title">
  <img src="/img/people/calls/phone.svg" class="icon-section">
  <h3>
    {{ trans('people.call_title') }}

    <span>
      <a href="#logCallModal" class="btn edit-information" data-toggle="modal">{{ trans('people.call_button') }}</a>
    </span>
  </h3>
</div>

@if ($contact->calls()->count() == 0)

  <div class="col-xs-12">
    <div class="section-blank">
      <h3>{{ trans('people.call_blank_title', ['name' => $contact->getFirstName()]) }}</h3>
      <a href="#logCallModal" data-toggle="modal">{{ trans('people.call_button') }}</a>
    </div>
  </div>

@else

  <div class="col-xs-12">

    @foreach($contact->calls as $call)

      @if (is_null($call->getParsedContentAttribute()))

        <div class="ba br2 b--black-10 br--top w-100 mb4">
          <div class="pa2">
            {{ trans('people.call_blank_desc', ['name' => $contact->first_name]) }}
          </div>
          <div class="pa2 cf bt b--black-10 br--bottom f7 lh-copy">
            <div class="fl w-50">
              {{ \App\Helpers\DateHelper::getShortDate($call->called_at) }}
            </div>
            <div class="fl w-50 tr">
              <a href="#" onclick="if (confirm('{{ trans('people.call_delete_confirmation') }}')) { $(this).parent().find('.entry-delete-form').submit(); } return false;">              
                <i class="fa fa-trash-o" aria-hidden="true"></i>
              </a>

              <form method="POST" action="{{ action('People\\CallsController@destroy', compact('contact', 'call')) }}" class="entry-delete-form hidden">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
              </form>
            </div>
          </div>
        </div>

      @else

        <div class="ba br2 b--black-10 br--top w-100 mb4">
          <div class="pa2">
            {!! $call->getParsedContentAttribute() !!}
          </div>
          <div class="pa2 cf bt b--black-10 br--bottom f7 lh-copy">
            <div class="fl w-50">
              {{ \App\Helpers\DateHelper::getShortDate($call->called_at) }}
            </div>
            <div class="fl w-50 tr">
              <a href="#" onclick="if (confirm('{{ trans('people.call_delete_confirmation') }}')) { $(this).parent().find('.entry-delete-form').submit(); } return false;">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
              </a>

              <form method="POST" action="{{ action('People\\CallsController@destroy', compact('contact', 'call')) }}" class="entry-delete-form hidden">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
              </form>
            </div>
          </div>
        </div>

      @endif

    @endforeach

  </div>

@endif
