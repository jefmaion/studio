<ul class="list-unstyled list-unstyled-border list-unstyled-noborder">
    <li class="media">
        <figure class="avatar mr-2 avatar-xl mr-4">
            <img src="{{ avatar($class->student->user->avatar) }}" alt="">
        </figure>
        <div class="media-body">
            <div class="media-title smb-1">
                <h4>
                <a href="{{ route('student.show', $class->student) }}">
                    
                        {{ $class->student->user->shortName }}
                        
                    
                </a>
                <small><small><span class="text-muted">({{ $class->student->user->phone_wpp }})</span></small></small>
            </h4>
            </div>
            <div class="">
                <div class="mb-2">
                    <div class="mb-1">

                        <p class="mb-1">
                           

                           <div>
                                
                                {{-- <i class="fa fa-birthday-cake" aria-hidden="true"></i> {{ $class->student->user->age }} Anos <span class="mx-1 text-light">|</span> --}}
                                {{ $class->modality->name }} <span class="mx-1 text-light">|</span>
                              {{ $class->typeText }}
                              @if($class->type == 'RP')
                                ({{ $class->parent->date->format('d/m/Y') }})
                              @endif
                              
                              <span class="mx-1 text-light">|</span>
                              <figure class="avatar avatar-xs">
                                <img src="{{ avatar($class->instructor->user->avatar) }}" alt="...">
                              </figure> {{ $class->instructor->user->shortName }}
          
                               
                                
                                
                           </div>

                           

                        <div class="mt-2">
                            @if($class->student->OverdueInstallments->count())
                            <span class="badge badge-pill badge-warning">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Pagamento não realizado
                            </span>
                            @endif
                    
                            @foreach( $class->pendencies() as $pendecy)
                            <span class="badge badge-pill badge-primary"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>  {{ $pendecy }}</span> 
                            @endforeach
                        </div>

                    
                            

                        </p>
                    </div>
                </div>
            </div>
        </div>



    </li>
</ul>

