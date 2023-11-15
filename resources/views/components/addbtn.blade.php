               @props(['type' => 'button', 'id' => ''])

               <div {{ $attributes->merge(['class' => 'btn btn-primary']) }} type="{{ $type }}" id="{{ $id }}">
                   <i class="fas fa-plus"></i>
               </div>
