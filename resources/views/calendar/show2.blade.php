<div class="modal fade " id="modal-class-{{ $class->id }}" role="dialog" data-backdrop="static" aria-hidden="true">

    <style>
        .tab-pane {
            height: 200px;
            overflow: auto
        }
    </style>

    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header bg-whitesmoke  p-3 modal-class-{{ $class->id }}">
                <h5 class="modal-title">
                    <i class="fas fa-info-circle  drag-area  "></i>
                    Aula em {{ $class->date->format('d/m/Y') }} às {{ date('H\hi', strtotime($class->time)) }} - {{
                    $class->situation }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <section class="section">
                    <div class="section-body">
                      <div class="row mt-sm-4">
                        <div class="col-12 col-md-12 col-lg-4">
                          <div class="card author-box">
                            <div class="card-body">
                              <div class="author-box-center">
                                <img alt="image" src="assets/img/users/user-1.png" class="rounded-circle author-box-picture">
                                <div class="clearfix"></div>
                                <div class="author-box-name">
                                  <a href="#">Sarah Smith</a>
                                </div>
                                <div class="author-box-job">Web Developer</div>
                              </div>
                              <div class="text-center">
                                <div class="author-box-description">
                                  <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur voluptatum alias molestias
                                    minus quod dignissimos.
                                  </p>
                                </div>
                                <div class="mb-2 mt-3">
                                  <div class="text-small font-weight-bold">Follow Hasan On</div>
                                </div>
                                <a href="#" class="btn btn-social-icon mr-1 btn-facebook">
                                  <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="btn btn-social-icon mr-1 btn-twitter">
                                  <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-social-icon mr-1 btn-github">
                                  <i class="fab fa-github"></i>
                                </a>
                                <a href="#" class="btn btn-social-icon mr-1 btn-instagram">
                                  <i class="fab fa-instagram"></i>
                                </a>
                                <div class="w-100 d-sm-none"></div>
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header">
                              <h4>Personal Details</h4>
                            </div>
                            <div class="card-body">
                              <div class="py-4">
                                <p class="clearfix">
                                  <span class="float-left">
                                    Birthday
                                  </span>
                                  <span class="float-right text-muted">
                                    30-05-1998
                                  </span>
                                </p>
                                <p class="clearfix">
                                  <span class="float-left">
                                    Phone
                                  </span>
                                  <span class="float-right text-muted">
                                    (0123)123456789
                                  </span>
                                </p>
                                <p class="clearfix">
                                  <span class="float-left">
                                    Mail
                                  </span>
                                  <span class="float-right text-muted">
                                    test@example.com
                                  </span>
                                </p>
                                <p class="clearfix">
                                  <span class="float-left">
                                    Facebook
                                  </span>
                                  <span class="float-right text-muted">
                                    <a href="#">John Deo</a>
                                  </span>
                                </p>
                                <p class="clearfix">
                                  <span class="float-left">
                                    Twitter
                                  </span>
                                  <span class="float-right text-muted">
                                    <a href="#">@johndeo</a>
                                  </span>
                                </p>
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header">
                              <h4>Skills</h4>
                            </div>
                            <div class="card-body">
                              <ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder">
                                <li class="media">
                                  <div class="media-body">
                                    <div class="media-title">Java</div>
                                  </div>
                                  <div class="media-progressbar p-t-10">
                                    <div class="progress" data-height="6" style="height: 6px;">
                                      <div class="progress-bar bg-primary" data-width="70%" style="width: 70%;"></div>
                                    </div>
                                  </div>
                                </li>
                                <li class="media">
                                  <div class="media-body">
                                    <div class="media-title">Web Design</div>
                                  </div>
                                  <div class="media-progressbar p-t-10">
                                    <div class="progress" data-height="6" style="height: 6px;">
                                      <div class="progress-bar bg-warning" data-width="80%" style="width: 80%;"></div>
                                    </div>
                                  </div>
                                </li>
                                <li class="media">
                                  <div class="media-body">
                                    <div class="media-title">Photoshop</div>
                                  </div>
                                  <div class="media-progressbar p-t-10">
                                    <div class="progress" data-height="6" style="height: 6px;">
                                      <div class="progress-bar bg-green" data-width="48%" style="width: 48%;"></div>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-8">
                          <div class="card">
                            <div class="padding-20">
                              <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings" role="tab" aria-selected="false">Setting</a>
                                </li>
                              </ul>
                              <div class="tab-content tab-bordered" id="myTab3Content">
                                <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">
                                  <div class="row">
                                    <div class="col-md-3 col-6 b-r">
                                      <strong>Full Name</strong>
                                      <br>
                                      <p class="text-muted">Emily Smith</p>
                                    </div>
                                    <div class="col-md-3 col-6 b-r">
                                      <strong>Mobile</strong>
                                      <br>
                                      <p class="text-muted">(123) 456 7890</p>
                                    </div>
                                    <div class="col-md-3 col-6 b-r">
                                      <strong>Email</strong>
                                      <br>
                                      <p class="text-muted">johndeo@example.com</p>
                                    </div>
                                    <div class="col-md-3 col-6">
                                      <strong>Location</strong>
                                      <br>
                                      <p class="text-muted">India</p>
                                    </div>
                                  </div>
                                  <p class="m-t-30">Completed my graduation in Arts from the well known and
                                    renowned institution
                                    of India – SARDAR PATEL ARTS COLLEGE, BARODA in 2000-01, which was
                                    affiliated
                                    to M.S. University. I ranker in University exams from the same
                                    university
                                    from 1996-01.</p>
                                  <p>Worked as Professor and Head of the department at Sarda Collage, Rajkot,
                                    Gujarat
                                    from 2003-2015 </p>
                                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                    industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s,
                                    when
                                    an unknown printer took a galley of type and scrambled it to make a
                                    type
                                    specimen book. It has survived not only five centuries, but also the
                                    leap
                                    into electronic typesetting, remaining essentially unchanged.</p>
                                  <div class="section-title">Education</div>
                                  <ul>
                                    <li>B.A.,Gujarat University, Ahmedabad,India.</li>
                                    <li>M.A.,Gujarat University, Ahmedabad, India.</li>
                                    <li>P.H.D., Shaurashtra University, Rajkot</li>
                                  </ul>
                                  <div class="section-title">Experience</div>
                                  <ul>
                                    <li>One year experience as Jr. Professor from April-2009 to march-2010
                                      at B.
                                      J. Arts College, Ahmedabad.</li>
                                    <li>Three year experience as Jr. Professor at V.S. Arts &amp; Commerse
                                      Collage
                                      from April - 2008 to April - 2011.</li>
                                    <li>Lorem Ipsum is simply dummy text of the printing and typesetting
                                      industry.
                                    </li>
                                    <li>Lorem Ipsum is simply dummy text of the printing and typesetting
                                      industry.
                                    </li>
                                    <li>Lorem Ipsum is simply dummy text of the printing and typesetting
                                      industry.
                                    </li>
                                    <li>Lorem Ipsum is simply dummy text of the printing and typesetting
                                      industry.
                                    </li>
                                  </ul>
                                </div>
                                <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
                                  <form method="post" class="needs-validation">
                                    <div class="card-header">
                                      <h4>Edit Profile</h4>
                                    </div>
                                    <div class="card-body">
                                      <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                          <label>First Name</label>
                                          <input type="text" class="form-control" value="John">
                                          <div class="invalid-feedback">
                                            Please fill in the first name
                                          </div>
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                          <label>Last Name</label>
                                          <input type="text" class="form-control" value="Deo">
                                          <div class="invalid-feedback">
                                            Please fill in the last name
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="form-group col-md-7 col-12">
                                          <label>Email</label>
                                          <input type="email" class="form-control" value="test@example.com">
                                          <div class="invalid-feedback">
                                            Please fill in the email
                                          </div>
                                        </div>
                                        <div class="form-group col-md-5 col-12">
                                          <label>Phone</label>
                                          <input type="tel" class="form-control" value="">
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="form-group col-12">
                                          <label>Bio</label>
                                          <textarea class="form-control summernote-simple" style="display: none;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur voluptatum alias molestias minus quod dignissimos.</textarea><div class="note-editor note-frame card"><div class="note-dropzone">  <div class="note-dropzone-message"></div></div><div class="note-toolbar-wrapper"><div class="note-toolbar card-header"><div class="note-btn-group btn-group note-style"><button type="button" class="note-btn btn btn-light btn-sm note-btn-bold" tabindex="-1" title="" data-original-title="Bold (CTRL+B)"><i class="note-icon-bold"></i></button><button type="button" class="note-btn btn btn-light btn-sm note-btn-italic" tabindex="-1" title="" data-original-title="Italic (CTRL+I)"><i class="note-icon-italic"></i></button><button type="button" class="note-btn btn btn-light btn-sm note-btn-underline" tabindex="-1" title="" data-original-title="Underline (CTRL+U)"><i class="note-icon-underline"></i></button><button type="button" class="note-btn btn btn-light btn-sm" tabindex="-1" title="" data-original-title="Remove Font Style (CTRL+\)"><i class="note-icon-eraser"></i></button></div><div class="note-btn-group btn-group note-font"><button type="button" class="note-btn btn btn-light btn-sm note-btn-strikethrough" tabindex="-1" title="" data-original-title="Strikethrough (CTRL+SHIFT+S)"><i class="note-icon-strikethrough"></i></button></div><div class="note-btn-group btn-group note-para"><div class="note-btn-group btn-group"><button type="button" class="note-btn btn btn-light btn-sm dropdown-toggle" tabindex="-1" data-toggle="dropdown" title="" data-original-title="Paragraph"><i class="note-icon-align-left"></i></button><div class="dropdown-menu"><div class="note-btn-group btn-group note-align"><button type="button" class="note-btn btn btn-light btn-sm" tabindex="-1" title="" data-original-title="Align left (CTRL+SHIFT+L)"><i class="note-icon-align-left"></i></button><button type="button" class="note-btn btn btn-light btn-sm" tabindex="-1" title="" data-original-title="Align center (CTRL+SHIFT+E)"><i class="note-icon-align-center"></i></button><button type="button" class="note-btn btn btn-light btn-sm" tabindex="-1" title="" data-original-title="Align right (CTRL+SHIFT+R)"><i class="note-icon-align-right"></i></button><button type="button" class="note-btn btn btn-light btn-sm" tabindex="-1" title="" data-original-title="Justify full (CTRL+SHIFT+J)"><i class="note-icon-align-justify"></i></button></div><div class="note-btn-group btn-group note-list"><button type="button" class="note-btn btn btn-light btn-sm" tabindex="-1" title="" data-original-title="Outdent (CTRL+[)"><i class="note-icon-align-outdent"></i></button><button type="button" class="note-btn btn btn-light btn-sm" tabindex="-1" title="" data-original-title="Indent (CTRL+])"><i class="note-icon-align-indent"></i></button></div></div></div></div></div></div><div class="note-editing-area"><div class="note-handle"><div class="note-control-selection"><div class="note-control-selection-bg"></div><div class="note-control-holder note-control-nw"></div><div class="note-control-holder note-control-ne"></div><div class="note-control-holder note-control-sw"></div><div class="note-control-sizing note-control-se"></div><div class="note-control-selection-info"></div></div></div><textarea class="note-codable"></textarea><div class="note-editable card-block" contenteditable="true" style="min-height: 150px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur voluptatum alias molestias minus quod dignissimos.</div></div><div class="note-statusbar">  <div class="note-resizebar">    <div class="note-icon-bar"></div>    <div class="note-icon-bar"></div>    <div class="note-icon-bar"></div>  </div></div></div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="form-group mb-0 col-12">
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="remember" class="custom-control-input" id="newsletter">
                                            <label class="custom-control-label" for="newsletter">Subscribe to newsletter</label>
                                            <div class="text-muted form-text">
                                              You will get new information about products, offers and promotions
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="card-footer text-right">
                                      <button class="btn btn-primary">Save Changes</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
            </div>

            <div class="modal-footer br">
                <hr>

                <button type="button" class="btn btn-secondary text-dark" data-dismiss="modal">
                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                    Fechar
                </button>

                @if(!$class->finished)

                <a class="btn btn-danger text-white open-view"
                    href="{{ route('calendar.edit', [$class, 'action=absense']) }}">
                    <i class="fas fa-user-times"></i>
                    Registrar Falta
                </a>

                <a class="btn  btn-success open-view" href="{{ route('calendar.edit', [$class, 'action=presence']) }}">
                    <i class="fas fa-user-check    "></i>
                    Registrar Presença
                </a>

                @else

                <a class="btn btn-primary text-white"
                    href="{{ route('class.edit', $class) }}">
                    <i class="fas fa-edit    "></i>
                    Editar Aula
                </a>

                @endif

            </div>

        </div>
    </div>



    <script>
        // $('body').getNiceScroll().remove();
        // $(".scroll").niceScroll();
        // $(".scroll").getNiceScroll().resize();
        

        $('.open-view').click(function (e) { 
            e.preventDefault();
            $('#context').remove()
            $.ajax({
                type: "get",
                url: $(this).attr('href'),
                success: function (response) {
                    showModal(response)
                }
            });
        }); 
    
        $('.reset-class').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                type: "post",
                url: 'class/'+id+'/reset',
                data: {
                    _method: 'put',
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    $('#modelId').modal('hide')
                    refreshCalendar();
                }
            });
        });
    
        // $('#btn-remark').click(function (e) { 
        //     // e.preventDefault();
        //     // setRemark(true, $(this).attr('href'))
        //     // $('#modelId').modal('hide')

        //     $.ajax({
        //         url: 'calendar/remark/',
        //         success: function(doc) {


        //             showModal(doc)

            
        //         }
        //     });
        // });
    
    </script>
</div>