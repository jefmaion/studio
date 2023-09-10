<ul class="list-unstyled list-unstyled-border list-unstyled-noborder">
    <li class="media">
        <figure class="avatar mr-2 avatar-xl mr-4">
            <img src="{{ asset('template/assets/img/users/user-3.png') }}" alt="">
        </figure>
        <div class="media-body">
            <div class="media-title smb-1">
                <a href="{{ route('student.show', $class->student) }}">
                    <h4>
                        {{ $class->student->user->shortName }}
                    </h4>
                </a>
            </div>
            <div class="">
                <div class="mb-2">
                    <div class="mb-1">

                        <p class="mb-1">
                            {{-- 
                            <i class="fas fa-phone"></i> {{ $class->student->user->phone_wpp }} <span class="mx-1 text-light">|</span>
                            <i class="fas fa-boxes"></i> {{ $class->modality->name }} <span class="mx-1 text-light">|</span>
                            <i class="fas fa-boxes"></i> {{ $class->typeText }}<span class="mx-1 text-light">|</span>

                            <i class="fas fa-calendar"></i> {{ formatData($class->date, 'd/m') }} {{ date('H\hi', strtotime($class->time)) }} <span class="mx-1 text-light">|</span>
                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                            {{ $class->instructor->user->shortName }} 
                            --}}

                           <div>
                                <i class="fa fa-genderless" aria-hidden="true"></i> {{ $class->student->user->genderName }} <span class="mx-1 text-light">|</span>
                                <i class="fa fa-birthday-cake" aria-hidden="true"></i> {{ $class->student->user->age }} Anos <span class="mx-1 text-light">|</span>
                                <i class="fa fa-phone" aria-hidden="true"></i> {{ $class->student->user->phone_wpp }} 
                                
                           </div>

                           <div>
                             • {{ $class->modality->name }} <span class="mx-1 text-light">|</span>
                              {{ $class->typeText }}
                              @if($class->type == 'RP')
                                ({{ $class->parent->date->format('d/m/Y') }})
                              @endif
                              
                              <span class="mx-1 text-light">|</span>
                              {{ $class->instructor->user->shortName }}
                        </div>

                        <div class="mt-2">
                            <span class="badge badge-pill badge-{{ $class->bgColor }} bg-{{ $class->bgColor }}">{{ $class->situation }}</span>  
                        </div>

                        <div>
                            {{ $class->absense_comments }}
                        </div>
                            

                        </p>
                    </div>
                </div>
            </div>
        </div>



    </li>
</ul>

